<section id="home" class="relative min-h-screen flex items-center overflow-hidden">
    {{-- Background --}}
    <div class="absolute inset-0">
        <img
            src="{{ isset($bannerData['banner_image']) ? asset('storage/' . $bannerData['banner_image']) : 'https://sdgases.com.np/assets/img/hero-bg.jpg' }}"
            alt="SD Gases Hero"
            class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-secondary/95 via-secondary/80 to-secondary/40"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary/20 backdrop-blur-sm border border-primary/30 rounded-full text-primary-foreground mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m8 3 4 8 5-5 5 15H2L8 3z"/></svg>
                <span class="text-sm font-medium">{{ $bannerData['banner_badge'] ?? "Nepal's Leading Oxygen Provider" }}</span>
            </div>

            {{-- Heading --}}
            <h1 class="text-4xl md:text-5xl lg:text-7xl font-display font-bold text-white leading-tight mb-6">
                {!! str_replace('Climb Beyond', '<span class="text-primary">Climb Beyond</span>', $bannerData['banner_title'] ?? 'Breathe Higher, Climb Beyond') !!}
            </h1>

            <p class="text-lg md:text-xl text-white/80 mb-8 max-w-2xl">
                {!! $bannerData['banner_subtitle'] ?? "High-pressure aviation-grade medical oxygen systems for Himalayan mountaineering. 15+ years of excellence with 80% market share in Nepal's mountaineering oxygen sector." !!}
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-wrap gap-4 mb-12">
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-primary text-primary-foreground font-semibold rounded-xl"
                >
                    Explore Products
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a
                    href="{{ route('about') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-white/10 text-white font-semibold rounded-xl backdrop-blur-sm border border-white/20"
                >
                    Learn More
                </a>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-8 border-t border-white/10 pt-8">
                @foreach($bannerData['banner_stats'] ?? [] as $stat)
                    <div>
                        <p class="text-3xl md:text-4xl font-bold text-white mb-1">{{ $stat['value'] }}</p>
                        <p class="text-sm text-white/60">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
