@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="Medical Oxygen Equipment"
        subtitle="Hospital-grade oxygen solutions for healthcare facilities and home medical use"
        :breadcrumbs="[
            ['label' => 'Products', 'href' => route('products.index')],
            ['label' => 'Medical Oxygen']
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
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">Healthcare Solutions</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 mb-6 font-display">
                        Life-Saving Oxygen Supply
                    </h2>
                    <p class="text-muted-foreground mb-6 leading-relaxed">
                        We provide comprehensive medical oxygen solutions for hospitals, clinics, nursing homes, 
                        and home patients across Nepal. Our medical-grade oxygen meets the highest purity standards 
                        required for therapeutic use.
                    </p>
                    <ul class="space-y-3 mb-8">
                        @foreach(["99.5% purity guaranteed", "Regular refilling service", "Emergency supply within hours", "Equipment maintenance included"] as $item)
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
                        src="https://images.unsplash.com/photo-1584362917165-526a968c4b29?w=800"
                        alt="Medical Oxygen"
                        class="rounded-2xl shadow-xl w-full"
                    />
                    <div class="absolute -bottom-6 -left-6 bg-primary text-primary-foreground p-6 rounded-xl shadow-lg">
                        <div class="text-3xl font-bold font-display">99.5%</div>
                        <div class="text-primary-foreground/80 text-sm">Purity Level</div>
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
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Our Commitment</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Why Healthcare Providers Trust Us
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $features = [
                        ['icon' => 'heart', 'title' => "Medical Grade", 'description' => "99.5% purity meets all hospital requirements"],
                        ['icon' => 'hospital', 'title' => "Hospital Approved", 'description' => "Certified for use in healthcare facilities"],
                        ['icon' => 'home', 'title' => "Home Delivery", 'description' => "Regular delivery service for home patients"],
                        ['icon' => 'stethoscope', 'title' => "Expert Support", 'description' => "Trained staff for setup and maintenance"],
                        ['icon' => 'clock', 'title' => "24/7 Service", 'description' => "Emergency supply available round the clock"],
                        ['icon' => 'shield', 'title' => "Quality Assured", 'description' => "Rigorous testing and quality control"],
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
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Our Products</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Equipment Specifications
                </h2>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        Medical Oxygen Cylinders
                    </h3>
                    @php
                        $cylinderSpecs = [
                            ['label' => "Oxygen Purity", 'value' => "99.5% Medical Grade"],
                            ['label' => "Available Sizes", 'value' => "10L, 20L, 40L, 50L"],
                            ['label' => "Working Pressure", 'value' => "150 bar"],
                            ['label' => "Valve Type", 'value' => "Pin Index / Bull Nose"],
                            ['label' => "Certification", 'value' => "ISO 7866 / DOT"],
                            ['label' => "Testing Interval", 'value' => "5 Years"],
                        ];
                    @endphp
                    <x-spec-table title="Cylinder Specifications" :specifications="$cylinderSpecs" />
                    <p class="mt-4 text-muted-foreground text-sm">
                        Available in various sizes for hospital use, ambulance service, and home oxygen therapy.
                    </p>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        Oxygen Concentrators
                    </h3>
                    @php
                        $concentratorSpecs = [
                            ['label' => "Flow Rate", 'value' => "1-5 L/min (adjustable)"],
                            ['label' => "Oxygen Purity", 'value' => "93% ± 3%"],
                            ['label' => "Power Consumption", 'value' => "300W"],
                            ['label' => "Noise Level", 'value' => "≤45 dB"],
                            ['label' => "Weight", 'value' => "14 kg"],
                            ['label' => "Operating Hours", 'value' => "10,000+ hours"],
                        ];
                    @endphp
                    <x-spec-table title="Concentrator Specifications" :specifications="$concentratorSpecs" />
                    <p class="mt-4 text-muted-foreground text-sm">
                        Ideal for continuous home oxygen therapy. Rental and purchase options available.
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
                    Need Medical Oxygen Supply?
                </h2>
                <p class="text-secondary-foreground/80 mb-6 max-w-2xl mx-auto">
                    Contact us for hospital contracts, home delivery, or emergency oxygen supply.
                </p>
                <a 
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                >
                    Contact Medical Team
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
