@extends('admin.layouts.app')

@section('header')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>
            </nav>

            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="{{ asset('niceadmin/assets/img/profile-img.jpg') }}" alt="Profile"
                                    class="rounded-circle">
                                <h2>{{ Auth::guard('admin')->user()->name }}</h2>
                                <h3>Founder Of TechJobs</h3>
                                <div class="social-links mt-2">
                                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">
                        @if (Session::has('success'))
                            <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-error mt-2">{{ Session::get('error') }}</div>
                        @endif
                        <div class="card">

                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Overview</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-settings">Settings</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-change-password">Change Password</button>
                                    </li>

                                </ul>
                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="card-title">About</h5>
                                        <p class="small fst-italic">A Passioniate Laravel Developer</p>

                                        <h5 class="card-title">Profile Details</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                            <div class="col-lg-9 col-md-8">Himel Hasan</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Company</div>
                                            <div class="col-lg-9 col-md-8">Moner Company Boro Company</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Job</div>
                                            <div class="col-lg-9 col-md-8">Se kotha boliyen na. kew chay certificate kew
                                                chay experience, tai goriber jonno chakri noy business 🏆</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Country</div>
                                            <div class="col-lg-9 col-md-8">Bangladesh</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Address</div>
                                            <div class="col-lg-9 col-md-8">Apnader bajarer bkash er dokaner samne bosa thaka
                                                loktir barir pasher elakar choto vaier <a href="">see more...</a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Phone</div>
                                            <div class="col-lg-9 col-md-8">(880) ********</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8">webhimel032@gmail.com</div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade pt-3" id="profile-settings">

                                        <form action="{{ route('admin.updateSetting') }}" method="POST">

                                            @csrf
                                            <div class="row mb-3">
                                                <label for="" class="col-md-4 col-lg-3 col-form-label">Site
                                                    name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="site_name" type="text" class="form-control"
                                                        id="site_name" value="{{ $settings->site_name }}" required>
                                                </div>
                                                @error('site_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="row mb-3">
                                                <label for="" class="col-md-4 col-lg-3 col-form-label">Hero
                                                    title</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="site_hero_title" type="text"
                                                        class="form-control required" id="site_hero_title"
                                                        value="{{ $settings->site_hero_title }}" required>
                                                </div>
                                                @error('site_hero_title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="row mb-3">
                                                <label for="" class="col-md-4 col-lg-3 col-form-label">Hero
                                                    description</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="site_hero_desc" type="text"
                                                        class="form-control required"
                                                        value="{{ $settings->site_hero_desc }}" id="site_hero_desc"
                                                        required>
                                                </div>
                                                @error('site_hero_desc')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Update Settings</button>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="tab-pane fade pt-3" id="profile-change-password">
                                        <!-- Change Password Form -->
                                        <form action="{{ route('admin.updatePassword') }}" method="POST">

                                            @csrf
                                            <div class="row mb-3">
                                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                    Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="password" type="password" class="form-control"
                                                        id="password" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="renewPassword"
                                                    class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="confirm_password" type="password"
                                                        class="form-control required" id="confirm_password" required>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
                                            </div>
                                        </form><!-- End Change Password Form -->

                                    </div>

                                </div><!-- End Bordered Tabs -->

                            </div>
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
