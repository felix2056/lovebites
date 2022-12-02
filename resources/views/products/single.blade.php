@extends('layouts.app')

@section('title')
{{ $product->title }}
@endsection

@section('styles')
<style>
    .w-100px { width: 100px; }
    .w-110px { width: 110px; }
    .w-120px { width: 120px; }
    .w-130px { width: 130px; }
    .w-140px { width: 140px; }
    .w-150px { width: 150px; }
    .w-160px { width: 160px; }
    .w-170px { width: 170px; }
    .w-180px { width: 180px; }
    .w-190px { width: 190px; }
    .w-200px { width: 200px; }

    .product-desc-content span, .product-desc-content p {
        font-size: inherit !important;
    }
</style>
@endsection

@section('content')
<main class="main bg-gray">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
            </ol>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 main-content product-sidebar-right mb-0">
                <div class="product-single-container product-single-default">

                    @if (session()->has('success'))
                    <div class="cart-message">
                        <strong class="single-cart-notice">“{{ $product->title }}”</strong>
                        <span>has been added to your cart.</span>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 product-single-gallery">
                            <div class="product-slider-container">
                                <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{ $product->featured_image }}" data-zoom-image="{{ $product->featured_image }}" width="468" height="468" alt="product">
                                    </div>
                                </div>
                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
                                    <i class="icon-plus"></i>
                                </span>
                            </div>

                            <div class="prod-thumbnail owl-dots">
                                <div class="owl-dot">
                                    <img src="{{ $product->featured_image }}" width="110" height="110" alt="product-thumbnail">
                                </div>
                                @foreach ($product->images as $image)
                                    <div class="owl-dot">
                                        <img src="{{ $image }}" width="110" height="110" alt="product-thumbnail">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End .product-single-gallery -->

                        <div class="col-md-6 product-single-details">
                            <h1 class="product-title">{{ $product->title }}</h1>

                            <div class="product-nav">
                                @if($product->previous())
                                <div class="product-prev">
                                    <a href="{{ route('products.show', $product->previous()->slug) }}" class="tooltip-link">
                                        <span class="product-link"></span>

                                        <span class="product-popup">
                                            <span class="box-content">
                                                <img alt="product" width="150" height="150" src="{{ $product->previous()->featured_image }}" style="padding-top: 0px;">

                                                <span>{{ $product->previous()->name }}</span>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                @endif

                                @if($product->next())
                                <div class="product-next">
                                    <a href="{{ route('products.show', $product->next()->slug) }}">
                                        <span class="product-link"></span>

                                        <span class="product-popup">
                                            <span class="box-content">
                                                <img alt="product" width="150" height="150" src="{{ $product->next()->featured_image }}" style="padding-top: 0px;">

                                                <span>{{ $product->next()->name }}</span>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                @endif
                            </div>

                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:{{ $product->ratings }}"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->

                                <a href="#" class="rating-link">( {{ $product->total_ratings }} Reviews )</a>
                            </div>
                            <!-- End .ratings-container -->

                            <hr class="short-divider">

                            <div class="price-box">
                                <span class="old-price">{{ $product->original_price_cur }}</span>
                                <span class="new-price">{{ $product->sale_price_cur }}</span>
                            </div>
                            <!-- End .price-box -->

                            <div class="product-desc">
                                <p>
                                    {{ $product->short_description }}
                                </p>
                            </div>
                            <!-- End .product-desc -->

                            <ul class="single-info-list">
                                <!---->
                                @foreach ($product->specs as $item)
                                    <li>
                                        {{ $item->attrName }}:
                                        <strong>{{ $item->attrValue }}</strong>
                                    </li>
                                @endforeach
                                

                                <li>
                                    CATEGORY:
                                    <strong>
                                        <a href="#" class="product-category">{{ $product->subcategory->category->name }}</a>
                                    </strong>
                                </li>

                                <li>
                                    SUBCATEGORY:
                                    <strong>
                                        <a href="#" class="product-category">{{ $product->subcategory->name }}</a>
                                    </strong>
                                </li>

                                {{-- <li>
                                    TAGs:
                                    <strong><a href="#" class="product-category">CLOTHES</a></strong>,
                                    <strong><a href="#" class="product-category">SWEATER</a></strong>
                                </li> --}}
                            </ul>

                            @php
                                $cart = session()->get('cart');
                            @endphp

                            <div class="product-action">
                                <form action="{{ route('products.add-to-cart', $product->slug) }}" method="GET">
                                    @csrf
                                    <div class="product-single-qty">
                                        <input name="quantity" class="horizontal-quantity form-control" type="text" value="{{ isset($cart[$product->slug]) ? $cart[$product->slug]['quantity'] : 1 }}">
                                    </div>
                                    <!-- End .product-single-qty -->

                                    <!-- change add-to-cart to add-cart if you want to use ajax -->
                                    <button type="submit" class="btn btn-dark icon-shopping-cart mr-2 @if($cart && isset($cart[$product->slug])) added-to-cart @else add-to-cart @endif" title="Add to Cart">
                                        @if($cart && isset($cart[$product->slug]))
                                        Added to Cart
                                        @else
                                        Add to Cart
                                        @endif
                                    </button>

                                    @if($cart && isset($cart[$product->slug]))
                                    <a href="{{ route('cart') }}" class="btn btn-gray view-cart">View cart</a>
                                    @endif
                                </form>
                            </div>
                            <!-- End .product-action -->

                            <hr class="divider mb-0 mt-0">

                            <div class="product-single-share mb-2">
                                <label class="sr-only">Share:</label>

                                <div class="social-icons mr-2">
                                    <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                                    <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                                    <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                                    <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank" title="Google +"></a>
                                    <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                                </div>
                                <!-- End .social-icons -->

                                <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i class="icon-wishlist-2"></i><span>Add to Wishlist</span></a>
                            </div>
                            <!-- End .product single-share -->
                        </div>
                        <!-- End .product-single-details -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .product-single-container -->

                <div class="product-single-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews (1)</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Specifications</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                            <div class="product-desc-content">
                                <p>{!! $product->description !!}</p>
                            </div>
                            <!-- End .product-desc-content -->
                        </div>
                        <!-- End .tab-pane -->

                        <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                            <div class="product-reviews-content">
                                <h3 class="reviews-title">1 review for Men Black Sports Shoes</h3>

                                <div class="comment-list">
                                    <div class="comments">
                                        <figure class="img-thumbnail">
                                            <img src="/images/author.jpg" alt="author" width="80" height="80">
                                        </figure>

                                        <div class="comment-block">
                                            <div class="comment-header">
                                                <div class="comment-arrow"></div>

                                                <div class="ratings-container float-sm-right">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:60%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>

                                                <span class="comment-by">
                                                    <strong>Joe Doe</strong> – April 12, 2018
                                                </span>
                                            </div>

                                            <div class="comment-content">
                                                <p>Excellent.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider"></div>

                                <div class="add-product-review">
                                    <h3 class="review-title">Add a review</h3>

                                    <form action="#" class="comment-form m-0">
                                        <div class="rating-form">
                                            <label for="rating">Your rating <span class="required">*</span></label>
                                            <span class="rating-stars">
                                                <a class="star-1" href="#">1</a>
                                                <a class="star-2" href="#">2</a>
                                                <a class="star-3" href="#">3</a>
                                                <a class="star-4" href="#">4</a>
                                                <a class="star-5" href="#">5</a>
                                            </span>

                                            <select name="rating" id="rating" required style="display: none;">
                                                <option value>Rate…</option>
                                                <option value="5">Perfect</option>
                                                <option value="4">Good</option>
                                                <option value="3">Average</option>
                                                <option value="2">Not that bad</option>
                                                <option value="1">Very poor</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Your review <span class="required">*</span></label>
                                            <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                        </div>
                                        <!-- End .form-group -->


                                        <div class="row">
                                            <div class="col-md-6 col-xl-12">
                                                <div class="form-group">
                                                    <label>Name <span class="required">*</span></label>
                                                    <input type="text" class="form-control form-control-sm" required>
                                                </div>
                                                <!-- End .form-group -->
                                            </div>

                                            <div class="col-md-6 col-xl-12">
                                                <div class="form-group">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input type="text" class="form-control form-control-sm" required>
                                                </div>
                                                <!-- End .form-group -->
                                            </div>

                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="save-name">
                                                    <label class="custom-control-label mb-0" for="save-name">Save my
                                                        name, email, and website in this browser for the next
                                                        time I
                                                        comment.</label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </form>
                                </div>
                                <!-- End .add-product-review -->
                            </div>
                            <!-- End .product-reviews-content -->
                        </div>
                        <!-- End .tab-pane -->

                        <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                            <table class="table table-striped mt-2">
                                <tbody>
                                    @foreach ($product->specs as $item)
                                    <tr>
                                        <th>{{ $item->attrName }}:</th>
                                        <td>{{ $item->attrValue }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End .tab-pane -->
                    </div>
                    <!-- End .tab-content -->
                </div>
                <!-- End .product-single-tabs -->
                <!-- End .product-single-tabs -->
            </div>
            <!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <div class="sidebar-toggle custom-sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
            <aside class="sidebar-product col-lg-3 mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget widget-info">
                        <ul>
                            <li>
                                <i class="icon-shipped"></i>
                                <h4>FREE<br>SHIPPING</h4>
                            </li>
                            <li>
                                <i class="icon-us-dollar"></i>
                                <h4>100% MONEY<br>BACK GUARANTEE</h4>
                            </li>
                            <li>
                                <i class="icon-online-support"></i>
                                <h4>ONLINE<br>SUPPORT 24/7</h4>
                            </li>
                        </ul>
                    </div>

                    <div class="widget">
                        <div class="maga-sale-container custom-maga-sale-container">
                            <figure class="mega-image">
                                <img src="/images/banner-sidebar_1.jpg" class="w-100" alt="Banner Desc">
                            </figure>

                            <div class="mega-content">
                                <div class="mega-price-box">
                                    <span class="price-big">50</span>
                                    <span class="price-desc"><em>%</em>OFF</span>
                                </div>

                                <div class="mega-desc">
                                    <h3 class="mega-title line-height-1 mb-1 ls-n-10">MEGA SALE</h3>
                                    <span class="mega-subtitle line-height-1">HURRY UP!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .widget -->

                    <div class="widget widget-featured">
                        <h3 class="widget-title">FEATURED</h3>

                        <div class="widget-body">
                            <div class="featured-col">
                                @foreach ($featuredProducts as $product)
                                <div class="product-default left-details product-widget">
                                    <figure>
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            <img src="{{ $product->featured_image }}" width="75" height="75" alt="product">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h3 class="product-title"> <a href="{{ route('products.show', $product->slug) }}">{{ $product->title }}</a></h3>
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
                                            <span class="product-price">{{ $product->sale_price_cur }}</span>
                                        </div>
                                        <!-- End .price-box -->
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                                @endforeach
                            </div>
                            <!-- End .featured-col -->
                        </div>
                        <!-- End .widget-body -->
                    </div>
                    <!-- End .widget -->
                </div>
            </aside>
            <!-- End .col-md-3 -->
        </div>
        <!-- End .row -->

        <div class="products-section pt-0">
            <h2 class="section-title">Related Products</h2>

            <div class="products-slider owl-carousel owl-theme dots-top dots-small" data-owl-options="{ 
            'responsive': {
                '1200': {
                    'items': 5
                }
            } }">
                @foreach ($relatedProducts as $product)
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->featured_image }}" width="205" height="205" alt="{{ $product->title }}">
                        </a>
                        <div class="btn-icon-group">
                            <a href="{{ route('products.add-to-cart', $product->slug) }}" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                        </div>
                        <a href="{{ route('products.quick-view', $product->slug) }}" class="btn-quickview" title="Quick View">Quick View</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                                <a href="{{ route('products.index') }}" class="product-category">category</a>
                            </div>
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
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
                            <span class="product-price">{{ $product->sale_price_cur }}</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>
                @endforeach
            </div>
            <!-- End .products-slider -->
        </div>
        <!-- End .products-section -->
    </div>
</main>
<!-- End .main -->
@endsection
