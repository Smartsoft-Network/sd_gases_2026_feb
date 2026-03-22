@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" id="serviceForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Basic Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $service->title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Icon (FontAwesome Class)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i id="icon-preview" class="fas fa-{{ $service->icon ?? 'star' }}"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="icon" id="icon-input" class="form-control" value="{{ $service->icon ?? 'star' }}" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary" onclick="openIconPicker('icon-input', 'icon-preview')">Select Icon</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Short Description (Hero/List view)</label>
                                <textarea name="description" class="form-control h-150">{{ $service->description }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Featured Image</label>
                                        <input type="file" name="image" class="form-control">
                                        @if($service->image_url)
                                            <div class="mt-2">
                                                <img src="{{ $service->image_url }}" width="100" class="rounded shadow-sm">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $service->status ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ !$service->status ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details Description Section (Introduction in Maintenance template) -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Details Description (Introduction Section)</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Subtitle</label>
                                        <input type="text" name="details_description_subtitle" class="form-control" value="{{ $service->details_description['subtitle'] ?? '' }}" placeholder="e.g. Professional Care">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Title</label>
                                        <input type="text" name="details_description_title" class="form-control" value="{{ $service->details_description['title'] ?? 'Keep Your Equipment Safe & Reliable' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Content (HTML/CKEditor)</label>
                                <textarea name="details_description" id="ckeditor" class="form-control">{{ $service->details_description['html'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Tutorial Section -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Tutorial</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Subtitle</label>
                                        <input type="text" name="tutorial_section_subtitle" class="form-control" value="{{ $service->tutorial['section_subtitle'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Title</label>
                                        <input type="text" name="tutorial_section_title" class="form-control" value="{{ $service->tutorial['section_title'] ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            @php
                                $tutorialItems = $service->tutorial['items'] ?? [];
                            @endphp

                            <div class="form-group">
                                <label>Tutorial Videos</label>
                                <div id="tutorial-items-container">
                                    @foreach($tutorialItems as $index => $item)
                                        <div class="tutorial-item" id="tutorial-{{ $index }}">
                                            <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeElement('tutorial-{{ $index }}')">&times;</button>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-2">
                                                        <label>YouTube video URL</label>
                                                        <input type="text" name="tutorial_items[{{ $index }}][youtube_url]" class="form-control" value="{{ $item['youtube_url'] ?? '' }}" placeholder="https://www.youtube.com/embed/...">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-2">
                                                        <label>Tutorial Description</label>
                                                        <textarea name="tutorial_items[{{ $index }}][description]" class="form-control h-100" rows="3" placeholder="Short description for this video">{{ $item['description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-outline-primary mt-2" onclick="addTutorialItem()">
                                    <i class="fas fa-plus"></i> Add Tutorial
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Features Section -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Features Section</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Subtitle</label>
                                        <input type="text" name="features[subtitle]" class="form-control" value="{{ $service->features['subtitle'] ?? 'Why Choose Us' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Title</label>
                                        <input type="text" name="features[title]" class="form-control" value="{{ $service->features['title'] ?? 'Service Features' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Feature Items</label>
                                <div id="features-container">
                                    @if(!empty($service->features['items']))
                                        @foreach($service->features['items'] as $index => $item)
                                            <div class="feature-item" id="feature-{{ $index }}">
                                                <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeElement('feature-{{ $index }}')">&times;</button>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group mb-2">
                                                            <label>Icon</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i id="feature-icon-preview-{{ $index }}" class="fas fa-{{ $item['icon'] }}"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" name="features[items][{{ $index }}][icon]" id="feature-icon-input-{{ $index }}" class="form-control" value="{{ $item['icon'] }}" readonly>
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-primary" onclick="openIconPicker('feature-icon-input-{{ $index }}', 'feature-icon-preview-{{ $index }}')">Select</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-2">
                                                            <label>Title</label>
                                                            <input type="text" name="features[items][{{ $index }}][title]" class="form-control" value="{{ $item['title'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group mb-2">
                                                            <label>Description</label>
                                                            <input type="text" name="features[items][{{ $index }}][description]" class="form-control" value="{{ $item['description'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group mb-2">
                                                            <label>Order</label>
                                                            <input type="number" name="features[items][{{ $index }}][sort_order]" class="form-control" value="{{ $item['sort_order'] ?? $index }}" min="0" step="1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-primary mt-2" onclick="addFeature()">
                                    <i class="fas fa-plus"></i> Add Feature Item
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Service Offerings Section (Specifications Section in Product) -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Service Offerings Section</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Subtitle</label>
                                        <input type="text" name="specifications[subtitle]" class="form-control" value="{{ $service->specifications['subtitle'] ?? 'Our Services' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Title</label>
                                        <input type="text" name="specifications[title]" class="form-control" value="{{ $service->specifications['title'] ?? 'What We Offer' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Service Categories / Offerings</label>
                                <div id="variants-container">
                                    @if(!empty($service->specifications['variants']))
                                        @foreach($service->specifications['variants'] as $vIndex => $variant)
                                            <div class="variant-item" id="variant-{{ $vIndex }}">
                                                <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeElement('variant-{{ $vIndex }}')">&times;</button>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Offering Title</label>
                                                            <input type="text" name="specifications[variants][{{ $vIndex }}][title]" class="form-control" value="{{ $variant['title'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Short Description</label>
                                                            <textarea name="specifications[variants][{{ $vIndex }}][description]" class="form-control" rows="2">{{ $variant['description'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>List Items (Bullet Points)</label>
                                                    <div id="specs-container-{{ $vIndex }}">
                                                        @if(!empty($variant['specs']))
                                                            @foreach($variant['specs'] as $sIndex => $spec)
                                                                <div class="spec-item">
                                                                    <input type="text" name="specifications[variants][{{ $vIndex }}][specs][{{ $sIndex }}][value]" class="form-control" value="{{ $spec['value'] }}" required>
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.spec-item').remove()">&times;</button>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-info mt-2" onclick="addSpec({{ $vIndex }})">
                                                        <i class="fas fa-plus"></i> Add Point
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-primary mt-2" onclick="addVariant()">
                                    <i class="fas fa-plus"></i> Add Service Offering
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>CTA Section</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>CTA Title</label>
                                <input type="text" name="others_data[cta_title]" class="form-control" value="{{ $service->others_data['cta_title'] ?? 'Need this Service?' }}">
                                <small class="form-text text-muted">The main heading for the call-to-action section at the bottom.</small>
                            </div>
                            <div class="form-group">
                                <label>CTA Subtitle</label>
                                <textarea name="others_data[cta_subtitle]" class="form-control" rows="2">{{ $service->others_data['cta_subtitle'] ?? 'Contact us for scheduling or more information.' }}</textarea>
                                <small class="form-text text-muted">The supporting text for the call-to-action section.</small>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Section -->
                    <div class="card">
                        <div class="card-header">
                            <h4>SEO Settings</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>SEO Title</label>
                                <input type="text" name="seo[title]" class="form-control" value="{{ old('seo.title', $service->seo['title'] ?? '') }}">
                                <small class="form-text text-muted">The title for SEO purposes (e.g., in browser tabs and search results).</small>
                            </div>
                            <div class="form-group">
                                <label>SEO Description</label>
                                <textarea name="seo[description]" class="form-control" rows="3">{{ old('seo.description', $service->seo['description'] ?? '') }}</textarea>
                                <small class="form-text text-muted">A brief description for search engines.</small>
                            </div>
                            <div class="form-group mb-0">
                                <label>SEO Keywords</label>
                                <input type="text" name="seo[keywords]" class="form-control" value="{{ old('seo.keywords', $service->seo['keywords'] ?? '') }}">
                                <small class="form-text text-muted">Comma-separated keywords for search engines.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Section Settings -->
                    @php
                        $sectionsConfig = $service->others_data['sections'] ?? [];
                        $detailsConfig = $sectionsConfig['details_description'] ?? [];
                        $specsConfig = $sectionsConfig['specifications'] ?? [];
                        $tutorialConfig = $sectionsConfig['tutorial'] ?? [];
                        $featuresConfig = $sectionsConfig['features'] ?? [];

                        // Improved detection for existing data
                        $hasDetailsContent = false;
                        if (is_array($service->details_description)) {
                            $hasDetailsContent = !empty($service->details_description['html']);
                        } elseif (is_string($service->details_description)) {
                            $hasDetailsContent = !empty($service->details_description);
                        }

                        $detailsActive = array_key_exists('active', $detailsConfig) 
                            ? (bool)$detailsConfig['active'] 
                            : $hasDetailsContent;
                            
                        $specsActive = array_key_exists('active', $specsConfig) 
                            ? (bool)$specsConfig['active'] 
                            : !empty($service->specifications['variants']);
                            
                        $tutorialActive = array_key_exists('active', $tutorialConfig) 
                            ? (bool)$tutorialConfig['active'] 
                            : !empty($service->tutorial['items']);
                            
                        $featuresActive = array_key_exists('active', $featuresConfig) 
                            ? (bool)$featuresConfig['active'] 
                            : !empty($service->features['items']);

                        $detailsOrder = $detailsConfig['order'] ?? 1;
                        $specsOrder = $specsConfig['order'] ?? 2;
                        $tutorialOrder = $tutorialConfig['order'] ?? 3;
                        $featuresOrder = $featuresConfig['order'] ?? 4;
                    @endphp
                    <div class="card">
                        <div class="card-header">
                            <h4>Section Settings</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Section</th>
                                            <th style="width: 180px;">Status</th>
                                            <th style="width: 120px;">Order</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Introduction (Details)</td>
                                            <td>
                                                <select name="sections[details_description][active]" class="form-control">
                                                    <option value="0" {{ !$detailsActive ? 'selected' : '' }}>Inactive</option>
                                                    <option value="1" {{ $detailsActive ? 'selected' : '' }}>Active</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="sections[details_description][order]" class="form-control" value="{{ $detailsOrder }}" min="0" step="1">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Service Offerings</td>
                                            <td>
                                                <select name="sections[specifications][active]" class="form-control">
                                                    <option value="0" {{ !$specsActive ? 'selected' : '' }}>Inactive</option>
                                                    <option value="1" {{ $specsActive ? 'selected' : '' }}>Active</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="sections[specifications][order]" class="form-control" value="{{ $specsOrder }}" min="0" step="1">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tutorial</td>
                                            <td>
                                                <select name="sections[tutorial][active]" class="form-control">
                                                    <option value="0" {{ !$tutorialActive ? 'selected' : '' }}>Inactive</option>
                                                    <option value="1" {{ $tutorialActive ? 'selected' : '' }}>Active</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="sections[tutorial][order]" class="form-control" value="{{ $tutorialOrder }}" min="0" step="1">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Features</td>
                                            <td>
                                                <select name="sections[features][active]" class="form-control">
                                                    <option value="0" {{ !$featuresActive ? 'selected' : '' }}>Inactive</option>
                                                    <option value="1" {{ $featuresActive ? 'selected' : '' }}>Active</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="sections[features][order]" class="form-control" value="{{ $featuresOrder }}" min="0" step="1">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body text-right">
                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@include('admin.partials.icon-picker')

@push('styles')
<style>
    .feature-item, .variant-item, .tutorial-item {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #eee;
        margin-bottom: 15px;
        position: relative;
    }
    .remove-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
    }
    .spec-item {
        background: #fff;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 10px;
        display: flex;
        gap: 10px;
        align-items: center;
    }
</style>
@endpush

<script>
    let featureIndex = {{ !empty($service->features['items']) ? count($service->features['items']) : 0 }};
    let variantIndex = {{ !empty($service->specifications['variants']) ? count($service->specifications['variants']) : 0 }};
    let tutorialIndex = {{ !empty($service->tutorial['items']) ? count($service->tutorial['items']) : 0 }};

    function addFeature() {
        const container = document.getElementById('features-container');
        const index = featureIndex++;
        
        const html = `
            <div class="feature-item" id="feature-${index}">
                <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeElement('feature-${index}')">&times;</button>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <label>Icon</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i id="feature-icon-preview-${index}" class="fas fa-star"></i>
                                    </span>
                                </div>
                                <input type="text" name="features[items][${index}][icon]" id="feature-icon-input-${index}" class="form-control" value="star" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" onclick="openIconPicker('feature-icon-input-${index}', 'feature-icon-preview-${index}')">Select</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label>Title</label>
                            <input type="text" name="features[items][${index}][title]" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group mb-2">
                            <label>Description</label>
                            <input type="text" name="features[items][${index}][description]" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <label>Order</label>
                            <input type="number" name="features[items][${index}][sort_order]" class="form-control" value="${index}" min="0" step="1">
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', html);
    }

    function addTutorialItem() {
        const container = document.getElementById('tutorial-items-container');
        const index = tutorialIndex++;

        const html = `
            <div class="tutorial-item" id="tutorial-${index}">
                <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeElement('tutorial-${index}')">&times;</button>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label>YouTube video URL</label>
                            <input type="text" name="tutorial_items[${index}][youtube_url]" class="form-control" placeholder="https://www.youtube.com/embed/...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label>Tutorial Description</label>
                            <textarea name="tutorial_items[${index}][description]" class="form-control h-100" rows="3" placeholder="Short description for this video"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
    }

    function removeElement(id) {
        document.getElementById(id).remove();
    }

    function addVariant() {
        const container = document.getElementById('variants-container');
        const index = variantIndex++;
        
        const html = `
            <div class="variant-item" id="variant-${index}">
                <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeElement('variant-${index}')">&times;</button>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Offering Title</label>
                            <input type="text" name="specifications[variants][${index}][title]" class="form-control" required placeholder="e.g. Cylinder Inspection">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea name="specifications[variants][${index}][description]" class="form-control" rows="2" placeholder="Brief explanation of the service"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>List Items (Bullet Points)</label>
                    <div id="specs-container-${index}">
                        <!-- Dynamic List Items -->
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-info mt-2" onclick="addSpec(${index})">
                        <i class="fas fa-plus"></i> Add Point
                    </button>
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', html);
        
        // Add one initial list item
        addSpec(index);
    }

    function addSpec(variantIdx) {
        const container = document.getElementById(`specs-container-${variantIdx}`);
        const specIdx = container.children.length;
        
        const html = `
            <div class="spec-item">
                <input type="text" name="specifications[variants][${variantIdx}][specs][${specIdx}][value]" class="form-control" placeholder="e.g. Visual inspection" required>
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.spec-item').remove()">&times;</button>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', html);
    }
</script>

@endsection
