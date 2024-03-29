<div class="product-single-container product-single-default product-quick-view mb-0 custom-scrollbar">
	<div class="row">
		<div class="col-md-6 product-single-gallery mb-md-0">
			<div class="product-slider-container">
				<div class="label-group">
					<div class="product-label label-hot">HOT</div>
					<!---->
					<div class="product-label label-sale">
						-16%
					</div>
				</div>

				<div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
					<div class="product-item">
						<img class="product-single-image" src="{{ $product->featured_image }}" data-zoom-image="{{ $product->featured_image }}">
					</div>
					@foreach($product->images as $image)
					<div class="product-item">
						<img class="product-single-image" src="{{ $image }}" data-zoom-image="{{ $image }}">
					</div>
					@endforeach
				</div>
				<!-- End .product-single-carousel -->
			</div>
			<div class="prod-thumbnail owl-dots">
				@foreach ($product->images as $image)
				<div class="owl-dot">
					<img src="{{ $image }}">
				</div>
				@endforeach
			</div>
		</div><!-- End .product-single-gallery -->

		<div class="col-md-6">
			<div class="product-single-details mb-0 ml-md-4">
				<h1 class="product-title">{{ $product->title }}</h1>

				<div class="ratings-container">
					<div class="product-ratings">
						<span class="ratings" style="width:{{ $product->ratings }}"></span><!-- End .ratings -->
					</div><!-- End .product-ratings -->

					<a href="#" class="rating-link">( {{ $product->total_ratings }} Reviews )</a>
				</div><!-- End .ratings-container -->

				<hr class="short-divider">

				<div class="price-box">
					<span class="product-price">{{ $product->sale_price_cur }}</span>
				</div><!-- End .price-box -->

				<div class="product-desc">
					<p>
						{!! $product->description !!}
					</p>
				</div><!-- End .product-desc -->

				<ul class="single-info-list">
					<!---->
					@foreach ($product->specs as $item)
					<li>
						{{ $item->attrName }}:
						<strong>{{ $item->attrValue }}</strong>
					</li>
					@endforeach
				</ul>

				<div class="product-filters-container">
					<div class="product-single-filter">
						<label>Size:</label>
						<ul class="config-size-list">
							<li><a href="javascript:;" class="d-flex align-items-center justify-content-center">XL</a>
							</li>
							<li class><a href="javascript:;" class="d-flex align-items-center justify-content-center">L</a></li>
							<li class><a href="javascript:;" class="d-flex align-items-center justify-content-center">M</a></li>
							<li class><a href="javascript:;" class="d-flex align-items-center justify-content-center">S</a></li>
						</ul>
					</div>

					<div class="product-single-filter">
						<label></label>
						<a class="font1 text-uppercase clear-btn" href="#">Clear</a>
					</div>
					<!---->
				</div>

				<div class="product-action">
					<div class="price-box product-filtered-price">
						<del class="old-price"><span>{{ $product->original_price_cur }}</span></del>
						<span class="product-price">{{ $product->sale_price_cur }}</span>
					</div>

					<div class="product-single-qty">
						<input class="horizontal-quantity form-control" type="text">
					</div><!-- End .product-single-qty -->

					<a href="{{ route('products.add-to-cart', $product->slug) }}" class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to Cart</a>

					<a href="{{ route('cart') }}" class="btn view-cart d-none">View cart</a>
				</div><!-- End .product-action -->

				<hr class="divider mb-0 mt-0">

				<div class="product-single-share mb-0">
					<label class="sr-only">Share:</label>

					<div class="social-icons mr-2">
						<a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
						<a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
						<a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
						<a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank" title="Google +"></a>
						<a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
					</div><!-- End .social-icons -->

					<a href="wishlist_1.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i class="icon-wishlist-2"></i><span>Add to
							Wishlist</span></a>
				</div><!-- End .product single-share -->
			</div>
		</div><!-- End .product-single-details -->

		<button title="Close (Esc)" type="button" class="mfp-close">
			×
		</button>
	</div><!-- End .row -->
</div><!-- End .product-single-container -->