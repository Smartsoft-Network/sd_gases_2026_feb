@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="Our Services"
        subtitle="Comprehensive oxygen services from refilling to equipment rental and maintenance"
        :breadcrumbs="[['label' => 'Services']]"
    />

    {{-- Features Bar --}}
    <section class="py-8 bg-muted/30 border-b border-border">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center gap-8">
                @php
                    $features = [
                        ['icon' => 'clock', 'title' => 'Fast Turnaround', 'description' => 'Same-day service available'],
                        ['icon' => 'shield', 'title' => 'Certified Quality', 'description' => 'ISO certified processes'],
                        ['icon' => 'users', 'title' => 'Expert Team', 'description' => 'Trained professionals'],
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
                        @if($feature['icon'] === 'clock')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        @elseif($feature['icon'] === 'shield')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                        @elseif($feature['icon'] === 'users')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
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

    {{-- Service Categories --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="text-center mb-16 transition-all duration-700 ease-out"
            >
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">What We Offer</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Service Categories
                </h2>
                <p class="text-muted-foreground mt-4 max-w-2xl mx-auto">
                    From routine refilling to specialized expedition support, we provide end-to-end oxygen solutions.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                @php
                    $serviceCategories = [
                        [
                            'title' => "Cylinder Refilling",
                            'description' => "Professional oxygen cylinder refilling service with quick turnaround and purity testing.",
                            'image' => "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800",
                            'href' => route('services.show', 'cylinder-refilling'),
                            'features' => ["Same-day service", "Purity certified", "All cylinder sizes"],
                        ],
                        [
                            'title' => "Equipment Rental",
                            'description' => "Flexible rental options for oxygen equipment - from single cylinders to complete expedition packages.",
                            'image' => "https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=800",
                            'href' => route('services.show', 'equipment-rental'),
                            'features' => ["Daily/weekly/monthly", "Maintenance included", "Delivery available"],
                        ],
                        [
                            'title' => "Maintenance & Repair",
                            'description' => "Expert maintenance, testing, and repair services for all oxygen equipment and regulators.",
                            'image' => "https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800",
                            'href' => route('services.show', 'maintenance'),
                            'features' => ["Certified technicians", "Genuine parts", "Warranty service"],
                        ],
                        [
                            'title' => "Bulk Supply Contracts",
                            'description' => "Long-term supply agreements for hospitals, industries, and expedition companies.",
                            'image' => "https://images.unsplash.com/photo-1565793298595-6a879b1d9492?w=800",
                            'href' => route('services.show', 'bulk-supply'),
                            'features' => ["Competitive pricing", "Scheduled delivery", "Dedicated account manager"],
                        ],
                    ];
                @endphp

                @foreach($serviceCategories as $index => $service)
                    <div 
                        x-data="{ shown: false }"
                        x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class="transition-all duration-700 ease-out"
                        style="transition-delay: {{ $index * 100 }}ms"
                    >
                        <x-product-card 
                            :title="$service['title']"
                            :description="$service['description']"
                            :image="$service['image']"
                            :href="$service['href']"
                            :features="$service['features']"
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
                    Need a Custom Service Package?
                </h2>
                <p class="text-secondary-foreground/80 mb-6">
                    Contact us to discuss your specific requirements.
                </p>
                <a 
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                >
                    Get in Touch
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
