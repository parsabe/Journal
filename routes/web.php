<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; // <--- 1. Import the Class

use App\Http\Controllers\ContactController; // <-- Don't forget to import this!
use App\Http\Controllers\ChatController;

use Spatie\Sitemap\SitemapGenerator;

Route::get('/generate-sitemap', function () {
    SitemapGenerator::create('https://parsabe.com')->writeToFile(public_path('sitemap.xml'));
    return 'Sitemap generated!';
});
// ==========================================
// Independent Routes & Closures
// ==========================================

// Language Switcher Route (EN / DE)
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de'])) {
        session(['app_locale' => $locale]);
    }
    return back();
})->name('lang.switch');

// Contact Form Routes (Moved here so ContactController handles them)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store']);



// ==========================================
// PageController Group
// ==========================================
Route::controller(PageController::class)->group(function () {

    // --- Main Navigation Pages ---
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    // (Removed /contact from here since ContactController handles it now)
    Route::get('/search', 'search')->name('search');
    Route::get('/myplaylist', 'myplaylist')->name('myplaylist');
    Route::get('/vpn', 'VPN_server')->name('vpn-server');
    Route::get('/fun', 'fun')->name('fun');
    Route::get('/support', 'support')->name('support');
    Route::get('/books', 'books')->name('books');

// Sandika Portal Routes
Route::get('/sandika', [App\Http\Controllers\SandikaController::class, 'index'])->name('sandika');
Route::post('/sandika/voice-log', [App\Http\Controllers\SandikaController::class, 'analyzeVoiceLog'])->name('sandika.voice_log');
Route::post('/sandika/file-upload', [App\Http\Controllers\SandikaController::class, 'processFile'])->name('sandika.file_upload');
Route::post('/sandika/story', [App\Http\Controllers\SandikaController::class, 'postStory'])->name('sandika.story');
Route::post('/sandika/dictionary', [App\Http\Controllers\SandikaController::class, 'addDictionaryWord'])->name('sandika.dictionary');
Route::post('/sandika/git', [App\Http\Controllers\SandikaController::class, 'postGitInsight'])->name('sandika.git');
Route::post('/sandika/git/{id}/update', [App\Http\Controllers\SandikaController::class, 'updateGitInsight'])->name('sandika.git.update');
Route::post('/sandika/git/{id}/delete', [App\Http\Controllers\SandikaController::class, 'deleteGitInsight'])->name('sandika.git.delete');
Route::post('/sandika/arkham', [App\Http\Controllers\SandikaController::class, 'solveArkhamSpirit'])->name('sandika.arkham');

// Nigma Riddler Portal Routes
Route::get('/nigma', [App\Http\Controllers\NigmaController::class, 'index'])->name('nigma');
Route::post('/nigma/solve', [App\Http\Controllers\NigmaController::class, 'solve'])->name('nigma.solve');

// Rich Text Blog Routes
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::post('/blog', [App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');
Route::get('/publications/articles/{slug}', [App\Http\Controllers\BlogController::class, 'showArticle'])->name('publications.article.show');

    Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

    // --- Projects ---
    Route::get('/projects', 'projects')->name('projects');
    Route::get('/projects/vectra', 'vectra')->name('projects.vectra');
    Route::get('/projects/vectra-pc-game', 'vectra_pc_game')->name('projects.vectra-pc-game');
    Route::get('/projects/vectra-pc', 'vectra_pc_game')->name('projects.vectra-pc');
    Route::get('/projects/blackwall', [App\Http\Controllers\BlackwallAiController::class, 'index'])->name('projects.blackwall');
    Route::post('/projects/blackwall/chat', [App\Http\Controllers\BlackwallAiController::class, 'sendMessage'])->name('projects.blackwall.chat');
    Route::get('/projects/mlmatrix', 'Mlmatrix')->name('projects.mlmatrix');
    Route::get('/projects/scp', 'SCP')->name('projects.scp');
    Route::get('/projects/ceasartoolkit', 'CeasarToolkit')->name('projects.ceasartoolkit');
    Route::get('/projects/parsai', 'parsai')->name('projects.parsai');
    Route::get('/projects/netnexus', 'netnexus')->name('projects.netnexus');
    Route::get('/projects/hounaartoolkit', 'hounaartoolkit')->name('projects.hounaartoolkit');
    Route::get('/projects/funroot', 'funroot')->name('projects.funroot');
    Route::get('/projects/sandika', 'proj_sandika')->name('projects.sandika');
    Route::get('/projects/aquapulse', 'aquapulse')->name('projects.aquapulse');

    // --- Publications ---
    Route::get('/publications', 'publications')->name('publications');
    Route::get('/publications/vectra-paper', 'vectra_paper')->name('publications.vectra_paper');
    Route::get('/publications/blackwall-paper', 'blackwall_paper')->name('publications.blackwall_paper');
    Route::get('/publications/moodium', 'moodium')->name('publications.moodium');
    Route::get('/publications/scm', 'scm')->name('publications.scm');
    Route::get('/publications/captcha', 'captcha')->name('publications.captcha');
    Route::get('/publications/ai-blockchain', 'ai_blockchain')->name('publications.ai_blockchain');
    Route::get('/publications/synergy-blockchain', 'synergy_blockchain')->name('publications.synergy_blockchain');
    Route::get('/publications/php-vuls', 'php_vuls')->name('publications.php_vuls');
    Route::get('/publications/crm', 'crm')->name('publications.crm');
    Route::get('/publications/qca', 'qca')->name('publications.qca');
    Route::get('/publications/aquapulse', 'aquapulse_paper')->name('publications.aquapulse');
});

// ==========================================
// Online Chat Portal Routes
// ==========================================
Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::get('/chat/messages', [ChatController::class, 'fetchMessages'])->name('chat.messages');
Route::get('/chat/users', [ChatController::class, 'fetchUsers'])->name('chat.users');
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
Route::post('/chat/upload', [ChatController::class, 'uploadFile'])->name('chat.upload');
Route::post('/chat/react', [ChatController::class, 'toggleReaction'])->name('chat.react');
Route::post('/chat/profile', [ChatController::class, 'updateProfile'])->name('chat.profile');
Route::get('/chat/stories', [ChatController::class, 'fetchStories'])->name('chat.stories');
Route::post('/chat/stories', [ChatController::class, 'createStory'])->name('chat.stories.create');
Route::post('/chat/stories/vote', [ChatController::class, 'voteStoryPoll'])->name('chat.stories.vote');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [App\Http\Controllers\ChatController::class, 'myProfilePage'])->name('user.profile.show');
    Route::get('/user/{id}/profile', [App\Http\Controllers\ChatController::class, 'publicProfilePage'])->name('user.public_profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/user/delete-account', [ProfileController::class, 'deleteAccountWithReason'])->name('user.account.delete');
    
    // User Published Articles Management Routes
    Route::get('/user/articles', [App\Http\Controllers\BlogController::class, 'userArticles'])->name('user.articles');
    Route::post('/user/articles/{id}/update', [App\Http\Controllers\BlogController::class, 'updateArticle'])->name('user.articles.update');
    Route::post('/user/articles/{id}/delete', [App\Http\Controllers\BlogController::class, 'deleteArticle'])->name('user.articles.delete');

    // Multiple Profile Headers & Avatars Gallery Routes
    Route::post('/user/profile/select-avatar', [App\Http\Controllers\ChatController::class, 'selectAvatar'])->name('user.profile.select-avatar');
    Route::post('/user/profile/select-header', [App\Http\Controllers\ChatController::class, 'selectHeader'])->name('user.profile.select-header');
    Route::post('/user/profile/delete-avatar', [App\Http\Controllers\ChatController::class, 'deleteAvatarFromGallery'])->name('user.profile.delete-avatar');
    Route::post('/user/profile/delete-header', [App\Http\Controllers\ChatController::class, 'deleteHeaderFromGallery'])->name('user.profile.delete-header');

    // Follow / Unfollow & Profile Stats Routes
    Route::post('/user/{id}/follow', [App\Http\Controllers\ChatController::class, 'toggleFollow'])->name('user.follow.toggle');
    Route::get('/user/{id}/stats', [App\Http\Controllers\ChatController::class, 'getUserStats'])->name('user.stats');

    // Instagram Story Archive & Highlights Routes
    Route::get('/user/stories/archive', [App\Http\Controllers\ChatController::class, 'fetchStoryArchive'])->name('user.stories.archive');
    Route::post('/user/stories/{id}/highlight', [App\Http\Controllers\ChatController::class, 'toggleStoryHighlight'])->name('user.stories.highlight');
    Route::post('/user/story-archives/create', [App\Http\Controllers\ChatController::class, 'createStoryArchive'])->name('user.story-archives.create');
    Route::post('/user/story-archives/{id}/delete', [App\Http\Controllers\ChatController::class, 'deleteStoryArchive'])->name('user.story-archives.delete');

    // Twitter/X User Profile Posts Routes
    Route::post('/user/posts/create', [App\Http\Controllers\ChatController::class, 'createUserPost'])->name('user.posts.create');
    Route::get('/user/{id}/posts', [App\Http\Controllers\ChatController::class, 'fetchUserPosts'])->name('user.posts.fetch');
    Route::get('/user/posts/feed', [App\Http\Controllers\ChatController::class, 'fetchPublicFeedPosts'])->name('user.posts.public-feed');
    Route::post('/user/posts/{id}/like', [App\Http\Controllers\ChatController::class, 'toggleLikeUserPost'])->name('user.posts.like');
    Route::post('/user/posts/{id}/repost', [App\Http\Controllers\ChatController::class, 'toggleRepostUserPost'])->name('user.posts.repost');
    Route::post('/user/posts/{id}/bookmark', [App\Http\Controllers\ChatController::class, 'toggleBookmarkUserPost'])->name('user.posts.bookmark');
    Route::post('/user/posts/{id}/comment', [App\Http\Controllers\ChatController::class, 'addPostComment'])->name('user.posts.comment');
    Route::post('/user/posts/{id}/delete', [App\Http\Controllers\ChatController::class, 'deleteUserPost'])->name('user.posts.delete');
    // Chat Deletion & Erasing & Block Routes
    Route::post('/chat/messages/{id}/delete', [App\Http\Controllers\ChatController::class, 'deleteMessage'])->name('chat.message.delete');
    Route::post('/chat/messages/clear', [App\Http\Controllers\ChatController::class, 'clearChatHistory'])->name('chat.history.clear');
    Route::post('/user/{id}/block', [App\Http\Controllers\ChatController::class, 'toggleBlockUser'])->name('user.block.toggle');
});

