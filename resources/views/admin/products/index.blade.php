@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Products</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($product->image_url)
                                                <img alt="image" src="{{ $product->image_url }}" width="35">
                                            @else
                                                <img alt="image" src="{{ asset('admin-assets/assets/img/users/user-5.png') }}" width="35">
                                            @endif
                                        </td>
                                        <td>{{ $product->title }}</td>
                                        <td>
                                            @if($product->status)
                                                <div class="badge badge-success">Active</div>
                                            @else
                                                <div class="badge badge-danger">Inactive</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
