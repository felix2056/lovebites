@foreach($products as $product)
<div class="col-6 col-md-4 col-lg-3 col-xl-5col">
    <div class="product-default inner-quickview inner-icon">
        <figure>
            <a href="demo18-product_1.html">
                <img src="{{ $product->featured_image }}" width="205" height="205" alt="product">
            </a>
            <div class="btn-icon-group">
                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
            </div>
            <a href="{{ route('products.quick-view', $product->slug) }}" class="btn-quickview" title="Quick View">Quick View</a>
        </figure>
        <div class="product-details">
            <div class="category-wrap">
                <div class="category-list">
                    <a href="demo18-shop_1.html" class="product-category">category</a>
                </div>
                <a href="wishlist_1.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
            </div>
            <h3 class="product-title">
                <a href="demo18-product_1.html">{{ $product->title }}</a>
            </h3>
            <div class="ratings-container">
                <div class="product-ratings">
                    <span class="ratings" style="width:{{ $product->ratings }}"></span><!-- End .ratings -->
                    <span class="tooltiptext tooltip-top"></span>
                </div><!-- End .product-ratings -->
            </div><!-- End .product-container -->
            <div class="price-box">
                <span class="product-price">{{ $product->sale_price_cur }}</span>
            </div><!-- End .price-box -->
        </div><!-- End .product-details -->
    </div>
</div><!-- End .col-lg-3 -->
@endforeach