@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="Himalayan Oxygen Systems"
        subtitle="Professional-grade oxygen equipment trusted by thousands of climbers on the world's highest peaks"
        :breadcrumbs="[
            ['label' => 'Products', 'href' => route('products.index')],
            ['label' => 'Himalayan Oxygen']
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
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">Climb Beyond Limits</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 mb-6 font-display">
                        Engineered for the World's Highest Peaks
                    </h2>
                    <p class="text-muted-foreground mb-6 leading-relaxed">
                        Our Himalayan oxygen systems are designed specifically for extreme altitude mountaineering. 
                        Used by expedition teams on Everest, K2, Annapurna, and other 8000m peaks, our equipment 
                        combines lightweight construction with reliable performance in the harshest conditions.
                    </p>
                    <ul class="space-y-3 mb-8">
                        @foreach(["Trusted by 500+ expeditions annually", "24/7 technical support", "Rental and purchase options", "Free equipment training"] as $item)
                            <li class="flex items-center gap-3 text-foreground">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary flex-shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a 
                        href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                    >
                        Request Quote
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>

                <div 
                    x-data="{ shown: false }"
                    x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'"
                    class="relative transition-all duration-700 ease-out"
                >
                    <img
                        src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800"
                        alt="Himalayan Mountain"
                        class="rounded-2xl shadow-xl w-full"
                    />
                    <div class="absolute -bottom-6 -left-6 bg-primary text-primary-foreground p-6 rounded-xl shadow-lg">
                        <div class="text-3xl font-bold font-display">8,848m</div>
                        <div class="text-primary-foreground/80 text-sm">Summit Ready</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="py-20 bg-muted/30">
        <div class="container mx-auto px-4">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="text-center mb-16 transition-all duration-700 ease-out"
            >
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Why Choose Us</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Key Features
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $features = [
                        ['icon' => 'mountain', 'title' => "High Altitude", 'description' => "Engineered for extreme altitudes up to 8,848m"],
                        ['icon' => 'shield', 'title' => "Safety Certified", 'description' => "Meets international mountaineering safety standards"],
                        ['icon' => 'wind', 'title' => "Lightweight", 'description' => "Optimized weight for expedition climbing"],
                        ['icon' => 'thermometer', 'title' => "Cold Resistant", 'description' => "Functions in temperatures as low as -40°C"],
                        ['icon' => 'gauge', 'title' => "Precise Flow", 'description' => "Adjustable flow rates from 0.5 to 4 L/min"],
                        ['icon' => 'package', 'title' => "Complete Kit", 'description' => "Includes mask, regulator, and carrying system"],
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

    {{-- Product Options --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="text-center mb-16 transition-all duration-700 ease-out"
            >
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Choose Your System</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    System Specifications
                </h2>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        Standard System
                    </h3>
                    @php
                        $standardSpecs = [
                            ['label' => "Cylinder Material", 'value' => "Aluminum Alloy 6061-T6"],
                            ['label' => "Capacity", 'value' => "4 Liters (520L O₂)"],
                            ['label' => "Working Pressure", 'value' => "3000 PSI (207 bar)"],
                            ['label' => "Weight (Empty)", 'value' => "2.8 kg"],
                            ['label' => "Weight (Full)", 'value' => "3.5 kg"],
                            ['label' => "Flow Rate Range", 'value' => "0.5 - 4 L/min"],
                            ['label' => "Duration @ 2 L/min", 'value' => "4.3 hours"],
                            ['label' => "Operating Temperature", 'value' => "-40°C to +60°C"],
                        ];
                    @endphp
                    <x-spec-table title="Technical Specifications" :specifications="$standardSpecs" />
                    <p class="mt-4 text-muted-foreground text-sm">
                        Ideal for trekking peaks and commercial expeditions. Proven reliability at an accessible price point.
                    </p>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary animate-pulse"></div>
                        Elite System
                    </h3>
                    @php
                        $eliteSpecs = [
                            ['label' => "Cylinder Material", 'value' => "Carbon Fiber Composite"],
                            ['label' => "Capacity", 'value' => "4.5 Liters (585L O₂)"],
                            ['label' => "Working Pressure", 'value' => "4500 PSI (310 bar)"],
                            ['label' => "Weight (Empty)", 'value' => "1.9 kg"],
                            ['label' => "Weight (Full)", 'value' => "2.6 kg"],
                            ['label' => "Flow Rate Range", 'value' => "0.25 - 6 L/min"],
                            ['label' => "Duration @ 2 L/min", 'value' => "4.9 hours"],
                            ['label' => "Operating Temperature", 'value' => "-50°C to +60°C"],
                        ];
                    @endphp
                    <x-spec-table title="Technical Specifications" :specifications="$eliteSpecs" />
                    <p class="mt-4 text-muted-foreground text-sm">
                        Premium carbon fiber construction for weight-conscious climbers. Maximum performance for the most demanding expeditions.
                    </p>
                </div>
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
                    Planning Your Expedition?
                </h2>
                <p class="text-secondary-foreground/80 mb-6 max-w-2xl mx-auto">
                    Contact us to discuss your oxygen requirements. We offer rental packages, bulk discounts, and comprehensive support for expedition teams.
                </p>
                <a 
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                >
                    Contact Our Expedition Team
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
