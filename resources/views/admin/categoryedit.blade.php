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
        </div><!-- End Page Title -->
        @include('admin.includes.sidebar')

        <section class="section">
            <div class="row">
                <div class="col-lg-5 block mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Update Category</h5>

                            <form action="{{ route('category.update', $category->id) }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label for="category" class="form-label">Category name</label>
                                    <input type="text" name="name" class="form-control" id="category" value="{{ $category->name }}">
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
    </main><!-- End #main -->
@endsection

@section('javascript')
@endsection
