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
            @if(isset($services) && $services->count() > 0)
                @foreach($services as $index => $service)
                    <div 
                        class="group h-full"
                        x-data="{ shown: false }" 
                        x-intersect.once="shown = true" 
                        :class="{ 'opacity-100 translate-y-0': shown, 'opacity-0 translate-y-10': !shown }" 
                        class="transition-all duration-500 delay-{{ $index * 150 }}"
                    >
                        <a href="{{ route('services.show', $service->slug) }}" class="block h-full">
                            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden shadow-lg h-full flex flex-col hover:bg-white/10 hover:shadow-xl transition-all duration-300">
                                {{-- Image --}}
                                <div class="h-48 relative overflow-hidden bg-white/5">
                                    @if($service->image_url)
                                        <img 
                                            src="{{ $service->image_url }}" 
                                            alt="{{ $service->title }}" 
                                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-primary/10">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-primary opacity-50"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                        </div>
                                    @endif
                                </div>

                                {{-- Content --}}
                                <div class="p-6 flex-1 flex flex-col">
                                    <h3 class="text-xl font-display font-bold mb-3">
                                        {{ $service->title }}
                                    </h3>
                                    <p class="text-secondary-foreground/70 leading-relaxed flex-1 line-clamp-3 mb-4">
                                        {{ $service->description }}
                                    </p>

                                    {{-- CTA --}}
                                    <div class="inline-flex items-center gap-2 text-primary font-semibold group/link mt-auto">
                                        Learn More
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 transition-transform group-hover/link:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-12">
                    <p class="text-secondary-foreground/70">No services available at the moment.</p>
                </div>
            @endif
        </div>

        {{-- View All Button --}}
        @if(isset($services) && $services->count() > 0)
            <div class="text-center">
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-primary text-white font-bold rounded-full hover:bg-primary-dark transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    View All Services
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        @endif
    </div>
</section>
