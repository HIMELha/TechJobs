@extends('client.layouts.app')

@section('header')
@endsection


@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employers') }}">Employers</a></li>
                            <li class="breadcrumb-item active">{{ $user->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="s-body text-center mt-3">
                            <img src="{{ $user->image == '' ? asset('jobportal-template/assets/images/avatar7.png') : asset('uploads/avatars/' . $user->image) }}"
                                alt="avatar" id="avatarImage" class="rounded-circle img-fluid"
                                style="width: 150px; height: 150px">
                            <input type="hidden" id="baseAvatarUrl" value="{{ asset('uploads/avatars/') }}">

                            <h5 class="mt-3 pb-0">{{ $user->name }}</h5>
                            <p class="text-muted mb-1 fs-6">{{ $user->designation }}</p>

                        </div>
                    </div>
                    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                        <div class="card-body p-0">
                           
                        </div>

                    </div>
                </div>

                <div class="col-lg-9">
                    @include('client.alert')

                    <div class="card p-4">
                        <h5>About {{ $user->name }}</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat id consectetur, quas soluta
                            voluptatem quisquam incidunt nostrum consequuntur a maxime minus ab quo eaque odio amet
                            praesentium eius libero perspiciatis possimus unde et placeat consequatur esse! Ipsam nam culpa,
                            iste ad sequi quam modi incidunt accusamus, praesentium, eos veniam quisquam!</p>

                        <br>
                        <h5>Recently posted jobs</h5>
                        <div class="job_lists">
                            <div class="row" style="row-gap: 25px">
                                @if ($jobs->isNotEmpty())
                                    @foreach ($jobs as $job)
                                        <div class="col-md-4">
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
        </div>
    </section>
@endsection

@section('javascript')
@endsection
