@extends('layouts.app')

@section('title')
    Checkout Paypal
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=USD"></script>
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
                    <h3>YOUR ORDER</h3>

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
                                    <h3 class="product-title">
                                        {{ $item['name'] }} x
                                        <span class="product-qty">{{ $item['quantity'] }}</span>
                                    </h3>
                                </td>

                                <td class="price-col">
                                    <span>${{ $item['price'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="cart-subtotal">
                                <td>
                                    <h4>Subtotal</h4>
                                </td>

                                <td class="price-col">
                                    <span>${{ $subtotal }}</span>
                                </td>
                            </tr>
                            <tr class="order-shipping">
                                <td class="text-left" colspan="2">
                                    <h4 class="m-b-sm">Shipping</h4>

                                    <div class="form-group form-group-custom-control">
                                        <div class="custom-control custom-radio d-flex">
                                            <input type="radio" class="custom-control-input" name="radio" checked>
                                            <label class="custom-control-label">Local Pickup</label>
                                        </div>
                                        <!-- End .custom-checkbox -->
                                    </div>
                                    <!-- End .form-group -->

                                    <div class="form-group form-group-custom-control mb-0">
                                        <div class="custom-control custom-radio d-flex mb-0">
                                            <input type="radio" name="radio" class="custom-control-input">
                                            <label class="custom-control-label">Flat Rate</label>
                                        </div>
                                        <!-- End .custom-checkbox -->
                                    </div>
                                    <!-- End .form-group -->
                                </td>
                            </tr>

                            <tr class="order-total">
                                <td>
                                    <h4>Tax</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span>${{ number_format($tax, 2) }}</span></b>
                                </td>
                            </tr>

                            <tr class="order-total">
                                <td>
                                    <h4>Shipping</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span>${{ number_format($shipping, 2) }}</span></b>
                                </td>
                            </tr>

                            <tr class="order-total">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span>${{ number_format($total, 2) }}</span></b>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="payment-methods">
                        <h4 class>Payment methods</h4>
                        {{-- <div class="form-group form-group-custom-control">
                            <div class="custom-control custom-radio d-flex">
                                <input type="radio" class="custom-control-input" name="payment_method" checked>
                                <label class="custom-control-label">Stripe</label>
                            </div>
                            <!-- End .custom-checkbox -->
                        </div>
                        <!-- End .form-group -->

                        <div class="form-group form-group-custom-control mb-0">
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input disabled type="radio" name="payment_method" class="custom-control-input">
                                <label class="custom-control-label">PayPal</label>
                            </div>
                            <!-- End .custom-checkbox -->
                        </div>
                        <!-- End .form-group --> --}}

                        {{-- <div class="info-box with-icon p-0">
                            <p>
                                Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.
                            </p>
                        </div> --}}

                        <div id="paypal-button-container" class="paypal-button-container"></div>
                    </div>
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

@section('scripts')
<script>
    let amount = "{{ $total }}";
    // round to 2 decimal places
    amount = Math.round(amount * 100) / 100;

    paypal.Buttons({
        onCancel: function (data) {
            window.location.href = "{{ route('checkout.cancel') }}";
        },
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: amount,
                        currency_code: 'USD'
                    }
                }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                // actions.redirect('/checkout/success');
                window.location.href = "{{ route('checkout.success') }}";
                
                /************
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                ************/

                // When ready to go live, remove the alert and show a success message within this page. For example:
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  actions.redirect('thank_you.html');
            });
        }
    }).render('#paypal-button-container');
</script>
@endsection