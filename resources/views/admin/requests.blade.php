@extends('admin.layouts.app')

@section('header')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Membership</li>
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
                                    <h5 class="card-title">Membership</h5>

                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Joined on</th>
                                            <th scope="col">Membership type</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @if ($memberships->isNotEmpty())
                                            @foreach ($memberships as $job)
                                                <tr>
                                                    <th scope="row">{{ $job->id }}</th>
                                                    <td>{{ $job->user->name }}</td>
                                                    <td>{{ $job->title }}</td>
                                                    <td>{{ $job->category->name }}</td>
                                                    <td>{{ $job->jobApplication->count() }} Application</td>
                                                    <td>
                                                        <p
                                                            class="badge {{ $job->status == true ? 'bg-info' : 'bg-danger' }}">
                                                            {{ $job->status == true ? 'Active' : 'Pending' }}</p>
                                                    </td>
                                                    <td class="d-flex gap-1">
                                                        <a href="{{ route('adminjobs.edit', $job->id) }}"
                                                            class="btn btn-sm btn-success">Edit</a>
                                                        <a href="{{ route('adminjobs.destroy', $job->id) }}"
                                                            class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">No Jobs available</td>
                                            </tr>
                                        @endif --}}
                                    </tbody>
                                </table>

                                {{-- {{ $memberships->links('pagination::bootstrap-5') }} --}}

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
