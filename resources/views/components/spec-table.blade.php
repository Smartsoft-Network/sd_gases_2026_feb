@props(['title', 'specifications'])

<div 
    x-data="{ shown: false }"
    x-intersect.once="shown = true"
    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
    class="bg-card rounded-2xl overflow-hidden shadow-lg transition-all duration-700 ease-out"
>
    <div class="bg-secondary px-6 py-4">
        <h3 class="text-lg font-bold text-secondary-foreground font-display">{{ $title }}</h3>
    </div>
    <div class="divide-y divide-border">
        @foreach($specifications as $index => $spec)
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'"
                class="flex justify-between items-center px-6 py-4 hover:bg-muted/50 transition-all duration-500"
                style="transition-delay: {{ $index * 50 }}ms"
            >
                <span class="text-muted-foreground font-medium">{{ $spec['label'] }}</span>
                <span class="text-foreground font-semibold">{{ $spec['value'] }}</span>
            </div>
        @endforeach
    </div>
</div>
