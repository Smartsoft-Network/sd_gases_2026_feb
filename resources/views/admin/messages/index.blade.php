@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Messages</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Messages</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($messages as $message)
                                        <tr>
                                            <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->subject }}</td>
                                            <td>
                                                @if($message->replied_at)
                                                    <div class="badge badge-success">Replied</div>
                                                @else
                                                    <div class="badge badge-danger">Pending</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-primary">View</a>
                                                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $messages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
