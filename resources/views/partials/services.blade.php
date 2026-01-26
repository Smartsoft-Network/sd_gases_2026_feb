<section id="services" class="py-24 bg-secondary text-secondary-foreground relative overflow-hidden">
    {{-- Decorative elements --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Header --}}
        <div class="text-center max-w-2xl mx-auto mb-16" x-data="{ shown: false }" x-intersect.once="shown = true" :class="{ 'opacity-100 translate-y-0': shown, 'opacity-0 translate-y-10': !shown }" class="transition-all duration-700">
            <span class="inline-block px-4 py-1.5 bg-primary/20 text-primary font-medium rounded-full text-sm mb-4">
                Our Services
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-bold mb-4">
                Complete <span class="text-primary">Oxygen Solutions</span>
            </h2>
            <p class="text-lg text-secondary-foreground/70">
                From refilling to repairs, we provide comprehensive services for all your 
                high-altitude oxygen needs.
            </p>
        </div>

        {{-- Services Grid --}}
        <div class="grid md:grid-cols-3 gap-8 mb-20">
            @php
                $services = [
                    ['icon' => 'RefreshCw', 'title' => 'Refilling', 'desc' => 'Only company in Nepal using liquid trans-fill technology for high-pressure cylinders, maintaining optimal dew point moisture.', 'link' => route('services.cylinder-refilling')],
                    ['icon' => 'ShoppingCart', 'title' => 'Sales & Rental', 'desc' => 'High-quality cylinders, regulators, and facemasks available for purchase or rental with fast service.', 'link' => route('services.equipment-rental')],
                    ['icon' => 'Wrench', 'title' => 'Repair & Maintenance', 'desc' => 'Expert repair services with genuine Russian spare parts and professional purging services.', 'link' => route('services.maintenance')],
                ];
            @endphp

            @foreach($services as $index => $service)
                <div 
                    class="group h-full"
                    x-data="{ shown: false }" 
                    x-intersect.once="shown = true" 
                    :class="{ 'opacity-100 translate-y-0': shown, 'opacity-0 translate-y-10': !shown }" 
                    class="transition-all duration-500 delay-{{ $index * 150 }}"
                >
                    <a href="{{ $service['link'] }}" class="block h-full">
                        <div class="p-8 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300 h-full">
                            <div class="w-16 h-16 rounded-xl bg-primary/20 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-transform">
                                @if($service['icon'] == 'RefreshCw')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>
                                @elseif($service['icon'] == 'ShoppingCart')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                                @elseif($service['icon'] == 'Wrench')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                @endif
                            </div>
                            <h3 class="text-xl font-display font-bold mb-3">
                                {{ $service['title'] }}
                            </h3>
                            <p class="text-secondary-foreground/70 leading-relaxed">
                                {{ $service['desc'] }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
