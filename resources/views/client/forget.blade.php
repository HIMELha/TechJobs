@extends('client.layouts.app')

@section('header')
@endsection


@section('content')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Password recovery</h1>
                        <form action="{{ route('forget.sentRecoveryMail') }}" method="post">
                            @csrf
                            @if (Session::has('error'))
                                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                            @endif
                            @if (Session::has('success'))
                                <p class="alert alert-success">{{ Session::get('success') }}</p>
                            @endif
                            
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="example@example.com">
                            </div>
                            <div class="justify-content-between d-flex">
                                <button class="btn btn-primary mt-2">Sent a request</button>
                                
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
