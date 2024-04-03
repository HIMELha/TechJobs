@extends('client.layouts.app')
@section('header')
    <title>TechJobs | Best Job Finding Platform</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <section class="section-0 lazy d-flex bg-image-style dark align-items-center " class=""
        data-bg="{{ asset('jobportal-template/assets/images/banner5.jpg') }}">
        <div class="container">
            <div class="row">
                @php
                    $setting = \App\Models\Setting::first();
                @endphp
                <div class="col-12 col-xl-8">
                    <h1>{{ $setting->site_hero_title }}</h1>
                    <p>{{ $setting->site_hero_desc }}</p>
                    <div class="banner-btn mt-5"><a href="{{ route('jobs.find') }}"
                            class="btn btn-info text-white mb-4 mb-sm-0">Explore
                            Jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-1 py-5 ">
        <div class="container">
            <div class="card border-0 shadow p-5">
                <form action="/find-jobs/" class="row">
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="keywords" id="keywords" placeholder="Keywords">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="location" id="location" placeholder="Location">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <select name="category" id="category" class="form-select">
                            <option value="">Select a Category</option>
                            @if ($categories->isNotEmpty())
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @else
                                <option value="">No categories found</option>
                            @endif

                        </select>
                    </div>

                    <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-info text-white btn-block">Search</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section-2 bg-2 py-5">
        <div class="container">
            <h2>Popular Categories</h2>
            <div class="row pt-5">
                @if ($categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <div class="col-lg-4 col-xl-3 col-md-6">
                            <div class="single_catagory">
                                <form action="/find-jobs/">
                                    <input type="text" name="category" value="{{ $category->id }}" hidden>

                                    <button type="submit" style="border: none;" class="btn btn-outline">
                                        <h4 class="pb-2 text-info">{{ $category->name }}</h4>
                                    </button>
                                </form>
                                <p class="mb-0"> <span>{{ $category->jobs->count() }}</span> Available position</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="d-block mx-auto">
                        <h5 class="text-center">No Categories found</h5>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <section class="section-3  py-5">
        <div class="container">
            <h2>Featured Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row" style="row-gap: 25px">
                            @if ($jobs->isNotEmpty())
                                @foreach ($jobs as $job)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card border-0 p-3 shadow mb-4 d-flex flex-column h-100">
                                            <div class="card-body d-flex flex-column justify-contents-between">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                                <p>{!! Str::words($job->description, 20, '...') !!}</p>
                                                <div class="bg-light p-3 border flex-grow-1">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $job->company_location }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $job->job_type->name }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $job->min_salary }} -
                                                            {{ $job->max_salary }}</span>
                                                    </p>
                                                </div>
                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('viewJob', $job->id) }}"
                                                        class="btn btn-info text-white btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <h5 class="text-center">No Jobs available</h5>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2>Latest Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row" style="row-gap: 25px">
                            @if ($jobs->isNotEmpty())
                                @foreach ($jobs as $job)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card border-0 p-3 shadow mb-4 d-flex flex-column h-100">
                                            <div class="card-body d-flex flex-column justify-contents-between">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                                <p>{!! Str::words($job->description, 20, '...') !!}</p>
                                                <div class="bg-light p-3 border flex-grow-1">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $job->company_location }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $job->job_type->name }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $job->min_salary }} -
                                                            {{ $job->max_salary }}</span>
                                                    </p>
                                                </div>
                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('viewJob', $job->id) }}"
                                                        class="btn btn-info text-white btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <h5 class="text-center">No Jobs available</h5>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h3 class="text-center" style="font-weight: 400; font-size: 29px !important">Explore Premium</h3>
            <div class="row pt-5">
                <div class="row" style="row-gap: 25px">
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 p-3 shadow d-flex flex-column h-100">
                            <div class="card-body d-flex flex-column justify-contents-between">
                                <h3 class="border-0 fs-5 pb-2 text-center mb-3">Starter Package <span
                                        class="text-info">29BDT</span></h3>
                                <div class="d-flex flex-column gap-3">
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa fa-robot"></i></span>
                                        <span class="ps-1">AI Search</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-envelope-open-text"></i></span>
                                        <span class="ps-1">Daily Email</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-comment-dots"></i></span>
                                        <span class="ps-1">Job Notifications</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i
                                                class="fa-brands fa-creative-commons-sampling"></i></span>
                                        <span class="ps-1">Auto Suggestion</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-list-check"></i></span>
                                        <span class="ps-1">Advance Searching</span>
                                    </p>

                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-toolbox"></i></span>
                                        <span class="ps-1">Analytics Dashboard</span>
                                    </p>

                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-regular fa-circle-check"></i></span>
                                        <span class="ps-1">Profile Badge</span>
                                    </p>

                                </div>
                                <div class="d-grid mt-4">
                                    <a href="{{ route('viewJob', $job->id) }}"
                                        class="btn btn-info text-white btn-lg">Checkout now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 p-3 shadow d-flex flex-column h-100">
                            <div class="card-body d-flex flex-column justify-contents-between">
                                <h3 class="border-0 fs-5 pb-2 text-center mb-3">Standard Package <span
                                        class="text-danger">49BDT</span></h3>
                                <div class="d-flex flex-column gap-3">
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa fa-robot"></i></span>
                                        <span class="ps-1">AI Search</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-envelope-open-text"></i></span>
                                        <span class="ps-1">Daily Email</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-comment-dots"></i></span>
                                        <span class="ps-1">Job Notifications</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i
                                                class="fa-brands fa-creative-commons-sampling"></i></span>
                                        <span class="ps-1">Auto Suggestion</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-list-check"></i></span>
                                        <span class="ps-1">Advance Searching</span>
                                    </p>

                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-toolbox"></i></span>
                                        <span class="ps-1">Analytics Dashboard</span>
                                    </p>

                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-regular fa-circle-check"></i></span>
                                        <span class="ps-1">Profile Badge</span>
                                    </p>

                                </div>
                                <div class="d-grid mt-4">
                                    <a href="{{ route('viewJob', $job->id) }}"
                                        class="btn btn-info text-white btn-lg">Checkout now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 p-3 shadow d-flex flex-column h-100">
                            <div class="card-body d-flex flex-column justify-contents-between">
                                <h3 class="border-0 fs-5 pb-2 text-center mb-3">Premium Package <span
                                        class="text-warning">99BDT</span></h3>
                                <div class="d-flex flex-column gap-3">
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa fa-robot"></i></span>
                                        <span class="ps-1">AI Search</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-envelope-open-text"></i></span>
                                        <span class="ps-1">Daily Email</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-comment-dots"></i></span>
                                        <span class="ps-1">Job Notifications</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i
                                                class="fa-brands fa-creative-commons-sampling"></i></span>
                                        <span class="ps-1">Auto Suggestion</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-list-check"></i></span>
                                        <span class="ps-1">Advance Searching</span>
                                    </p>

                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-solid fa-toolbox"></i></span>
                                        <span class="ps-1">Analytics Dashboard</span>
                                    </p>

                                    <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa-regular fa-circle-check"></i></span>
                                        <span class="ps-1">Profile Badge</span>
                                    </p>

                                </div>
                                <div class="d-grid mt-4">
                                    <a href="{{ route('viewJob', $job->id) }}"
                                        class="btn btn-info text-white btn-lg">Checkout now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-3 bg-2 pb-5">
        <div class="container pb-5">

            <div class="row d-block mx-auto pt-5">
                <h4 class="text-center">About TechJobs</h4>

                <p style="font-size: 18px !important">TechJobs is a leading HR site dedicated to connecting technology professionals with job opportunities
                    across various industries. Founded with the mission to streamline the job search process for both
                    employers and candidates within the tech sector, TechJobs has emerged as a go-to platform for
                    individuals seeking employment in fields such as software development, cybersecurity, data science, IT
                    support, and more.</p>
                <p style="font-size: 18px !important">The platform offers a user-friendly interface where job seekers can easily search for positions based on
                    their skills, experience level, location preferences, and other criteria. With a vast database of job
                    listings from reputable companies, TechJobs provides candidates with access to a diverse range of career
                    opportunities, ranging from entry-level positions to senior management roles.</p>
                <p style="font-size: 18px !important">For employers, TechJobs offers a powerful recruiting solution to attract top talent in the tech industry.
                    Companies can post job openings, manage applications, and screen candidates efficiently through the
                    platform's intuitive dashboard. Advanced features such as targeted job promotion, applicant tracking,
                    and resume parsing help employers streamline their hiring process and identify the most qualified
                    candidates for their roles.</p>
            </div>
        </div>
    </section>
@endsection
