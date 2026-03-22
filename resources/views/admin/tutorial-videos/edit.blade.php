@extends('layouts.admin')

@section('title', 'Edit ' . ($tutorialVideosPageData['page_title'] ?? 'Gallery'))

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.tutorial-videos.update', $tutorialVideo->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit {{ $tutorialVideosPageData['page_title'] ?? 'Gallery' }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $tutorialVideo->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Video URL (YouTube/Vimeo)</label>
                                        <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url', $tutorialVideo->video_url) }}" required placeholder="https://www.youtube.com/watch?v=...">
                                        @error('video_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Enter the full URL of the video.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control h-150 @error('description') is-invalid @enderror">{{ old('description', $tutorialVideo->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sort Order</label>
                                        <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $tutorialVideo->sort_order) }}">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $tutorialVideo->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $tutorialVideo->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Update Video</button>
                            <a href="{{ route('admin.tutorial-videos.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
