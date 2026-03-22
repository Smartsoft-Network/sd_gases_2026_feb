@extends('layouts.public')

@section('content')
    <x-page-hero 
        title="Our Products"
        :subtitle="$productMainData['hero_subtitle'] ?? 'Complete range of oxygen solutions for mountaineering, medical, and industrial applications'"
        :breadcrumbs="[['label' => 'Products']]"
    />

    {{-- Features Bar --}}
    <section class="py-8 bg-muted/30 border-b border-border">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-4">
                @foreach($productMainData['features'] ?? [] as $index => $feature)
                    <div 
                        x-data="{ shown: false }"
                        x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        class="flex items-center gap-3 transition-all duration-700 ease-out"
                        style="transition-delay: {{ $index * 100 }}ms"
                    >
                        <div class="flex-shrink-0">
                            <i class="{{ $feature['icon'] ?? 'fas fa-star' }} text-xl text-primary"></i>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-foreground whitespace-nowrap">{{ $feature['title'] }}</span>
                            <span class="text-muted-foreground text-sm border-l border-border pl-2 line-clamp-1">{{ $feature['desc'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-primary font-semibold uppercase tracking-wider text-sm">{{ $productMainData['category_section_browse'] ?? 'Browse Our Range' }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                    {{ $productMainData['category_section_title'] ?? 'Product Categories' }}
                </h2>
                <p class="text-muted-foreground mt-4 max-w-2xl mx-auto">
                    {!! $productMainData['category_section_desc'] ?? 'From the summit of Everest to hospital wards, we provide oxygen solutions that save lives and enable achievements.' !!}
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                @if($products->isEmpty())
                    <div class="col-span-full text-center py-12">
                        <p class="text-muted-foreground text-lg">No products available at the moment.</p>
                    </div>
                @else
                    @foreach($products as $index => $product)
                        <div 
                            x-data="{ shown: false }"
                            x-intersect.once="shown = true"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            class="group relative bg-card rounded-2xl overflow-hidden shadow-lg border border-border hover:shadow-xl transition-all duration-300"
                            style="transition-delay: {{ $index * 100 }}ms"
                        >
                            <div class="aspect-video relative overflow-hidden">
                                <div class="absolute inset-0 bg-primary/10 group-hover:bg-primary/0 transition-colors z-10"></div>
                                @if($product->image_url)
                                    <img 
                                        src="{{ $product->image_url }}" 
                                        alt="{{ $product->title }}" 
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                    >
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-6" style="border-top: 1px solid #f6f6f6;">
                                <h3 class="text-xl font-bold text-foreground mb-3 font-display">{{ $product->title }}</h3>
                                <p class="text-muted-foreground mb-6 line-clamp-3">
                                    {{ $product->description['content'] ?? '' }}
                                </p>
                                
                                <a 
                                    href="{{ route('products.show', $product->slug) }}" 
                                    class="inline-flex items-center text-primary font-semibold hover:gap-2 transition-all"
                                >
                                    View Details
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-12 bg-secondary">
        <div class="container mx-auto px-4 text-center">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-700 ease-out"
            >
                <h2 class="text-2xl md:text-3xl font-bold text-secondary-foreground mb-4 font-display">
                    Need Custom Solutions?
                </h2>
                <p class="text-secondary-foreground/80 mb-6">
                    Contact us for tailored oxygen solutions for your specific requirements.
                </p>
                <a 
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                >
                    Get Custom Quote
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
