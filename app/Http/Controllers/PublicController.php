<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TutorialVideo;

class PublicController extends Controller
{
    public function home()
    {
        $products = Product::where('status', true)->latest()->take(6)->get();
        $services = Service::where('status', true)->latest()->take(6)->get();
        
        $aboutSetting = Setting::where('key', 'about_page')->first();
        $aboutData = $aboutSetting ? $aboutSetting->value : $this->getDefaultAboutData();
        
        $bannerSetting = Setting::where('key', 'home_banner')->first();
        $bannerData = $bannerSetting ? $bannerSetting->value : $this->getDefaultBannerData();
        
        return view('home', compact('products', 'services', 'aboutData', 'bannerData'));
    }

    public function about()
    {
        $aboutSetting = Setting::where('key', 'about_page')->first();
        $aboutData = $aboutSetting ? $aboutSetting->value : $this->getDefaultAboutData();
        
        return view('about', compact('aboutData'));
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

    public function products()
    {
        $products = Product::where('status', true)->latest()->get();
        $settings = Setting::where('key', 'product_main_page_settings')->first();
        $productMainData = $settings ? $settings->value : $this->getDefaultProductMainData();
        return view('products', compact('products', 'productMainData'));
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

    public function services()
    {
        $services = Service::where('status', true)->latest()->get();
        $settings = Setting::where('key', 'services_main_page_settings')->first();
        $servicesMainData = $settings ? $settings->value : $this->getDefaultServicesMainData();
        return view('services', compact('services', 'servicesMainData'));
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

    public function tutorialVideos()
    {
        $tutorialVideosPageSetting = Setting::where('key', 'tutorial_videos_page_settings')->first();
        $tutorialVideosPageData = $tutorialVideosPageSetting ? $tutorialVideosPageSetting->value : $this->getDefaultTutorialVideosData();

        $isTutorialVideosEnabled = $tutorialVideosPageData['is_enabled'] ?? true;

        if (!$isTutorialVideosEnabled) {
            abort(404);
        }

        $videos = TutorialVideo::where('status', true)->orderBy('sort_order')->latest()->get();
        return view('tutorial-videos', compact('videos', 'tutorialVideosPageData'));
    }

    private function getDefaultTutorialVideosData()
    {
        return [
            'hero_title' => 'Gallery',
            'hero_subtitle' => 'Explore our gallery of images and videos related to our oxygen systems and equipment.',
        ];
    }

    public function showProduct($slug)
    {
        $product = Product::where('slug', $slug)->where('status', true)->firstOrFail();
        return view('products.show', compact('product'));
    }

    public function showService($slug)
    {
        $service = Service::where('slug', $slug)->where('status', true)->firstOrFail();
        return view('services.show', compact('service'));
    }
}
