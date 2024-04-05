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
                            <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $job->title }}</li>
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
                                    <h3 class="fs-4 mb-1">{{ $job->title }} - Job Application</h3>
                                </div>
                                <div style="margin-top: -10px;">
                                    <a href="{{ route('createJob') }}" class="btn btn-info text-white">Post a Job</a>
                                </div>

                            </div>
                            <div class="table-responsive">
                                @if ($job->jobApplication->isNotEmpty())
                                    <table class="table ">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Employer name</th>
                                                <th scope="col">Employer email</th>
                                                <th scope="col">Employer phone</th>
                                                <th scope="col">Applied on</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-0">
                                            @foreach ($job->jobApplication as $application)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">{{ $application->id }}</div>
                                                    </td>
                                                    <td><a href="{{ route('employers.view', $application->user->id) }}">{{ $application->user->name }}</a></td>
                                                    <td>{{ $application->user->email }}</td>
                                                    <td>{{ $application->user->phone ? $application->user->phone : 'Not Added' }}</td>
                                                    <td>
                                                        <div class="job-status text-capitalize text-success">{{ date_format($application->created_at, 'd M Y') }}</div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('employers.view', $application->user->id) }}" class="btn btn-sm btn-success text-white">View Profile</a>
                                                    </td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                @else
                                    <div class="mt-3 mx-auto">
                                        <h5 class="text-center ">No Job Application available</h5>
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
