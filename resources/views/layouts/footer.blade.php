<footer class="bg-secondary text-secondary-foreground">
    <div class="container mx-auto px-4 py-10">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12">
            {{-- Brand --}}
            <div class="lg:col-span-1">
                <img src="{{ isset($generalData['logo']) ? asset('storage/' . $generalData['logo']) : asset('images/sdgases-logo.png') }}" alt="{{ $generalData['site_name'] ?? 'SD Gases' }}" class="h-14 w-auto mb-6" />
                <p class="text-secondary-foreground/70 mb-6 leading-relaxed">
                    Nepal's leading provider of high-pressure aviation-grade medical oxygen 
                    systems for Himalayan mountaineering and helicopter operations.
                </p>
                <div class="flex gap-4">
                    @if(isset($generalData['social_links']) && is_array($generalData['social_links']))
                        @php
                            $socialIcons = [
                                'facebook' => 'fab fa-facebook',
                                'instagram' => 'fab fa-instagram',
                                'youtube' => 'fab fa-youtube',
                                'twitter' => 'fab fa-twitter',
                                'linkedin' => 'fab fa-linkedin',
                                'tiktok' => 'fab fa-tiktok',
                                'whatsapp' => 'fab fa-whatsapp',
                            ];
                        @endphp
                        @foreach($generalData['social_links'] as $link)
                            <a href="{{ $link['url'] }}" target="_blank" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-primary transition-colors hover:scale-110">
                                <i class="{{ $socialIcons[$link['icon']] ?? '' }}" style="font-size: 20px;"></i>
                            </a>
                        @endforeach
                    @endif
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
                    @foreach($menuProducts ?? [] as $product)
                        <li>
                            <a href="{{ route('products.show', $product->slug) }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">
                                {{ $product->title }}
                            </a>
                        </li>
                    @endforeach
                    @foreach($menuServices ?? [] as $service)
                        <li>
                            <a href="{{ route('services.show', $service->slug) }}" class="text-secondary-foreground/70 hover:text-primary transition-colors">
                                {{ $service->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-lg font-display font-semibold mb-6">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary mt-0.5 flex-shrink-0"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span class="text-secondary-foreground/70">
                            {{ $generalData['address'] ?? '' }}
                        </span>
                    </li>
                    <li>
                        <a href="tel:{{ $generalData['contact_phone'] ?? '' }}" class="flex items-center gap-3 text-secondary-foreground/70 hover:text-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary flex-shrink-0"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            {{ $generalData['contact_phone'] ?? '' }}
                        </a>
                    </li>
                </ul>
                {{-- Dynamic Map --}}
                @if(!empty($generalData['google_maps_url']))
                    <div class="mt-6 rounded-xl overflow-hidden shadow-lg border border-white/10">
                        <iframe
                            src="{{ $generalData['google_maps_url'] }}"
                            width="100%"
                            height="200"
                            style="border: 0; pointer-events: auto;"
                            allowfullscreen=""
                            referrerpolicy="no-referrer-when-downgrade"
                            title="SD Gases Location"
                        ></iframe>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-white/20 py-4 bg-secondary">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-secondary-foreground/60">
            <p><b>&copy; 2026 {{ $generalData['site_name'] ?? 'SD Gases' }}. All Rights Reserved.</b></p>
            <p class="font-medium"><b>Powered By </b> <i><a href="https://smartsoft.com.np" target="_blank" class="hover:text-primary transition-colors">Smartsoft Network</a></i></p>
        </div>
    </div>
</footer>
