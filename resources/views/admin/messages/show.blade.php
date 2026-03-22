@extends('layouts.admin')

@section('title', 'Message Details')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Message Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.messages.index') }}">Messages</a></div>
                <div class="breadcrumb-item">View Message</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sender Details</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Name:</strong> {{ $message->name }}</p>
                            <p><strong>Email:</strong> {{ $message->email }}</p>
                            <p><strong>Phone:</strong> {{ $message->phone ?? 'N/A' }}</p>
                            <p><strong>Subject:</strong> {{ $message->subject }}</p>
                            <p><strong>Date:</strong> {{ $message->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Message</h4>
                        </div>
                        <div class="card-body">
                            <p>{{ $message->message }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Reply</h4>
                        </div>
                        <div class="card-body">
                            @if($message->replied_at)
                                <div class="alert alert-info">
                                    Replied on {{ $message->replied_at->format('M d, Y H:i') }}
                                </div>
                                <div class="form-group">
                                    <label>Reply Message</label>
                                    <p>{{ $message->reply }}</p>
                                </div>
                            @else
                                <form action="{{ route('admin.messages.reply', $message) }}" method="POST" id="replyForm">
                                    @csrf
                                    <div class="form-group">
                                        <label>Reply Message</label>
                                        <textarea name="reply" class="form-control" style="height: 150px;" required></textarea>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="sendReplyBtn">
                                            <span class="indicator-label">Send Reply</span>
                                            <span class="indicator-progress" style="display: none;">
                                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.getElementById('replyForm')?.addEventListener('submit', function() {
        const btn = document.getElementById('sendReplyBtn');
        const label = btn.querySelector('.indicator-label');
        const progress = btn.querySelector('.indicator-progress');
        
        btn.disabled = true;
        label.style.display = 'none';
        progress.style.display = 'inline-block';
    });
</script>
@endpush
