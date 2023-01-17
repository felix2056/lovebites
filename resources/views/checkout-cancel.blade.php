@extends('layouts.app')

@section('title')
    Checkout Cancel
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
@endsection

@section('content')
<main class="main main-test">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Shop</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart') }}">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div>
    </nav>

    <div class="container-fluid checkout-container">
        <div class="checkout-discount">
            <h4>Have a coupon?
                <button data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link btn-toggle">ENTER YOUR CODE</button>
            </h4>

            <div id="collapseTwo" class="collapse">
                <div class="feature-box">
                    <div class="feature-box-content">
                        <p>If you have a coupon code, please apply it below.</p>

                        <form action="#">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm w-auto" placeholder="Coupon code" required>
                                <div class="input-group-append">
                                    <button class="btn btn-sm mt-0" type="button">
                                        Apply Coupon
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 offset-3">
                <div class="order-summary">
                    <h3>We could not process your order.</h3>
                    <p>Something went wrong. Please try again.</p>

                    <a href="{{ route('checkout') }}" class="btn btn-success">Try again</a>
                    <a href="{{ route('cart') }}" class="btn btn-primary">Go to Cart</a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary-2 btn-block">Continue Shopping</a>
                </div>
                <!-- End .cart-summary -->
            </div>
            <!-- End .col-lg-4 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->
</main>
<!-- End .main -->
@endsection