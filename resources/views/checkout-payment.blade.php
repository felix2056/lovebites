@extends('layouts.app')

@section('title')
    Checkout
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <style>
        .hidden { display: none;}
    </style>
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
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="order-summary">
                    <div class="payment-methods">
                        <div class="info-box with-icon p-0">
                            <form id="payment-form" class="w-100">
                                <div id="payment-element">
                                    <!--Stripe.js injects the Payment Element-->
                                </div>
                                <button id="submit" class="btn btn-primary btn-block btn-lg">
                                    <div class="spinner hidden" id="spinner"></div>
                                    <span id="button-text">Pay now</span>
                                </button>

                                <div id="payment-message" class="hidden">
                                    <p class="alert"></p><a class="btn btn-sucess btn-sm" href="{{ route('products.index') }}">Continue Shopping</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                        Place order
                    </button> --}}
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
@php
    $stripe_key = env('STRIPE_KEY');

    $items = [];

    if(Session::has('cart')) {
        foreach(Session::get('cart') as $item) {
            $items[] = [
                'id' => $item['name'],
                'amount' => $item['price'],
                'quantity' => $item['quantity'],
            ];
        }
    }
@endphp

<script src="https://js.stripe.com/v3/"></script>
<script>
    // This is a public sample test API key.
    // Don’t submit any personally identifiable information in requests made with this key.
    // Sign in to see your own test API key embedded in code samples.
    // const stripe = Stripe('{{ $stripe_key }}');
    const stripe = Stripe('pk_test_51KWJuaLYB0I58J6wLoIDNxdHNSgFW0VqBe7wbtsMSd6Mm2ldSeQU7DIiReKykY6JhAMONzrC2hMUlAWbGsRsUaKp00lJ2OFhPO');

    // The items the customer wants to buy
    // const items = [{ id: "xl-tshirt" }];
    const items = {!! json_encode($items) !!};
    
    let elements;

    initialize();
    checkStatus();

    document
    .querySelector("#payment-form")
    .addEventListener("submit", handleSubmit);

    // Fetches a payment intent and captures the client secret
    async function initialize() {
        const { clientSecret } = await fetch("/stripe/create", {
            method: "POST",
            headers: { 
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            },
            body: JSON.stringify({ items }),
        }).then((r) => r.json());

        elements = stripe.elements({ clientSecret });

        const paymentElement = elements.create("payment");
        paymentElement.mount("#payment-element");
    }

    // Fetches the payment intent status after payment submission
    async function checkStatus() {
        const clientSecret = new URLSearchParams(window.location.search).get(
            "payment_intent_client_secret"
        );

        if (!clientSecret) {
            return;
        }

        const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

        switch (paymentIntent.status) {
            case "succeeded":
                showMessage("Payment succeeded!", "success");
                break;
            case "processing":
                showMessage("Your payment is processing.", "warning");
                break;
            case "requires_payment_method":
                showMessage("Your payment was not successful, please try again.", "danger");
                break;
            default:
                showMessage("Something went wrong.", "danger");
                break;
        }
    }

    async function handleSubmit(e) {
        e.preventDefault();
        setLoading(true);

        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                // Make sure to change this to your payment completion page
                return_url: "{{ route('checkout.stripe') }}",
                receipt_email: "{{ auth()->user()->email ?? session()->get('user_information')['email'] }}",
            },
        });

        // This point will only be reached if there is an immediate error when
        // confirming the payment. Otherwise, your customer will be redirected to
        // your `return_url`. For some payment methods like iDEAL, your customer will
        // be redirected to an intermediate site first to authorize the payment, then
        // redirected to the `return_url`.
        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message, 'danger');
        } else {
            showMessage("An unexpected error occurred.", 'danger');
        }

        setLoading(false);
    }

    // ------- UI helpers -------

    function showMessage(messageText, type) {
        const messageContainer = document.querySelector("#payment-message");

        messageContainer.classList.remove("hidden");
        messageContainer.querySelector(".alert").textContent = messageText;
        messageContainer.querySelector(".alert").classList.add(`alert-${type}`);

        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 40000);
    }

    // Show a spinner on payment submission
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    }
</script>
@endsection