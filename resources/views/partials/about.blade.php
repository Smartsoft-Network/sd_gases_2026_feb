<section id="about" class="py-24 bg-muted/50 relative overflow-hidden">
    {{-- Pattern overlay --}}
    <div class="absolute inset-0 opacity-50 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px]"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Left content --}}
            <div x-data="{ shown: false }" x-intersect.once="shown = true" :class="{ 'opacity-100 translate-x-0': shown, 'opacity-0 -translate-x-10': !shown }" class="transition-all duration-700">
                <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary font-medium rounded-full text-sm mb-4">
                    About SD Gases
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-bold text-foreground mb-6 leading-tight">
                    Nepal's Premier <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-accent">Oxygen Systems</span> Provider
                </h2>
                <p class="text-lg text-muted-foreground mb-6 leading-relaxed">
                    SD Gases is the major service provider of high-pressure aviation-grade, 
                    medical supplementary oxygen systems for high-altitude Himalayan mountaineering. 
                    We specialize in the development, manufacture, and post-sales service of 
                    supplemental oxygen systems for use at extreme altitudes.
                </p>
                <p class="text-muted-foreground mb-8 leading-relaxed">
                    With over 15 years in the industry, we've grown to be Nepal's most trusted 
                    refilling and assembling center, handling 80% of the total market in 
                    mountaineering supplementary oxygen business.
                </p>

                {{-- Stats cards --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-card p-6 text-center rounded-xl shadow-lg border border-border hover:scale-105 transition-transform duration-300">
                        <p class="text-4xl font-display font-bold text-primary mb-1">15+</p>
                        <p class="text-sm text-muted-foreground">Years of Excellence</p>
                    </div>
                    <div class="bg-card p-6 text-center rounded-xl shadow-lg border border-border hover:scale-105 transition-transform duration-300">
                        <p class="text-4xl font-display font-bold text-primary mb-1">80%</p>
                        <p class="text-sm text-muted-foreground">Market Share in Nepal</p>
                    </div>
                </div>
            </div>

            {{-- Right content - Feature grid --}}
            <div class="grid sm:grid-cols-2 gap-6">
                @php
                    $features = [
                        ['icon' => 'CheckCircle', 'title' => 'Best Quality', 'desc' => 'We provide best quality products and services meeting international standards.'],
                        ['icon' => 'DollarSign', 'title' => 'Reasonable Pricing', 'desc' => 'Competitive pricing without compromising on quality or safety.'],
                        ['icon' => 'Users', 'title' => 'Expert Team', 'desc' => 'Russian experts with decades of experience working with our team.'],
                        ['icon' => 'Zap', 'title' => 'Efficient Service', 'desc' => 'Quick turnaround with time-efficient service delivery.'],
                    ];
                @endphp

                @foreach($features as $index => $feature)
                    <div 
                        x-data="{ shown: false }" 
                        x-intersect.once="shown = true" 
                        :class="{ 'opacity-100 translate-y-0': shown, 'opacity-0 translate-y-10': !shown }" 
                        class="bg-card p-6 rounded-xl shadow-lg border border-border group hover:-translate-y-1 transition-all duration-500 delay-{{ $index * 100 }}"
                    >
                        <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors">
                            {{-- Icons based on name --}}
                            @if($feature['icon'] == 'CheckCircle')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m22 4-12 12-4-4"/></svg>
                            @elseif($feature['icon'] == 'DollarSign')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-primary"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            @elseif($feature['icon'] == 'Users')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-primary"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            @elseif($feature['icon'] == 'Zap')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-primary"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14H4z"/></svg>
                            @endif
                        </div>
                        <h3 class="font-bold text-lg mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-sm text-muted-foreground">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
