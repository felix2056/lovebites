@extends('layouts.app')

@section('title')
    Checkout Success
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
            @php
                $cart = session()->get('cart');
                $subtotal = 0.00;

                foreach ($cart as $item) {
                    $subtotal += (float) $item['price'] * $item['quantity'];
                }

                $shipping = 3.99;
                $tax = $subtotal * 0.15;
                $total = $subtotal + $tax;
            @endphp

            <div class="col-6 offset-3">
                <div class="order-summary">
                    <h3>Thanks for your order!</h3>
                    <p>Your order has been placed and will be processed as soon as possible.</p>

                    <table class="table table-mini-cart">
                        <thead>
                            <tr>
                                <th colspan="2">Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                                <td class="product-col">
                                    <img src="{{ $item['featured_image'] }}" class="w-50">
                                </td>
                                <td class="product-col">
                                    <h3 class="product-title">
                                        {{ $item['name'] }} ×
                                        <span class="product-qty">{{ $item['quantity'] }}</span>
                                    </h3>
                                </td>

                                <td class="price-col">
                                    <span>{{ $item['price'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary-2 btn-order btn-block">
                        <span>CONTINUE SHOPPING</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
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