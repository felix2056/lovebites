@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<main class="main">
    <section class="home-slider-container">
        <div class="home-slider owl-carousel with-dots-container" data-owl-options="{'nav': false, 'loop': true, 'autoplay': true, 'autoplayTimeout': 7000}">
            <div class="home-slide home-slide2 banner" style="background-color: #111;">
                <div class="slide-bg" src="assets/images/demoes/demo18/slider/home-slide-back.jpg"
                    style="transform: scaleX(-1);"></div>
                <!-- End .slide-bg !-->
                <ul class="slide-bg scene" style="width: 100%; height: 100%;">
                    <li class="layer" data-depth="0.05"><img src="/images/site/womanizer-toys.jpg" alt></li>
                    <li class="layer" data-depth="0.06"><img style="position: absolute; top: 70%; left: 42%;"
                            src="/images/blurflake1.png" alt></li>
                    <li class="layer" data-depth="0.07"><img class="animation-spin"
                            style="position: absolute; top: 25%; left: 45%;" src="/images/blurflake2.png" alt>
                    </li>
                    <li class="layer" data-depth="0.10"><img class="animation-wave"
                            style="position: absolute; top: 49%; left: 21%;" src="/images/blurflake3.png" alt>
                    </li>
                    <li class="layer" data-depth="0.15"><img style="position: absolute; top: 25%; left: 23%;"
                            src="/images/blurflake4.png" alt></li>
                </ul>
                <div class="home-slide-content">
                    <h2 class="text-white text-transform-uppercase line-height-1">100% Waterproof LILY™ 2</h2>
                    <h3 class="text-white d-inline-block line-height-1 ls-0 text-center">up<br> to
                    </h3>
                    <h4 class="text-white text-uppercase line-height-1 d-inline-block">20% off</h4>
                    <div></div>
                    <h5 class="float-left text-white text-uppercase line-height-1 ls-n-20">Starting At</h5>
                    <h6
                        class="float-left coupon-sale-text line-height-1 ls-n-20 font-weight-bold text-secondary">
                        <sup>$</sup>149<sup>99</sup>
                    </h6>
                    <a href="{{ route('products.index') }}" class="btn btn-light d-inline-block">Shop Now</a>
                </div>
                <!-- End .home-slide-content -->
            </div>
            <!-- End .home-slide -->

            <div class="home-slide home-slide1 banner" style="background-color: #111">
                <div class="slide-bg" src="/images/home-slide-back.jpg"></div>
                <!-- End .slide-bg !-->
                <ul class="slide-bg scene" style="width: 100%; height: 100%;">
                    <li class="layer" data-depth="0.05"><img src="/images/site/woman-in-bedroom-holding-vibrator-in-hand-royalty-free-image-1635204448.jpg" alt></li>
                    <li class="layer" data-depth="0.06"><img style="position: absolute; top: 31%; left: 46.5%;"
                            src="/images/blurflake1.png" alt></li>
                    <li class="layer" data-depth="0.07"><img class="animation-spin"
                            style="position: absolute; top: 25%; left: 66%;" src="/images/blurflake2.png" alt>
                    </li>
                    <li class="layer" data-depth="0.10"><img class="animation-wave"
                            style="position: absolute; top: 50%; left: 80%;" src="/images/blurflake3.png" alt>
                    </li>
                    <li class="layer" data-depth="0.15"><img style="position: absolute; top: 70%; left: 55%;"
                            src="/images/blurflake4.png" alt></li>
                </ul>
                <div class="home-slide-content">
                    <h2 class="text-white text-transform-uppercase line-height-1">INA™ 3 Dual-Action Massager</h2>
                    <h3 class="text-white d-inline-block line-height-1 ls-0 text-center">up<br> to
                    </h3>
                    <h4 class="text-white text-uppercase line-height-1 d-inline-block">25% off</h4>
                    <div></div>
                    <h5 class="float-left text-white text-uppercase line-height-1 ls-n-20">Starting At</h5>
                    <h6
                        class="float-left coupon-sale-text line-height-1 ls-n-20 font-weight-bold text-secondary">
                        <sup>$</sup>179<sup>99</sup>
                    </h6>
                    <a href="{{ route('products.index') }}" class="btn btn-light d-inline-block">Shop Now</a>
                </div>
                <!-- End .home-slide-content -->
            </div>
            <!-- End .home-slide -->
        </div>
        <!-- End .home-slider -->

        <div class="home-slider-thumbs owl-dots">
            <a href="#" class="owl-dot">
                <img src="/images/site/lily3-3.jpg" alt="Slide Thumb">
            </a>
            <a href="#" class="owl-dot">
                <img src="/images/site/ina3-3.jpg" alt="Slide Thumb">
            </a>
        </div>
        <!-- End .home-slide-thumbs -->
    </section>
    <!-- End .home-slider-container -->

    <div class="products-filter-container bg-gray">
        <div class="container-fluid">
            <div class="row align-items-lg-stretch">
                <aside class="filter-sidebar col-lg-2">
                    <div class="sidebar-wrapper">
                        <h3 class="ls-n-10 text-uppercase text-primary">Sort By</h3>

                        <ul class="check-filter-list">
                            <li><a href="#" class="active">All</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Electronics</a></li>
                            <li><a href="#">Men</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">Women</a></li>
                        </ul>
                    </div>
                    <!-- End .sidebar-wrapper -->
                </aside>
                <!-- End .col-lg-3 -->

                <div class="col-lg-10">
                    <div class="row product-ajax-grid mb-2">
                        @foreach ($popular as $product)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product-default inner-quickview inner-icon appear-animate"
                                data-animation-name="fadeIn">
                                <figure>
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <img src="{{ $product->featured_image }}" width="205" height="205" alt="{{ $product->title }}">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="{{ route('products.add-to-cart', $product->slug) }}" class="btn-icon btn-add-cart product-type-simple">
                                            <i class="icon-shopping-cart"></i>
                                        </a>
                                    </div>
                                    <a href="{{ route('products.quick-view', $product->slug) }}" class="btn-quickview"title="Quick View">Quick View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="{{ route('products.index') }}" class="product-category">category</a>
                                        </div>
                                        <a href="wishlist.html" class="btn-icon-wish">
                                            <i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="{{ route('products.show', $product->slug) }}">{{ $product->title }}</a>
                                    </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:{{ $product->ratings }}"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">{{ $product->sale_price }}</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                        </div><!-- End .col-lg-3 -->
                        @endforeach
                    </div>
                    <!-- End .row -->

                    @php
                        $current_page = $popular->currentPage();
                        
                        $current_url = Request::fullUrl();
                        $next_url = $popular->nextPageUrl();
                        $prev_url = $popular->previousPageUrl();

                        // determine if current url already has a query string
                        if (strpos($current_url, '?sort') !== false || strpos($current_url, '&sort') !== false) {
                            $next_url = $next_url . '&sort=' . $sort;
                        }

                        if (strpos($current_url, '?sort') !== false || strpos($current_url, '&sort') !== false) {
                            $prev_url = $prev_url . '&sort=' . $sort;
                        }
                    @endphp

                    @unless($popular->currentPage() == $popular->lastPage())
                        <div class="product-more-container d-flex justify-content-center">
                            <!-- change load-more to loadmore for ajax -->
                            <a href="{{ $next_url }}" class="btn btn-outline-dark load-more">Load More...</a>
                        </div><!-- End .product-more-container -->

                    @else
                    <div class="product-more-container d-flex justify-content-center">
                        <!-- change load-more to loadmore for ajax -->
                        <a href="{{ $prev_url }}" class="btn btn-outline-dark load-more">Load Prev...</a>
                    </div><!-- End .product-more-container -->
                    @endunless
                </div>
                <!-- End .col-lg-9 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container-fluid -->
    </div>
    <!-- End .produts-filter-container-->

    <section class="product-banner-section">
        <div class="banner" style="background-color: #111;">
            <figure class="w-100 appear-animate" data-animation-name="fadeIn">
                <img class="w-100 h-400px" src="/images/site/21.webp" alt="product banner">
            </figure>
            <div class="container-fluid">
                <div class="position-relative h-100">
                    <div class="banner-layer banner-layer-middle">
                        <h3 class="text-white text-uppercase ls-n-25 m-b-4 appear-animate"
                            data-animation-name="fadeInUpShorter" data-animation-duration="1000"
                            data-animation-delay="200">Ultra Boost</h3>
                        <img class="m-b-4 appear-animate" data-animation-name="fadeInUpShorter"
                            data-animation-duration="1000" data-animation-delay="400" src="/images/site/img-1.jpg"
                            alt="img" width="540" height="100">
                        <a href="{{ route('products.index') }}" class="btn btn-light appear-animate"
                            data-animation-name="fadeInUpShorter" data-animation-duration="1000"
                            data-animation-delay="600">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End .product-banner-section -->

    <section class="product-slider-section bg-gray">
        <div class="container-fluid">
            <h2 class="subtitle text-center text-uppercase mb-2 appear-animate" data-animation-name="fadeIn">
                Featured products</h2>

            <div class="featured-products owl-carousel owl-theme show-nav-hover nav-outer nav-image-center mb-3 appear-animate"
                data-owl-options="{ 
                'dots': false, 
                'nav': true, 
                'margin': 20, 
                'responsive': {
                    '992': {
                        'items': 4
                    },
                    '1200': {
                        'items': 6
                    }
                } 
            }" data-animation-name="fadeIn">
                @foreach ($latest as $product)
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->featured_image }}" width="205" height="205" alt="{{ $product->title }}">
                            </a>
                            <div class="btn-icon-group">
                                <a href="{{ route('products.add-to-cart', $product->slug) }}" class="btn-icon btn-add-cart product-type-simple">
                                    <i class="icon-shopping-cart"></i>
                                </a>
                            </div>
                            <a href="{{ route('products.quick-view', $product->slug) }}" class="btn-quickview" title="Quick View">Quick View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="{{ route('products.index') }}" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->title }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:{{ $product->ratings }}"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">{{ $product->sale_price }}</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach
            </div>
            <!-- End .featured-produts -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="banner mb-2 mb-lg-0" style="background-color: #fff;">
                        <figure>
                            <img class="h-100px" src="/images/site/womanizer-toys-Fls8Q8fgF9o-unsplash-2.jpg" alt="banner" width="873" height="151">
                        </figure>
                        <div class="banner-layer banner-layer-middle d-flex align-items-center justify-content-between">
                            <div class="content-left">
                                <h4 class="text-white mb-0">Summer Sale</h4>
                                <h5 class="text-uppercase text-white mb-0">20% off</h5>
                            </div>
                            <a href="{{ route('products.index') }}" class="btn btn-dark">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner" style="background-color: #111;">
                        <figure>
                            <img class="h-100px" src="/images/site/C5-HIW-Banner-DESKTOP.webp" alt="banner" width="873" height="151">
                        </figure>
                        <div class="banner-layer banner-layer-middle d-flex align-items-center justify-content-between">
                            <div class="content-left">
                                <h4 class="text-white mb-0">Flash Sale</h4>
                                <h5 class="text-uppercase text-white mb-0">30% off</h5>
                            </div>
                            <a href="{{ route('products.index') }}" class="btn btn-light">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .container-fluid -->
    </section>

    <section class="explore-section d-flex align-items-center"
        data-parallax="{'speed': 1.8,  'enableOnMobile': true}"
        data-image-src="/assets/images/demoes/demo18/bg-2.jpg" style="background-color: #111;">
        <div class="container-fluid text-center position-relative appear-animate"
            data-animation-name="fadeInUpShorter">
            <h3 class="line-height-1 ls-n-25 text-white text-uppercase m-b-4">Explore the best of you</h3>
            <a href="{{ route('products.index') }}" class="btn btn-light">Shop Now</a>
        </div>
        <!-- End .container -->
    </section>
    <!-- End .explore-section -->

    <section class="feature-boxes-container">
        <div class="container-fluid appear-animate" data-animation-name="fadeInUpShorter">
            <div class="row no-gaps m-0 ">
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box feature-box-simple text-center mb-2">
                        <div class="feature-box-icon">
                            <i class="icon-earphones-alt text-white"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3 class="text-white">Customer Support</h3>
                            <h5 class="line-height-1">Need Assistance?</h5>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
                                magna, et dapib.</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-sm-6.col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box feature-box-simple text-center mb-2">
                        <div class="feature-box-icon">
                            <i class="icon-credit-card text-white"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3 class="text-white">Secured Payment</h3>
                            <h5 class="line-height-1">Safe &amp; Fast</h5>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
                                magna, et dapibus lacus. Lorem ipsum dolor sit amet.</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box feature-box-simple text-center mb-2">
                        <div class="feature-box-icon">
                            <i class="icon-action-undo text-white"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3 class="text-capitalize text-white">Free Returns</h3>
                            <h5 class="line-height-1">Easy &amp; Free</h5>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
                                magna, et dapib.</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box feature-box-simple text-center mb-2">
                        <div class="feature-box-icon">
                            <i class="icon-shipping text-white"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3 class="text-white">Free Shipping</h3>
                            <h5 class="line-height-1">Made To Help You</h5>

                            <p>Porto has very powerful admin features to help customer to build their own shop
                                in minutes without any special skills in web development.</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-sm-6 col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container-->
    </section>
    <!-- End .feature-boxes-container -->
</main>
@endsection