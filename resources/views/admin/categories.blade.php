@extends('admin.layouts.app')

@section('header')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </nav>
        </div>
        @include('admin.includes.sidebar')

        <section class="section">
            <div class="row">
                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-error mt-2">{{ Session::get('error') }}</div>
                            @endif
                            <h5 class="card-title">Categories</h5>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Jobs</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                            <tr>
                                                <th scope="row">{{ $category->id }}</th>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->jobs->count() }} Jobs</td>
                                                <td>
                                                    <p
                                                        class="badge {{ $category->status == true ? 'bg-info' : 'bg-danger' }}">
                                                        {{ $category->status == true ? 'Active' : 'Pending' }}</p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-success">Edit</a>
                                                    <a href="{{ route('admincategory.destroy', $category->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No categories available</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            {{ $categories->links('pagination::bootstrap-5') }}

                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Category</h5>

                            <form action="{{ route('category.store') }}" method="post" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label for="category" class="form-label">Category name</label>
                                    <input type="text" name="name" class="form-control" id="category">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </main>
@endsection

@section('javascript')
@endsection
