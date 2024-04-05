@extends('client.layouts.app')


@section('header')
    <title>{{ $job->title }}</title>
    <meta name="description" content="{{ $job->title }}">
@endsection

@section('content')
    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('jobs.find') }}" class="text-info"><i
                                        class="fa fa-arrow-left" aria-hidden="true"></i>
                                    &nbsp;Back to Jobs</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container job_details_area">
            <div class="row pb-5">
                <div class="col-md-8">
                    @include('client.alert')
                    <div class="card shadow border-0">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">

                                    <div class="jobs_conetent">
                                        <a href="{{ route('viewJob', $job->id) }}" class="text-info">
                                            <h4>{{ $job->title }}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i> {{ $job->company_location }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fa fa-clock-o"></i> {{ $job->job_type->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        @auth
                                            @if ($isJobSaved)
                                                <a class="heart_mark border border-info"
                                                    style="background-color: #00D363; color: white"
                                                    href="{{ route('jobs.save', $job->id) }}">
                                                    <i class="fa fa-heart-o " aria-hidden="true"></i>
                                                </a>
                                            @else
                                                <a class="heart_mark border border-info"
                                                    href="{{ route('jobs.save', $job->id) }}">
                                                    <i class="fa fa-heart-o " aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        @else
                                            <a class="heart_mark border border-info" href="{{ route('jobs.save', $job->id) }}">
                                                <i class="fa fa-heart-o " aria-hidden="true"></i>
                                            </a>
                                        @endauth


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="descript_wrap white-bg">
                            <div class="single_wrap">
                                <h4>Job description</h4>
                                <p>{{ $job->description }}</p>
                            </div>
                            <div class="single_wrap">
                                <h4>Responsibility</h4>
                                <ul>
                                    p{{ $job->responsibility }}
                                </ul>
                            </div>
                            <div class="single_wrap">
                                <h4>Qualifications</h4>
                                <ul>
                                    <p>{{ $job->qualifications }}</p>
                                </ul>
                            </div>
                            <div class="single_wrap">
                                <h4>Benefits</h4>
                                <p>{{ $job->benifits }}</p>
                            </div>
                            <div class="border-bottom"></div>
                            <div class="pt-3 text-end">
                                <a href="#" class="btn btn-success">Save</a>
                                @auth
                                    @if ($job->user_id == auth()->user()->id)
                                        <a href="{{ route('editJob', $job->id) }}" class="btn btn-dark">Edit Job</a>
                                    @else
                                        <form style="display: inline-block" action="{{ route('jobs.apply', $job->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info text-white">Apply</button>
                                        </form>
                                    @endif
                                @else
                                    <form style="display: inline-block" action="{{ route('jobs.apply', $job->id) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-info text-white">Apply</button>
                                    </form>
                                @endauth

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Job Summery</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Published on: <span>{{ date_format($job->created_at, 'd M Y') }}</span></li>
                                    <li>Vacancy: <span>{{ $job->vacancy }}</span></li>
                                    <li>Salary: <span>{{ $job->min_salary }} - {{ $job->min_salary }}</span></li>
                                    <li>Location: <span>{{ $job->company_location }}</span></li>
                                    <li>Job Nature: <span> {{ $job->job_type->name }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0 my-4">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Company Details</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Name: <span>{{ $job->company_name }}</span></li>
                                    <li>Locaion: <span>{{ $job->company_location }}</span></li>
                                    <li>Webite: <a href="{{ $job->company_website }}"
                                            class="text-info">{{ $job->company_website }}</a></li>
                                </ul>
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
