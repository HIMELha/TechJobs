@extends('client.layouts.app')
@section('header')
    <title>{{ $pagee->title }}</title>
    <meta name="description" content="{{ $pagee->title }}">
@endsection
@section('content')
    <section class="section-5">
        <div class="container my-2">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 mx-auto">
                    {!! $pagee->description !!}

                    <br><br><br>
                    <br><br><br>
                </div>
            </div>
        </div>
    </section>
@endsection
