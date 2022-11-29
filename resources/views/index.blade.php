@extends('layouts.app')

@section('styles')
{{-- <link rel="stylesheet" href="/css/demo4.min.css"> --}}

<style>
    .banner-big-sale {
    margin-top: 21px;
    margin-bottom: 44px;
}
.banner {
    position: relative;
    font-size: 1.6rem;
}
.banner-big-sale .banner-content {
    padding-top: 1.6rem;
    padding-bottom: 1.6rem;
}
.banner-content {
    position: relative;
}
.banner-big-sale h2 {
    font-size: 1.275em;
    line-height: 1.2;
}
.banner-big-sale b {
    position: relative;
    padding: 0.4em 0.6em;
    margin-left: 1px;
    z-index: 1;
}
.banner-big-sale b:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #222529;
    transform: rotate(-2deg);
    z-index: -1;
}
.banner-big-sale h2 small {
    font-size: 64%;
    font-weight: 400;
    opacity: 0.7;
    margin-left: 0.8em;
}
.banner-big-sale .btn {
    letter-spacing: 0.01em;
}

.section-title.categories-section-title {
    margin-bottom: 4.5rem;
}
.heading-border.section-title {
    margin: 0 -2rem 1.9rem;
    letter-spacing: -0.02em;
    line-height: 1.4;
}
.heading-border.section-title:after, .heading-border.section-title:before {
    margin: 0 1.5rem;
    margin-top: 2px;
}
.heading-border:after, .heading-border:before {
    content: "";
    margin: 0 8px;
    flex: 1;
    -ms-flex: 1;
    height: 0;
    border-top: 1px solid rgba(0,0,0,0.1);
}

.category-content {
    position: absolute;
    bottom: 0;
    width: 100%;
    z-index: 1;
    background: #fff;
}
.category-content h3, .category-content span {
    color: #1d2127;
}

.promo-section {
    padding: 6.1rem 0;
    margin-top: -1px;
}
.promo-section .parallax-background {
    background-color: #22252A;
}
.promo-section h2 {
    font-size: 2.25em;
    line-height: 1.15;
}
.promo-section .btn {
    padding: 1.5rem 3.92rem;
}
.promo-section h4 {
    font-size: 0.7em;
    line-height: 1.4;
}
.promo-section h5 {
    font-size: 1em;
    font-family: "Open Sans",sans-serif;
}
.coupon-sale-text b {
    display: inline-block;
    padding: 5px 8px;
    font-size: 1.6em;
    background-color: #fff;
}
.coupon-sale-text i {
    position: absolute;
    left: -2.25em;
    top: 50%;
    transform: translateY(-50%) rotate(-90deg);
    font-size: 0.65em;
    font-style: normal;
    opacity: 0.6;
    letter-spacing: 0;
}

.info-boxes-slider .owl-item.active {
    margin-right: -1px;
    margin-left: 1px;
}
.info-boxes-slider .active:not(:last-of-type) .info-box {
    border-right: 1px solid #e7e7e7;
}

.info-boxes-slider .info-box {
    padding: 1.6rem 0;
}
.info-boxes-slider i.icon-shipping {
    font-size: 35px;
}

.info-boxes-slider i {
    line-height: 35px;
}
.info-boxes-slider i:before {
    margin: 0 3px 0 2px;
}

