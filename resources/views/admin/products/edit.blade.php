@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
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
                                        <input type="text" name="title" class="form-control" value="{{ $product->title }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea name="description_text" class="form-control h-150">{{ $product->description['content'] ?? '' }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                        @if($product->image_url)
                                            <div class="mt-2">
                                                <img src="{{ $product->image_url }}" width="100" class="rounded">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
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
                                        <input type="text" name="features[subtitle]" class="form-control" value="{{ $product->features['subtitle'] ?? 'Why Choose Us' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Title</label>
                                        <input type="text" name="features[title]" class="form-control" value="{{ $product->features['title'] ?? 'Key Features' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Feature Items</label>
                                <div id="features-container">
                                    @if(!empty($product->features['items']))
                                        @foreach($product->features['items'] as $index => $item)
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
                                                            <input type="text" name="features[items][{{ $index }}][description]" class="form-control" value="{{ $item['description'] }}">
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

                    <!-- Description Section -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Details Description</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Subtitle</label>
                                        <input type="text" name="details_description_subtitle" class="form-control" value="{{ $product->details_description['subtitle'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Title</label>
                                        <input type="text" name="details_description_title" class="form-control" value="{{ $product->details_description['title'] ?? 'Description' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label>Details Description</label>
                                <textarea name="details_description" id="ckeditor" class="form-control">{{ $product->details_description['html'] ?? '' }}</textarea>
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
                                        <input type="text" name="tutorial_section_subtitle" class="form-control" value="{{ $product->tutorial['section_subtitle'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Title</label>
                                        <input type="text" name="tutorial_section_title" class="form-control" value="{{ $product->tutorial['section_title'] ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            @php
                                $tutorialItems = $product->tutorial['items'] ?? [];
                                if (empty($tutorialItems) && (!empty($product->tutorial['youtube_iframe']) || !empty($product->tutorial['description']))) {
                                    $tutorialItems[] = [
                                        'youtube_url' => $product->tutorial['youtube_iframe'] ?? '',
                                        'description' => $product->tutorial['description'] ?? '',
                                    ];
                                }
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

                    <!-- Specifications Section -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Specifications Section</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Subtitle</label>
                                        <input type="text" name="specifications[subtitle]" class="form-control" value="{{ $product->specifications['subtitle'] ?? 'Choose Your System' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Title</label>
                                        <input type="text" name="specifications[title]" class="form-control" value="{{ $product->specifications['title'] ?? 'System Specifications' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>System Variants</label>
                                <div id="variants-container">
                                    @if(!empty($product->specifications['variants']))
                                        @foreach($product->specifications['variants'] as $vIndex => $variant)
                                            <div class="variant-item" id="variant-{{ $vIndex }}">
                                                <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeElement('variant-{{ $vIndex }}')">&times;</button>
                                                <h5 class="mb-3">Variant #{{ $vIndex + 1 }}</h5>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Variant Title</label>
                                                            <input type="text" name="specifications[variants][{{ $vIndex }}][title]" class="form-control" value="{{ $variant['title'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Marker Class (CSS)</label>
                                                            <input type="text" name="specifications[variants][{{ $vIndex }}][marker_class]" class="form-control" value="{{ $variant['marker_class'] ?? 'bg-primary' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Table Title</label>
                                                            <input type="text" name="specifications[variants][{{ $vIndex }}][table_title]" class="form-control" value="{{ $variant['table_title'] ?? 'Technical Specifications' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea name="specifications[variants][{{ $vIndex }}][description]" class="form-control">{{ $variant['description'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="specs-container-wrapper p-3 bg-light rounded">
                                                    <h6>Technical Specs</h6>
                                                    <div id="specs-container-{{ $vIndex }}">
                                                        @if(!empty($variant['specs']))
                                                            @foreach($variant['specs'] as $sIndex => $spec)
                                                                <div class="spec-item" id="spec-{{ $vIndex }}-{{ $sIndex }}">
                                                                    <input type="text" name="specifications[variants][{{ $vIndex }}][specs][{{ $sIndex }}][label]" class="form-control" placeholder="Label" value="{{ $spec['label'] }}" required>
                                                                    <input type="text" name="specifications[variants][{{ $vIndex }}][specs][{{ $sIndex }}][value]" class="form-control" placeholder="Value" value="{{ $spec['value'] }}" required>
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('spec-{{ $vIndex }}-{{ $sIndex }}')">&times;</button>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-info mt-2" onclick="addSpec({{ $vIndex }})">
                                                        <i class="fas fa-plus"></i> Add Spec Row
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-primary mt-2" onclick="addVariant()">
                                    <i class="fas fa-plus"></i> Add System Variant
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
                                <input type="text" name="others_data[cta_title]" class="form-control" value="{{ $product->others_data['cta_title'] ?? 'Interested in this Product?' }}">
                                <small class="form-text text-muted">The main heading for the call-to-action section at the bottom.</small>
                            </div>
                            <div class="form-group">
                                <label>CTA Subtitle</label>
                                <textarea name="others_data[cta_subtitle]" class="form-control" rows="2">{{ $product->others_data['cta_subtitle'] ?? 'Contact us for more details or to place an order.' }}</textarea>
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
                                <input type="text" name="seo[title]" class="form-control" value="{{ old('seo.title', $product->seo['title'] ?? '') }}">
                                <small class="form-text text-muted">The title for SEO purposes (e.g., in browser tabs and search results).</small>
                            </div>
                            <div class="form-group">
                                <label>SEO Description</label>
                                <textarea name="seo[description]" class="form-control" rows="3">{{ old('seo.description', $product->seo['description'] ?? '') }}</textarea>
                                <small class="form-text text-muted">A brief description for search engines.</small>
                            </div>
                            <div class="form-group mb-0">
                                <label>SEO Keywords</label>
                                <input type="text" name="seo[keywords]" class="form-control" value="{{ old('seo.keywords', $product->seo['keywords'] ?? '') }}">
                                <small class="form-text text-muted">Comma-separated keywords for search engines.</small>
                            </div>
                        </div>
                    </div>

                    @php
                        $sectionsConfig = $product->others_data['sections'] ?? [];
                        $featuresConfig = $sectionsConfig['features'] ?? [];
                        $detailsConfig = $sectionsConfig['details_description'] ?? [];
                        $tutorialConfig = $sectionsConfig['tutorial'] ?? [];
                        $specsConfig = $sectionsConfig['specifications'] ?? [];

                        $hasFeatures = !empty($product->features);
                        $hasDetails = !empty($product->details_description['html'] ?? null);
                        $hasTutorial = !empty($product->tutorial);
                        $hasSpecifications = !empty($product->specifications);

                        $featuresActive = array_key_exists('active', $featuresConfig) ? (bool)$featuresConfig['active'] : $hasFeatures;
                        $detailsActive = array_key_exists('active', $detailsConfig) ? (bool)$detailsConfig['active'] : $hasDetails;
                        $tutorialActive = array_key_exists('active', $tutorialConfig) ? (bool)$tutorialConfig['active'] : $hasTutorial;
                        $specsActive = array_key_exists('active', $specsConfig) ? (bool)$specsConfig['active'] : $hasSpecifications;

                        $featuresOrder = $featuresConfig['order'] ?? 1;
                        $detailsOrder = $detailsConfig['order'] ?? 2;
                        $tutorialOrder = $tutorialConfig['order'] ?? 3;
                        $specsOrder = $specsConfig['order'] ?? 4;
                    @endphp

                    <!-- Section Settings -->
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
                                        <tr>
                                            <td>Details Description</td>
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
                                            <td>Specifications</td>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body text-right">
                            <button class="btn btn-primary mr-1" type="submit">Update</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
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
    // Initialize indices based on existing data
    let featureIndex = {{ !empty($product->features['items']) ? count($product->features['items']) : 0 }};
    let variantIndex = {{ !empty($product->specifications['variants']) ? count($product->specifications['variants']) : 0 }};
    let tutorialIndex = {{ !empty($tutorialItems) ? count($tutorialItems) : 0 }};

    function addFeature() {
        const container = document.getElementById('features-container');
        const index = featureIndex++;
        
        const html = `
            <div class="feature-item" id="feature-${index}">
                <button type="button" class="btn btn-danger btn-sm remove-btn" onclick="removeElement('feature-${index}')">&times;</button>
                <div class="row">
                    <div class="col-md-3">
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
                    <div class="col-md-4">
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
                            <label>Variant Title</label>
                            <input type="text" name="specifications[variants][${index}][title]" class="form-control" required placeholder="e.g. Standard System">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Variant Description</label>
                            <input type="text" name="specifications[variants][${index}][description]" class="form-control" placeholder="Short description">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Table Title</label>
                            <input type="text" name="specifications[variants][${index}][table_title]" class="form-control" value="Technical Specifications">
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                            <label>Marker Class (Color)</label>
                            <select name="specifications[variants][${index}][marker_class]" class="form-control">
                                <option value="bg-primary">Primary (Blue)</option>
                                <option value="bg-secondary">Secondary (Grey)</option>
                                <option value="bg-success">Success (Green)</option>
                                <option value="bg-danger">Danger (Red)</option>
                                <option value="bg-warning">Warning (Yellow)</option>
                                <option value="bg-info">Info (Cyan)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Technical Specifications (Table Rows)</label>
                    <div id="specs-container-${index}">
                        <!-- Dynamic Specs -->
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-info mt-2" onclick="addSpec(${index})">
                        <i class="fas fa-plus"></i> Add Spec Row
                    </button>
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', html);
        
        // Add one initial spec row
        addSpec(index);
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

    function addSpec(variantIdx) {
        const container = document.getElementById(`specs-container-${variantIdx}`);
        const specIdx = container.children.length;
        
        const html = `
            <div class="spec-item">
                <input type="text" name="specifications[variants][${variantIdx}][specs][${specIdx}][label]" class="form-control" placeholder="Label (e.g. Weight)" required>
                <input type="text" name="specifications[variants][${variantIdx}][specs][${specIdx}][value]" class="form-control" placeholder="Value (e.g. 5kg)" required>
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.spec-item').remove()">&times;</button>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', html);
    }
</script>

@endsection
