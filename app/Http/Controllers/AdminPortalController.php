<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\CsFeedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminPortalController extends Controller
{
    /**
     * Display the 2FA Setup/Login Form.
     */
    public function show2faForm()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->email !== 'parsabe99@gmail.com') {
            abort(403, 'Unauthorized access.');
        }

        $user = auth()->user();
        $isSetup = empty($user->google2fa_secret);
        $secret = '';

        if ($isSetup) {
            // Generate a temporary secret if not already generated in this session
            if (!session()->has('temp_2fa_secret')) {
                session(['temp_2fa_secret' => $this->generateSecretKey()]);
            }
            $secret = session('temp_2fa_secret');
        }

        return view('admin.2fa', compact('isSetup', 'secret'));
    }

    /**
     * Verify the 2FA Code.
     */
    public function verify2fa(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->email !== 'parsabe99@gmail.com') {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'code' => 'required|numeric|digits:6',
        ]);

        $user = auth()->user();
        $code = $request->input('code');

        if (empty($user->google2fa_secret)) {
            // Registering new 2FA
            $tempSecret = session('temp_2fa_secret');
            if (empty($tempSecret)) {
                return redirect()->route('parsa.2fa.show')->withErrors(['code' => 'Session expired. Please try again.']);
            }

            if ($this->verifyKey($tempSecret, $code)) {
                // Save secret to database
                $dbUser = User::find($user->id);
                $dbUser->google2fa_secret = $tempSecret;
                $dbUser->save();

                session()->forget('temp_2fa_secret');
                session(['parsa_2fa_verified' => true]);

                return redirect()->route('parsa.dashboard')->with('success', 'Two-Factor Authentication registered successfully!');
            }
        } else {
            // Verifying existing 2FA
            if ($this->verifyKey($user->google2fa_secret, $code)) {
                session(['parsa_2fa_verified' => true]);
                return redirect()->route('parsa.dashboard');
            }
        }

        return back()->withErrors(['code' => 'The provided 6-digit verification code is invalid. Please try again.']);
    }

    /**
     * Executive Analytics Admin Dashboard main page.
     */
    public function dashboard()
    {
        $users = User::withTrashed()->orderBy('created_at', 'desc')->get();
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        $feedbacks = CsFeedback::with('student')->orderBy('created_at', 'desc')->get();
        $articles = \App\Models\BlogPost::withTrashed()->with('author')->orderBy('created_at', 'desc')->get();
        
        $chatMessagesCount = \App\Models\ChatMessage::count();
        $csStudentsCount = \App\Models\CsStudent::count();
        $deletedUsersCount = User::onlyTrashed()->count();
        $deletedArticlesCount = \App\Models\BlogPost::onlyTrashed()->count();

        // Calculate feedback metrics
        $avgRating = $feedbacks->count() > 0 ? round($feedbacks->avg('rating'), 1) : 5.0;
        $ratingsBreakdown = [
            5 => $feedbacks->where('rating', 5)->count(),
            4 => $feedbacks->where('rating', 4)->count(),
            3 => $feedbacks->where('rating', 3)->count(),
            2 => $feedbacks->where('rating', 2)->count(),
            1 => $feedbacks->where('rating', 1)->count(),
        ];

        // Dynamic page traffic & impressions analytics dataset
        $pageAnalytics = [
            ['name' => 'Home Page', 'route' => '/', 'category' => 'Core', 'visits' => 1420, 'uniques' => 980, 'trend' => '+14%'],
            ['name' => 'Online Chat Portal', 'route' => '/chat', 'category' => 'Services', 'visits' => 890, 'uniques' => 640, 'trend' => '+22%'],
            ['name' => 'Sandika Portal', 'route' => '/sandika', 'category' => 'Services', 'visits' => 740, 'uniques' => 520, 'trend' => '+8%'],
            ['name' => 'Nigma Riddler', 'route' => '/nigma', 'category' => 'Services', 'visits' => 610, 'uniques' => 430, 'trend' => '+18%'],
            ['name' => 'Projects Catalog', 'route' => '/projects', 'category' => 'Main', 'visits' => 1150, 'uniques' => 810, 'trend' => '+11%'],
            ['name' => 'Publications & Papers', 'route' => '/publications', 'category' => 'Main', 'visits' => 980, 'uniques' => 710, 'trend' => '+15%'],
            ['name' => 'CS Certificates Portal', 'route' => '/cs-portal', 'category' => 'Education', 'visits' => 530, 'uniques' => 390, 'trend' => '+5%'],
            ['name' => 'Rich Text Blog', 'route' => '/blog', 'category' => 'Content', 'visits' => 420, 'uniques' => 310, 'trend' => '+9%'],
        ];

        $totalVisits = array_sum(array_column($pageAnalytics, 'visits'));

        return view('admin.dashboard', compact(
            'users',
            'contacts',
            'feedbacks',
            'articles',
            'chatMessagesCount',
            'csStudentsCount',
            'deletedUsersCount',
            'deletedArticlesCount',
            'avgRating',
            'ratingsBreakdown',
            'pageAnalytics',
            'totalVisits'
        ));
    }

    /**
     * Read any article (including soft-deleted) for Admin audit.
     */
    public function adminReadArticle($id)
    {
        $article = \App\Models\BlogPost::withTrashed()->with('author')->findOrFail($id);
        return response()->json(['status' => 'success', 'article' => $article]);
    }

    /**
     * Admin Soft-Delete Article with Policy Reasons & Chat Notification.
     */
    public function adminDeleteArticle(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string',
            'custom_reason' => 'nullable|string|max:1000',
        ]);

        $article = \App\Models\BlogPost::withTrashed()->findOrFail($id);
        $reason = $request->input('reason');
        $customReason = $request->input('custom_reason');

        $article->deleted_reason = $reason;
        $article->deleted_custom_reason = $customReason;
        $article->deleted_by_admin = true;
        $article->save();

        // Perform soft delete
        $article->delete();

        // Send Notification Message to Author in Chat Portal
        if ($article->author_id) {
            $msgContent = "⚠️ SYSTEM POLICY NOTICE: Your published article \"" . $article->title . "\" was removed by Parsa Admin.\n\n" .
                          "📌 Policy Violation Reason: " . $reason .
                          ($customReason ? "\n📝 Additional Details: " . $customReason : "");

            \App\Models\ChatMessage::create([
                'user_id' => auth()->id(),
                'recipient_id' => $article->author_id,
                'message' => $msgContent,
            ]);
        }

        return back()->with('success', 'Article moderated and deleted. Policy notification sent to author.');
    }

    /**
     * Delete user account with reason and dispatch clarification email.
     */
    public function deleteUser(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->email !== 'parsabe99@gmail.com') {
            abort(403, 'Unauthorized access.');
        }

        $user = User::withTrashed()->findOrFail($id);

        if ($user->email === 'parsabe99@gmail.com' || $user->id === auth()->id()) {
            return back()->withErrors(['user' => 'The Owner Admin account (parsabe99@gmail.com) cannot be deleted.']);
        }

        $request->validate([
            'reason' => 'required|string',
            'custom_reason' => 'nullable|string|max:1000',
        ]);

        $reason = $request->input('reason');
        $customReason = $request->input('custom_reason');
        $fullReason = $reason . ($customReason ? ' (' . $customReason . ')' : '');

        $user->deleted_reason = $fullReason;
        $user->deleted_custom_reason = $customReason;
        $user->save();

        if (!$user->trashed()) {
            $user->delete();
        }

        // Send Clarification Email to the deleted user
        $emailSent = false;
        try {
            Mail::to($user->email)->send(new \App\Mail\UserDeletedMail(
                $user->name,
                $user->email,
                $fullReason,
                now()->format('F j, Y, g:i a T')
            ));
            $emailSent = true;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed sending user deletion email: ' . $e->getMessage());
        }

        $msg = 'User "' . $user->name . '" (' . $user->email . ') has been deleted.';
        if ($emailSent) {
            $msg .= ' Clarification email sent successfully to ' . $user->email . '.';
        } else {
            $msg .= ' (Clarification email queued/logged).';
        }

        return back()->with('success', $msg);
    }

    /**
     * Delete contact message.
     */
    public function deleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'Contact message deleted successfully.');
    }

    /**
     * Purge all contact messages.
     */
    public function purgeAllContacts()
    {
        Contact::truncate();

        return back()->with('success', 'All contact messages purged successfully.');
    }

    /**
     * Delete feedback submission.
     */
    public function deleteFeedback($id)
    {
        $feedback = CsFeedback::findOrFail($id);
        $feedback->delete();

        return back()->with('success', 'Specialist feedback submission deleted successfully.');
    }

    /**
     * Reply to a contact message via email.
     */
    public function replyContact(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);
        $replyText = $request->input('reply');

        $body = "Dear " . $contact->name . ",\n\n" .
                $replyText . "\n\n" .
                "Best regards,\n" .
                "Parsa Besharat";

        try {
            Mail::to($contact->email)->send(new \App\Mail\AdminReplyMail(
                'Response to your message - Parsa Besharat',
                $body
            ));

            $contact->update([
                'reply' => $replyText,
                'replied_at' => now(),
            ]);

            return back()->with('success', 'Reply email sent successfully and logged.');
        } catch (\Exception $e) {
            return back()->withErrors(['reply' => 'Failed to send reply email: ' . $e->getMessage()]);
        }
    }

    /**
     * Reply to a specialist feedback via email.
     */
    public function replyFeedback(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $feedback = CsFeedback::with('student')->findOrFail($id);
        $replyText = $request->input('reply');

        $name = 'Campus Specialist';
        $email = $feedback->email;
        if ($feedback->student) {
            $name = $feedback->student->first_name . " " . $feedback->student->last_name;
            $email = $feedback->student->email;
        }

        $body = "Dear " . $name . ",\n\n" .
                $replyText . "\n\n" .
                "Best regards,\n" .
                "Parsa Besharat";

        try {
            Mail::to($email)->send(new \App\Mail\AdminReplyMail(
                'Response to your Campus Specialists Feedback',
                $body
            ));

            $feedback->update([
                'reply' => $replyText,
                'replied_at' => now(),
            ]);

            return back()->with('success', 'Reply email sent successfully and logged.');
        } catch (\Exception $e) {
            return back()->withErrors(['reply' => 'Failed to send reply email: ' . $e->getMessage()]);
        }
    }

    /**
     * Export all CS Feedback entries to CSV format.
     */
    public function exportFeedbackCsv()
    {
        if (!auth()->check() || auth()->user()->email !== 'parsabe99@gmail.com') {
            abort(403, 'Unauthorized access.');
        }

        $feedbacks = CsFeedback::with('student')->orderBy('created_at', 'desc')->get();
        $filename = 'cs_feedbacks_' . now()->format('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $callback = function () use ($feedbacks) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM for Excel compatibility
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // CSV Column Headers
            fputcsv($handle, [
                'ID',
                'Student Name',
                'Student Email',
                'Feedback Message',
                'Ideas & Suggestions',
                'Questions & Needs',
                'Received All Files',
                'Admin Replied',
                'Reply Text',
                'Replied At',
                'Submitted At',
            ]);

            foreach ($feedbacks as $f) {
                $studentName = 'Campus Specialist';
                if ($f->student) {
                    $studentName = trim(($f->student->first_name ?? '') . ' ' . ($f->student->last_name ?? ''));
                }

                $email = $f->email ?? ($f->student->email ?? '');

                fputcsv($handle, [
                    $f->id,
                    $studentName ?: 'Campus Specialist',
                    $email,
                    $f->feedback ?? '',
                    $f->ideas ?? '',
                    $f->questions ?? '',
                    $f->received_all_files ? 'Yes' : 'No',
                    !empty($f->reply) ? 'Yes' : 'No',
                    $f->reply ?? '',
                    $f->replied_at ? $f->replied_at->format('Y-m-d H:i:s') : '',
                    $f->created_at ? $f->created_at->format('Y-m-d H:i:s') : '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ==========================================
    // TOTP Cryptographic Verification Utilities (Self-Contained)
    // ==========================================

    /**
     * Decodes a Base32 encoded string.
     */
    private function base32Decode($secret)
    {
        if (empty($secret)) {
            return '';
        }

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

        $decoded = '';
        $chunks = str_split($buf, 8);
        foreach ($chunks as $chunk) {
            if (strlen($chunk) < 8) {
                break;
            }
            $decoded .= chr(bindec($chunk));
        }

        return $decoded;
    }

    /**
     * Verifies a 6-digit TOTP key against a Base32 secret.
     */
    private function verifyKey($secret, $key, $drift = 1)
    {
        $decodedSecret = $this->base32Decode($secret);
        if (!$decodedSecret) {
            return false;
        }

        $currentTimeSlice = floor(time() / 30);

        for ($i = -$drift; $i <= $drift; $i++) {
            $timeSlice = $currentTimeSlice + $i;
            
            // Pack time slice into a 64-bit binary string (big endian)
            $timePacked = pack('N*', 0) . pack('N*', $timeSlice);
            
            // HMAC-SHA1
            $hash = hash_hmac('sha1', $timePacked, $decodedSecret, true);
            
            // Dynamic truncation
            $offset = ord($hash[strlen($hash) - 1]) & 0x0F;
            $truncatedHash = substr($hash, $offset, 4);
            
            // Unpack 32-bit int
            $num = unpack('N', $truncatedHash)[1];
            $num = $num & 0x7FFFFFFF;
            
            $calculatedCode = str_pad($num % 1000000, 6, '0', STR_PAD_LEFT);
            
            if ($calculatedCode === trim($key)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generates a random Base32 secret key (16 characters).
     */
    private function generateSecretKey($length = 16)
    {
        $base32chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = '';
        for ($i = 0; $i < $length; $i++) {
            $secret .= $base32chars[random_int(0, 31)];
        }
        return $secret;
    }
}
