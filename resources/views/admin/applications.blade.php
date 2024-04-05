@extends('admin.layouts.app')

@section('header')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Job Applications</li>
                </ol>
            </nav>

            <section class="section">
                <div class="row">
                    <div class="col-lg-10 d-block mx-auto">

                        <div class="card">
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>
                                @endif
                                @if (Session::has('error'))
                                    <div class="alert alert-error mt-2">{{ Session::get('error') }}</div>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">{{ $job->title }} -Job Application</h5>

                                    <a href="{{ route('adminjobs.create') }}" class="btn btn-info text-white btn-sm">Post
                                        Job</a>
                                </div>

                                <table class="table">
                                    @if ($applications->isNotEmpty())
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
                                                @foreach ($applications as $application)
                                                    <tr class="active">
                                                        <td>
                                                            <div class="job-name fw-500">{{ $application->id }}</div>
                                                        </td>
                                                        <td><a
                                                                href="{{ route('employers.view', $application->user->id) }}">{{ $application->user->name }}</a>
                                                        </td>
                                                        <td>{{ $application->user->email }}</td>
                                                        <td>{{ $application->user->phone ? $application->user->phone : 'Not Added' }}
                                                        </td>
                                                        <td>
                                                            <div class="job-status text-capitalize text-success">
                                                                {{ date_format($application->created_at, 'd M Y') }}</div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('employers.view', $application->user->id) }}"
                                                                class="btn btn-sm btn-success text-white">View Profile</a>
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
                                </table>

                                {{ $applications->links('pagination::bootstrap-5') }}

                            </div>
                        </div>

                    </div>
            </section>

        </div>
        @include('admin.includes.sidebar')
    </main>
@endsection

@section('javascript')
@endsection
