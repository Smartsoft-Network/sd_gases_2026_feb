<footer class="bg-secondary text-secondary-foreground">
    <div class="container mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12">
            {{-- Brand --}}
            <div class="lg:col-span-1">
                <img src="{{ asset('images/sdgases-logo.png') }}" alt="SD Gases" class="h-14 w-auto mb-6" />
                <p class="text-secondary-foreground/70 mb-6 leading-relaxed">
                    Nepal's leading provider of high-pressure aviation-grade medical oxygen 
                    systems for Himalayan mountaineering and helicopter operations.
                </p>
                <div class="flex gap-4">
                    {{-- Facebook --}}
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-primary transition-colors hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    {{-- Instagram --}}
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-primary transition-colors hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                    {{-- Youtube --}}
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-primary transition-colors hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-lg font-display font-semibold mb-6">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">About Us</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">Products</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">Services</a></li>
                    <li><a href="{{ route('contact') }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">Contact</a></li>
                </ul>
            </div>

            {{-- Products --}}
            <div>
                <h4 class="text-lg font-display font-semibold mb-6">Products</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('products.himalayan-oxygen') }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">Oxygen Cylinders</a></li>
                    <li><a href="{{ route('products.medical-oxygen') }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">Oxygen Regulators</a></li>
                    <li><a href="{{ route('products.emergency-oxygen') }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">Oxygen Masks</a></li>
                    <li><a href="{{ route('services.cylinder-refilling') }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">Refilling Services</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-lg font-display font-semibold mb-6">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary mt-0.5 flex-shrink-0"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span class="text-secondary-foreground/70">
                            Patan Dhoka, Lalitpur, Nepal
                        </span>
                    </li>
                    <li>
                        <a href="tel:+01-5533950" class="flex items-center gap-3 text-secondary-foreground/70 hover:text-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary flex-shrink-0"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            +01-5533950
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
