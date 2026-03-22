@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                    <div class="card-body">
                        <div class="author-box-center text-center">
                            <img alt="image" src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('admin-assets/assets/img/user.png') }}" class="rounded-circle author-box-picture" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="clearfix"></div>
                            <div class="author-box-name mt-3">
                                <a href="#">{{ $user->name }}</a>
                            </div>
                            <div class="author-box-job">{{ $user->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Profile Photo</label>
                                    <input type="file" name="photo" class="form-control">
                                    <small class="text-muted">Max size: 1MB (JPG, PNG)</small>
                                    @error('photo')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Update Password</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.profile.password.update') }}">
                            @csrf
                            @method('put')

                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Current Password</label>
                                    <input type="password" name="current_password" class="form-control" required>
                                    @error('current_password', 'updatePassword')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>New Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                    @error('password', 'updatePassword')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
