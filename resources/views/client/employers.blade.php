@extends('client.layouts.app')
@section('header')
    <title>CareerVibe | Find Best Jobs</title>
@endsection
@section('content')
    <section class="section-3 py-5 bg-2 ">
        <form action="{{ route('employers') }}" method="GET" class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Explore employers</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-select">
                            <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <div class="card border-0 shadow p-4">
                        <div class="mb-4">
                            <h2>Name or keywords</h2>
                            <input type="text" placeholder="keywords" name="keywords" value="{{ $keyword ?? $keyword }}" id="keywords"
                                class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Location</h2>
                            <input type="text" placeholder="Location" id="location" name="location" value="{{ $location ?? $location }}"
                                class="form-control">
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-info text-white">Find employer</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row" style="row-gap: 25px;" id="JobsLists">
                                @if ($users->isNotEmpty())
                                    @foreach ($users as $user)
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            <div class="card border-0 shadow mb-4 d-flex flex-column h-100">
                                                <div class="card-body  d-flex flex-column justify-contents-between">

                                                    <div class="bg-light border flex-grow-1">
                                                        <div class="card-body  d-flex flex-column justify-contents-between">
                                                            <div class="s-body text-center mt-3">
                                                                <img src="{{ $user->image == '' ? asset('jobportal-template/assets/images/avatar7.png') : asset('uploads/avatars/' . $user->image) }}"
                                                                    alt="avatar" id="avatarImage"
                                                                    class="rounded-circle img-fluid"
                                                                    style="width: 150px; height: 150px">
                                                                <input type="hidden" id="baseAvatarUrl"
                                                                    value="{{ asset('uploads/avatars/') }}">

                                                                <h5 class="mt-3 pb-0">{{ $user->name }}</h5>
                                                                <p class="text-muted mb-1 fs-6">{{ $user->designation }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('employers.view', $user->id) }}" class="btn btn-info text-white btn-lg">View
                                                            Porfile</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12 mt-5">
                                        <h5 style="text-align: center"> No employer available </h5>
                                    </div>
                                @endif

                            </div>
                        </div>

                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>

            </div>
        </form>
    </section>
@endsection

@section('javascript')
    {{-- <script>
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
    </script> --}}
@endsection
