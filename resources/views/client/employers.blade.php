@extends('client.layouts.app')
@section('header')
    <title>Explore employers | TechJobs</title>
    <meta name="description">Explore employers | TechJobs</meta>
    <!-- Open Graph meta tags -->
    <meta property="og:title" content="Explore employers | TechJobs">
    <meta property="og:description" content="Explore employers | TechJobs">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:image" content="">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <section class="section-3 py-5 bg-2 ">
        <form action="{{ route('employers') }}" method="GET" class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Explore employers</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-select">
                            <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <div class="card border-0 shadow p-4">
                        <div class="mb-4">
                            <h2>Name or keywords</h2>
                            <input type="text" placeholder="keywords" name="keywords" value="{{ $keyword ?? $keyword }}"
                                id="keywords" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Location</h2>
                            <input type="text" placeholder="Location" id="location" name="location"
                                value="{{ $location ?? $location }}" class="form-control">
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-info text-white">Find employer</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row" style="row-gap: 25px;" id="JobsLists">
                                @if ($users->isNotEmpty())
                                    @foreach ($users as $user)
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            <div class="card border-0 shadow mb-4 d-flex flex-column h-100">
                                                <div class="card-body  d-flex flex-column justify-contents-between">

                                                    <div class="bg-light border flex-grow-1">
                                                        <div class="card-body  d-flex flex-column justify-contents-between">
                                                            <div class="s-body text-center mt-3">
                                                                <img src="{{ $user->image == '' ? asset('jobportal-template/assets/images/avatar7.png') : asset('uploads/avatars/' . $user->image) }}"
                                                                    alt="avatar" id="avatarImage"
                                                                    class="rounded-circle img-fluid"
                                                                    style="width: 150px; height: 150px">
                                                                <input type="hidden" id="baseAvatarUrl"
                                                                    value="{{ asset('uploads/avatars/') }}">

                                                                <h5 class="mt-3 pb-0  text-center">{{ $user->name }}
                                                                @php
                                                                    $subscription = \App\Models\Subscription::where('user_id', $user->id)->latest()->first();
                                                                @endphp
                                                                @if ($subscription)
                                                                    <img class="verificationBadge"
                                                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTz6BwqUK7GcdwCGF4RvvZA8KabNsqIIEW5d8IYMz1gAQ&s"
                                                                        alt="{{ $user->name }} - Verified">
                                                                @endif
                                                            </h5>
                                                                <p class="text-muted mb-1 fs-6">{{ $user->designation }}</p>
                                                            </div>
                                                            <div
                                                                class="px-3 mt-2 d-flex justify-content-center gap-1 align-items-center">
                                                                @if ($user->website)
                                                                    <a href="{{ $user->website }}" class="d-block"><i
                                                                            class="fa-solid fa-globe mr-1" style="font-size: 20px !important"></i></a>
                                                                @endif
                                                                @if ($user->github)
                                                                    <a href="{{ $user->github }}"><i
                                                                            class="fa-brands fa-github mr-1" style="font-size: 20px !important"></i></a>
                                                                @endif
                                                                @if ($user->linkedin)
                                                                    <a href="{{ $user->linkedin }}"><i
                                                                            class="fa-brands fa-linkedin mr-1" style="font-size: 20px !important"></i></a>
                                                                @endif

                                                                @if ($user->twitter)
                                                                    <a href="{{ $user->twitter }}"><i
                                                                            class="fa-brands fa-twitter mr-1" style="font-size: 20px !important"></i></a>
                                                                @endif

                                                                @if ($user->facebook)
                                                                    <a href="{{ $user->facebook }}"><i
                                                                            class="fa-brands fa-facebook mr-1" style="font-size: 20px !important"></i></a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('employers.view', $user->id) }}"
                                                            class="btn btn-info text-white btn-lg">View
                                                            Porfile</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12 mt-5">
                                        <h5 style="text-align: center"> No employer available </h5>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="mt-5">
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </section>
@endsection

@section('javascript')
   
@endsection
