<section id="products" class="py-24 bg-background relative overflow-hidden">
    <div class="container mx-auto px-4">
        {{-- Header --}}
        <div class="text-center max-w-2xl mx-auto mb-16" x-data="{ shown: false }" x-intersect.once="shown = true" :class="{ 'opacity-100 translate-y-0': shown, 'opacity-0 translate-y-10': !shown }" class="transition-all duration-700">
            <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary font-medium rounded-full text-sm mb-4">
                Our Products
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-bold text-foreground mb-4">
                Premium <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-accent">Oxygen Equipment</span>
            </h2>
            <p class="text-lg text-muted-foreground">
                Explore our high-quality oxygen equipment, designed for professionals 
                and enthusiasts conquering the world's highest peaks.
            </p>
        </div>

        {{-- Products Grid --}}
        <div class="grid md:grid-cols-3 gap-8">
            @php
                $products = [
                    [
                        'name' => 'Oxygen Cylinder',
                        'desc' => 'Lightweight, durable 4-liter water capacity cylinders at 300BAR fill pressure. The lightest on the market.',
                        'features' => ['4L Water Capacity', '300BAR Pressure', 'Ultra Lightweight'],
                        'gradient' => 'from-primary/20 to-primary/5',
                        'link' => route('products.himalayan-oxygen')
                    ],
                    [
                        'name' => 'Oxygen Regulator',
                        'desc' => 'Precise and reliable regulators designed for extreme high-altitude environments with durable construction.',
                        'features' => ['Precise Flow Control', 'Durable Build', 'Easy Operation'],
                        'gradient' => 'from-secondary/20 to-secondary/5',
                        'link' => route('products.medical-oxygen')
                    ],
                    [
                        'name' => 'Oxygen Mask',
                        'desc' => 'High-quality aviation-grade masks preferred by high-altitude climbers for comfort and efficiency.',
                        'features' => ['Aviation Grade', 'Comfortable Fit', 'High Efficiency'],
                        'gradient' => 'from-primary/15 to-accent/20',
                        'link' => route('products.emergency-oxygen')
                    ],
                ];
            @endphp

            @foreach($products as $index => $product)
                <div 
                    class="group h-full"
                    x-data="{ shown: false }" 
                    x-intersect.once="shown = true" 
                    :class="{ 'opacity-100 translate-y-0': shown, 'opacity-0 translate-y-10': !shown }" 
                    class="transition-all duration-500 delay-{{ $index * 150 }}"
                >
                    <div class="bg-card rounded-2xl overflow-hidden shadow-lg border border-border h-full flex flex-col hover:shadow-xl transition-all duration-300">
                        {{-- Image placeholder with gradient --}}
                        <div class="h-48 bg-gradient-to-br {{ $product['gradient'] }} flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-card/50 to-transparent"></div>
                            <div class="w-24 h-24 rounded-full bg-primary/20 backdrop-blur-sm flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                <span class="text-4xl font-display font-bold text-primary">O₂</span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-display font-bold text-foreground mb-3">
                                {{ $product['name'] }}
                            </h3>
                            <p class="text-muted-foreground mb-4 flex-1">
                                {{ $product['desc'] }}
                            </p>

                            {{-- Features --}}
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($product['features'] as $feature)
                                    <span class="px-3 py-1 text-xs font-medium bg-muted text-muted-foreground rounded-full">
                                        {{ $feature }}
                                    </span>
                                @endforeach
                            </div>

                            {{-- CTA --}}
                            <a
                                href="{{ $product['link'] }}"
                                class="inline-flex items-center gap-2 text-primary font-semibold group/link"
                            >
                                Learn More
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 transition-transform group-hover/link:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
