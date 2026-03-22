<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\ContactController;

use App\Models\Setting;

// Get Dynamic Tutorial Videos / Gallery Slug
$tutorialVideosPageSlug = 'gallery';
try {
    if (Schema::hasTable('settings')) {
        $tutorialVideosPageSetting = Setting::where('key', 'tutorial_videos_page_settings')->first();
        if ($tutorialVideosPageSetting && isset($tutorialVideosPageSetting->value['page_slug'])) {
            $tutorialVideosPageSlug = $tutorialVideosPageSetting->value['page_slug'];
        }
    }
} catch (\Exception $e) {
    // Fallback to gallery
}

// Main Pages
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/products', [App\Http\Controllers\PublicController::class, 'products'])->name('products.index');
Route::get('/services', [App\Http\Controllers\PublicController::class, 'services'])->name('services.index');

// Dynamic Tutorial Videos / Gallery Route
Route::get('/' . $tutorialVideosPageSlug, [App\Http\Controllers\PublicController::class, 'tutorialVideos'])->name('tutorial-videos.index');

Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Product Detail Pages
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/{slug}', [PublicController::class, 'showProduct'])->name('show');
});

// Service Detail Pages
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/{slug}', [PublicController::class, 'showService'])->name('show');
});

use App\Http\Controllers\Admin\TutorialVideoController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

// Admin Routes (Protected)
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () use ($tutorialVideosPageSlug) {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/update-ui-setting', [AdminController::class, 'updateUiSetting'])->name('update-ui-setting');
    Route::resource('products', ProductController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('tutorial-videos', TutorialVideoController::class);

    // Profile
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Messages
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{message}/reply', [AdminMessageController::class, 'reply'])->name('messages.reply');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

    // Traffic Analysis
    Route::get('/traffic', [App\Http\Controllers\Admin\TrafficController::class, 'index'])->name('traffic.index');

    // Settings
    Route::get('/settings/about', [SettingController::class, 'about'])->name('settings.about');
    Route::get('/settings/product-main', [SettingController::class, 'productMain'])->name('settings.product-main');
    Route::post('/settings/product-main', [SettingController::class, 'updateProductMain'])->name('settings.product-main.update');
    Route::get('/settings/services-main', [SettingController::class, 'servicesMain'])->name('settings.services-main');
    Route::post('/settings/services-main', [SettingController::class, 'updateServicesMain'])->name('settings.services-main.update');
    Route::get('/settings/' . $tutorialVideosPageSlug, [SettingController::class, 'tutorialVideosPage'])->name('settings.tutorial-videos');
    Route::post('/settings/' . $tutorialVideosPageSlug, [SettingController::class, 'updateTutorialVideosPage'])->name('settings.tutorial-videos.update');
    Route::post('/settings/about', [SettingController::class, 'updateAbout'])->name('settings.about.update');
    Route::get('/settings/general', [SettingController::class, 'general'])->name('settings.general');
    Route::post('/settings/general', [SettingController::class, 'updateGeneral'])->name('settings.general.update');
});

require __DIR__.'/auth.php';
