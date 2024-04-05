@extends('client.layouts.app')
@section('header')
    <title>CareerVibe | Find Best Jobs</title>
@endsection
@section('content')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-select">
                            <option value="latest">Latest</option>
                            <option value="oldest">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <div class="card border-0 shadow p-4">
                        <div class="mb-4">
                            <h2>Keywords</h2>
                            <input type="text" placeholder="Keywords" value="{{ $keyword ?? $keyword }}" id="keywords"
                                class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Location</h2>
                            <input type="text" placeholder="Location" id="location" value="{{ $location ?? $location }}" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Category</h2>
                            <select name="category" id="category" class="form-select">
                                <option value="">Select a Category</option>
                                @if ($categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category_f == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No Categories available</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-4">
                            <h2>Job Type</h2>
                            @if ($job_types->isNotEmpty())
                                <div id="jobTypes">
                                    @foreach ($job_types as $type)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input " name="job_type" type="checkbox"
                                                value="{{ $type->id }}" id="job_type_{{ $type->id }}">
                                            <label class="form-check-label "
                                                for="job_type_{{ $type->id }}">{{ $type->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="form-check mb-2">
                                    <label class="form-check-label">No types avaialble</label>
                                </div>
                            @endif

                        </div>

                        <div class="mb-4">
                            <h2>Experience</h2>
                            <select name="experience" id="experience" class="form-select">
                                <option value="">Select Experience</option>
                                @for ($exp = 1; $exp <= 9; $exp++)
                                    <option value="{{ $exp }}">{{ $exp }} Year</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9 ">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row" style="row-gap: 25px" id="JobsLists">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script>
        function loadJobs() {
            const jobLists = $('#JobsLists');

            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            const keyword = $('#keywords').val();
            const location = $('#location').val();
            const category = $('#category').val();
            const experience = $('#experience').val();
            const sort = $('#sort').val();
            const job_types = [];
            const selectedJobTypes = $('#jobTypes input[name="job_type"]');

            selectedJobTypes.each(function() {
                if ($(this).is(':checked')) {
                    job_types.push($(this).val());
                }
            });

            $.ajax({
                url: "{{ route('jobs.get') }}",
                type: 'post',
                data: {
                    _token: csrfToken,
                    keyword: keyword,
                    location: location,
                    category: category,
                    job_types: job_types,
                    experience: experience,
                    sort: sort
                },
                beforeSend: function() {
                    const animation = `
                        <div class="col-12 mt-5" >
                            <div class="d-block mx-auto spinner-border text-info" role="status">                          
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>`;
                    jobLists.html(animation);
                },
                success: function(response) {

                    if (response.status == true && response.jobs.data.length > 0) {
                        const routeViewJob = "{{ route('viewJob', '') }}";
                        const jobs = response.jobs.data;

                        let jobsHtml = '';
                        jobs.forEach(job => {
                            const desc = job.description.substring(0, 30);
                            const jobId = job.id;
                            const jobhtml = `
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <div class="card border-0 p-3 shadow mb-4 d-flex flex-column h-100">
                                    <div class="card-body  d-flex flex-column justify-contents-between">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">${job.title}</h3>
                                        <p>${desc}</p>
                                        <div class="bg-light p-3 border flex-grow-1">
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                <span class="ps-1">${job.company_location}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                <span class="ps-1">${job.job_type.name}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                <span class="ps-1">${job.min_salary} - ${job.max_salary}</span>
                                            </p>
                                        </div>

                                        <div class="d-grid mt-3">
                                            <a href="${routeViewJob}/${jobId}" class="btn btn-info text-white btn-lg">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                            jobsHtml += jobhtml;
                        });
                        jobLists.html(jobsHtml);
                    } else {
                        jobLists.html(
                            '<div class="col-12 mt-5"> <h5 style="text-align: center"> No Jobs available </h5> </div>'
                        );
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
        
        loadJobs();

        let timer;

        $('#keywords, #location, #category, input[name="job_type"], #experience, #sort').on('input', function() {
            clearTimeout(timer);

            timer = setTimeout(() => {
                loadJobs();
            }, 600);
        });
    </script>
@endsection