// ==========================================
// CS Certificates Download Portal
// ==========================================
Route::get('/cs-portal', [App\Http\Controllers\CsCertificateController::class, 'index'])->name('cs.certificates.index');
Route::post('/cs-portal/search', [App\Http\Controllers\CsCertificateController::class, 'search'])->middleware('throttle:5,1')->name('cs.certificates.search');
Route::post('/cs-portal/clear', [App\Http\Controllers\CsCertificateController::class, 'clear'])->name('cs.certificates.clear');
Route::get('/cs-portal/download/certificate', [App\Http\Controllers\CsCertificateController::class, 'downloadCertificate'])->name('cs.certificates.download');
Route::get('/cs-portal/download/images', [App\Http\Controllers\CsCertificateController::class, 'downloadImages'])->name('cs.certificates.download-images');

// ==========================================
// CS Feedback Portal
// ==========================================
Route::get('/cs-portal/feedback', [App\Http\Controllers\CsFeedbackController::class, 'create'])->name('cs.feedback.create');
Route::post('/cs-portal/feedback', [App\Http\Controllers\CsFeedbackController::class, 'store'])->name('cs.feedback.store');
Route::post('/cs-portal/feedback/verify', [App\Http\Controllers\CsFeedbackController::class, 'verifyEmail'])->name('cs.feedback.verify');
Route::post('/cs-portal/feedback/reset', [App\Http\Controllers\CsFeedbackController::class, 'resetSession'])->name('cs.feedback.reset');

