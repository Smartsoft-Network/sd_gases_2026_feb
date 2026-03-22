{{-- Top bar --}}
<div class="bg-secondary text-secondary-foreground py-2 text-sm hidden md:block">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="flex items-center gap-6">
            <a href="mailto:{{ $generalData['contact_email'] ?? '' }}" class="flex items-center gap-2 hover:text-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                {{ $generalData['contact_email'] ?? '' }}
            </a>
            <a href="tel:{{ $generalData['contact_phone'] ?? '' }}" class="flex items-center gap-2 hover:text-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                {{ $generalData['contact_phone'] ?? '' }}
            </a>
        </div>
        <p class="text-muted-foreground">{{ $generalData['address'] ?? '' }}</p>
    </div>
</div>

{{-- Main header --}}
<header 
    x-data="{ mobileMenuOpen: false, scrolled: false }" 
    @scroll.window="scrolled = (window.pageYOffset > 50)"
    :class="{ 'bg-card/95 backdrop-blur-md shadow-lg': scrolled, 'bg-card': !scrolled }"
    class="sticky top-0 z-50 transition-all duration-300 bg-card"
>
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ isset($generalData['logo']) ? asset('storage/' . $generalData['logo']) : asset('images/sdgases-logo.png') }}" alt="{{ $generalData['site_name'] ?? 'SD Gases' }}" class="h-12 md:h-14 w-auto" />
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-1">
                {{-- Home --}}
                <a href="{{ route('home') }}" class="px-4 py-2 text-foreground/80 font-medium hover:text-primary transition-colors flex items-center gap-1">Home</a>
                
                {{-- About --}}
                <a href="{{ route('about') }}" class="px-4 py-2 text-foreground/80 font-medium hover:text-primary transition-colors flex items-center gap-1">About</a>

                {{-- Products Dropdown --}}
                <div class="relative group">
                    <a href="{{ route('products.index') }}" class="px-4 py-2 text-foreground/80 font-medium hover:text-primary transition-colors flex items-center gap-1 cursor-pointer">
                        Products
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m6 9 6 6 6-6"/></svg>
                    </a>
                    <div class="absolute top-full left-0 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="bg-card rounded-xl shadow-xl border border-border p-2 min-w-48">
                            @foreach($menuProducts ?? [] as $product)
                                <a href="{{ route('products.show', $product->slug) }}" class="block px-4 py-2 text-sm text-foreground/80 hover:bg-accent hover:text-primary rounded-lg transition-colors">
                                    {{ $product->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Services Dropdown --}}
                <div class="relative group">
                    <a href="{{ route('services.index') }}" class="px-4 py-2 text-foreground/80 font-medium hover:text-primary transition-colors flex items-center gap-1 cursor-pointer">
                        Services
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m6 9 6 6 6-6"/></svg>
                    </a>
                    <div class="absolute top-full left-0 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="bg-card rounded-xl shadow-xl border border-border p-2 min-w-48">
                            @foreach($menuServices ?? [] as $service)
                                <a href="{{ route('services.show', $service->slug) }}" class="block px-4 py-2 text-sm text-foreground/80 hover:bg-accent hover:text-primary rounded-lg transition-colors">
                                    {{ $service->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Tutorial Videos --}}
                @if($tutorialVideosPageData['is_enabled'] ?? true)
                    <a href="{{ route('tutorial-videos.index') }}" class="px-4 py-2 text-foreground/80 font-medium hover:text-primary transition-colors flex items-center gap-1">{{ $tutorialVideosPageData['page_title'] ?? 'Gallery' }}</a>
                @endif

                {{-- Contact --}}
                {{-- <a href="{{ route('gallery') }}" class="px-4 py-2 text-foreground/80 font-medium hover:text-primary transition-colors flex items-center gap-1">Gallery</a> --}}
                
                {{-- Quote Button --}}
                <a href="{{ route('contact') }}" class="ml-4 px-6 py-2 bg-primary text-primary-foreground font-medium rounded-lg hover:bg-primary-dark transition-colors shadow-lg shadow-primary/25">
                    Contact
                </a>
            </nav>

            {{-- Mobile Menu Button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-foreground">
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div 
        x-show="mobileMenuOpen" 
        x-transition
        class="lg:hidden absolute top-full left-0 w-full bg-card border-t border-border shadow-xl p-4 flex flex-col gap-4 h-[calc(100vh-80px)] overflow-y-auto"
    >
        <a href="{{ route('home') }}" class="text-lg font-medium text-foreground py-2 border-b border-border/50">Home</a>
        <a href="{{ route('about') }}" class="text-lg font-medium text-foreground py-2 border-b border-border/50">About</a>
        
        <div x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center justify-between w-full text-lg font-medium text-foreground py-2 border-b border-border/50">
                Products
                <svg :class="{'rotate-180': open}" class="transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
            </button>
            <div x-show="open" class="pl-4 py-2 flex flex-col gap-2 bg-accent/30 rounded-lg mt-2">
                <a href="{{ route('products.index') }}" class="py-2 text-primary font-medium border-b border-primary/10">All Products</a>
                @foreach($menuProducts ?? [] as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="py-2 text-foreground/80 hover:text-primary transition-colors">
                        {{ $product->title }}
                    </a>
                @endforeach
            </div>
        </div>

        <div x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center justify-between w-full text-lg font-medium text-foreground py-2 border-b border-border/50">
                Services
                <svg :class="{'rotate-180': open}" class="transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
            </button>
            <div x-show="open" class="pl-4 py-2 flex flex-col gap-2 bg-accent/30 rounded-lg mt-2">
                <a href="{{ route('services.index') }}" class="py-2 text-primary font-medium border-b border-primary/10">All Services</a>
                @foreach($menuServices ?? [] as $service)
                    <a href="{{ route('services.show', $service->slug) }}" class="py-2 text-foreground/80 hover:text-primary transition-colors">
                        {{ $service->title }}
                    </a>
                @endforeach
            </div>
        </div>

        @if($tutorialVideosPageData['is_enabled'] ?? true)
            <a href="{{ route('tutorial-videos.index') }}" class="text-lg font-medium text-foreground py-2 border-b border-border/50">{{ $tutorialVideosPageData['page_title'] ?? 'Gallery' }}</a>
        @endif

        <a href="{{ route('contact') }}" class="text-lg font-medium text-foreground py-2 border-b border-border/50">Contact</a>
    </div>
</header>
