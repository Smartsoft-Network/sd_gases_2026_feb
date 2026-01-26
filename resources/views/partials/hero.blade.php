<section id="home" class="relative min-h-screen flex items-center overflow-hidden">
    {{-- Background --}}
    <div class="absolute inset-0">
        <img
            src="https://sdgases.com.np/assets/img/hero-bg.jpg"
            alt="SD Gases Hero"
            class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-secondary/95 via-secondary/80 to-secondary/40"></div>
    </div>

    {{-- Floating elements (Simplified CSS animation) --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 right-1/4 w-64 h-64 bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/3 w-48 h-48 bg-primary/20 rounded-full blur-2xl animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary/20 backdrop-blur-sm border border-primary/30 rounded-full text-primary-foreground mb-6 animate-fade-in-up">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m8 3 4 8 5-5 5 15H2L8 3z"/></svg>
                <span class="text-sm font-medium">Nepal's Leading Oxygen Provider</span>
            </div>

            {{-- Heading --}}
            <h1 class="text-4xl md:text-5xl lg:text-7xl font-display font-bold text-white leading-tight mb-6 animate-fade-in-up delay-100">
                Breathe Higher, <span class="text-primary">Climb Beyond</span>
            </h1>

            <p class="text-lg md:text-xl text-white/80 mb-8 max-w-2xl animate-fade-in-up delay-200">
                High-pressure aviation-grade medical oxygen systems for Himalayan mountaineering. 
                15+ years of excellence with 80% market share in Nepal's mountaineering oxygen sector.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-wrap gap-4 mb-12 animate-fade-in-up delay-300">
                <a
                    href="#products"
                    class="group inline-flex items-center gap-2 px-8 py-4 bg-primary text-primary-foreground font-semibold rounded-xl hover:bg-primary-dark transition-all hover:scale-105"
                >
                    Explore Products
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 transition-transform group-hover:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a
                    href="{{ route('about') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-white/10 text-white font-semibold rounded-xl backdrop-blur-sm border border-white/20 hover:bg-white/20 transition-all hover:scale-105"
                >
                    Learn More
                </a>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-8 border-t border-white/10 pt-8 animate-fade-in-up delay-500">
                <div>
                    <p class="text-3xl md:text-4xl font-bold text-white mb-1">15+</p>
                    <p class="text-sm text-white/60">Years Experience</p>
                </div>
                <div>
                    <p class="text-3xl md:text-4xl font-bold text-white mb-1">80%</p>
                    <p class="text-sm text-white/60">Market Share</p>
                </div>
                <div>
                    <p class="text-3xl md:text-4xl font-bold text-white mb-1">24/7</p>
                    <p class="text-sm text-white/60">Support</p>
                </div>
            </div>
        </div>
    </div>
</section>
