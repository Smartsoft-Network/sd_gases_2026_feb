@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="Industrial Gas Solutions"
        subtitle="Complete industrial gas supply for manufacturing, welding, and specialty applications"
        :breadcrumbs="[
            ['label' => 'Products', 'href' => route('products.index')],
            ['label' => 'Industrial Gas']
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
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">Industrial Solutions</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 mb-6 font-display">
                        Powering Nepal's Industries
                    </h2>
                    <p class="text-muted-foreground mb-6 leading-relaxed">
                        SD Gases is a leading supplier of industrial gases in Nepal, serving manufacturing plants, 
                        construction companies, metal fabricators, and various industrial sectors. We provide reliable, 
                        consistent supply with flexible delivery options.
                    </p>
                    <ul class="space-y-3 mb-8">
                        @foreach(["Long-term supply contracts", "Competitive bulk pricing", "Flexible delivery schedules", "Technical support and training"] as $item)
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
                        src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=800"
                        alt="Industrial Application"
                        class="rounded-2xl shadow-xl w-full"
                    />
                    <div class="absolute -bottom-6 -left-6 bg-primary text-primary-foreground p-6 rounded-xl shadow-lg">
                        <div class="text-3xl font-bold font-display">24/7</div>
                        <div class="text-primary-foreground/80 text-sm">Supply Ready</div>
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
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Our Advantage</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Why Industries Choose Us
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $features = [
                        ['icon' => 'factory', 'title' => "Industrial Grade", 'description' => "High-purity gases for manufacturing"],
                        ['icon' => 'flame', 'title' => "Welding Solutions", 'description' => "Complete welding gas supply"],
                        ['icon' => 'cog', 'title' => "Custom Mixtures", 'description' => "Specialty gas blends available"],
                        ['icon' => 'truck', 'title' => "Bulk Delivery", 'description' => "Regular scheduled deliveries"],
                        ['icon' => 'clock', 'title' => "On-Demand Supply", 'description' => "Emergency orders fulfilled quickly"],
                        ['icon' => 'file-check', 'title' => "Documentation", 'description' => "Full compliance certificates"],
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
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Our Gases</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Industrial Gas Specifications
                </h2>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        Industrial Oxygen
                    </h3>
                    @php
                        $oxygenSpecs = [
                            ['label' => "Purity", 'value' => "99.5% (Industrial Grade)"],
                            ['label' => "Cylinder Sizes", 'value' => "40L, 50L"],
                            ['label' => "Working Pressure", 'value' => "150-200 bar"],
                            ['label' => "Applications", 'value' => "Cutting, Welding, Brazing"],
                            ['label' => "Delivery", 'value' => "Cylinder / Bulk Tanker"],
                            ['label' => "Certification", 'value' => "ISO 7866"],
                        ];
                    @endphp
                    <x-spec-table title="Oxygen Specifications" :specifications="$oxygenSpecs" />
                    <p class="mt-4 text-muted-foreground text-sm">
                        High-purity industrial oxygen for cutting, welding, and combustion applications.
                    </p>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        Industrial Nitrogen
                    </h3>
                    @php
                        $nitrogenSpecs = [
                            ['label' => "Purity", 'value' => "99.999% (High Purity)"],
                            ['label' => "Cylinder Sizes", 'value' => "40L, 50L"],
                            ['label' => "Working Pressure", 'value' => "150-200 bar"],
                            ['label' => "Applications", 'value' => "Inerting, Purging, Packaging"],
                            ['label' => "Delivery", 'value' => "Cylinder / Bulk Tanker"],
                            ['label' => "Certification", 'value' => "ISO 14175"],
                        ];
                    @endphp
                    <x-spec-table title="Nitrogen Specifications" :specifications="$nitrogenSpecs" />
                    <p class="mt-4 text-muted-foreground text-sm">
                        Ultra-high purity nitrogen for inerting, blanketing, and food packaging.
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
                    Need Industrial Gas Supply?
                </h2>
                <p class="text-secondary-foreground/80 mb-6 max-w-2xl mx-auto">
                    Contact us for bulk contracts, regular delivery schedules, or specialty gas requirements.
                </p>
                <a 
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                >
                    Contact Industrial Team
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
