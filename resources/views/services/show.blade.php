@extends('layouts.public')

@section('content')

@php
    $seo = $service->seo ?? [];
    $seoTitle = $seo['title'] ?? $service->title;
    $seoDescription = $seo['description'] ?? $service->description;
    $seoKeywords = $seo['keywords'] ?? '';
@endphp

@section('title', $seoTitle)
@section('description', $seoDescription)
@section('keywords', $seoKeywords)
    <x-page-hero 
        :title="$service->title"
        :subtitle="$service->description ? Str::limit($service->description, 100) : ''"
        :breadcrumbs="[
            ['label' => 'Services', 'href' => route('services.index')],
            ['label' => $service->title]
        ]"
    />

    {{-- Introduction (Always First) --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div 
                    x-data="{ shown: false }"
                    x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                    class="transition-all duration-700 ease-out"
                >
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">Service Details</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 mb-6 font-display">
                        {{ $service->title }}
                    </h2>
                    <div class="text-muted-foreground mb-6 leading-relaxed">
                        {!! nl2br(e($service->description)) !!}
                    </div>
                    
                    <a 
                        href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                    >
                        Request Service
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>

                <div 
                    x-data="{ shown: false }"
                    x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'"
                    class="relative transition-all duration-700 ease-out"
                >
                    @if($service->image_url)
                        <img
                            src="{{ $service->image_url }}"
                            alt="{{ $service->title }}"
                            class="rounded-2xl shadow-xl w-full"
                        />
                    @else
                        <div class="rounded-2xl shadow-xl w-full h-64 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image Available</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @php
        $detailsData = $service->details_description ?? null;
        $detailsHtml = null;
        $detailsTitle = null;
        $detailsSubtitle = null;

        if (is_array($detailsData)) {
            $detailsHtml = $detailsData['html'] ?? null;
            $detailsTitle = $detailsData['title'] ?? null;
            $detailsSubtitle = $detailsData['subtitle'] ?? null;
        } elseif (is_string($detailsData)) {
            $detailsHtml = $detailsData;
        }

        $sectionsConfig = $service->others_data['sections'] ?? null;

        $hasFeatures = !empty($service->features['items'] ?? []);
        $hasDetails = !empty($detailsHtml);
        $hasOfferings = !empty($service->specifications['variants'] ?? []);
        $hasTutorial = !empty($service->tutorial['items'] ?? []);

        $orderedSections = [];

        if (is_array($sectionsConfig)) {
            foreach (['details_description', 'specifications', 'tutorial', 'features'] as $key) {
                if (!isset($sectionsConfig[$key]) || !is_array($sectionsConfig[$key])) {
                    continue;
                }

                $config = $sectionsConfig[$key];
                $active = (bool)($config['active'] ?? false);
                $order = (int)($config['order'] ?? 0);

                if (!$active) {
                    continue;
                }

                if ($key === 'features' && !$hasFeatures) continue;
                if ($key === 'details_description' && !$hasDetails) continue;
                if ($key === 'specifications' && !$hasOfferings) continue;
                if ($key === 'tutorial' && !$hasTutorial) continue;

                $orderedSections[] = [
                    'key' => $key,
                    'order' => $order,
                ];
            }

            usort($orderedSections, function ($a, $b) {
                return $a['order'] <=> $b['order'];
            });
        } else {
            // Default ordering if no config exists
            if ($hasDetails) $orderedSections[] = ['key' => 'details_description', 'order' => 1];
            if ($hasOfferings) $orderedSections[] = ['key' => 'specifications', 'order' => 2];
            if ($hasTutorial) $orderedSections[] = ['key' => 'tutorial', 'order' => 3];
            if ($hasFeatures) $orderedSections[] = ['key' => 'features', 'order' => 4];
        }
    @endphp

    @foreach ($orderedSections as $section)
        @if ($section['key'] === 'details_description')
            {{-- Introduction / Details Section --}}
            <section class="py-16 bg-background">
                <div class="container mx-auto px-4">
                    <div x-data="{ shown: false }" x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class="mx-auto transition-all duration-700 ease-out">
                        <div class="text-center mb-10">
                            @if ($detailsSubtitle)
                                <span class="text-primary font-semibold uppercase tracking-wider text-xs md:text-sm block mb-2">
                                    {{ $detailsSubtitle }}
                                </span>
                            @endif
                            <h2 class="text-3xl md:text-4xl font-bold text-foreground font-display">
                                {{ $detailsTitle ?? 'Service Overview' }}
                            </h2>
                        </div>
                        <div class="text-muted-foreground leading-relaxed prose-content">
                            {!! $detailsHtml !!}
                        </div>
                    </div>
                </div>
            </section>

        @elseif ($section['key'] === 'specifications')
            {{-- Service Offerings Section --}}
            <section class="py-16 bg-muted/30">
                <div class="container mx-auto px-4">
                    <div x-data="{ shown: false }" x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class="text-center mb-16 transition-all duration-700 ease-out">
                        <span class="text-primary font-semibold uppercase tracking-wider text-sm">
                            {{ $service->specifications['subtitle'] ?? 'Our Services' }}
                        </span>
                        <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                            {{ $service->specifications['title'] ?? 'What We Offer' }}
                        </h2>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($service->specifications['variants'] ?? [] as $index => $offering)
                            <div 
                                x-data="{ shown: false }"
                                x-intersect.once="shown = true"
                                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                                class="bg-card p-8 rounded-2xl shadow-lg border border-border transition-all duration-700 ease-out hover:shadow-xl hover:-translate-y-1"
                                style="transition-delay: {{ $index * 100 }}ms"
                            >
                                <h3 class="text-xl font-bold text-foreground mb-4 font-display">{{ $offering['title'] }}</h3>
                                @if(!empty($offering['description']))
                                    <p class="text-muted-foreground text-sm mb-6 leading-relaxed">{{ $offering['description'] }}</p>
                                @endif
                                
                                @if(!empty($offering['specs']))
                                    <ul class="space-y-3">
                                        @foreach($offering['specs'] as $item)
                                            <li class="flex items-start gap-3 text-sm text-foreground">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-primary mt-0.5 flex-shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                                <span>{{ $item['value'] }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

        @elseif ($section['key'] === 'tutorial')
            {{-- Tutorial Section --}}
            <section class="py-16 bg-background">
                <div class="container mx-auto px-4">
                    @php
                        $tutorialItems = $service->tutorial['items'] ?? [];
                    @endphp

                    @if (!empty($tutorialItems))
                        <div x-data="{ shown: false }" x-intersect.once="shown = true"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            class="max-w-6xl mx-auto transition-all duration-700 ease-out">
                            @if (!empty($service->tutorial['section_subtitle']) || !empty($service->tutorial['section_title']))
                                <div class="text-center mb-16">
                                    @if (!empty($service->tutorial['section_subtitle']))
                                        <span
                                            class="text-primary font-semibold uppercase tracking-wider text-xs md:text-sm block mb-2">
                                            {{ $service->tutorial['section_subtitle'] }}
                                        </span>
                                    @endif
                                    @if (!empty($service->tutorial['section_title']))
                                        <h2 class="text-2xl md:text-3xl font-bold text-foreground font-display">
                                            {{ $service->tutorial['section_title'] }}
                                        </h2>
                                    @endif
                                </div>
                            @endif

                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach ($tutorialItems as $item)
                                    @php
                                        $videoUrl = $item['youtube_url'] ?? null;
                                        $embedUrl = '';
                                        
                                        if ($videoUrl) {
                                            if (str_contains($videoUrl, '<iframe')) {
                                                // Extract src from iframe if it's already an iframe string
                                                if (preg_match('/src="([^"]+)"/', $videoUrl, $matches)) {
                                                    $videoUrl = $matches[1];
                                                }
                                            }

                                            // Standard conversion logic as used in gallery
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
                                                // Fallback: try to extract ID anyway if it's just the ID
                                                if (preg_match('/([a-zA-Z0-9_-]{11})/', $videoUrl, $idMatches)) {
                                                    $embedUrl = "https://www.youtube.com/embed/" . $idMatches[1];
                                                } else {
                                                    $embedUrl = $videoUrl;
                                                }
                                            }
                                        }
                                    @endphp

                                    <div class="bg-card rounded-2xl shadow-lg border border-border overflow-hidden flex flex-col">
                                        @if ($embedUrl)
                                            <div class="aspect-video bg-black">
                                                <iframe 
                                                    class="w-full h-full"
                                                    src="{{ $embedUrl }}" 
                                                    title="YouTube video player" 
                                                    frameborder="0" 
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                                    referrerpolicy="strict-origin-when-cross-origin" 
                                                    allowfullscreen
                                                ></iframe>
                                            </div>
                                        @endif

                                        @if (!empty($item['description']))
                                            <div class="p-4 md:p-5 flex-1 flex" style="border-top: 1px solid #f6f6f6;">
                                                <div class="text-muted-foreground leading-relaxed text-sm">
                                                    {!! nl2br(e($item['description'])) !!}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </section>

        @elseif ($section['key'] === 'features')
            {{-- Service Features Section --}}
            <section class="py-16 bg-background">
                <div class="container mx-auto px-4">
                    <div x-data="{ shown: false }" x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class="text-center mb-16 transition-all duration-700 ease-out">
                        <span class="text-primary font-semibold uppercase tracking-wider text-sm">
                            {{ $service->features['subtitle'] ?? 'Why Choose Us' }}
                        </span>
                        <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                            {{ $service->features['title'] ?? 'Service Features' }}
                        </h2>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($service->features['items'] ?? [] as $index => $feature)
                            <x-feature-card 
                                :icon="$feature['icon']" 
                                :title="$feature['title']" 
                                :description="$feature['description']" 
                                :delay="$index * 100" 
                            />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach

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
                    {{ $service->others_data['cta_title'] ?? 'Need this Service?' }}
                </h2>
                <p class="text-secondary-foreground/80 mb-6 max-w-2xl mx-auto">
                    {{ $service->others_data['cta_subtitle'] ?? 'Contact us for scheduling or more information.' }}
                </p>
                <a 
                    href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]"
                >
                    Contact Us
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
