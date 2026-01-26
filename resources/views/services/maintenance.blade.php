@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="Maintenance & Repair"
        subtitle="Expert maintenance, testing, and repair services for all oxygen equipment"
        :breadcrumbs="[
            ['label' => 'Services', 'href' => route('services.index')],
            ['label' => 'Maintenance & Repair']
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
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">Professional Care</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 mb-6 font-display">
                        Keep Your Equipment Safe & Reliable
                    </h2>
                    <p class="text-muted-foreground mb-6 leading-relaxed">
                        Regular maintenance is essential for oxygen equipment safety and performance. Our certified 
                        technicians provide comprehensive inspection, testing, and repair services for all types of 
                        oxygen cylinders, regulators, and accessories.
                    </p>
                    <ul class="space-y-3 mb-8">
                        @foreach(["Certified service technicians", "All major brands supported", "Genuine replacement parts only", "Same-week turnaround for most repairs"] as $item)
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
                        Schedule Service
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
                        src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800"
                        alt="Equipment Maintenance"
                        class="rounded-2xl shadow-xl"
                    />
                    <div class="absolute -bottom-6 -left-6 bg-primary text-primary-foreground p-6 rounded-xl shadow-lg">
                        <div class="text-3xl font-bold font-display">10K+</div>
                        <div class="text-primary-foreground/80 text-sm">Units Serviced</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Services --}}
    <section class="py-20 bg-muted/30">
        <div class="container mx-auto px-4">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="text-center mb-16 transition-all duration-700 ease-out"
            >
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Our Services</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    What We Offer
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $services = [
                        [
                            'title' => "Cylinder Inspection",
                            'description' => "Complete visual and hydrostatic testing to ensure cylinder safety and compliance with regulations.",
                            'items' => ["Visual inspection", "Hydrostatic pressure test", "Valve inspection", "Safety certification"],
                        ],
                        [
                            'title' => "Regulator Service",
                            'description' => "Professional calibration and repair of all types of oxygen regulators and flow meters.",
                            'items' => ["Flow calibration", "Seal replacement", "Gauge testing", "Safety valve check"],
                        ],
                        [
                            'title' => "Equipment Overhaul",
                            'description' => "Complete refurbishment of oxygen equipment including cleaning, part replacement, and testing.",
                            'items' => ["Complete disassembly", "Part replacement", "Ultrasonic cleaning", "Performance testing"],
                        ],
                    ];
                @endphp
                @foreach($services as $index => $service)
                    <div 
                        x-data="{ shown: false }"
                        x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class="bg-card p-8 rounded-xl transition-all duration-700 ease-out hover:shadow-lg hover:-translate-y-1"
                        style="transition-delay: {{ $index * 100 }}ms"
                    >
                        <h3 class="text-xl font-bold text-foreground mb-3 font-display">{{ $service['title'] }}</h3>
                        <p class="text-muted-foreground text-sm mb-4">{{ $service['description'] }}</p>
                        <ul class="space-y-2">
                            @foreach($service['items'] as $item)
                                <li class="flex items-center gap-2 text-sm text-foreground">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-primary flex-shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
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
                        ['icon' => 'wrench', 'title' => "Expert Repairs", 'description' => "Certified technicians for all brands"],
                        ['icon' => 'test-tube', 'title' => "Hydrostatic Testing", 'description' => "Cylinder pressure testing services"],
                        ['icon' => 'settings', 'title' => "Regulator Service", 'description' => "Calibration and repair"],
                        ['icon' => 'clock', 'title' => "Quick Turnaround", 'description' => "Most repairs completed same week"],
                        ['icon' => 'shield', 'title' => "Warranty Work", 'description' => "Authorized service center"],
                        ['icon' => 'award', 'title' => "Genuine Parts", 'description' => "Only OEM replacement parts"],
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
                    Equipment Need Service?
                </h2>
                <p class="text-secondary-foreground/80 mb-6 max-w-2xl mx-auto">
                    Contact us to schedule maintenance or repair. We offer pickup service for bulk orders.
                </p>
                <a
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg btn-glow hover:bg-primary-dark transition-colors"
                >
                    Schedule Service
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
