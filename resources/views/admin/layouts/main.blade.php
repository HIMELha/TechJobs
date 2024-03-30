@extends('admin.layouts.app')

@section('header')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        @include('admin.includes.sidebar')
    </main>
@endsection

@section('javascript')
@endsection