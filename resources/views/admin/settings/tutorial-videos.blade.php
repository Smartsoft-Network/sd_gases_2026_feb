@extends('layouts.admin')

@section('title', ($tutorialVideosPageData['page_title'] ?? 'Gallery') . ' Page Settings')

@section('content')
<section class="section">
    <div class="section-body">
        <form action="{{ route('admin.settings.tutorial-videos.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 text-center mb-4 mt-2">
                    <div class="py-4 bg-light rounded shadow-sm">
                        <h2 class="font-weight-bold text-dark mb-2">{{ $tutorialVideosPageData['page_title'] ?? 'Gallery' }} Page Settings</h2>
                        <p class="text-muted mb-0">Configure the content for the {{ strtolower($tutorialVideosPageData['page_title'] ?? 'gallery') }} page.</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Page Content</h4>
                        </div>
                        <div class="card-body">
                            {{-- Page Visibility --}}
                            <div class="form-group">
                                <label class="d-block">Enable {{ $tutorialVideosPageData['page_title'] ?? 'Gallery' }} Page</label>
                                <label class="custom-switch mt-2">
                                    <input type="hidden" name="is_enabled" value="0">
                                    <input type="checkbox" name="is_enabled" value="1" class="custom-switch-input" {{ ($tutorialVideosData['is_enabled'] ?? true) ? 'checked' : '' }}>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">If enabled, the page will be visible in the header and accessible to the public.</span>
                                </label>
                            </div>

                            {{-- Page Title --}}
                            <div class="form-group pt-4 border-top">
                                <label>Page Title (Label for Header, Sidebar, and Page)</label>
                                <input type="text" name="page_title" class="form-control" value="{{ $tutorialVideosData['page_title'] ?? 'Gallery' }}" required placeholder="e.g. Gallery or Tutorial Videos">
                                <small class="text-muted">This title will be used everywhere as the link label (e.g., in the header and sidebar).</small>
                            </div>

                            {{-- Page Slug / Route --}}
                            <div class="form-group">
                                <label>Page Route (Slug)</label>
                                <input type="text" name="page_slug" class="form-control" value="{{ $tutorialVideosData['page_slug'] ?? 'gallery' }}" required placeholder="e.g. gallery or tutorial-videos">
                                <small class="text-muted">This is the URL where the page will be accessible. Default is <code>gallery</code>. Changing this will update all links to this page automatically.</small>
                            </div>

                            {{-- Hero Section --}}
                            <div class="form-group pt-4 border-top">
                                <label>Hero Title</label>
                                <input type="text" name="hero_title" class="form-control" value="{{ $tutorialVideosData['hero_title'] ?? 'Tutorial Videos' }}" required>
                            </div>
                            <div class="form-group">
                                <label>Hero Subtitle</label>
                                <textarea name="hero_subtitle" class="form-control" rows="3" required>{{ $tutorialVideosData['hero_subtitle'] ?? 'Learn how to use our oxygen systems and equipment with our detailed video guides.' }}</textarea>
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
@endsection
