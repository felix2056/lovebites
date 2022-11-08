@extends('layouts.app')

@section('title')
	Cart
@endsection

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
@endsection

@section('content')
@php
	$cart = session()->get('cart');
	$subtotal = 0.00;

	if ($cart) {
		foreach ($cart as $item) {
			$subtotal += $item['price'] * $item['quantity'];
		}
	}
@endphp

<main class="main bg-gray">
	<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </div>
    </nav>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8">
				<div class="cart-table-container">
					<table class="table table-cart">
						<thead>
							<tr>
								<th class="thumbnail-col"></th>
								<th class="product-col">Product</th>
								<th class="price-col">Price</th>
								<th class="qty-col">Quantity</th>
								<th class="text-right">Subtotal</th>
							</tr>
						</thead>
						
						@if (session()->has('cart') && count($cart) > 0)
							<tbody>
								@foreach ($cart as $item)
									<tr class="product-row">
										<td>
											<figure class="product-image-container">
												<a href="{{ route('products.show', $item['slug']) }}" class="product-image">
													<img src="{{ $item['featured_image'] }}" alt="product">
												</a>

												<a href="{{ route('products.remove-from-cart', $item['slug']) }}" class="btn-remove icon-cancel" title="Remove Product"></a>
											</figure>
										</td>
										<td class="product-col">
											<h5 class="product-title">
												<a href="{{ route('products.show', $item['slug']) }}">{{ $item['name'] }}</a>
											</h5>
										</td>
										<td>${{ $item['price'] }}</td>
										<td>
											<div class="product-single-qty">
												<input class="horizontal-quantity form-control" type="text" value="{{ $item['quantity'] }}">
											</div><!-- End .product-single-qty -->
										</td>
										<td class="text-right"><span class="subtotal-price">${{ $item['price'] * $item['quantity'] }}</span></td>
									</tr>
								@endforeach
							</tbody>
						@else
							<tbody>
								<tr class="product-row">
									<td colspan="5" class="text-center">No items in cart</td>
								</tr>
							</tbody>
						@endif

						<tfoot>
							<tr>
								<td colspan="5" class="clearfix">
									<div class="float-left">
										<div class="cart-discount">
											<form action="#">
												<div class="input-group">
													<input type="text" class="form-control form-control-sm" placeholder="Coupon Code" required>
													<div class="input-group-append">
														<button class="btn btn-dark" type="submit">Apply Coupon</button>
													</div>
												</div><!-- End .input-group -->
											</form>
										</div>
									</div><!-- End .float-left -->

									<div class="float-right">
										<button type="submit" class="btn btn-dark btn-update-cart">
											Update Cart
										</button>
									</div><!-- End .float-right -->
								</td>
							</tr>
						</tfoot>
					</table>
				</div><!-- End .cart-table-container -->
			</div><!-- End .col-lg-8 -->

			<div class="col-lg-4">
				<div class="cart-summary">
					<h3>CART TOTALS</h3>

					<table class="table table-totals">
						<tbody>
							<tr>
								<td>Subtotal</td>
								<td>${{ $subtotal }}</td>
							</tr>

							<tr>
								<td colspan="2" class="text-left">
									<h4>Shipping</h4>

									<div class="form-group form-group-custom-control">
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" name="radio" checked>
											<label class="custom-control-label">Local pickup</label>
										</div><!-- End .custom-checkbox -->
									</div><!-- End .form-group -->

									<div class="form-group form-group-custom-control mb-0">
										<div class="custom-control custom-radio mb-0">
											<input type="radio" name="radio" class="custom-control-input">
											<label class="custom-control-label">Flat rate</label>
										</div><!-- End .custom-checkbox -->
									</div><!-- End .form-group -->

									<form action="#">
										<div class="form-group form-group-sm">
											<label>Shipping to <strong>NY.</strong></label>
											<div class="select-custom">
												<select class="form-control form-control-sm">
													<option value="USA">United States (US)</option>
													<option value="Turkey">Turkey</option>
													<option value="China">China</option>
													<option value="Germany">Germany</option>
												</select>
											</div><!-- End .select-custom -->
										</div><!-- End .form-group -->

										<div class="form-group form-group-sm">
											<div class="select-custom">
												<select class="form-control form-control-sm">
													<option value="NY">New York</option>
													<option value="CA">California</option>
													<option value="TX">Texas</option>
												</select>
											</div><!-- End .select-custom -->
										</div><!-- End .form-group -->

										<div class="form-group form-group-sm">
											<input type="text" class="form-control form-control-sm" placeholder="Town / City">
										</div><!-- End .form-group -->

										<div class="form-group form-group-sm">
											<input type="text" class="form-control form-control-sm" placeholder="ZIP">
										</div><!-- End .form-group -->

										<button type="submit" class="btn btn-shop btn-update-total">
											Update Totals
										</button>
									</form>
								</td>
							</tr>
						</tbody>

						<tfoot>
							<tr>
								<td>Total</td>
								<td>$17.90</td>
							</tr>
						</tfoot>
					</table>

					<div class="checkout-methods">
						<a href="{{ route('checkout') }}" class="btn btn-block btn-dark">Proceed to Checkout
							<i class="fa fa-arrow-right"></i>
						</a>
					</div>
				</div><!-- End .cart-summary -->
			</div><!-- End .col-lg-4 -->
		</div><!-- End .row -->
	</div><!-- End .container -->

	<div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->
@endsection