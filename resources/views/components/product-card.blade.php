@props(['title', 'description', 'image', 'href', 'features' => [], 'delay' => 0])

<a href="{{ $href }}" class="group block h-full">
    <div class="h-full bg-card rounded-2xl overflow-hidden border border-border hover:shadow-xl transition-all duration-300 flex flex-col group-hover:-translate-y-1">
        {{-- Image --}}
        <div class="relative h-64 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
            <img 
                src="{{ $image }}" 
                alt="{{ $title }}" 
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            />
            <div class="absolute bottom-4 left-4 z-20">
                <h3 class="text-2xl font-bold text-white font-display">{{ $title }}</h3>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-6 flex-1 flex flex-col">
            <p class="text-muted-foreground mb-6 flex-1 leading-relaxed">
                {{ $description }}
            </p>

            {{-- Features --}}
            @if(count($features) > 0)
                <div class="space-y-2 mb-6">
                    @foreach($features as $feature)
                        <div class="flex items-center gap-2 text-sm text-foreground/80">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-primary"><path d="M20 6 9 17l-5-5"/></svg>
                            {{ $feature }}
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="flex items-center gap-2 text-primary font-semibold mt-auto group-hover:gap-3 transition-all">
                Learn More
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </div>
        </div>
    </div>
</a>
