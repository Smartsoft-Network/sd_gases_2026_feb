<section id="products" class="py-24 bg-background relative overflow-hidden">
    <div class="container mx-auto px-4">
        {{-- Header --}}
        <div class="text-center max-w-2xl mx-auto mb-16" x-data="{ shown: false }" x-intersect.once="shown = true" :class="{ 'opacity-100 translate-y-0': shown, 'opacity-0 translate-y-10': !shown }" class="transition-all duration-700">
            <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary font-medium rounded-full text-sm mb-4">
                Our Products
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-bold text-foreground mb-4">
                Premium <span class="gradient-text-title to-accent">Oxygen Equipment</span>
            </h2>
            <p class="text-lg text-muted-foreground">
                Explore our high-quality oxygen equipment, designed for professionals 
                and enthusiasts conquering the world's highest peaks.
            </p>
        </div>

        {{-- Products Grid --}}
        <div class="grid md:grid-cols-3 gap-8">
            @if(isset($products) && $products->count() > 0)
                @foreach($products as $index => $product)
                    <div 
                        class="group h-full"
                        x-data="{ shown: false }" 
                        x-intersect.once="shown = true" 
                        :class="{ 'opacity-100 translate-y-0': shown, 'opacity-0 translate-y-10': !shown }" 
                        class="transition-all duration-500 delay-{{ $index * 150 }}"
                    >
                        <div class="bg-card rounded-2xl overflow-hidden shadow-lg border border-border h-full flex flex-col hover:shadow-xl transition-all duration-300">
                            {{-- Image --}}
                            <div class="h-48 relative overflow-hidden bg-muted">
                                @if($product->image_url)
                                    <img 
                                        src="{{ $product->image_url }}" 
                                        alt="{{ $product->title }}" 
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-primary/10">
                                        <span class="text-4xl font-display font-bold text-primary">O₂</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="p-6 flex-1 flex flex-col">
                                <h3 class="text-xl font-display font-bold text-foreground mb-3">
                                    {{ $product->title }}
                                </h3>
                                <p class="text-muted-foreground mb-4 flex-1 line-clamp-3">
                                    {{ $product->description['content'] ?? '' }}
                                </p>

                                {{-- CTA --}}
                                <a
                                    href="{{ route('products.show', $product->slug) }}"
                                    class="inline-flex items-center gap-2 text-primary font-semibold group/link mt-auto"
                                >
                                    Learn More
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 transition-transform group-hover/link:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-12">
                    <p class="text-muted-foreground">No products available at the moment.</p>
                </div>
            @endif
        </div>

        {{-- View All Button --}}
        @if(isset($products) && $products->count() > 0)
            <div class="mt-16 text-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-primary text-white font-bold rounded-full hover:bg-primary-dark transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    View All Products
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        @endif
    </div>
</section>
