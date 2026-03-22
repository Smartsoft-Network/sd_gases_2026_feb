@extends('layouts.admin')

@section('title', $tutorialVideosPageData['page_title'] ?? 'Gallery')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $tutorialVideosPageData['page_title'] ?? 'Gallery' }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.tutorial-videos.create') }}" class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Title</th>
                                        <th>Video URL</th>
                                        <th>Sort Order</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($videos as $video)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $video->title }}</td>
                                        <td>
                                            <a href="{{ $video->video_url }}" target="_blank">{{ Str::limit($video->video_url, 40) }}</a>
                                        </td>
                                        <td>{{ $video->sort_order }}</td>
                                        <td>
                                            @if($video->status)
                                                <div class="badge badge-success">Active</div>
                                            @else
                                                <div class="badge badge-danger">Inactive</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tutorial-videos.edit', $video->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('admin.tutorial-videos.destroy', $video->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $videos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
