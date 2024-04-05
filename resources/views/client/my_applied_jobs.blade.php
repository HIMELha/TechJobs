@extends('client.layouts.app')

@section('header')
    <title>Applied Jobs - TechJobs</title>
    <meta name="description" content="Applied Jobs - TechJobs">
@endsection


@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Applied Jobs</li>
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
                            <h3 class="fs-4 mb-1">Jobs Applied</h3>
                            @if ($appliedJobs->isNotEmpty())
                                <div class="table-responsive">
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
                                            @foreach ($appliedJobs as $aJob)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">{{ $aJob->job->title }}</div>
                                                        <div class="info1">{{ $aJob->job->company_location }}</div>
                                                    </td>
                                                    <td>{{ date_format($aJob->job->created_at, 'd M Y') }}</td>
                                                    <td>{{ $aJob->job->jobApplication->count() }} Applications</td>
                                                    <td>
                                                        <div class="job-status text-capitalize">active</div>
                                                    </td>
                                                    <td>
                                                        <div class="action-dots float-end">
                                                            <a href="#" class="" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('viewJob', $aJob->job->id) }}"> <i
                                                                            class="fa fa-eye" aria-hidden="true"></i>
                                                                        View</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('jobs.apply.delete', $aJob->id) }}"><i
                                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                                        Remove</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="d-block mx-auto mt-5">
                                    <h5 class="text-center">No applied jobs available</h5>
                                    <a href="{{ route('jobs.find') }}"
                                        class="d-block mx-auto btn btn-info text-white text-center"
                                        style="width: 120px">Find Jobs</a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('javascript')
@endsection
