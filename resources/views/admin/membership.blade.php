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
                                            <th scope="col">Phone</th>
                                            <th scope="col">TrxID</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($memberships->isNotEmpty())
                                            @foreach ($memberships as $member)
                                                <tr>
                                                    <th scope="row">{{ $member->id }}</th>
                                                    <td>{{ $member->user->name }}</td>
                                                    <td>{{ date_format($member->created_at, 'd-m-Y') }}</td>
                                                    <td>{{ $member->type }}</td>
                                                    <td>{{ $member->phone }}</td>
                                                    <td>{{ $member->transaction_id }}</td>
                                                    <td>
                                                        <p
                                                            class="badge {{ $member->status == true ? 'bg-info' : 'bg-danger' }}">
                                                            {{ $member->status == true ? 'Active' : 'Pending' }}</p>
                                                    </td>
                                                    <td class="d-flex gap-1">
                                                        <a href="{{ route('employers.view', $member->user->id) }}"
                                                                class="btn btn-sm btn-success">View Profile</a>
                                                        @if ($member->status == false)
                                                            <a href="{{ route('membership.responseRequest', [$member->id, 'approve']) }}"
                                                                class="btn btn-sm btn-success">Approve</a>
                                                        @endif


                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">No membership requests available</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                {{ $memberships->links('pagination::bootstrap-5') }}

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
