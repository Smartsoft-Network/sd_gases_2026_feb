@extends('layouts.admin')

@section('title', 'About Page Settings')

@section('content')
<section class="section">
    <div class="section-body">
        <form action="{{ route('admin.settings.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- Home Page Banner Section --}}
                <div class="col-12 text-center mb-4 mt-2">
                    <div class="py-4 bg-light rounded shadow-sm">
                        <h2 class="font-weight-bold text-dark mb-2">Home Page Banner Settings</h2>
                        <p class="text-muted mb-0">The following settings apply specifically to the Hero section on the main landing page.</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Banner Content</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Banner Badge Text</label>
                                        <input type="text" name="banner_badge" class="form-control" value="{{ $bannerData['banner_badge'] ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Banner Image</label>
                                        <input type="file" name="banner_image" class="form-control">
                                        <small class="text-muted">Upload a new image to change the main hero background on the home page.</small>
                                    </div>
                                    @if(isset($bannerData['banner_image']))
                                        <div class="mt-3">
                                            <h6>Current Image:</h6>
                                            <img src="{{ asset('storage/' . $bannerData['banner_image']) }}" alt="Home Banner" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <h6>Default Image:</h6>
                                            <img src="https://sdgases.com.np/assets/img/hero-bg.jpg" alt="Default Home Banner" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Banner Title</label>
                                        <input type="text" name="banner_title" class="form-control" value="{{ $bannerData['banner_title'] ?? '' }}" required>
                                        <small class="text-muted">Tip: Use "Climb Beyond" to highlight it in primary color.</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Banner Subtitle</label>
                                        <textarea name="banner_subtitle" class="form-control" rows="3" required>{{ $bannerData['banner_subtitle'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Banner Stats</label>
                                <div id="banner-stats-container">
                                    @if(isset($bannerData['banner_stats']) && is_array($bannerData['banner_stats']))
                                        @foreach($bannerData['banner_stats'] as $index => $stat)
                                            <div class="stat-item mb-3 p-3 border rounded bg-light" id="banner-stat-{{ $index }}">
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('banner-stat-{{ $index }}')">&times;</button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Value</label>
                                                        <input type="text" name="banner_stats[{{ $index }}][value]" class="form-control" value="{{ $stat['value'] }}" required>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label>Label</label>
                                                        <input type="text" name="banner_stats[{{ $index }}][label]" class="form-control" value="{{ $stat['label'] }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-primary" onclick="addBannerStat()">+ Add Banner Stat</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center mb-4 mt-4">
                    <hr class="my-5">
                    <div class="py-4 bg-light rounded shadow-sm">
                        <h2 class="font-weight-bold text-dark mb-2">Home Page "About Us" Section Settings</h2>
                        <p class="text-muted mb-0">The following settings apply specifically to the About section on the main landing page.</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Description Section (Homepage About)</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title (Homepage About)</label>
                                <input type="text" name="home_about_title" class="form-control" value="{{ $aboutData['home_about_title'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label>Description Paragraphs</label>
                                <div id="home-descriptions-container">
                                    @if(isset($aboutData['home_about_descriptions']) && is_array($aboutData['home_about_descriptions']))
                                        @foreach($aboutData['home_about_descriptions'] as $index => $desc)
                                            <div class="description-item mb-3 p-3 border rounded bg-light" id="home-desc-{{ $index }}">
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('home-desc-{{ $index }}')">&times;</button>
                                                </div>
                                                <textarea name="home_about_descriptions[]" class="form-control" rows="4" required>{{ $desc }}</textarea>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-primary" onclick="addHomeDescription()">+ Add Paragraph</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Stats Section (Homepage About)</h4>
                        </div>
                        <div class="card-body">
                            <div id="stats-container">
                                @if(isset($aboutData['stats']) && is_array($aboutData['stats']))
                                    @foreach($aboutData['stats'] as $index => $stat)
                                        <div class="stat-item mb-3 p-3 border rounded bg-light" id="stat-{{ $index }}">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('stat-{{ $index }}')">&times;</button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Value</label>
                                                    <input type="text" name="stats[{{ $index }}][value]" class="form-control" value="{{ $stat['value'] }}" required>
                                                </div>
                                                <div class="col-md-8">
                                                    <label>Label</label>
                                                    <input type="text" name="stats[{{ $index }}][label]" class="form-control" value="{{ $stat['label'] }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary" onclick="addStat()">+ Add Stat</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Features Section (Homepage About)</h4>
                        </div>
                        <div class="card-body">
                            <div id="features-container">
                                @if(isset($aboutData['features']) && is_array($aboutData['features']))
                                    @foreach($aboutData['features'] as $index => $feature)
                                        <div class="feature-item mb-3 p-3 border rounded bg-light" id="feature-{{ $index }}">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('feature-{{ $index }}')">&times;</button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Icon & Title</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" style="background-color: #fdfdff; width: 45px; display: flex; justify-content: center; cursor: pointer;" onclick="openIconPicker('feature-icon-input-{{ $index }}', 'feature-icon-preview-{{ $index }}')">
                                                                @php
                                                                    $iconClass = $feature['icon'] ?? 'fas fa-star';
                                                                    if ($iconClass == 'CheckCircle') $iconClass = 'fas fa-check-circle';
                                                                    elseif ($iconClass == 'DollarSign') $iconClass = 'fas fa-dollar-sign';
                                                                    elseif ($iconClass == 'Users') $iconClass = 'fas fa-users';
                                                                    elseif ($iconClass == 'Zap') $iconClass = 'fas fa-zap';
                                                                    if (!str_contains($iconClass, 'fa-')) {
                                                                        $iconClass = 'fas fa-' . strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $iconClass));
                                                                    }
                                                                @endphp
                                                                <i id="feature-icon-preview-{{ $index }}" class="{{ $iconClass }}" style="font-size: 1.2rem; color: #6777ef;"></i>
                                                            </span>
                                                        </div>
                                                        <input type="hidden" name="features[{{ $index }}][icon]" id="feature-icon-input-{{ $index }}" value="{{ $iconClass }}">
                                                        <input type="text" name="features[{{ $index }}][title]" class="form-control" value="{{ $feature['title'] }}" placeholder="Feature Title" required>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-primary" onclick="openIconPicker('feature-icon-input-{{ $index }}', 'feature-icon-preview-{{ $index }}')">Select</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <label>Description</label>
                                                    <input type="text" name="features[{{ $index }}][desc]" class="form-control" value="{{ $feature['desc'] }}" placeholder="Feature Description" required>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary" onclick="addFeature()">+ Add Feature</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center mb-4 mt-2">
                    <hr class="my-5">
                    <div class="py-4 bg-light rounded shadow-sm">
                        <h2 class="font-weight-bold text-dark mb-2">About Page Settings</h2>
                        <p class="text-muted mb-0">The following settings apply to the standalone About Us page.</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Hero Section</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Hero Title</label>
                                <input type="text" name="hero_title" class="form-control" value="{{ $aboutData['hero_title'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label>Hero Subtitle</label>
                                <textarea name="hero_subtitle" class="form-control" rows="3" required>{!! $aboutData['hero_subtitle'] ?? '' !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Mission Section</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Mission Title</label>
                                <input type="text" name="mission_title" class="form-control" value="{{ $aboutData['mission_title'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label>Mission Content</label>
                                <textarea name="mission_content" class="form-control" rows="5" required>{{ $aboutData['mission_content'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Vision Section</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Vision Title</label>
                                <input type="text" name="vision_title" class="form-control" value="{{ $aboutData['vision_title'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label>Vision Content</label>
                                <textarea name="vision_content" class="form-control" rows="5" required>{{ $aboutData['vision_content'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Journey Section</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Journey Subtitle (Label)</label>
                                        <input type="text" name="journey_subtitle" class="form-control" value="{{ $aboutData['journey_subtitle'] ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Journey Title (Heading)</label>
                                        <input type="text" name="journey_title" class="form-control" value="{{ $aboutData['journey_title'] ?? '' }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Milestones (Timeline)</label>
                                <div id="milestones-container">
                                    @if(isset($aboutData['milestones']) && is_array($aboutData['milestones']))
                                        @foreach($aboutData['milestones'] as $index => $milestone)
                                            <div class="milestone-item mb-3 p-3 border rounded bg-light" id="milestone-{{ $index }}">
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('milestone-{{ $index }}')">&times;</button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Year</label>
                                                        <input type="text" name="milestones[{{ $index }}][year]" class="form-control" value="{{ $milestone['year'] }}" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Title</label>
                                                        <input type="text" name="milestones[{{ $index }}][title]" class="form-control" value="{{ $milestone['title'] }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Description</label>
                                                        <input type="text" name="milestones[{{ $index }}][desc]" class="form-control" value="{{ $milestone['desc'] }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-primary" onclick="addMilestone()">+ Add Milestone</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-right mb-5">
                    <button type="submit" class="btn btn-primary btn-lg">Save Settings</button>
                </div>
            </div>
        </form>
    </div>
</section>

@include('admin.partials.icon-picker')

@push('scripts')
<script>
    let milestoneIndex = {{ isset($aboutData['milestones']) ? count($aboutData['milestones']) : 0 }};
    let homeDescIndex = {{ isset($aboutData['home_about_descriptions']) ? count($aboutData['home_about_descriptions']) : 0 }};
    let bannerStatIndex = {{ isset($bannerData['banner_stats']) ? count($bannerData['banner_stats']) : 0 }};
    let statIndex = {{ isset($aboutData['stats']) ? count($aboutData['stats']) : 0 }};
    let featureIndex = {{ isset($aboutData['features']) ? count($aboutData['features']) : 0 }};

    function addMilestone() {
        const container = document.getElementById('milestones-container');
        const index = milestoneIndex++;
        const html = `
            <div class="milestone-item mb-3 p-3 border rounded bg-light" id="milestone-${index}">
                <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('milestone-${index}')">&times;</button>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label>Year</label>
                        <input type="text" name="milestones[${index}][year]" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Title</label>
                        <input type="text" name="milestones[${index}][title]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Description</label>
                        <input type="text" name="milestones[${index}][desc]" class="form-control" required>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }

    function addBannerStat() {
        const container = document.getElementById('banner-stats-container');
        const index = bannerStatIndex++;
        const html = `
            <div class="stat-item mb-3 p-3 border rounded bg-light" id="banner-stat-${index}">
                <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('banner-stat-${index}')">&times;</button>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Value</label>
                        <input type="text" name="banner_stats[${index}][value]" class="form-control" required>
                    </div>
                    <div class="col-md-8">
                        <label>Label</label>
                        <input type="text" name="banner_stats[${index}][label]" class="form-control" required>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }

    function addHomeDescription() {
        const container = document.getElementById('home-descriptions-container');
        const index = homeDescIndex++;
        const html = `
            <div class="description-item mb-3 p-3 border rounded bg-light" id="home-desc-${index}">
                <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('home-desc-${index}')">&times;</button>
                </div>
                <textarea name="home_about_descriptions[]" class="form-control" rows="4" required></textarea>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }

    function addStat() {
        const container = document.getElementById('stats-container');
        const index = statIndex++;
        const html = `
            <div class="stat-item mb-3 p-3 border rounded bg-light" id="stat-${index}">
                <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('stat-${index}')">&times;</button>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Value</label>
                        <input type="text" name="stats[${index}][value]" class="form-control" required>
                    </div>
                    <div class="col-md-8">
                        <label>Label</label>
                        <input type="text" name="stats[${index}][label]" class="form-control" required>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }

    function addFeature() {
        const container = document.getElementById('features-container');
        const index = featureIndex++;
        const html = `
            <div class="feature-item mb-3 p-3 border rounded bg-light" id="feature-${index}">
                <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('feature-${index}')">&times;</button>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label>Icon & Title</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #fdfdff; width: 45px; display: flex; justify-content: center; cursor: pointer;" onclick="openIconPicker('feature-icon-input-${index}', 'feature-icon-preview-${index}')">
                                    <i id="feature-icon-preview-${index}" class="fas fa-star" style="font-size: 1.2rem; color: #6777ef;"></i>
                                </span>
                            </div>
                            <input type="hidden" name="features[${index}][icon]" id="feature-icon-input-${index}" value="fas fa-star">
                            <input type="text" name="features[${index}][title]" class="form-control" placeholder="Feature Title" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" onclick="openIconPicker('feature-icon-input-${index}', 'feature-icon-preview-${index}')">Select</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <label>Description</label>
                        <input type="text" name="features[${index}][desc]" class="form-control" placeholder="Feature Description" required>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }

    function removeElement(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to remove this item?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(id).remove();
                Swal.fire(
                    'Removed!',
                    'Item has been removed.',
                    'success'
                )
            }
        })
    }
</script>
@endpush
@endsection
