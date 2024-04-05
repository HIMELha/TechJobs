@extends('client.layouts.app')

@section('header')
    <title>Update Job - TechJobs</title>
    <meta name="description" content="Update Job - TechJobs">
@endsection


@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Update Job</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                @include('client.sidebar')
                <div class="col-lg-9">
                    @include('client.alert')
                    <form action="{{ route('updateJob', $job->id) }}" method="POST" class="card border-0 shadow mb-4 ">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Update job</h3>
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Title<span class="req">*</span></label>
                                    <input type="text" placeholder="Job Title" id="title" name="title"
                                        value="{{ $job->title }}"
                                        class="form-control @error('job_type_id') is-invalid @enderror">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Category<span class="req">*</span></label>
                                    <select name="category_id" id="category"
                                        class="form-select @error('category') is-invalid @enderror">
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $job->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
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
                                    <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                    <select class="form-select @error('job_type_id') is-invalid @enderror"
                                        name="job_type_id">
                                        @if ($job_types->isNotEmpty())
                                            @foreach ($job_types as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ $job->job_type_id == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}</option>
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
                                    <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                    <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy"
                                        value="{{ $job->vacancy }}"
                                        class="form-control @error('vacancy') is-invalid @enderror">
                                    @error('vacancy')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-2 col-md-3">
                                    <label for="" class="mb-2">Min Salary</label>
                                    <input type="text" placeholder="Min Salary" id="min_salary" name="min_salary"
                                        value="{{ $job->min_salary }}"
                                        class="form-control @error('min_salary') is-invalid @enderror">
                                    @error('min_salary')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="" class="mb-2">Max Salary</label>
                                    <input type="text" placeholder="Max Salary" id="max_salary" name="max_salary"
                                        value="{{ $job->max_salary }}"
                                        class="form-control @error('max_salary') is-invalid @enderror">
                                    @error('max_salary')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Experience<span class="req">*</span></label>
                                    <select id="experience" name="experience"
                                        class="form-select @error('experience') is-invalid @enderror">
                                        @for ($exp = 1; $exp <= 9; $exp++)
                                            <option value="{{ $exp }}"
                                                {{ $exp == $job->experience ? 'selected' : '' }}>{{ $exp }} year
                                                experience</option>
                                        @endfor

                                    </select>
                                    @error('experience')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="form-control textarea  @error('description') is-invalid @enderror" name="description" id="description"
                                    cols="5" rows="5" placeholder="Description"> {{ $job->description }} </textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Benefits</label>
                                <textarea class="form-control textarea @error('benifits') is-invalid @enderror" name="benifits" id="benifits"
                                    cols="5" rows="5" placeholder="Benifits"> {{ $job->benifits }} </textarea>
                                @error('benifits')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Responsibility</label>
                                <textarea value="{{ $job->responsibility }}"
                                    class="form-control textarea @error('responsibility') is-invalid @enderror" name="responsibility"
                                    id="responsibility" cols="5" rows="5" placeholder="Responsibility"> {{ $job->responsibility }} </textarea>
                                @error('responsibility')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Qualifications</label>
                                <textarea value="{{ $job->qualifications }}"
                                    class="form-control textarea @error('qualifications') is-invalid @enderror" name="qualifications"
                                    id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ $job->qualifications }}</textarea>
                                @error('qualifications')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>



                            <div class="mb-4">
                                <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                                <input type="text" placeholder="keywords" id="keywords" name="keywords"
                                    value="{{ $job->keywords }}"
                                    class="form-control @error('keywords') is-invalid @enderror">
                                @error('keywords')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Name<span class="req">*</span></label>
                                    <input type="text" placeholder="Company Name" id="company_name"
                                        name="company_name"value="{{ $job->company_name }}"
                                        class="form-control @error('company_name') is-invalid @enderror">
                                    @error('company_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                                    <input type="text" placeholder="Location" id="location" name="company_location"
                                        value="{{ $job->company_location }}"
                                        class="form-control @error('company_location') is-invalid @enderror">
                                    @error('company_location')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Website<span class="req">*</span></label>
                                <input type="text" placeholder="Website" id="company_website" name="company_website"
                                    value="{{ $job->company_website }}"
                                    class="form-control @error('company_website') is-invalid @enderror">
                                @error('company_website')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="Status" class="mb-2">Status<span class="req">*</span></label>
                                <select id="status" name="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                    <option value="{{ $job->status }}" {{ $job->status == false ? 'selected' : '' }}>
                                        Paused</option>
                                    <option value="{{ $job->status }}" {{ $job->status == true ? 'selected' : '' }}>
                                        Active</option>

                                </select>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-info text-white">Update Job</button>
                        </div>
                    </form>

                </div>
            </div>
    </section>
@endsection

@section('javascript')
    <script>
        $('.textarea').trumbowyg();
    </script>
@endsection
