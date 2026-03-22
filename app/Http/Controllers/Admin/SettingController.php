<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function about()
    {
        $aboutSetting = Setting::where('key', 'about_page')->first();
        $aboutData = $aboutSetting ? $aboutSetting->value : $this->getDefaultAboutData();
        
        $bannerSetting = Setting::where('key', 'home_banner')->first();
        $bannerData = $bannerSetting ? $bannerSetting->value : $this->getDefaultBannerData();
        
        return view('admin.settings.about', compact('aboutData', 'bannerData'));
    }

    public function general()
    {
        $generalSetting = Setting::where('key', 'general_settings')->first();
        $defaults = $this->getDefaultGeneralData();
        $generalData = $generalSetting ? array_merge($defaults, $generalSetting->value) : $defaults;
        
        return view('admin.settings.general', compact('generalData'));
    }

    public function updateAbout(Request $request)
    {
        // Validation for About Page
        $aboutData = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string',
            'home_about_title' => 'required|string|max:255',
            'home_about_descriptions' => 'nullable|array',
            'mission_title' => 'required|string|max:255',
            'mission_content' => 'required|string',
            'vision_title' => 'required|string|max:255',
            'vision_content' => 'required|string',
            'journey_subtitle' => 'required|string|max:255',
            'journey_title' => 'required|string|max:255',
            'milestones' => 'nullable|array',
            'stats' => 'nullable|array',
            'features' => 'nullable|array',
        ]);

        // Validation for Banner Section
        $bannerData = $request->validate([
            'banner_badge' => 'required|string|max:255',
            'banner_title' => 'required|string|max:255',
            'banner_subtitle' => 'required|string',
            'banner_stats' => 'nullable|array',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle Banner Image Upload
        $oldBannerSetting = Setting::where('key', 'home_banner')->first();
        $oldBannerData = $oldBannerSetting ? $oldBannerSetting->value : $this->getDefaultBannerData();
        
        if ($request->hasFile('banner_image')) {
            if (isset($oldBannerData['banner_image'])) {
                Storage::disk('public')->delete($oldBannerData['banner_image']);
            }
            $bannerData['banner_image'] = $request->file('banner_image')->store('settings', 'public');
        } else {
            $bannerData['banner_image'] = $oldBannerData['banner_image'] ?? null;
        }

        Setting::updateOrCreate(
            ['key' => 'about_page'],
            ['value' => $aboutData]
        );

        Setting::updateOrCreate(
            ['key' => 'home_banner'],
            ['value' => $bannerData]
        );

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function updateGeneral(Request $request)
    {
        $generalData = $request->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:255',
            'whatsapp_numbers' => 'nullable|array',
            'address' => 'required|string',
            'google_maps_url' => 'nullable|string',
            'inner_hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:512',
            'social_links' => 'nullable|array',
            'mail_mailer' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|string|max:255',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:255',
            'mail_from_address' => 'required|email|max:255',
            'mail_from_name' => 'required|string|max:255',
        ]);

        $oldGeneralSetting = Setting::where('key', 'general_settings')->first();
        $oldGeneralData = $oldGeneralSetting ? $oldGeneralSetting->value : $this->getDefaultGeneralData();

        // Handle Inner Hero Image
        if ($request->hasFile('inner_hero_image')) {
            if (isset($oldGeneralData['inner_hero_image'])) {
                Storage::disk('public')->delete($oldGeneralData['inner_hero_image']);
            }
            $generalData['inner_hero_image'] = $request->file('inner_hero_image')->store('settings', 'public');
        } else {
            $generalData['inner_hero_image'] = $oldGeneralData['inner_hero_image'] ?? null;
        }

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            if (isset($oldGeneralData['logo'])) {
                Storage::disk('public')->delete($oldGeneralData['logo']);
            }
            $generalData['logo'] = $request->file('logo')->store('settings', 'public');
        } else {
            $generalData['logo'] = $oldGeneralData['logo'] ?? null;
        }

        // Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            if (isset($oldGeneralData['favicon'])) {
                Storage::disk('public')->delete($oldGeneralData['favicon']);
            }
            $generalData['favicon'] = $request->file('favicon')->store('settings', 'public');
        } else {
            $generalData['favicon'] = $oldGeneralData['favicon'] ?? null;
        }

        // Handle Mail Password - keep old if new is empty
        if (empty($request->mail_password)) {
            $generalData['mail_password'] = $oldGeneralData['mail_password'] ?? '';
        }

        Setting::updateOrCreate(
            ['key' => 'general_settings'],
            ['value' => $generalData]
        );

        return redirect()->back()->with('success', 'General settings updated successfully.');
    }

    public function productMain()
    {
        $settings = Setting::where('key', 'product_main_page_settings')->first();
        $productMainData = $settings ? $settings->value : $this->getDefaultProductMainData();
        return view('admin.settings.product-main', compact('productMainData'));
    }

    public function updateProductMain(Request $request)
    {
        $data = $request->except('_token');

        // Handle features separately to ensure they are stored as an array
        $features = [];
        if ($request->has('features')) {
            foreach ($request->features as $feature) {
                $features[] = [
                    'icon' => $feature['icon'] ?? 'fas fa-star',
                    'title' => $feature['title'],
                    'desc' => $feature['desc'],
                ];
            }
        }
        $data['features'] = $features;

        Setting::updateOrCreate(
            ['key' => 'product_main_page_settings'],
            ['value' => $data]
        );

        return back()->with('success', 'Product main page settings updated successfully.');
    }

    public function servicesMain()
    {
        $settings = Setting::where('key', 'services_main_page_settings')->first();
        $servicesMainData = $settings ? $settings->value : $this->getDefaultServicesMainData();
        return view('admin.settings.services-main', compact('servicesMainData'));
    }

    public function tutorialVideosPage()
    {
        $settings = Setting::where('key', 'tutorial_videos_page_settings')->first();
        $tutorialVideosData = $settings ? $settings->value : $this->getDefaultTutorialVideosData();
        return view('admin.settings.tutorial-videos', compact('tutorialVideosData'));
    }

    public function updateTutorialVideosPage(Request $request)
    {
        $data = $request->except('_token');

        $oldSetting = Setting::where('key', 'tutorial_videos_page_settings')->first();
        $oldData = $oldSetting ? $oldSetting->value : $this->getDefaultTutorialVideosData();
        $oldSlug = $oldData['page_slug'] ?? 'gallery';
        $newSlug = $data['page_slug'] ?? 'gallery';

        Setting::updateOrCreate(
            ['key' => 'tutorial_videos_page_settings'],
            ['value' => $data]
        );

        if ($oldSlug !== $newSlug) {
            return redirect()->route('admin.dashboard')->with('success', 'Page settings updated successfully. Since the slug was changed, you have been redirected to the dashboard.');
        }

        return back()->with('success', 'Page settings updated successfully.');
    }

    public function updateServicesMain(Request $request)
    {
        $data = $request->except('_token');

        $features = [];
        if ($request->has('features')) {
            foreach ($request->features as $feature) {
                $features[] = [
                    'icon' => $feature['icon'] ?? 'fas fa-star',
                    'title' => $feature['title'],
                    'desc' => $feature['desc'],
                ];
            }
        }
        $data['features'] = $features;

        Setting::updateOrCreate(
            ['key' => 'services_main_page_settings'],
            ['value' => $data]
        );

        return back()->with('success', 'Services main page settings updated successfully.');
    }

    private function getDefaultServicesMainData()
    {
        return [
            'hero_subtitle' => 'Comprehensive oxygen services from refilling to equipment rental and maintenance',
            'features' => [
                ['icon' => 'fas fa-clock', 'title' => 'Fast Turnaround', 'desc' => 'Same-day service available'],
                ['icon' => 'fas fa-shield-alt', 'title' => 'Certified Quality', 'desc' => 'ISO certified processes'],
                ['icon' => 'fas fa-users', 'title' => 'Expert Team', 'desc' => 'Trained professionals'],
            ],
            'section_badge' => 'What We Offer',
            'section_title' => 'Service Categories',
            'section_desc' => 'From routine refilling to specialized expedition support, we provide end-to-end oxygen solutions.',
        ];
    }

    private function getDefaultTutorialVideosData()
    {
        return [
            'is_enabled' => true,
            'page_title' => 'Gallery',
            'page_slug' => 'gallery',
            'hero_title' => 'Gallery',
            'hero_subtitle' => 'Explore our gallery of images and videos related to our oxygen systems and equipment.',
        ];
    }

    private function getDefaultProductMainData()
    {
        return [
            'hero_subtitle' => 'Complete range of oxygen solutions for mountaineering, medical, and industrial applications',
            'features' => [
                ['icon' => 'fas fa-shield-alt', 'title' => 'Quality Certified', 'desc' => 'ISO 9001:2015 certified products'],
                ['icon' => 'fas fa-award', 'title' => 'Industry Leader', 'desc' => '13+ years of experience'],
                ['icon' => 'fas fa-truck', 'title' => 'Reliable Delivery', 'desc' => 'Nationwide distribution'],
            ],
            'category_section_browse' => 'Browse Our Range',
            'category_section_title' => 'Product Categories',
            'category_section_desc' => 'From the summit of Everest to hospital wards, we provide oxygen solutions that save lives and enable achievements.',
        ];
    }

    private function getDefaultGeneralData()
    {
        return [
            'site_name' => 'SD Gases',
            'contact_email' => 'info@sdgases.com.np',
            'contact_phone' => '+977-1-5421122',
            'whatsapp_numbers' => [
                ['label' => 'Support', 'number' => '+9779851000000'],
                ['label' => 'Sales', 'number' => '+9779856027273'],
            ],
            'address' => 'Patan Dhoka, Lalitpur, Nepal',
            'google_maps_url' => null,
            'inner_hero_image' => null,
            'logo' => null,
            'favicon' => null,
            'mail_mailer' => 'smtp',
            'mail_host' => 'smtp.gmail.com',
            'mail_port' => '587',
            'mail_username' => '',
            'mail_password' => '',
            'mail_encryption' => 'tls',
            'mail_from_address' => '',
            'mail_from_name' => 'SD Gases',
            'social_links' => [],
        ];
    }

    private function getDefaultBannerData()
    {
        return [
            'banner_badge' => "Nepal's Leading Oxygen Provider",
            'banner_title' => 'Breathe Higher, Climb Beyond',
            'banner_subtitle' => 'High-pressure aviation-grade medical oxygen systems for Himalayan mountaineering. 15+ years of excellence with 80% market share in Nepal\'s mountaineering oxygen sector.',
            'banner_image' => null,
            'banner_stats' => [
                ['value' => '15+', 'label' => 'Years Experience'],
                ['value' => '80%', 'label' => 'Market Share'],
                ['value' => '24/7', 'label' => 'Support'],
            ],
        ];
    }

    private function getDefaultAboutData()
    {
        return [
            'hero_title' => 'About SD Gases',
            'hero_subtitle' => "Nepal's trusted partner for high-quality oxygen solutions since 2010",
            'home_about_title' => "Nepal's Premier Oxygen Systems Provider",
            'home_about_descriptions' => [
                "SD Gases is the major service provider of high-pressure aviation-grade, medical supplementary oxygen systems for high-altitude Himalayan mountaineering. We specialize in the development, manufacture, and post-sales service of supplemental oxygen systems for use at extreme altitudes.",
                "With over 15 years in the industry, we've grown to be Nepal's most trusted refilling and assembling center, handling 80% of the total market in mountaineering supplementary oxygen business.",
            ],
            'mission_title' => 'Our Mission',
            'mission_content' => 'To provide Nepal with the highest quality oxygen solutions for mountaineering, medical, and industrial applications. We are committed to safety, reliability, and supporting life-saving operations across the Himalayas and beyond.',
            'vision_title' => 'Our Vision',
            'vision_content' => 'To be the leading oxygen solutions provider in the Himalayan region, recognized for excellence in service, innovation in technology, and unwavering commitment to the safety of mountaineers and patients alike.',
            'journey_subtitle' => 'Our Journey',
            'journey_title' => 'A Legacy of Excellence',
            'milestones' => [
                ['year' => '2010', 'title' => 'Company Founded', 'desc' => 'SD Gases established in Patan Dhoka, Lalitpur'],
                ['year' => '2012', 'title' => 'First Himalayan Expedition', 'desc' => 'Supplied oxygen for Mount Everest expedition'],
                ['year' => '2015', 'title' => 'Helicopter Rescue Partner', 'desc' => 'Became official partner for helicopter rescue operations'],
                ['year' => '2018', 'title' => 'Medical Gas Division', 'desc' => 'Expanded to medical oxygen supply'],
                ['year' => '2020', 'title' => 'COVID-19 Response', 'desc' => 'Played vital role in medical oxygen supply during pandemic'],
                ['year' => '2023', 'title' => 'Nationwide Presence', 'desc' => 'Established distribution network across Nepal'],
            ],
            'stats' => [
                ['value' => '15+', 'label' => 'Years of Excellence'],
                ['value' => '80%', 'label' => 'Market Share in Nepal'],
            ],
            'features' => [
                ['icon' => 'CheckCircle', 'title' => 'Best Quality', 'desc' => 'We provide best quality products and services meeting international standards.'],
                ['icon' => 'DollarSign', 'title' => 'Reasonable Pricing', 'desc' => 'Competitive pricing without compromising on quality or safety.'],
                ['icon' => 'Users', 'title' => 'Expert Team', 'desc' => 'Russian experts with decades of experience working with our team.'],
                ['icon' => 'Zap', 'title' => 'Efficient Service', 'desc' => 'Quick turnaround with time-efficient service delivery.'],
            ],
        ];
    }
}
