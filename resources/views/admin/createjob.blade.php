@extends('admin.layouts.app')

@section('header')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Post Job</li>
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
                                    <h5 class="card-title">Post Job</h5>

                                    <a href="{{ route('adminjobs.index') }}" class="btn btn-info text-white btn-sm">Back</a>
                                </div>

                                <form action="{{ route('adminjobs.store') }}" method="POST" class="card border-0 shadow mb-4 ">
                                    <div class="card-body card-form p-4">
                                        <h3 class="fs-4 mb-1">Post a Job</h3>
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="" class="mb-2">Title<span
                                                        class="req">*</span></label>
                                                <input type="text" placeholder="Job Title" id="title" name="title"
                                                    class="form-control @error('title')
                                            is-invalid
                                        @enderror">
                                                @error('title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-6  mb-4">
                                                <label for="" class="mb-2">Category<span
                                                        class="req">*</span></label>
                                                <select name="category_id" id="category"
                                                    class="form-select @error('category')
                                            is-invalid
                                        @enderror">
                                                    @if ($categories->isNotEmpty())
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="" disabled> No Category Found</option>
                                                    @endif
                                                </select>
                                                @error('category_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="" class="mb-2">Job Nature<span
                                                        class="req">*</span></label>
                                                <select
                                                    class="form-select @error('job_type_id')
                                            is-invalid
                                        @enderror"
                                                    name="job_type_id">
                                                    @if ($job_types->isNotEmpty())
                                                        @foreach ($job_types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="" disabled>No JobType Found</option>
                                                    @endif
                                                </select>
                                                @error('job_type_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-6  mb-4">
                                                <label for="" class="mb-2">Vacancy<span
                                                        class="req">*</span></label>
                                                <input type="number" min="1" placeholder="Vacancy" id="vacancy"
                                                    name="vacancy"
                                                    class="form-control @error('vacancy')
                                            is-invalid
                                        @enderror">
                                                @error('vacancy')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-2 col-md-3">
                                                <label for="" class="mb-2">Min Salary</label>
                                                <input type="text" placeholder="Min Salary" id="min_salary"
                                                    name="min_salary"
                                                    class="form-control @error('min_salary')
                                            is-invalid
                                        @enderror">
                                                @error('min_salary')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mb-2 col-md-3">
                                                <label for="" class="mb-2">Max Salary</label>
                                                <input type="text" placeholder="Max Salary" id="max_salary"
                                                    name="max_salary"
                                                    class="form-control @error('max_salary')
                                            is-invalid
                                        @enderror">
                                                @error('max_salary')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mb-4 col-md-6">
                                                <label for="" class="mb-2">Experience<span
                                                        class="req">*</span></label>
                                                <select id="experience" name="experience"
                                                    class="form-select @error('experience')
                                            is-invalid
                                        @enderror">
                                                    @for ($exp = 1; $exp <= 9; $exp++)
                                                        <option value="{{ $exp }}">{{ $exp }} year
                                                            experience
                                                        </option>
                                                    @endfor
                                                </select>
                                                @error('experience')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="" class="mb-2">Description<span
                                                    class="req">*</span></label>
                                            <textarea
                                                class="form-control textarea @error('description')
                                            is-invalid
                                        @enderror"
                                                name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>
                                            @error('description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="" class="mb-2">Benefits</label>
                                            <textarea
                                                class="form-control textarea @error('benifits')
                                            is-invalid
                                        @enderror"
                                                name="benifits" id="benifits" cols="5" rows="5" placeholder="Benifits"></textarea>
                                            @error('benifits')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="" class="mb-2">Responsibility</label>
                                            <textarea
                                                class="form-control textarea @error('responsibility')
                                            is-invalid
                                        @enderror"
                                                name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility"></textarea>
                                            @error('responsibility')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="" class="mb-2">Qualifications</label>
                                            <textarea
                                                class="form-control textarea @error('qualifications')
                                            is-invalid
                                        @enderror"
                                                name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications"></textarea>
                                            @error('qualifications')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mb-4">
                                            <label for="" class="mb-2">Keywords<span
                                                    class="req">*</span></label>
                                            <input type="text" placeholder="keywords" id="keywords" name="keywords"
                                                class="form-control @error('keywords')
                                            is-invalid
                                        @enderror">
                                            @error('keywords')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                        <div class="row">
                                            <div class="mb-4 col-md-6">
                                                <label for="" class="mb-2">Name<span
                                                        class="req">*</span></label>
                                                <input type="text" placeholder="Company Name" id="company_name"
                                                    name="company_name"
                                                    class="form-control @error('company_name')
                                            is-invalid
                                        @enderror">
                                                @error('company_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mb-4 col-md-6">
                                                <label for="" class="mb-2">Location<span
                                                        class="req">*</span></label>
                                                <input type="text" placeholder="Location" id="location"
                                                    name="company_location"
                                                    class="form-control @error('company_location')
                                            is-invalid
                                        @enderror">
                                                @error('company_location')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="" class="mb-2">Website<span
                                                    class="req">*</span></label>
                                            <input type="text" placeholder="Website" id="company_website"
                                                name="company_website"
                                                class="form-control @error('title')
                                            is-invalid
                                        @enderror">
                                            @error('company_website')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer  p-4">
                                        <button type="submit" class="btn btn-info text-white">Save Job</button>
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