@extends('layouts.app')

@section('title')
    Checkout
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
        @guest
            <div class="login-form-container">
                <h4>Returning customer?
                    <button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link btn-toggle">Login</button>
                </h4>

                <div id="collapseOne" class="collapse">
                    <div class="login-section feature-box">
                        <div class="feature-box-content">
                            <form action="{{ route('login') }}" id="login-form">
                                <p>
                                    If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing & Shipping section.
                                </p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0 pb-1">Email <span class="required">*</span></label>
                                            <input name="email" type="email" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0 pb-1">Password <span class="required">*</span></label>
                                            <input name="password" type="password" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn">LOGIN</button>

                                <div class="form-footer mb-1">
                                    <div class="custom-control custom-checkbox mb-0 mt-0">
                                        <input type="checkbox" class="custom-control-input" id="lost-password">
                                        <label class="custom-control-label mb-0" for="lost-password">Remember me</label>
                                    </div>

                                    <a href="forgot-password.html" class="forget-password">Lost your password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endguest

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
                                    <button class="btn btn-sm mt-0" type="submit">
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
            <div class="col-lg-7">
                <ul class="checkout-steps">
                    <li>
                        <h2 class="step-title">Billing details</h2>

                        <form action="{{ route('stripe.checkout') }}" id="checkout-form" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First name
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input name="first_name" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last name
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input name="last_name" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company name (optional)</label>
                                <input name="company_name" type="text" class="form-control">
                            </div>

                            <div class="select-custom">
                                <label>Country / Region
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <select name="country" class="form-control" required>
                                    <option value="">Select Country</option>
                                </select>
                            </div>

                            <div class="select-custom">
                                <label>State / County <abbr class="required" title="required">*</abbr></label>
                                <select name="state" class="form-control" required>
                                    <option value="">Select State</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Town / City
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <select name="city" class="form-control" required>
                                    <option value="">Select City</option>
                                </select>
                            </div>

                            <div class="form-group mb-1 pb-2">
                                <label>Street address
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <input name="address_1" type="text" class="form-control" placeholder="House number and street name" required>
                            </div>

                            <div class="form-group">
                                <input name="address_2" type="text" class="form-control" placeholder="Apartment, suite, unite, etc. (optional)">
                            </div>

                            <div class="form-group">
                                <label>Postcode / Zip
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <input name="zip" type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Phone <abbr class="required" title="required">*</abbr></label>
                                <input name="phone" type="tel" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Email address
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <input name="email" type="email" class="form-control" required>
                            </div>

                            @guest
                                <div class="form-group mb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input name="create_account" type="checkbox" class="custom-control-input" id="create-account">
                                        <label class="custom-control-label" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree" for="create-account">
                                            Create an account?
                                        </label>
                                    </div>
                                </div>

                                <div id="collapseThree" class="collapse">
                                    <div class="form-group">
                                        <label>Create account password
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input name="password" type="password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm account password
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input name="password_confirmation" type="password" placeholder="Confirm Password" class="form-control">
                                    </div>
                                </div>
                            @endguest

                            {{-- <div class="form-group">
                                <div class="custom-control custom-checkbox mt-0">
                                    <input type="checkbox" class="custom-control-input" id="different-shipping">
                                    <label class="custom-control-label" data-toggle="collapse" data-target="#collapseFour" aria-controls="collapseFour" for="different-shipping">Ship to a
                                        different address?
                                    </label>
                                </div>
                            </div>

                            <div id="collapseFour" class="collapse">
                                <div class="shipping-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First name <abbr class="required" title="required">*</abbr></label>
                                                <input name="shipping_first_name" type="text" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last name <abbr class="required" title="required">*</abbr></label>
                                                <input name="shipping_last_name" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Company name (optional)</label>
                                        <input name="shipping_company_name" type="text" class="form-control">
                                    </div>

                                    <div class="select-custom">
                                        <label>Country / Region <span class="required">*</span></label>
                                        <select name="shipping_country" name="orderby" class="form-control">
                                            <option value selected="selected">Vanuatu</option>
                                            <option value="1">Brunei</option>
                                            <option value="2">Bulgaria</option>
                                            <option value="3">Burkina Faso</option>
                                            <option value="4">Burundi</option>
                                            <option value="5">Cameroon</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-1 pb-2">
                                        <label>Street address <abbr class="required" title="required">*</abbr></label>
                                        <input name="shipping_address_1" type="text" class="form-control" placeholder="House number and street name" required>
                                    </div>

                                    <div class="form-group">
                                        <input name="shipping_address_2" type="text" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Town / City <abbr class="required" title="required">*</abbr></label>
                                        <input name="shipping_city" type="text" class="form-control" required>
                                    </div>

                                    <div class="select-custom">
                                        <label>State / County <abbr class="required" title="required">*</abbr></label>
                                        <select name="shipping_state" class="form-control">
                                            <option value selected="selected">NY</option>
                                            <option value="1">Brunei</option>
                                            <option value="2">Bulgaria</option>
                                            <option value="3">Burkina Faso</option>
                                            <option value="4">Burundi</option>
                                            <option value="5">Cameroon</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Postcode / ZIP <abbr class="required" title="required">*</abbr></label>
                                        <input name="shipping_zip" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <label class="order-comments">Order notes (optional)</label>
                                <textarea name="shipping_notes" class="form-control" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- End .col-lg-8 -->

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

            <div class="col-lg-5">
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
                                    <b class="total-price"><span>${{ $tax }}</span></b>
                                </td>
                            </tr>

                            <tr class="order-total">
                                <td>
                                    <h4>Shipping</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span>${{ $shipping }}</span></b>
                                </td>
                            </tr>

                            <tr class="order-total">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span>${{ $total }}</span></b>
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

                    <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                        Place order
                    </button>
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
    $(document).ready(function () {
        let headers = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSCAPI-KEY': 'WFhpbWRyOVBKbXRoemFYMlVNdVllVW90S01rZ3k4OGNjRmtRM1JmSQ=='
        };

        // get all countries via ajax
        $.ajax({
            url: 'https://api.countrystatecity.in/v1/countries',
            type: 'GET',
            headers: headers,
            success: function (data) {
                let countries = data;
                let countryOptions = '';
                countries.forEach(country => {
                    countryOptions += `<option value="${country.iso2}">${country.name}</option>`;
                });
                $('select[name="country"]').append(countryOptions);
            }
        });

        // get all states in the US via ajax
        $('select[name="country"]').on('change', function () {
            let country = $(this).val();
            $.ajax({
                url: `https://api.countrystatecity.in/v1/countries/${country}/states`,
                type: 'GET',
                headers: headers,
                success: function (data) {
                    let states = data;
                    let stateOptions = '';
                    states.forEach(state => {
                        stateOptions += `<option value="${state.iso2}">${state.name}</option>`;
                    });
                    $('select[name="state"]').append(stateOptions);
                }
            });
        });

        // get all cities in the US via ajax
        $('select[name="state"]').on('change', function () {
            let state = $(this).val();
            let country = $('select[name="country"]').val();
            $.ajax({
                url: `https://api.countrystatecity.in/v1/countries/${country}/states/${state}/cities`,
                type: 'GET',
                headers: headers,
                success: function (data) {
                    let cities = data;
                    let cityOptions = '';
                    cities.forEach(city => {
                        cityOptions += `<option value="${city.name}">${city.name}</option>`;
                    });
                    $('select[name="city"]').append(cityOptions);
                }
            });
        });
    });
</script>

<script>
    paypal.Buttons({
        onCancel: function (data) {
            window.location.href = "{{ route('cart') }}";
        },
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
            purchase_units: [{
                amount: {
                value: "{{ $total }}" // Can also reference a variable or function
                }
            }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
            });
        }
    }).render('#paypal-button-container');
  </script>
@endsection