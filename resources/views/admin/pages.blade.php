@extends('admin.layouts.app')

@section('header')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Pages</li>
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
                                    <h5 class="card-title">Pages</h5>

                                    <a href="{{ route('pages.create') }}" class="btn btn-info text-white btn-sm">Create Page</a>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($pages->isNotEmpty())
                                            @foreach ($pages as $page)
                                                <tr>
                                                    <th scope="row">{{ $page->id }}</th>
                                                    <td>{{ $page->title }}</td>
                                                    <td>{!! Str::words(strip_tags($page->description), 30, '...') !!}</td>
                                                    <td>
                                                        <p
                                                            class="badge {{ $page->status == true ? 'bg-info' : 'bg-danger' }}">
                                                            {{ $page->status == true ? 'Active' : 'Pending' }}</p>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('pages.edit', $page->id) }}"
                                                            class="btn btn-sm btn-success">Edit</a>
                                                        <a href="{{ route('pages.pageDestroy', $page->id) }}"
                                                            class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">No Pages available</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                {{ $pages->links('pagination::bootstrap-5') }}

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
