<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

use App\Models\Setting;
use App\Models\Message;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RedirectIfAuthenticated::redirectUsing(function () {
            return route('admin.dashboard');
        });

        // Use a static variable to avoid multiple table checks
        static $hasSettingsTable = null;
        if ($hasSettingsTable === null) {
            $hasSettingsTable = Schema::hasTable('settings');
        }

        if ($hasSettingsTable) {
            $generalSetting = Setting::where('key', 'general_settings')->first();
            if ($generalSetting && is_array($generalSetting->value)) {
                $data = $generalSetting->value;
                if (isset($data['mail_host'])) {
                     config([
                        'mail.default' => $data['mail_mailer'] ?? 'smtp',
                        'mail.mailers.smtp.host' => $data['mail_host'],
                        'mail.mailers.smtp.port' => $data['mail_port'],
                        'mail.mailers.smtp.username' => $data['mail_username'],
                        'mail.mailers.smtp.password' => $data['mail_password'],
                        'mail.mailers.smtp.encryption' => $data['mail_encryption'],
                        'mail.from.address' => $data['mail_from_address'],
                        'mail.from.name' => $data['mail_from_name'],
                    ]);
                }
            }
        }

        // Share common data across layouts only, not every single view
        View::composer(['layouts.*', 'admin.*', 'home', 'about', 'products', 'services', 'contact', 'tutorial-videos.*'], function ($view) {
            static $sharedData = null;
            
            if ($sharedData === null) {
                $generalSetting = Setting::where('key', 'general_settings')->first();
                $generalData = $generalSetting ? $generalSetting->value : [
                    'site_name' => 'SD Gases',
                    'contact_email' => 'info@sdgases.com.np',
                    'contact_phone' => '+977-1-5421122',
                    'address' => 'Patan Dhoka, Lalitpur, Nepal',
                    'inner_hero_image' => null,
                ];

                $tutorialVideosPageSetting = Setting::where('key', 'tutorial_videos_page_settings')->first();
                $tutorialVideosPageData = $tutorialVideosPageSetting ? $tutorialVideosPageSetting->value : [
                    'is_enabled' => true,
                    'page_title' => 'Gallery',
                    'page_slug' => 'gallery',
                    'hero_title' => 'Gallery',
                    'hero_subtitle' => 'Explore our gallery of images and videos related to our oxygen systems and equipment.',
                ];

                $unreadMessagesCount = 0;
                if (Schema::hasTable('messages')) {
                    $unreadMessagesCount = Message::whereNull('replied_at')->count();
                }

                $sharedData = [
                    'generalData' => $generalData,
                    'tutorialVideosPageData' => $tutorialVideosPageData,
                    'unreadMessagesCount' => $unreadMessagesCount,
                ];
            }

            $view->with($sharedData);
        });

        View::composer(['layouts.header', 'layouts.footer'], function ($view) {
            static $menuData = null;
            
            if ($menuData === null) {
                $menuProducts = Product::where('status', true)
                    ->orderBy('title')
                    ->get();

                $menuServices = Service::where('status', true)
                    ->orderBy('title')
                    ->get();
                    
                $menuData = compact('menuProducts', 'menuServices');
            }

            $view->with($menuData);
        });
    }
}
