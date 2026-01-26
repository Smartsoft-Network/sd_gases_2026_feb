@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="Bulk Supply Contracts"
        subtitle="Long-term supply agreements with dedicated service and competitive pricing"
        :breadcrumbs="[
            ['label' => 'Services', 'href' => route('services.index')],
            ['label' => 'Bulk Supply']
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
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">Partnership</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 mb-6 font-display">
                        Reliable Supply, Guaranteed
                    </h2>
                    <p class="text-muted-foreground mb-6 leading-relaxed">
                        Our bulk supply contracts are designed for organizations that need consistent, reliable 
                        oxygen supply. Whether you're a hospital, industrial facility, or expedition operator, 
                        we offer customized agreements that ensure you never run out of supply.
                    </p>
                    <ul class="space-y-3 mb-8">
                        @foreach(["Volume-based pricing discounts", "Dedicated account manager", "Priority during supply constraints", "Flexible payment terms", "Emergency supply guarantee"] as $item)
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
                        Request Contract Quote
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
                        src="https://images.unsplash.com/photo-1565793298595-6a879b1d9492?w=800"
                        alt="Bulk Supply"
                        class="rounded-2xl shadow-xl"
                    />
                    <div class="absolute -bottom-6 -left-6 bg-primary text-primary-foreground p-6 rounded-xl shadow-lg">
                        <div class="text-3xl font-bold font-display">50+</div>
                        <div class="text-primary-foreground/80 text-sm">Active Contracts</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contract Types --}}
    <section class="py-20 bg-muted/30">
        <div class="container mx-auto px-4">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="text-center mb-16 transition-all duration-700 ease-out"
            >
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Contract Options</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    Contract Types
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $contractTypes = [
                        [
                            'title' => "Hospital Contracts",
                            'description' => "Comprehensive oxygen supply agreements for healthcare facilities of all sizes.",
                            'items' => ["Medical-grade oxygen", "Equipment on loan", "24/7 emergency supply", "Monthly billing", "On-site support"],
                        ],
                        [
                            'title' => "Industrial Contracts",
                            'description' => "Bulk gas supply for manufacturing, construction, and industrial operations.",
                            'items' => ["Bulk cylinder supply", "Tanker delivery", "Regular schedule", "Volume discounts", "Safety compliance"],
                        ],
                        [
                            'title' => "Expedition Contracts",
                            'description' => "Seasonal and annual contracts for expedition companies and mountaineering operators.",
                            'items' => ["Expedition packages", "Basecamp delivery", "Equipment rental", "Training included", "Season pricing"],
                        ],
                    ];
                @endphp
                @foreach($contractTypes as $index => $contract)
                    <div 
                        x-data="{ shown: false }"
                        x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class="bg-card p-8 rounded-xl transition-all duration-700 ease-out hover:-translate-y-2 hover:shadow-lg"
                        style="transition-delay: {{ $index * 100 }}ms"
                    >
                        <h3 class="text-xl font-bold text-foreground mb-3 font-display">{{ $contract['title'] }}</h3>
                        <p class="text-muted-foreground text-sm mb-4">{{ $contract['description'] }}</p>
                        <ul class="space-y-2">
                            @foreach($contract['items'] as $item)
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
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">Contract Benefits</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    What You Get
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $features = [
                        ['icon' => 'trending-down', 'title' => "Volume Discounts", 'description' => "Significant savings on bulk orders"],
                        ['icon' => 'calendar', 'title' => "Scheduled Delivery", 'description' => "Regular delivery on your schedule"],
                        ['icon' => 'users', 'title' => "Account Manager", 'description' => "Dedicated support contact"],
                        ['icon' => 'file-text', 'title' => "Easy Billing", 'description' => "Monthly consolidated invoicing"],
                        ['icon' => 'truck', 'title' => "Priority Supply", 'description' => "First priority during shortages"],
                        ['icon' => 'headphones', 'title' => "24/7 Emergency", 'description' => "Emergency supply guarantee"],
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
                    Ready to Discuss a Contract?
                </h2>
                <p class="text-secondary-foreground/80 mb-6 max-w-2xl mx-auto">
                    Contact us to discuss your requirements and receive a customized contract proposal.
                </p>
                <a
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg btn-glow hover:bg-primary-dark transition-colors"
                >
                    Contact Sales Team
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
