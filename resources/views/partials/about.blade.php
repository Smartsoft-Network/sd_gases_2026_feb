<section id="about" class="py-16 bg-muted/50 relative overflow-hidden">
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
                    {!! str_replace('Oxygen Systems', '<span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-accent">Oxygen Systems</span>', $aboutData['home_about_title'] ?? "Nepal's Premier Oxygen Systems Provider") !!}
                </h2>
                @foreach($aboutData['home_about_descriptions'] ?? [] as $desc)
                    <p class="{{ $loop->first ? 'text-lg' : '' }} text-muted-foreground mb-6 leading-relaxed">
                        {{ $desc }}
                    </p>
                @endforeach

                {{-- Stats cards --}}
                <div class="grid grid-cols-2 gap-4">
                    @foreach($aboutData['stats'] ?? [] as $stat)
                        <div class="bg-card p-6 text-center rounded-xl shadow-lg border border-border hover:scale-105 transition-transform duration-300">
                            <p class="text-4xl font-display font-bold text-primary mb-1">{{ $stat['value'] }}</p>
                            <p class="text-sm text-muted-foreground">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right content - Feature grid --}}
            <div class="grid sm:grid-cols-2 gap-6">
                @php
                    $features = $aboutData['features'] ?? [];
                @endphp

                @foreach($features as $index => $feature)
                    <div 
                        x-data="{ shown: false }" 
                        x-intersect.once="shown = true" 
                        :class="{ 'opacity-100 translate-y-0': shown, 'opacity-0 translate-y-10': !shown }" 
                        class="bg-card p-6 rounded-xl shadow-lg border border-border group hover:-translate-y-1 transition-all duration-500 delay-{{ $index * 100 }}"
                    >
                        <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors">
                            @php
                                $iconClass = $feature['icon'] ?? 'fas fa-star';
                                // Backward compatibility for old CamelCase names
                                if ($iconClass == 'CheckCircle') $iconClass = 'fas fa-check-circle';
                                elseif ($iconClass == 'DollarSign') $iconClass = 'fas fa-dollar-sign';
                                elseif ($iconClass == 'Users') $iconClass = 'fas fa-users';
                                elseif ($iconClass == 'Zap') $iconClass = 'fas fa-zap';
                                
                                // If it doesn't contain 'fa-', assume it's just a name and prepend 'fas fa-'
                                if (!str_contains($iconClass, 'fa-')) {
                                    $iconClass = 'fas fa-' . strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $iconClass));
                                }
                            @endphp
                            <i class="{{ $iconClass }} text-2xl text-primary"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-sm text-muted-foreground">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
