@extends('client.layouts.app')

@section('header')
    <title>My Jobs Lists - TechJobs</title>
    <meta name="description" content="My Jobs Lists - TechJobs">
@endsection


@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">My Jobs</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                @include('client.sidebar')
                <div class="col-lg-9">
                    @include('client.alert')
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">My Jobs</h3>
                                </div>
                                <div style="margin-top: -10px;">
                                    <a href="{{ route('createJob') }}" class="btn btn-info text-white">Post a Job</a>
                                </div>

                            </div>
                            <div class="table-responsive">
                                @if ($jobs->isNotEmpty())
                                    <table class="table ">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col">Title</th>
                                                <th scope="col">Job Created</th>
                                                <th scope="col">Applicants</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-0">
                                            @foreach ($jobs as $job)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">{{ $job->title }}</div>
                                                        <div class="info1">{{ $job->category->name }}</div>
                                                    </td>
                                                    <td>{{ date_format($job->created_at, 'd M Y') }}</td>
                                                    <td><a class="bg-info text-white px-2 py-1"
                                                            href="{{ route('jobs.application', $job->id) }}">
                                                            {{ $job->jobApplication->count() }} Applications</a></td>
                                                    <td>
                                                        @if ($job->status)
                                                            <div class="job-status text-capitalize text-success">active
                                                            </div>
                                                        @else
                                                            <div class="job-status text-capitalize text-warning">paused
                                                            </div>
                                                        @endif


                                                    </td>
                                                    <td>
                                                        <div class="action-dots float-end">
                                                            <a href="#" class="" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('viewJob', $job->id) }}"> <i
                                                                            class="fa fa-eye" aria-hidden="true"></i>
                                                                        View</a>
                                                                </li>

                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('editJob', $job->id) }}"><i
                                                                            class="fa fa-edit" aria-hidden="true"></i>
                                                                        Edit</a>
                                                                </li>
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('deleteJob', $job->id) }}"><i
                                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                                        Remove</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                @else
                                    <div class="mt-3 mx-auto">
                                        <h5 class="text-center ">No Job posted yet</h5>
                                        <a href="{{ route('createJob') }}"
                                            class="btn btn-info text-white m-2 mt-2 text-center d-block mx-auto "
                                            style="width: 140px">Post Job</a>
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
