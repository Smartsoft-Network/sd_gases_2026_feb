@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="Our Products"
        subtitle="Complete range of oxygen solutions for mountaineering, medical, and industrial applications"
        :breadcrumbs="[['label' => 'Products']]"
    />

    {{-- Features Bar --}}
    <section class="py-8 bg-muted/30 border-b border-border">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center gap-8">
                @php
                    $features = [
                        ['icon' => 'shield', 'title' => 'Quality Certified', 'description' => 'ISO 9001:2015 certified products'],
                        ['icon' => 'award', 'title' => 'Industry Leader', 'description' => '13+ years of experience'],
                        ['icon' => 'truck', 'title' => 'Reliable Delivery', 'description' => 'Nationwide distribution'],
                    ];
                @endphp

                @foreach($features as $index => $feature)
                    <div 
                        x-data="{ shown: false }"
                        x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        class="flex items-center gap-3 transition-all duration-700 ease-out"
                        style="transition-delay: {{ $index * 100 }}ms"
                    >
                        @if($feature['icon'] === 'shield')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                        @elseif($feature['icon'] === 'award')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                        @elseif($feature['icon'] === 'truck')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        @endif
                        <div>
                            <span class="font-semibold text-foreground">{{ $feature['title'] }}</span>
                            <span class="text-muted-foreground text-sm ml-2">{{ $feature['description'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Product Categories --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="text-center mb-16 transition-all duration-700 ease-out"
            >
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Browse Our Range</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Product Categories
                </h2>
                <p class="text-muted-foreground mt-4 max-w-2xl mx-auto">
                    From the summit of Everest to hospital wards, we provide oxygen solutions that save lives and enable achievements.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                @php
                    $productCategories = [
                        [
                            'title' => "Himalayan Oxygen Systems",
                            'description' => "Professional-grade oxygen systems designed for high-altitude mountaineering expeditions. Trusted by thousands of climbers on Everest and beyond.",
                            'image' => "https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800",
                            'href' => route('products.show', 'himalayan-oxygen'),
                            'features' => ["High-altitude performance", "Lightweight design", "Cold-resistant"],
                        ],
                        [
                            'title' => "Medical Oxygen Equipment",
                            'description' => "Hospital-grade oxygen cylinders, concentrators, and accessories for healthcare facilities and home medical use.",
                            'image' => "https://images.unsplash.com/photo-1584362917165-526a968c4b29?w=800",
                            'href' => route('products.show', 'medical-oxygen'),
                            'features' => ["99.5% purity", "Hospital approved", "Home delivery"],
                        ],
                        [
                            'title' => "Industrial Gas Solutions",
                            'description' => "Industrial oxygen, nitrogen, and specialty gases for manufacturing, welding, and various industrial applications.",
                            'image' => "https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=800",
                            'href' => route('products.show', 'industrial-gas'),
                            'features' => ["Bulk supply", "Regular delivery", "Custom mixtures"],
                        ],
                        [
                            'title' => "Emergency Oxygen Kits",
                            'description' => "Portable emergency oxygen kits for rescue operations, helicopter evacuations, and emergency medical services.",
                            'image' => "https://images.unsplash.com/photo-1551076805-e1869033e561?w=800",
                            'href' => route('products.show', 'emergency-oxygen'),
                            'features' => ["Rapid deployment", "Compact design", "24/7 support"],
                        ],
                    ];
                @endphp

                @foreach($productCategories as $index => $product)
                    <div 
                        x-data="{ shown: false }"
                        x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class="transition-all duration-700 ease-out"
                        style="transition-delay: {{ $index * 100 }}ms"
                    >
                        <x-product-card 
                            :title="$product['title']"
                            :description="$product['description']"
                            :image="$product['image']"
                            :href="$product['href']"
                            :features="$product['features']"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16 bg-secondary">
        <div class="container mx-auto px-4 text-center">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-700 ease-out"
            >
                <h2 class="text-2xl md:text-3xl font-bold text-secondary-foreground mb-4 font-display">
                    Need Custom Solutions?
                </h2>
                <p class="text-secondary-foreground/80 mb-6">
                    Contact us for tailored oxygen solutions for your specific requirements.
                </p>
                <a 
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                >
                    Get Custom Quote
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
