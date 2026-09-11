<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\CsFeedback;
use App\Models\CsStudent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminPortalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }

    /**
     * Test guest is redirected.
     */
    public function test_guest_is_redirected_to_login()
    {
        $response = $this->get(route('parsa.dashboard'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test non-admin receives 403.
     */
    public function test_non_admin_receives_403()
    {
        $user = User::factory()->create(['email' => 'user@example.com']);
        
        $response = $this->actingAs($user)->get(route('parsa.dashboard'));
        $response->assertStatus(403);
    }

    /**
     * Test admin without 2FA is redirected to 2FA setup/verify.
     */
    public function test_admin_without_2fa_is_redirected_to_2fa_page()
    {
        $admin = User::factory()->create(['email' => 'parsabe99@gmail.com']);

        $response = $this->actingAs($admin)->get(route('parsa.dashboard'));
        $response->assertRedirect(route('parsa.2fa.show'));
    }

    /**
     * Test 2FA setup screen generates a temporary secret.
     */
    public function test_2fa_setup_screen_generates_secret()
    {
        $admin = User::factory()->create(['email' => 'parsabe99@gmail.com', 'google2fa_secret' => null]);

        $response = $this->actingAs($admin)->get(route('parsa.2fa.show'));
        $response->assertStatus(200);
        $response->assertSee('INITIALIZE_2FA');
        $this->assertTrue(session()->has('temp_2fa_secret'));
    }

    /**
     * Test verifying invalid code fails.
     */
    public function test_invalid_2fa_code_fails()
    {
        $admin = User::factory()->create(['email' => 'parsabe99@gmail.com', 'google2fa_secret' => 'SECRETKEY32CHARS']);

        $response = $this->actingAs($admin)->post(route('parsa.2fa.verify'), [
            'code' => '000000',
        ]);

        $response->assertSessionHasErrors(['code']);
        $this->assertNotEquals(true, session('parsa_2fa_verified'));
    }

    /**
     * Test verifying valid code succeeds (2FA login & setup flows).
     */
    public function test_valid_2fa_code_succeeds_and_allows_dashboard()
    {
        $admin = User::factory()->create(['email' => 'parsabe99@gmail.com', 'google2fa_secret' => null]);
        
        // 1. Visit setup screen to generate session key
        $this->actingAs($admin)->get(route('parsa.2fa.show'));
        $tempSecret = session('temp_2fa_secret');
        $this->assertNotEmpty($tempSecret);

        // Generate correct code for this temporary secret
        $validCode = $this->generateTotpCode($tempSecret);

        // 2. Verify registration
        $response = $this->actingAs($admin)->post(route('parsa.2fa.verify'), [
            'code' => $validCode,
        ]);

        $response->assertRedirect(route('parsa.dashboard'));
        $this->assertEquals(true, session('parsa_2fa_verified'));

        // Secret should be persisted in DB now
        $admin->refresh();
        $this->assertEquals($tempSecret, $admin->google2fa_secret);

        // 3. Admin dashboard should load successfully
        $dashboardResponse = $this->actingAs($admin)->get(route('parsa.dashboard'));
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('CENTRAL_DATABASE_NODE');
    }

    /**
     * Test deleting a contact.
     */
    public function test_admin_can_delete_contact()
    {
        $admin = User::factory()->create(['email' => 'parsabe99@gmail.com', 'google2fa_secret' => 'SECRET']);
        $contact = Contact::create(['name' => 'John', 'email' => 'john@test.com', 'message' => 'Hello']);

        // With 2FA session
        $response = $this->actingAs($admin)
            ->withSession(['parsa_2fa_verified' => true])
            ->post(route('parsa.contact.delete', $contact->id));

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    /**
     * Test replying to contact message via email.
     */
    public function test_admin_can_reply_contact()
    {
        $admin = User::factory()->create(['email' => 'parsabe99@gmail.com', 'google2fa_secret' => 'SECRET']);
        $contact = Contact::create(['name' => 'John', 'email' => 'john@test.com', 'message' => 'Hello']);

        $response = $this->actingAs($admin)
            ->withSession(['parsa_2fa_verified' => true])
            ->post(route('parsa.contact.reply', $contact->id), [
                'reply' => 'This is my email response.',
            ]);

        $response->assertSessionHasNoErrors();
        $contact->refresh();
        $this->assertEquals('This is my email response.', $contact->reply);
        $this->assertNotNull($contact->replied_at);

        Mail::assertSent(\App\Mail\AdminReplyMail::class, function ($mail) {
            return $mail->hasTo('john@test.com') && 
                   $mail->subjectLine === 'Response to your message - Parsa Besharat';
        });
    }

    /**
     * Test replying to attendee feedback.
     */
    public function test_admin_can_reply_feedback_for_attendee()
    {
        $admin = User::factory()->create(['email' => 'parsabe99@gmail.com', 'google2fa_secret' => 'SECRET']);
        $student = CsStudent::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@test.com',
        ]);
        $feedback = CsFeedback::create([
            'cs_student_id' => $student->id,
            'email' => 'jane@test.com',
            'ideas' => 'Idea text',
            'feedback' => 'Feedback text',
        ]);

        $response = $this->actingAs($admin)
            ->withSession(['parsa_2fa_verified' => true])
            ->post(route('parsa.feedback.reply', $feedback->id), [
                'reply' => 'Jane reply.',
            ]);

        $response->assertSessionHasNoErrors();
        $feedback->refresh();
        $this->assertEquals('Jane reply.', $feedback->reply);
        $this->assertNotNull($feedback->replied_at);

        Mail::assertSent(\App\Mail\AdminReplyMail::class, function ($mail) {
            return $mail->hasTo('jane@test.com') && 
                   $mail->subjectLine === 'Response to your Campus Specialists Feedback';
        });
    }

    /**
     * Test replying to non-attendee feedback.
     */
    public function test_admin_can_reply_feedback_for_non_attendee()
    {
        $admin = User::factory()->create(['email' => 'parsabe99@gmail.com', 'google2fa_secret' => 'SECRET']);
        $feedback = CsFeedback::create([
            'cs_student_id' => null,
            'email' => 'non_attendee@test.com',
            'ideas' => 'Idea text',
            'feedback' => 'Feedback text',
        ]);

        $response = $this->actingAs($admin)
            ->withSession(['parsa_2fa_verified' => true])
            ->post(route('parsa.feedback.reply', $feedback->id), [
                'reply' => 'Non-attendee reply.',
            ]);

        $response->assertSessionHasNoErrors();
        $feedback->refresh();
        $this->assertEquals('Non-attendee reply.', $feedback->reply);
        $this->assertNotNull($feedback->replied_at);

        Mail::assertSent(\App\Mail\AdminReplyMail::class, function ($mail) {
            return $mail->hasTo('non_attendee@test.com') && 
                   $mail->subjectLine === 'Response to your Campus Specialists Feedback';
        });
    }

    /**
     * Test purging all contacts.
     */
    public function test_admin_can_purge_all_contacts()
    {
        $admin = User::factory()->create(['email' => 'parsabe99@gmail.com', 'google2fa_secret' => 'SECRET']);
        Contact::create(['name' => 'John', 'email' => 'john@test.com', 'message' => 'Hello 1']);
        Contact::create(['name' => 'Jane', 'email' => 'jane@test.com', 'message' => 'Hello 2']);

        // Verify database has 2 contacts
        $this->assertDatabaseCount('contacts', 2);

        // Perform purge
        $response = $this->actingAs($admin)
            ->withSession(['parsa_2fa_verified' => true])
            ->post(route('parsa.contacts.purge-all'));

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseCount('contacts', 0);
    }

    /**
     * Test admin can export CS feedback to CSV.
     */
    public function test_admin_can_export_cs_feedback_to_csv()
    {
        $admin = User::factory()->create(['email' => 'parsabe99@gmail.com', 'google2fa_secret' => 'SECRET']);
        
        $student = CsStudent::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
        ]);

        CsFeedback::create([
            'cs_student_id' => $student->id,
            'email' => 'john.doe@example.com',
            'feedback' => 'Great experience!',
            'ideas' => 'Add more tutorials',
            'questions' => 'None',
            'received_all_files' => true,
        ]);

        $response = $this->actingAs($admin)
            ->withSession(['parsa_2fa_verified' => true])
            ->get(route('parsa.feedback.export_csv'));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('attachment; filename="cs_feedbacks_', $response->headers->get('Content-Disposition'));
        
        $content = $response->streamedContent();
        $this->assertStringContainsString('Student Name', $content);
        $this->assertStringContainsString('John Doe', $content);
        $this->assertStringContainsString('john.doe@example.com', $content);
        $this->assertStringContainsString('Great experience!', $content);
    }

    // ==========================================
    // Helper to generate TOTP code dynamically for testing
    // ==========================================
    private function generateTotpCode($secret)
    {
        $base32chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $base32charsFlipped = array_flip(str_split($base32chars));
        $secret = strtoupper($secret);
        $secret = str_replace('=', '', $secret);
        
        $buf = '';
        foreach (str_split($secret) as $char) {
            if (!isset($base32charsFlipped[$char])) {
                continue;
            }
            $buf .= str_pad(decbin($base32charsFlipped[$char]), 5, '0', STR_PAD_LEFT);
        }

        $decodedSecret = '';
        $chunks = str_split($buf, 8);
        foreach ($chunks as $chunk) {
            if (strlen($chunk) < 8) {
                break;
            }
            $decodedSecret .= chr(bindec($chunk));
        }

        $timeSlice = floor(time() / 30);
        $timePacked = pack('N*', 0) . pack('N*', $timeSlice);
        $hash = hash_hmac('sha1', $timePacked, $decodedSecret, true);
        $offset = ord($hash[strlen($hash) - 1]) & 0x0F;
        $truncatedHash = substr($hash, $offset, 4);
        $num = unpack('N', $truncatedHash)[1];
        $num = $num & 0x7FFFFFFF;
        return str_pad($num % 1000000, 6, '0', STR_PAD_LEFT);
    }
}
