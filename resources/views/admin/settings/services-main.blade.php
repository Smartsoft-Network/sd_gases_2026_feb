@extends('layouts.admin')

@section('title', 'Services Main Page Settings')

@section('content')
<section class="section">
    <div class="section-body">
        <form action="{{ route('admin.settings.services-main.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 text-center mb-4 mt-2">
                    <div class="py-4 bg-light rounded shadow-sm">
                        <h2 class="font-weight-bold text-dark mb-2">Services Main Page Settings</h2>
                        <p class="text-muted mb-0">Configure the content for the main services page.</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Page Content</h4>
                        </div>
                        <div class="card-body">
                            {{-- Hero Section --}}
                            <div class="form-group">
                                <label>Hero Subtitle</label>
                                <textarea name="hero_subtitle" class="form-control" rows="3" required>{{ $servicesMainData['hero_subtitle'] ?? '' }}</textarea>
                            </div>

                            {{-- Features Bar --}}
                            <div class="form-group">
                                <label>Features Bar (Public Services Page)</label>
                                <div id="features-container">
                                    @foreach($servicesMainData['features'] ?? [] as $index => $feature)
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
                                </div>
                                <button type="button" class="btn btn-primary" onclick="addFeature()">+ Add Feature</button>
                            </div>

                            {{-- Category Section --}}
                            <div class="form-group mt-5 pt-4 border-top">
                                <label>Section Badge Text (e.g., What We Offer)</label>
                                <input type="text" name="section_badge" class="form-control" value="{{ $servicesMainData['section_badge'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label>Section Title</label>
                                <input type="text" name="section_title" class="form-control" value="{{ $servicesMainData['section_title'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label>Section Description</label>
                                <textarea name="section_desc" class="form-control" rows="3" required>{{ $servicesMainData['section_desc'] ?? '' }}</textarea>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-lg">Save Settings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@include('admin.partials.icon-picker')

@push('scripts')
<script>
    let featureIndex = {{ count($servicesMainData['features'] ?? []) }};

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
