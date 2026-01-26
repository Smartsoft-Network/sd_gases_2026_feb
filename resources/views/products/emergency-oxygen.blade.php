@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="Emergency Oxygen Kits"
        subtitle="Portable emergency oxygen systems for rescue operations and emergency medical services"
        :breadcrumbs="[
            ['label' => 'Products', 'href' => route('products.index')],
            ['label' => 'Emergency Oxygen']
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
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">When Seconds Count</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 mb-6 font-display">
                        Life-Saving Emergency Solutions
                    </h2>
                    <p class="text-muted-foreground mb-6 leading-relaxed">
                        Our emergency oxygen kits are designed for rapid deployment in critical situations. 
                        Used by helicopter rescue teams, ambulance services, and mountain rescue operations 
                        across Nepal, these compact systems provide reliable oxygen delivery when it matters most.
                    </p>
                    <ul class="space-y-3 mb-8">
                        @foreach(["Helicopter rescue certified", "Instant activation design", "Extreme temperature tested", "24/7 refill service available"] as $item)
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
                        src="https://images.unsplash.com/photo-1551076805-e1869033e561?w=800"
                        alt="Emergency Equipment"
                        class="rounded-2xl shadow-xl w-full"
                    />
                    <div class="absolute -bottom-6 -left-6 bg-primary text-primary-foreground p-6 rounded-xl shadow-lg">
                        <div class="text-3xl font-bold font-display">&lt;30s</div>
                        <div class="text-primary-foreground/80 text-sm">Deployment Time</div>
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
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Emergency Ready</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Key Features
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $features = [
                        ['icon' => 'alert-triangle', 'title' => "Emergency Ready", 'description' => "Rapid deployment for critical situations"],
                        ['icon' => 'plane', 'title' => "Heli-Rescue", 'description' => "Approved for helicopter operations"],
                        ['icon' => 'clock', 'title' => "Instant Access", 'description' => "Pre-filled and ready to use"],
                        ['icon' => 'package', 'title' => "Compact Design", 'description' => "Lightweight and portable kits"],
                        ['icon' => 'shield', 'title' => "Certified Safe", 'description' => "Meets aviation safety standards"],
                        ['icon' => 'headphones', 'title' => "24/7 Support", 'description' => "Emergency hotline available"],
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
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Our Kits</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Emergency Kit Options
                </h2>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        Ground Rescue Kit
                    </h3>
                    @php
                        $rescueKitSpecs = [
                            ['label' => "Cylinder Type", 'value' => "Aluminum D-Cylinder"],
                            ['label' => "Capacity", 'value' => "425 Liters O₂"],
                            ['label' => "Weight (Full)", 'value' => "2.5 kg"],
                            ['label' => "Duration @ 4 L/min", 'value' => "1.8 hours"],
                            ['label' => "Regulator", 'value' => "Click-Style Preset"],
                            ['label' => "Case", 'value' => "Waterproof Hard Case"],
                        ];
                    @endphp
                    <x-spec-table title="Kit Specifications" :specifications="$rescueKitSpecs" />
                    <p class="mt-4 text-muted-foreground text-sm">
                        Ideal for ambulance services, mountain rescue, and first responder teams.
                    </p>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        Aviation Rescue Kit
                    </h3>
                    @php
                        $aviationKitSpecs = [
                            ['label' => "Cylinder Type", 'value' => "Composite Cylinder"],
                            ['label' => "Capacity", 'value' => "680 Liters O₂"],
                            ['label' => "Weight (Full)", 'value' => "1.8 kg"],
                            ['label' => "Duration @ 4 L/min", 'value' => "2.8 hours"],
                            ['label' => "Certification", 'value' => "FAA / EASA Approved"],
                            ['label' => "Case", 'value' => "Aviation-Grade Case"],
                        ];
                    @endphp
                    <x-spec-table title="Kit Specifications" :specifications="$aviationKitSpecs" />
                    <p class="mt-4 text-muted-foreground text-sm">
                        FAA/EASA certified for helicopter rescue operations and aviation use.
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
                    Equip Your Rescue Team
                </h2>
                <p class="text-secondary-foreground/80 mb-6 max-w-2xl mx-auto">
                    Contact us for emergency kit solutions, training programs, and maintenance services.
                </p>
                <a 
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                >
                    Contact Emergency Team
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
