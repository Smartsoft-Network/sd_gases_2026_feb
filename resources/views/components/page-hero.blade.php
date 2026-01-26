@props(['title', 'subtitle', 'breadcrumbs' => []])

<div class="relative bg-secondary py-20 lg:py-28 overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-[url('/images/hero-bg.jpg')] bg-cover bg-center mix-blend-overlay"></div>
    </div>
    
    {{-- Decorative Elements --}}
    <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-primary/10 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-1/3 h-full bg-gradient-to-r from-primary/5 to-transparent"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl">
            {{-- Breadcrumbs --}}
            <nav class="flex items-center gap-2 text-sm text-secondary-foreground/60 mb-6">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
                @foreach($breadcrumbs as $breadcrumb)
                    <span class="text-secondary-foreground/40">/</span>
                    @if(isset($breadcrumb['href']))
                        <a href="{{ $breadcrumb['href'] }}" class="hover:text-primary transition-colors">{{ $breadcrumb['label'] }}</a>
                    @else
                        <span class="text-primary">{{ $breadcrumb['label'] }}</span>
                    @endif
                @endforeach
            </nav>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 font-display">
                {{ $title }}
            </h1>
            
            @if($subtitle)
                <p class="text-xl text-secondary-foreground/80 max-w-2xl leading-relaxed">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
    </div>
</div>
