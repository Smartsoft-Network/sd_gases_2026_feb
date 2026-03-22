@extends('layouts.public')

@section('content')
    <x-page-hero 
        title="{{ $tutorialVideosPageData['hero_title'] ?? 'Tutorial Videos' }}"
        subtitle="{{ $tutorialVideosPageData['hero_subtitle'] ?? 'Learn how to use our oxygen systems and equipment with our detailed video guides.' }}"
        :breadcrumbs="[['label' => $tutorialVideosPageData['page_title'] ?? 'Gallery']]"
    />

    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($videos->isEmpty())
                    <div class="col-span-full text-center py-12">
                        <p class="text-muted-foreground text-lg">No tutorial videos available at the moment.</p>
                    </div>
                @else
                    @foreach($videos as $index => $video)
                        @php
                            $videoUrl = $video->video_url;
                            $embedUrl = '';
                            
                            // Convert YouTube URL to embed URL
                            if (str_contains($videoUrl, 'youtube.com/watch?v=')) {
                                $videoId = explode('v=', $videoUrl)[1];
                                $videoId = explode('&', $videoId)[0];
                                $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                            } elseif (str_contains($videoUrl, 'youtu.be/')) {
                                $videoId = explode('youtu.be/', $videoUrl)[1];
                                $videoId = explode('?', $videoId)[0];
                                $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                            } elseif (str_contains($videoUrl, 'youtube.com/embed/')) {
                                $embedUrl = $videoUrl;
                            } else {
                                $embedUrl = $videoUrl; // Fallback
                            }
                        @endphp
                        <div 
                            x-data="{ shown: false }"
                            x-intersect.once="shown = true"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            class="group relative bg-card rounded-2xl overflow-hidden shadow-lg border border-border hover:shadow-xl transition-all duration-300"
                            style="transition-delay: {{ $index * 100 }}ms"
                        >
                            <div class="aspect-video relative overflow-hidden bg-black">
                                <iframe 
                                    class="w-full h-full"
                                    src="{{ $embedUrl }}" 
                                    title="{{ $video->title }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    referrerpolicy="strict-origin-when-cross-origin" 
                                    allowfullscreen
                                ></iframe>
                            </div>
                            
                            <div class="px-6 py-2 pb-4" style="border-top: 1px solid #f6f6f6;">
                                <h3 class="text-xl font-bold text-foreground mb-2 font-display">{{ $video->title }}</h3>
                                @if($video->description)
                                    <p class="text-muted-foreground line-clamp-3">
                                        {{ $video->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-12 bg-secondary">
        <div class="container mx-auto px-4 text-center">
            <div 
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-700 ease-out"
            >
                <h2 class="text-2xl md:text-3xl font-bold text-secondary-foreground mb-4 font-display">
                    Still Have Questions?
                </h2>
                <p class="text-secondary-foreground/80 mb-6">
                    Our team is here to help you with any technical queries or support you need.
                </p>
                <a 
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                >
                    Contact Support
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
