@extends('admin.layouts.app')

@section('header')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Update Page</li>
                </ol>
            </nav>

            <section class="section">
                <div class="row">
                    <div class="col-lg-10 d-block mx-auto">

                        <div class="card">
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>
                                @endif
                                @if (Session::has('error'))
                                    <div class="alert alert-error mt-2">{{ Session::get('error') }}</div>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Update Page</h5>

                                    <a href="{{ route('pages.index') }}" class="btn btn-info text-white btn-sm">Back</a>
                                </div>

                                <form action="{{ route('pages.updatee', $page->id) }}" method="POST" class=" mb-4 ">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="" class="mb-2">Title<span class="req">*</span></label>
                                            <input type="text" placeholder="Job Title" id="title" name="title" value="{{ $page->title }}"
                                                class="form-control @error('title') is-invalid @enderror">
                                            @error('title')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="col-12">
                                            <label for="" class="mb-2">Description<span
                                                    class="req">*</span></label>
                                            <textarea
                                                class="form-control textarea @error('description') is-invalid  @enderror"
                                                name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $page->description }}</textarea>
                                            @error('description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    <div class="row">
                                        <div class="col-md-6  mb-4">
                                            <label for="" class="mb-2">Keywords<span
                                                    class="req">*</span></label>
                                            <input type="text" min="1" placeholder="Keywords" id="keywords"
                                                name="keywords" value="{{ $page->keywords }}"
                                                class="form-control @error('keywords') is-invalid @enderror">
                                            @error('keywords')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-6  mb-4">
                                            <label for="" class="mb-2">Status<span
                                                    class="req">*</span></label>
                                            <select name="status" id="category"
                                                class="form-select @error('status') is-invalid @enderror">
                                                <option disabled>Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Pending</option>

                                            </select>
                                            @error('status')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="card-footer  p-4">
                                        <button type="submit" class="btn btn-info text-white">Update Page</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
            </section>

        </div>
        @include('admin.includes.sidebar')
    </main>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"
        integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.textarea').trumbowyg();
    </script>
@endsection
