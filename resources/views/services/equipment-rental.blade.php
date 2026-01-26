@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="Equipment Rental"
        subtitle="Flexible rental options for oxygen equipment - from expedition kits to home medical equipment"
        :breadcrumbs="[
            ['label' => 'Services', 'href' => route('services.index')],
            ['label' => 'Equipment Rental']
        ]"
    />

    {{-- Introduction --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div 
                    x-data="{ shown: false }"
                    x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                    class="transition-all duration-700 ease-out"
                >
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">Flexible Solutions</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 mb-6 font-display">
                        Rent What You Need
                    </h2>
                    <p class="text-muted-foreground mb-6 leading-relaxed">
                        Not everyone needs to purchase oxygen equipment. Our rental program offers flexible, 
                        cost-effective solutions for expeditions, temporary medical needs, and short-term 
                        industrial projects. All equipment is professionally maintained and fully insured.
                    </p>
                    <ul class="space-y-3 mb-8">
                        @foreach(["No long-term commitment required", "Equipment delivered to your location", "All maintenance and repairs included", "Training provided at no extra cost"] as $item)
                            <li class="flex items-center gap-3 text-foreground">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary flex-shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a
                        href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg btn-glow hover:bg-primary-dark transition-colors"
                    >
                        Request Rental Quote
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>

                <div 
                    x-data="{ shown: false }"
                    x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'"
                    class="relative transition-all duration-700 ease-out"
                >
                    <img
                        src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=800"
                        alt="Equipment Rental"
                        class="rounded-2xl shadow-xl"
                    />
                    <div class="absolute -bottom-6 -left-6 bg-primary text-primary-foreground p-6 rounded-xl shadow-lg">
                        <div class="text-3xl font-bold font-display">500+</div>
                        <div class="text-primary-foreground/80 text-sm">Active Rentals</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Rental Options --}}
    <section class="py-20 bg-muted/30">
        <div class="container mx-auto px-4">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="text-center mb-16 transition-all duration-700 ease-out"
            >
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Rental Packages</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Choose Your Package
                </h2>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        Expedition Rental
                    </h3>
                    @php
                        $expeditionRental = [
                            ['label' => "Oxygen Cylinder Set", 'value' => "Rs. 5,000/week"],
                            ['label' => "Regulator with Mask", 'value' => "Rs. 1,500/week"],
                            ['label' => "Complete Climbing Kit", 'value' => "Rs. 12,000/week"],
                            ['label' => "Deposit Required", 'value' => "Rs. 20,000"],
                            ['label' => "Delivery to Basecamp", 'value' => "Available"],
                            ['label' => "Training Session", 'value' => "Included"],
                        ];
                    @endphp
                    <x-spec-table title="Mountaineering Equipment" :specifications="$expeditionRental" />
                    <p class="mt-4 text-muted-foreground text-sm">
                        Complete expedition packages with delivery to basecamp available.
                    </p>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        Medical Rental
                    </h3>
                    @php
                        $medicalRental = [
                            ['label' => "Oxygen Concentrator", 'value' => "Rs. 8,000/month"],
                            ['label' => "Cylinder + Regulator", 'value' => "Rs. 3,000/month"],
                            ['label' => "Pulse Oximeter", 'value' => "Rs. 500/month"],
                            ['label' => "Deposit Required", 'value' => "Rs. 10,000"],
                            ['label' => "Home Delivery", 'value' => "Free"],
                            ['label' => "Setup & Training", 'value' => "Included"],
                        ];
                    @endphp
                    <x-spec-table title="Home Medical Equipment" :specifications="$medicalRental" />
                    <p class="mt-4 text-muted-foreground text-sm">
                        Home delivery and setup included. Ideal for recovery and respiratory therapy.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="text-center mb-16 transition-all duration-700 ease-out"
            >
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">What's Included</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Rental Benefits
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $features = [
                        ['icon' => 'calendar', 'title' => "Flexible Terms", 'description' => "Daily, weekly, or monthly rental options"],
                        ['icon' => 'truck', 'title' => "Free Delivery", 'description' => "Delivery and pickup included"],
                        ['icon' => 'wrench', 'title' => "Maintenance", 'description' => "All maintenance included in rental"],
                        ['icon' => 'headphones', 'title' => "24/7 Support", 'description' => "Technical support always available"],
                        ['icon' => 'shield', 'title' => "Insurance", 'description' => "Equipment fully insured"],
                        ['icon' => 'package', 'title' => "Complete Kits", 'description' => "Ready-to-use equipment packages"],
                    ];
                @endphp
                @foreach($features as $index => $feature)
                    <x-feature-card 
                        :icon="$feature['icon']"
                        :title="$feature['title']"
                        :description="$feature['description']"
                        :delay="$index * 100"
                    />
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
                    Ready to Rent?
                </h2>
                <p class="text-secondary-foreground/80 mb-6 max-w-2xl mx-auto">
                    Contact us to discuss your rental requirements and get a customized quote.
                </p>
                <a
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg btn-glow hover:bg-primary-dark transition-colors"
                >
                    Contact Us
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
