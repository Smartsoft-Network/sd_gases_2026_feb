@extends('layouts.public')

@section('content')

@php
    $seo = $product->seo ?? [];
    $seoTitle = $seo['title'] ?? $product->title;
    $seoDescription = $seo['description'] ?? ($product->description['content'] ?? null);
    $seoKeywords = $seo['keywords'] ?? '';
@endphp

@section('title', $seoTitle)
@section('description', $seoDescription)
@section('keywords', $seoKeywords)
    <x-page-hero :title="$product->title" :subtitle="$product->description['content'] ?? null ? Str::limit($product->description['content'], 100) : ''" :breadcrumbs="[['label' => 'Products', 'href' => route('products.index')], ['label' => $product->title]]" />

    {{-- Introduction --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div x-data="{ shown: false }" x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                    class="transition-all duration-700 ease-out">
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">Product Details</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 mb-6 font-display">
                        {{ $product->title }}
                    </h2>
                    <div class="text-muted-foreground mb-6 leading-relaxed">
                        {!! nl2br(e($product->description['content'] ?? '')) !!}
                    </div>

                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]">
                        Request Quote
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-4 h-4">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div x-data="{ shown: false }" x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'"
                    class="relative transition-all duration-700 ease-out">
                    @if ($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->title }}"
                            class="rounded-2xl shadow-xl w-full" />
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
        $detailsData = $product->details_description ?? null;
        $detailsHtml = is_array($detailsData) ? ($detailsData['html'] ?? null) : null;
        $detailsTitle = is_array($detailsData) ? ($detailsData['title'] ?? null) : null;
        $detailsSubtitle = is_array($detailsData) ? ($detailsData['subtitle'] ?? null) : null;

        $sectionsConfig = $product->others_data['sections'] ?? null;

        $hasFeatures = !empty($product->features);
        $hasDetails = !empty($detailsHtml);
        $hasSpecifications = !empty($product->specifications);
        $hasTutorial = !empty($product->tutorial);

        $orderedSections = [];

        if (is_array($sectionsConfig)) {
            foreach (['features', 'details_description', 'tutorial', 'specifications'] as $key) {
                if (!isset($sectionsConfig[$key]) || !is_array($sectionsConfig[$key])) {
                    continue;
                }

                $config = $sectionsConfig[$key];
                $active = (bool)($config['active'] ?? false);
                $order = (int)($config['order'] ?? 0);

                if (!$active) {
                    continue;
                }

                if ($key === 'features' && !$hasFeatures) {
                    continue;
                }
                if ($key === 'details_description' && !$hasDetails) {
                    continue;
                }
                if ($key === 'specifications' && !$hasSpecifications) {
                    continue;
                }
                if ($key === 'tutorial' && !$hasTutorial) {
                    continue;
                }

                $orderedSections[] = [
                    'key' => $key,
                    'order' => $order,
                ];
            }

            usort($orderedSections, function ($a, $b) {
                return $a['order'] <=> $b['order'];
            });
        } else {
            if ($hasFeatures) {
                $orderedSections[] = ['key' => 'features', 'order' => 1];
            }
            if ($hasDetails) {
                $orderedSections[] = ['key' => 'details_description', 'order' => 2];
            }
            if ($hasTutorial) {
                $orderedSections[] = ['key' => 'tutorial', 'order' => 3];
            }
            if ($hasSpecifications) {
                $orderedSections[] = ['key' => 'specifications', 'order' => 4];
            }
        }
    @endphp

    @foreach ($orderedSections as $section)
        @if ($section['key'] === 'features')
            <section class="py-16 bg-muted/30">
                <div class="container mx-auto px-4">
                    <div x-data="{ shown: false }" x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class="text-center mb-16 transition-all duration-700 ease-out">
                        <span
                            class="text-primary font-semibold uppercase tracking-wider text-sm">{{ $product->features['subtitle'] ?? 'Why Choose Us' }}</span>
                        <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                            {{ $product->features['title'] ?? 'Key Features' }}
                        </h2>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($product->features['items'] ?? [] as $index => $feature)
                            <x-feature-card :icon="$feature['icon']" :title="$feature['title']" :description="$feature['description']" :delay="$index * 100" />
                        @endforeach
                    </div>
                </div>
            </section>
        @elseif ($section['key'] === 'details_description')
            <section class="pt-16 pb-[0] bg-background">
                <div class="container mx-auto px-4">
                    <div x-data="{ shown: false }" x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class=" mx-auto transition-all duration-700 ease-out">
                        <div class="text-center mb-6">
                            @if ($detailsSubtitle)
                                <span class="text-primary font-semibold uppercase tracking-wider text-xs md:text-sm block mb-2">
                                    {{ $detailsSubtitle }}
                                </span>
                            @endif
                            <h2 class="text-3xl md:text-4xl font-bold text-foreground font-display">
                                {{ $detailsTitle ?? 'Description' }}
                            </h2>
                        </div>
                        <div class="text-muted-foreground leading-relaxed prose-content">
                            {!! $detailsHtml !!}
                        </div>
                    </div>
                </div>
            </section>
        @elseif ($section['key'] === 'tutorial')
            <section class="pt-0 pb-[0] bg-background">
                <div class="container mx-auto px-4">
                    @php
                        $tutorialItems = $product->tutorial['items'] ?? [];
                        if (
                            empty($tutorialItems) &&
                            (!empty($product->tutorial['youtube_iframe']) || !empty($product->tutorial['description']))
                        ) {
                            $tutorialItems[] = [
                                'youtube_url' => $product->tutorial['youtube_iframe'] ?? null,
                                'description' => $product->tutorial['description'] ?? null,
                            ];
                        }
                    @endphp

                    @if (!empty($tutorialItems))
                        <div x-data="{ shown: false }" x-intersect.once="shown = true"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            class="max-w-6xl mx-auto transition-all duration-700 ease-out">
                            @if (!empty($product->tutorial['section_subtitle']) || !empty($product->tutorial['section_title']))
                                <div class="text-center mb-16">
                                    @if (!empty($product->tutorial['section_subtitle']))
                                        <span
                                            class="text-primary font-semibold uppercase tracking-wider text-xs md:text-sm block mb-2">
                                            {{ $product->tutorial['section_subtitle'] }}
                                        </span>
                                    @endif
                                    @if (!empty($product->tutorial['section_title']))
                                        <h2 class="text-2xl md:text-3xl font-bold text-foreground font-display">
                                            {{ $product->tutorial['section_title'] }}
                                        </h2>
                                    @endif
                                </div>
                            @endif

                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach ($tutorialItems as $item)
                                    @php
                                        $videoUrl = $item['youtube_url'] ?? ($item['youtube_iframe'] ?? null);
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
        @elseif ($section['key'] === 'specifications')
            <section class="py-16">
                <div class="container mx-auto px-4">
                    <div x-data="{ shown: false }" x-intersect.once="shown = true"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        class="text-center mb-16 transition-all duration-700 ease-out">
                        <span
                            class="text-primary font-semibold uppercase tracking-wider text-sm">{{ $product->specifications['subtitle'] ?? 'Choose Your System' }}</span>
                        <h2 class="text-3xl md:text-4xl font-bold text-foreground mt-2 font-display">
                            {{ $product->specifications['title'] ?? 'System Specifications' }}
                        </h2>
                    </div>

                    <div class="grid lg:grid-cols-2 gap-8">
                        @foreach ($product->specifications['variants'] ?? [] as $variant)
                            <div>
                                <h3 class="text-2xl font-bold text-foreground mb-6 font-display flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full {{ $variant['marker_class'] ?? 'bg-primary' }}"></div>
                                    {{ $variant['title'] }}
                                </h3>
                                <x-spec-table title="{{ $variant['table_title'] ?? 'Technical Specifications' }}"
                                    :specifications="$variant['specs'] ?? []" />
                                @if (!empty($variant['description']))
                                    <p class="mt-4 text-muted-foreground text-sm">
                                        {{ $variant['description'] }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    {{-- CTA --}}
    <section class="py-16 bg-secondary">
        <div class="container mx-auto px-4 text-center">
            <div x-data="{ shown: false }" x-intersect.once="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                class="transition-all duration-700 ease-out">
                <h2 class="text-2xl md:text-3xl font-bold text-secondary-foreground mb-4 font-display">
                    {{ $product->others_data['cta_title'] ?? 'Interested in this Product?' }}
                </h2>
                <p class="text-secondary-foreground/80 mb-6 max-w-2xl mx-auto">
                    {{ $product->others_data['cta_subtitle'] ?? 'Contact us for more details or to place an order.' }}
                </p>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)]">
                    Contact Us
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
