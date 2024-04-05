@extends('client.layouts.app')

@section('header')
    <title>Password Recovery - TechJobs</title>
    <meta name="description" content="Password Recovery - TechJobs">
@endsection

@section('content')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Reset Password</h1>
                        <form action="{{ route('password.reset', $hash) }}" method="post">
                            @csrf
                            @include('client.alert')

                            <div class="mb-3">
                                <label for="" class="mb-2">New password*</label>
                                <input type="password" name="password" value="{{ old('password') }}" id="password"
                                    class="form-control" placeholder="new password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Confirm new password*</label>
                                <input type="password" name="confirm_password" value="{{ old('confirm_password') }}"
                                    id="password" class="form-control" placeholder="confirm new password">
                                @error('confirm_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="justify-content-between d-flex">
                                <button class="btn btn-primary mt-2">Reset Password</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>
@endsection

@section('javascript')
@endsection
