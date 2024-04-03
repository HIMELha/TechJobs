<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('header')

    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('jobportal-template/assets/css/style.css') }}" />
    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css">
</head>

<body data-instant-intensity="mousedown">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">TechJobs</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('jobs.find') }}">Find Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('employers') }}">Explore employers</a>
                        </li>
                    </ul>
                    @auth
                        <a class="btn btn-outline-warning me-2" href="{{ route('profile.index') }}">My Profile</a>
                        <a class="btn btn-info text-white" href="{{ route('createJob') }}">Post a Job</a>
                    @else
                        <a class="btn btn-info text-white me-2" href="{{ route('login') }}">Login</a>
                        <a class="btn btn-outline me-2" href="{{ route('register') }}">Register</a>
                    @endauth


                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class=" py-3 bg-2" style="background-color: rgb(32, 186, 233)">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-start">
                        <a class="text-white fw-bold fs-6 me-3" href="{{ route('index') }}">Home</a>
                        <a class="text-white fw-bold fs-6 me-3" href="{{ route('pages.view', 'About') }}">About</a>
                        <a class="text-white fw-bold fs-6 me-3" href="{{ route('pages.view', 'Contact') }}">Contact</a>
                        <a class="text-white fw-bold fs-6 me-3" href="{{ route('pages.view', 'FAQ') }}">FAQ</a>
                        <a class="text-white fw-bold fs-6 me-3" href="{{ route('profile.index') }}">Account</a>
                        <a class="text-white fw-bold fs-6 me-3" href="{{ route('jobs.find') }}">Find Jobs</a>
                        <a class="text-white fw-bold fs-6 me-3" href="https://www.facebook.com/webhimel032">Community</a>
                        <a class="text-white fw-bold fs-6" href="https://www.facebook.com/webhimel032">Facebook</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-white fw-medium fs-6 mb-0">
                        <a href="{{ route('index') }}" class="text-white">TechJobs</a> &copy; 2023-2024, all rights reserved | Developed by <a href="https://webhimel.vercel.app" class="text-primary">Himel Hasan</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <script src="{{ asset('jobportal-template/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('jobportal-template/assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('jobportal-template/assets/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('jobportal-template/assets/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('jobportal-template/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('jobportal-template/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('jobportal-template/assets/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"
        integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('javascript')
</body>

</html>