// ==========================================
// Admin Portal (/parsa) with 2FA Protection
// ==========================================
Route::get('/parsa/2fa', [App\Http\Controllers\AdminPortalController::class, 'show2faForm'])->name('parsa.2fa.show');
Route::post('/parsa/2fa/verify', [App\Http\Controllers\AdminPortalController::class, 'verify2fa'])->name('parsa.2fa.verify');

Route::middleware(['auth', 'admin.2fa'])->group(function () {
    Route::get('/parsa', [App\Http\Controllers\AdminPortalController::class, 'dashboard'])->name('parsa.dashboard');
    Route::post('/parsa/contact/{id}/reply', [App\Http\Controllers\AdminPortalController::class, 'replyContact'])->name('parsa.contact.reply');
    Route::post('/parsa/contact/{id}/delete', [App\Http\Controllers\AdminPortalController::class, 'deleteContact'])->name('parsa.contact.delete');
    Route::post('/parsa/contacts/purge-all', [App\Http\Controllers\AdminPortalController::class, 'purgeAllContacts'])->name('parsa.contacts.purge-all');
    Route::get('/parsa/feedback/export-csv', [App\Http\Controllers\AdminPortalController::class, 'exportFeedbackCsv'])->name('parsa.feedback.export_csv');
    Route::post('/parsa/feedback/{id}/reply', [App\Http\Controllers\AdminPortalController::class, 'replyFeedback'])->name('parsa.feedback.reply');
    Route::post('/parsa/feedback/{id}/delete', [App\Http\Controllers\AdminPortalController::class, 'deleteFeedback'])->name('parsa.feedback.delete');
    Route::post('/parsa/article/{id}/delete', [App\Http\Controllers\AdminPortalController::class, 'adminDeleteArticle'])->name('parsa.article.delete');
    Route::get('/parsa/article/{id}', [App\Http\Controllers\AdminPortalController::class, 'adminReadArticle'])->name('parsa.article.read');
    Route::post('/parsa/user/{id}/delete', [App\Http\Controllers\AdminPortalController::class, 'deleteUser'])->name('parsa.user.delete');
});

require __DIR__ . '/auth.php';

