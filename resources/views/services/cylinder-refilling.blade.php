@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="Cylinder Refilling"
        subtitle="Fast, reliable oxygen cylinder refilling with purity testing and safety certification"
        :breadcrumbs="[
            ['label' => 'Services', 'href' => route('services.index')],
            ['label' => 'Cylinder Refilling']
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
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">Quick & Reliable</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 mb-6 font-display">
                        Professional Cylinder Refilling
                    </h2>
                    <p class="text-muted-foreground mb-6 leading-relaxed">
                        Our state-of-the-art refilling facility handles both medical and industrial oxygen cylinders. 
                        Every refill includes safety inspection, accurate filling, and purity certification to ensure 
                        you receive the highest quality oxygen.
                    </p>
                    <ul class="space-y-3 mb-8">
                        @foreach(["Same-day turnaround available", "All cylinder sizes accepted", "Pickup and delivery service", "Bulk discount for 10+ cylinders"] as $item)
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
                        Schedule Refill
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>

                <div 
                    x-data="{ shown: false }"
                    x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'"
                    class="transition-all duration-700 ease-out"
                >
                    @php
                        $pricingSpecs = [
                            ['label' => "Medical Oxygen (10L)", 'value' => "Rs. 800"],
                            ['label' => "Medical Oxygen (20L)", 'value' => "Rs. 1,200"],
                            ['label' => "Medical Oxygen (40L)", 'value' => "Rs. 2,000"],
                            ['label' => "Industrial Oxygen (40L)", 'value' => "Rs. 1,800"],
                            ['label' => "Industrial Oxygen (50L)", 'value' => "Rs. 2,200"],
                            ['label' => "Express Service (+50%)", 'value' => "2-4 hours"],
                        ];
                    @endphp
                    <x-spec-table title="Refilling Prices" :specifications="$pricingSpecs" />
                    <p class="mt-4 text-muted-foreground text-sm text-center">
                        * Prices may vary. Contact us for bulk pricing.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Process --}}
    <section class="py-20 bg-muted/30">
        <div class="container mx-auto px-4">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="text-center mb-16 transition-all duration-700 ease-out"
            >
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Our Process</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    How It Works
                </h2>
            </div>

            <div class="flex flex-wrap justify-center gap-4">
                @php
                    $processSteps = [
                        ['step' => "01", 'title' => "Drop Off", 'description' => "Bring your cylinder to our facility or schedule pickup"],
                        ['step' => "02", 'title' => "Inspection", 'description' => "We check for damage and verify cylinder certification"],
                        ['step' => "03", 'title' => "Refilling", 'description' => "Filled using calibrated equipment to exact capacity"],
                        ['step' => "04", 'title' => "Testing", 'description' => "Purity testing ensures 99.5% medical-grade oxygen"],
                        ['step' => "05", 'title' => "Ready", 'description' => "Cylinder sealed and ready for collection"],
                    ];
                @endphp
                @foreach($processSteps as $index => $step)
                    <div 
                        x-data="{ shown: false }"
                        x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class="bg-card p-6 rounded-xl text-center w-full sm:w-48 transition-all duration-700 ease-out hover:shadow-lg"
                        style="transition-delay: {{ $index * 100 }}ms"
                    >
                        <div class="text-4xl font-bold text-primary/20 mb-2 font-display">{{ $step['step'] }}</div>
                        <h3 class="text-lg font-bold text-foreground mb-2 font-display">{{ $step['title'] }}</h3>
                        <p class="text-muted-foreground text-sm">{{ $step['description'] }}</p>
                    </div>
                @endforeach
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
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Why Choose Us</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Service Features
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $features = [
                        ['icon' => 'clock', 'title' => "Fast Turnaround", 'description' => "Same-day service for most cylinders"],
                        ['icon' => 'test-tube', 'title' => "Purity Testing", 'description' => "Every refill tested for 99.5% purity"],
                        ['icon' => 'shield', 'title' => "Safety Checks", 'description' => "Full cylinder inspection included"],
                        ['icon' => 'refresh-cw', 'title' => "Any Brand", 'description' => "We refill all cylinder brands"],
                        ['icon' => 'truck', 'title' => "Pickup Available", 'description' => "Collection and delivery service"],
                        ['icon' => 'check-circle', 'title' => "Certified", 'description' => "ISO certified refilling process"],
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
                    Need a Refill?
                </h2>
                <p class="text-secondary-foreground/80 mb-6 max-w-2xl mx-auto">
                    Contact us or visit our facility in Patan Dhoka, Lalitpur for fast, reliable refilling service.
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
