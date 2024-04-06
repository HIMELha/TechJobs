@extends('client.layouts.app')
@section('header')
    <title>Premium subscritpion checkout</title>
    <meta name="description" content="Premium subscritpion checkout">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <section class="section-3 bg-2 py-5">
        <div class="container py-5">
            <h3 class="text-center text-danger mb-2" style="font-weight: 400; font-size: 29px !important">Attention Please!
            </h3>
            <div class="row" style="row-gap: 25px">
                <div class="d-block mx-auto col-md-6 col-lg-4">
                    <div class="card border-0 p-3 shadow d-flex flex-column h-100">
                        <div class="card-body d-flex flex-column justify-contents-between">
                            <span class="mb-1">You're going to buy
                                @if ($type == 'starter')
                                    <h3 class="border-0 fs-5 pb-2 text-center mb-3">Starter Package <span
                                            class="text-info">29BDT</span></h3>
                                @elseif($type == 'standard')
                                    <h3 class="border-0 fs-5 pb-2 text-center mb-3">Standard Package <span
                                            class="text-danger">49BDT</span></h3>
                                @else
                                    <h3 class="border-0 fs-5 pb-2 text-center mb-3">Premium Package <span
                                            class="text-warning">99BDT</span></h3>
                                @endif
                            </span>

                            <div class="d-flex flex-column gap-3">
                                <p class="mb-0">
                                    <span class="fw-bolder"><i class="fa fa-robot"></i></span>
                                    <span class="ps-1">AI Search</span>
                                </p>
                                <p class="mb-0">
                                    <span class="fw-bolder"><i class="fa-solid fa-envelope-open-text"></i></span>
                                    <span class="ps-1">Daily Email</span>
                                </p>
                                <p class="mb-0">
                                    <span class="fw-bolder"><i class="fa-solid fa-comment-dots"></i></span>
                                    <span class="ps-1">Job Notifications</span>
                                </p>
                                <p class="mb-0">
                                    <span class="fw-bolder"><i class="fa-brands fa-creative-commons-sampling"></i></span>
                                    <span class="ps-1">Auto Suggestion</span>
                                </p>
                                <p class="mb-0">
                                    <span class="fw-bolder"><i class="fa-solid fa-list-check"></i></span>
                                    <span class="ps-1">Advance Searching</span>
                                </p>

                                <p class="mb-0">
                                    <span class="fw-bolder"><i class="fa-solid fa-toolbox"></i></span>
                                    <span class="ps-1">Analytics Dashboard</span>
                                </p>

                                <p class="mb-0">
                                    <span class="fw-bolder"><i class="fa-regular fa-circle-check"></i></span>
                                    <span class="ps-1">Profile Badge</span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-block mx-auto col-md-6 col-lg-8">

                    <div class="card border-0 p-3 shadow d-flex flex-column h-100">
                        <h5>Payment information</h5>
                        <form action="{{ route('storeMembership', $type) }}" method="POST"
                            class="card-body d-flex flex-column justify-contents-between gap-3">
                            @csrf
                            <div class="form-group">
                                <label for="number">Phone number</label>
                                <input type="number" class="form-control" name="phone"
                                    placeholder="Enter your phone number">
                                @error('phone')
                                    <p class="badge bg-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="transaction">Payment transaction number</label>
                                <input type="transaction" class="form-control" name="transaction"
                                    placeholder="Enter transaction code">
                                @error('transaction')
                                    <p class="badge bg-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="d-flex flex-column gap-1">
                                <span class="my-2" style="font-size: 17px !important">Please pay through this</span>
                                <p><b>Bkash:</b> 🤠🤝💖</p>
                                <p><b>Nagad:</b> 🤠🤝💖</p>
                                <p><b>Binance:</b> Alexanderdraper032@gmail.com</p>
                            </div>

                            <button type="submit" class="btn btn-info mt-3 d-block mx-auto text-white">Complete
                                Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
