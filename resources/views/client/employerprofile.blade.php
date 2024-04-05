@extends('client.layouts.app')

@section('header')
    <title>{{ $user->name }} Profile - TechJobs</title>
    <!-- Open Graph  meta tags -->
    <meta property="og:title" content="{{ $user->name }} Profile - TechJobs">
    <meta property="og:description" content="{{ $user->designation }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:image"
        content="{{ $user->image ? asset('uploads/avatars/' . $user->image) : asset('jobportal-template/assets/images/avatar7.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employers') }}">Employers</a></li>
                            <li class="breadcrumb-item active">{{ $user->name }}</li>
                        </ol>
                    </nav>

                    @if (auth()->check() && auth()->user()->id == $user->id)
                        <a href="{{ route('profile.index', auth()->user()->id) }}"
                            class="btn btn-sm btn-info text-white mb-4"><i class="fa-solid fa-pen-to-square"></i> Update</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card border-0 shadow mb-4 p-4">
                        <div class="s-body text-center mt-3">
                            <img src="{{ $user->image ? asset('uploads/avatars/' . $user->image) : asset('jobportal-template/assets/images/avatar7.png') }}"
                                alt="{{ $user->name }} - TechJobs" id="avatarImage" class="rounded-circle img-fluid"
                                style="width: 150px; height: 150px">

                            <input type="hidden" id="baseAvatarUrl" value="{{ asset('uploads/avatars/') }}">

                            <h5 class="mt-3 pb-0  text-center">{{ $user->name }}
                                @if ($subscription)
                                    <img class="verificationBadge"
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTz6BwqUK7GcdwCGF4RvvZA8KabNsqIIEW5d8IYMz1gAQ&s"
                                        alt="{{ $user->name }} - Verified">
                                @endif
                            </h5>

                            <p class="text-muted mb-1 fs-6">{{ $user->designation }}</p>

                            <p class="mt-3">Connect with {{ Str::words($user->name, 1, '') }}</p>

                            <div class="px-3 d-flex justify-content-start gap-1 align-items-start flex-column">
                                @if ($user->website)
                                    <a href="{{ $user->website }}" class="d-block"><i class="fa-solid fa-globe mr-1"></i>
                                        Personal Website </a>
                                @endif
                                @if ($user->github)
                                    <a href="{{ $user->github }}"><i class="fa-brands fa-github mr-1"></i>
                                        Github</a>
                                @endif
                                @if ($user->linkedin)
                                    <a href="{{ $user->linkedin }}"><i class="fa-brands fa-linkedin mr-1"></i>
                                        Linkedin</a>
                                @endif

                                @if ($user->twitter)
                                    <a href="{{ $user->twitter }}"><i class="fa-brands fa-twitter mr-1"></i>
                                        twitter</a>
                                @endif

                                @if ($user->facebook)
                                    <a href="{{ $user->facebook }}"><i class="fa-brands fa-facebook mr-1"></i>
                                        Facebook</a>
                                @endif

                            </div>


                            <div class="px-3 mt-5 pt-2">
                                @if ($subscription)
                                    <p class="text-center mb-0" style="font-size: 15px !important">Paid member since: </p>
                                    <span class="badge bg-info"
                                        style="margin-top: -10px !important">{{ date_format($subscription->created_at, 'd M Y') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    @include('client.alert')

                    <div class="card">
                        @php
                            $bannerImage = asset('uploads/banners/' . $user->banner_image);
                        @endphp
                        @if ($user->banner_image)
                            <div>
                                <img src="{{ $bannerImage }}" alt="{{ $user->name }} Profile - TechJobs">
                            </div>
                        @else
                            <div>
                                <img src="{{ asset('uploads/banners/' . 'default.png') }}"
                                    alt="{{ $user->name }} Profile - TechJobs">
                            </div>
                        @endif

                        <div class="p-4">
                            <h5>About {{ $user->name }}</h5>
                            <p>{{ $user->about ? $user->about : 'Not available' }}</p>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Education</h5>
                                    <p>{{ $user->education ? $user->education : 'Not available' }}</p>
                                </div>

                                <div class="col-md-6">
                                    <h5>Experience</h5>
                                    <p>{{ $user->experience ? $user->experience : 'Not available' }}</p>
                                </div>
                            </div>

                            <br>
                            <hr>
                            <div class="d-flex justify-content-between align-item-center">
                                <h5>Recent Jobs</h5>

                                <a href="{{ route('jobs.find') }}"
                                    class="btn btn-sm btn-info text-white px-2 py-1 mb-4">Find Jobs</a>
                            </div>
                            <div class="job_lists">
                                <div class="row" style="row-gap: 25px">
                                    @if ($jobs->isNotEmpty())
                                        @foreach ($jobs as $job)
                                            <div class="col-md-6">
                                                <div class="card border-0 p-3 shadow mb-4 d-flex flex-column h-100">
                                                    <div class="card-body d-flex flex-column justify-contents-between">
                                                        <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                                        <p>{!! Str::words($job->description, 20, '...') !!}</p>
                                                        <div class="bg-light p-3 border flex-grow-1">
                                                            <p class="mb-0">
                                                                <span class="fw-bolder"><i
                                                                        class="fa fa-map-marker"></i></span>
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
            </div>
        </div>
    </section>
@endsection

@section('javascript')
@endsection