.info-box i:before {
    width: auto;
    margin: 0 0.1em;
}
.info-boxes-slider .info-box-content {
    margin-top: -1px;
    margin-left: 1px;
}
.info-boxes-slider .info-box h4 {
    margin-bottom: 3px;
    line-height: 14px;
}
.info-boxes-slider .info-box p {
    line-height: 17px;
    letter-spacing: 0;
}
</style>
@endsection

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

    <hr class="mt-0 m-b-5">

    <div class="container">
        <div class="info-boxes-slider owl-carousel owl-theme mb-2" data-owl-options="{
            'dots': false,
            'loop': false,
            'responsive': {
                '576': {
                    'items': 2
                },
                '992': {
                    'items': 3
                }
            }
        }">
            <div class="info-box info-box-icon-left">
                <i class="icon-shipping"></i>

                <div class="info-box-content">
                    <h4>FREE SHIPPING &amp; RETURN</h4>
                    <p class="text-body">Free shipping on all orders over $99.</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                <i class="icon-money"></i>

                <div class="info-box-content">
                    <h4>MONEY BACK GUARANTEE</h4>
                    <p class="text-body">100% money back guarantee</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                <i class="icon-support"></i>

                <div class="info-box-content">
                    <h4>ONLINE SUPPORT 24/7</h4>
                    <p class="text-body">Lorem ipsum dolor sit amet.</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->
        </div>
        <!-- End .info-boxes-slider -->
    </div>
    <!-- End .container -->

    <section class="new-products-section">
        <div class="container">
            <div class="banner banner-big-sale appear-animate" data-animation-delay="200" data-animation-name="fadeInUpShorter" style="background: #2A95CB center/cover url(&#x27;images/banner-4.jpg&#x27;);">
                <div class="banner-content row align-items-center mx-0">
                    <div class="col-md-9 col-sm-8">
                        <h2 class="text-white text-uppercase text-center text-sm-left ls-n-20 mb-md-0 px-4">
                            <b class="d-inline-block mr-3 mb-1 mb-md-0">Big Sale</b> All new items up to 15% off
                            <small class="text-transform-none align-middle">Online Purchases Only</small>
                        </h2>
                    </div>
                    <div class="col-md-3 col-sm-4 text-center text-sm-right">
                        <a class="btn btn-light btn-white btn-lg" href="{{ route('products.index') }}">View Sale</a>
                    </div>
                </div>
            </div>

            <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">Browse Our Categories</h2>

            <div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer">
                @foreach (\App\Category::with('subcategories')->get() as $category)
                <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                    <a href="{{ route('categories.show', $category->slug) }}">
                        <figure style="height: 280px">
                            <img src="{{ $category->icon }}" alt="category" width="280" height="240">
                        </figure>
                        <div class="category-content">
                            <h3>{{ $category->name }}</h3>
                            <span><mark class="count">{{ $category->products_count }}</mark> products</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <hr class="mt-0 m-b-5">

            <div class="banners-container mb-2">
                <div class="banners-slider owl-carousel owl-theme" data-owl-options="{
                    'loop':true,
                    'autoplay': true,
                    'autoplayTimeout': 5000,
                    'autoplayHoverPause': true,
                    'items': 4,
                    'dots': false
                }">
                    @php
                        $toys = App\Category::first();
                    @endphp
    
                    @foreach ($toys->subcategories()->take(4)->get() as $subcategory)
                    <div class="banner banner1 banner-sm-vw d-flex align-items-center appear-animate" style="background-color: #ccc;" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                        <figure class="w-100">
                            <img src="{{ $subcategory->icon }}" alt="{{ $subcategory->name }}" width="380" style="height: 175px">
                        </figure>
                        <div class="banner-layer">
                            <h3 class="text-capitalize m-b-2">{{ $subcategory->name }}</h3>
                            <h4 class="m-b-3 text-primary"><sup class="text-dark"><del>10%</del></sup>15%<sup>OFF</sup></h4>
                            <a href="{{ route('subcategories.show', $subcategory->slug) }}" class="btn btn-sm btn-dark">Shop Now</a>
                        </div>
                    </div>
                    <!-- End .banner -->
                    @endforeach
                </div>
            </div>

            <hr class="mt-0 m-b-5">

            <h2 class="section-title heading-border ls-20 border-0">New Arrivals</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2" data-owl-options="{
                'dots': false,
                'nav': true,
                'responsive': {
                    '992': {
                        'items': 4
                    },
                    '1200': {
                        'items': 5
                    }
                }
            }">
                @foreach ($latest as $product)
                <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                    <figure>
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->featured_image }}" width="220" height="220" alt="{{ $product->title }}">
                            <img src="{{ $product->images[1] }}" width="220" height="220" alt="{{ $product->title }}">
                        </a>
                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="{{ route('subcategories.show', $product->subcategory->slug) }}" class="product-category">{{ $product->subcategory->name }}</a>
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
                            <del class="old-price">{{ $product->original_price }}</del>
                            <span class="product-price">{{ $product->sale_price }}</span>
                        </div>
                        <!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                            <a href="{{ route('products.add-to-cart', $product->slug) }}" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                            <a href="{{ route('products.quick-view', $product->slug) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <!-- End .product-details -->
                </div>
                @endforeach
            </div>
            <!-- End .featured-proucts -->
        </div>
    </section>

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

    <hr class="mt-0 m-b-5">

    <section class="new-products-section">
        <div class="container">
            <h2 class="section-title heading-border ls-20 border-0">Featured</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2" data-owl-options="{
                'dots': false,
                'nav': true,
                'responsive': {
                    '992': {
                        'items': 4
                    },
                    '1200': {
                        'items': 5
                    }
                }
            }">
                @foreach ($featured as $product)
                <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                    <figure>
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->featured_image }}" width="220" height="220" alt="{{ $product->title }}">
                            <img src="{{ $product->images[1] }}" width="220" height="220" alt="{{ $product->title }}">
                        </a>
                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="{{ route('subcategories.show', $product->subcategory->slug) }}" class="product-category">{{ $product->subcategory->name }}</a>
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
                            <del class="old-price">{{ $product->original_price }}</del>
                            <span class="product-price">{{ $product->sale_price }}</span>
                        </div>
                        <!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                            <a href="{{ route('products.add-to-cart', $product->slug) }}" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                            <a href="{{ route('products.quick-view', $product->slug) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <!-- End .product-details -->
                </div>
                @endforeach
            </div>
            <!-- End .featured-proucts -->
        </div>
    </section>

    <section class="explore-section d-flex align-items-center"
        data-parallax="{'speed': 1.8,  'enableOnMobile': true}"
        data-image-src="/images/site/dainis-graveris-04qxvvRE8Mo-unsplash.jpg" style="background-color: #111;">
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

    <section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}" data-image-src="/images/site/dark-surface-with-reflections-smooth-minimal-black-waves-background-blurry-silk-waves-minimal-soft-grayscale-ripples-flow.jpg">
        <div class="promo-banner banner container text-uppercase">
            <div class="banner-content row align-items-center text-center">
                <div class="col-md-4 ml-xl-auto text-md-right appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="600">
                    <h2 class="mb-md-0 text-white">Top Fashion<br>Deals</h2>
                </div>
                <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate" data-animation-name="fadeIn" data-animation-delay="300">
                    <a href="{{ route('products.index') }}" class="btn btn-dark btn-black ls-10">View Sale</a>
                </div>
                <div class="col-md-4 mr-xl-auto text-md-left appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="600">
                    <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                        <b>Exclusive COUPON</b></h4>
                    <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0"><i class="ls-0">UP TO</i><b class="text-white bg-secondary ls-n-10">$100</b> OFF</h5>
                </div>
            </div>
        </div>
    </section>

    <hr class="mt-0 m-b-5">

    <section class="blog-section pb-0">
        <div class="container">
            <h2 class="section-title heading-border border-0 appear-animate" data-animation-name="fadeInUp">
                Latest News</h2>

            <div class="owl-carousel owl-theme appear-animate" data-animation-name="fadeIn" data-owl-options="{
                'loop': false,
                'margin': 20,
                'autoHeight': true,
                'autoplay': false,
                'dots': false,
                'items': 2,
                'responsive': {
                    '0': {
                        'items': 1
                    },
                    '480': {
                        'items': 2
                    },
                    '576': {
                        'items': 3
                    },
                    '768': {
                        'items': 4
                    }
                }
            }">
                <article class="post">
                    <div class="post-media">
                        <a href="single.html">
                            <img src="/images/blog/post-1.jpg" alt="Post" width="225" height="280">
                        </a>
                        <div class="post-date">
                            <span class="day">26</span>
                            <span class="month">Feb</span>
                        </div>
                    </div>
                    <!-- End .post-media -->

                    <div class="post-body">
                        <h2 class="post-title">
                            <a href="single.html">Your Guide to Different Vibrations</a>
                        </h2>
                        <div class="post-content">
                            <p>Most vibrator guides on the internet will tell you all about the different shapes, sizes, and materials of sex toys. While these things are important when choosing the right toy, there is also something else you want to keep in mind – different vibration types...</p>
                        </div>
                        <!-- End .post-content -->
                        <a href="single.html" class="post-comment">0 Comments</a>
                    </div>
                    <!-- End .post-body -->
                </article>
                <!-- End .post -->

                <article class="post">
                    <div class="post-media">
                        <a href="single.html">
                            <img src="/images/blog/post-2.jpg" alt="Post" width="225" height="280">
                        </a>
                        <div class="post-date">
                            <span class="day">26</span>
                            <span class="month">Feb</span>
                        </div>
                    </div>
                    <!-- End .post-media -->

                    <div class="post-body">
                        <h2 class="post-title">
                            <a href="single.html">Choosing Your First Vibrator: A LoveBites Guide</a>
                        </h2>
                        <div class="post-content">
                            <p>If you’re just getting started on your jolly journey traversing the highways, byways, and back alleys of Vibrator Village, the shop windows and street corners will be filled with enticing options, each of which will no doubt be cooing a seductive siren song in your ear...</p>
                        </div>
                        <!-- End .post-content -->
                        <a href="single.html" class="post-comment">0 Comments</a>
                    </div>
                    <!-- End .post-body -->
                </article>
                <!-- End .post -->

                <article class="post">
                    <div class="post-media">
                        <a href="single.html">
                            <img src="/images/blog/post-3.jpg" alt="Post" width="225" height="280">
                        </a>
                        <div class="post-date">
                            <span class="day">26</span>
                            <span class="month">Feb</span>
                        </div>
                    </div>
                    <!-- End .post-media -->

                    <div class="post-body">
                        <h2 class="post-title">
                            <a href="single.html">4 Crazy Sex Positions You’ll Want to Try Tonight</a>
                        </h2>
                        <div class="post-content">
                            <p>Before we dive in, let’s all agree that the term ‘crazy’ is relative? When someone talks about having a “crazy weekend” it’s often met with positive praise. But when one calls another “crazy” it’s a negative thing...</p>
                        </div>
                        <!-- End .post-content -->
                        <a href="single.html" class="post-comment">0 Comments</a>
                    </div>
                    <!-- End .post-body -->
                </article>
                <!-- End .post -->

                <article class="post">
                    <div class="post-media">
                        <a href="single.html">
                            <img src="/images/blog/post-4.jpg" alt="Post" width="225" height="280">
                        </a>
                        <div class="post-date">
                            <span class="day">26</span>
                            <span class="month">Feb</span>
                        </div>
                    </div>
                    <!-- End .post-media -->

                    <div class="post-body">
                        <h2 class="post-title">
                            <a href="single.html">The Secrets of Sex Without Climax</a>
                        </h2>
                        <div class="post-content">
                            <p>Imagine taking a shower and then just walking away instead of rinsing off the shower gel. Or having a dinner at a fine restaurant but suddenly, instead of eating the main course, just walking away after appetizers and soup. Or even worse...</p>
                        </div>
                        <!-- End .post-content -->
                        <a href="single.html" class="post-comment">0 Comments</a>
                    </div>
                    <!-- End .post-body -->
                </article>
                <!-- End .post -->
            </div>

            <hr class="mt-0 m-b-5">

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

            <hr class="mt-0 m-b-5">

            <div class="brands-slider owl-carousel owl-theme images-center appear-animate" data-animation-name="fadeIn" data-animation-duration="500" data-owl-options="{
            'margin': 0}">
                <img src="/images/brand1.png" width="130" height="56" alt="brand">
                <img src="/images/brand2.png" width="130" height="56" alt="brand">
                <img src="/images/brand3.png" width="130" height="56" alt="brand">
                <img src="/images/brand4.png" width="130" height="56" alt="brand">
                <img src="/images/brand5.png" width="130" height="56" alt="brand">
                <img src="/images/brand6.png" width="130" height="56" alt="brand">
            </div>
            <!-- End .brands-slider -->

            <hr class="mt-4 m-b-5">

            <div class="product-widgets-container row pb-2">
                <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="200">
                    <h4 class="section-sub-title">Featured Products</h4>
                    @foreach (\App\Product::where('featured', true)->take(3)->get() as $product)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="product.html">
                                <img src="{{ $product->featured_image }}" width="84" height="84" alt="{{ $product->title }}">
                                <img src="{{ $product->images[1] }}" width="84" height="84" alt="{{ $product->title }}">
                            </a>
                        </figure>

                        <div class="product-details">
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

                <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                    <h4 class="section-sub-title">Best Selling Products</h4>
                    @foreach (\App\Product::orderBy('views', 'desc')->take(3)->get() as $product)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="product.html">
                                <img src="{{ $product->featured_image }}" width="84" height="84" alt="{{ $product->title }}">
                                <img src="{{ $product->images[1] }}" width="84" height="84" alt="{{ $product->title }}">
                            </a>
                        </figure>

                        <div class="product-details">
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

                <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="800">
                    <h4 class="section-sub-title">Latest Products</h4>
                    @foreach (\App\Product::orderBy('created_at', 'desc')->take(3)->get() as $product)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="product.html">
                                <img src="{{ $product->featured_image }}" width="84" height="84" alt="{{ $product->title }}">
                                <img src="{{ $product->images[1] }}" width="84" height="84" alt="{{ $product->title }}">
                            </a>
                        </figure>

                        <div class="product-details">
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

                <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="1100">
                    <h4 class="section-sub-title">Top Rated Products</h4>
                    @foreach (\App\Product::orderBy('ratings', 'desc')->take(3)->get() as $product)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="product.html">
                                <img src="{{ $product->featured_image }}" width="84" height="84" alt="{{ $product->title }}">
                                <img src="{{ $product->images[1] }}" width="84" height="84" alt="{{ $product->title }}">
                            </a>
                        </figure>

                        <div class="product-details">
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
            </div>
            <!-- End .row -->
        </div>
    </section>
</main>
@endsection