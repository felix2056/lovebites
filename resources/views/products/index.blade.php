@extends('layouts.app')

@section('title')
    Shop
@endsection

@section('content')
<main class="main bg-gray">
    <div class="category-banner-container">
        <div class="container-fluid">
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
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
        </div>
    </nav>

    <div class="container-fluid bg-gray">
        <div class="row">
            <div class="col-lg-9 main-content shop-content">
                <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                    <div class="toolbox-left">
                        <a href="#" class="sidebar-toggle">
                            <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <line x1="15" x2="26" y1="9" y2="9" class="cls-1"/>
                                <line x1="6" x2="9" y1="9" y2="9" class="cls-1"/>
                                <line x1="23" x2="26" y1="16" y2="16" class="cls-1"/>
                                <line x1="6" x2="17" y1="16" y2="16" class="cls-1"/>
                                <line x1="17" x2="26" y1="23" y2="23" class="cls-1"/>
                                <line x1="6" x2="11" y1="23" y2="23" class="cls-1"/>
                                <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z" class="cls-2"/>
                                <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"/>
                                <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"/>
                                <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z" class="cls-2"/>
                            </svg>
                            <span>Filter</span>
                        </a>

                        <div class="toolbox-item toolbox-sort">
                            <label>Sort By:</label>

                            <div class="select-custom">
                                <select name="orderby" class="form-control">
                                    <option value="menu_order" selected="selected">Default sorting</option>
                                    <option value="name-asc">Sort by name: A - Z</option>
                                    <option value="name-desc">Sort by name: Z - A</option>
                                    <option value="price-asc">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by recency</option>
                                </select>
                            </div><!-- End .select-custom -->


                        </div><!-- End .toolbox-item -->
                    </div><!-- End .toolbox-left -->

                    <div class="toolbox-right">
                        <div class="toolbox-item layout-modes">
                            <a href="{{ route('products.index') }}" class="layout-btn btn-grid active" title="Grid">
                                <i class="icon-mode-grid"></i>
                            </a>
                            <a href="category-list.html" class="layout-btn btn-list" title="List">
                                <i class="icon-mode-list"></i>
                            </a>
                        </div><!-- End .layout-modes -->
                    </div><!-- End .toolbox-right -->
                </nav>

                <div class="row product-ajax-grid mb-2">
                    @foreach($products as $product)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <img src="{{ $product->featured_image }}" width="205" height="205" alt="product">
                                    </a>
                                    <div class="btn-icon-group">
                                        <a href="{{ route('products.add-to-cart', $product->slug) }}" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                                    </div>
                                    <a href="{{ route('products.quick-view', $product->slug) }}" class="btn-quickview" title="Quick View">Quick View</a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href="{{ route('subcategories.show', $product->subcategory->slug) }}" class="product-category">{{ $product->subcategory->name }}</a>
                                        </div>
                                        <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="{{ route('products.show', $product->slug) }}">{{ $product->title }}</a>
                                    </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:{{ $product->ratings }}"></span><!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">{{ $product->sale_price }}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        </div><!-- End .col-lg-3 -->
                    @endforeach
                </div><!-- End .row -->

                @php
                    $current_page = $products->currentPage();
                    
                    $current_url = Request::fullUrl();
                    $next_url = $products->nextPageUrl();
                    $prev_url = $products->previousPageUrl();

                    // determine if current url already has a query string
                    if (strpos($current_url, '?sort') !== false || strpos($current_url, '&sort') !== false) {
                        $next_url = $next_url . '&sort=' . $sort;
                    }

                    if (strpos($current_url, '?sort') !== false || strpos($current_url, '&sort') !== false) {
                        $prev_url = $prev_url . '&sort=' . $sort;
                    }
                @endphp

                @unless($products->currentPage() == $products->lastPage())
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
            </div><!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Categories</a>
                        </h3>

                        <div class="collapse show" id="widget-body-2">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($categories as $category)
                                    <li>
                                        <a @if($category->subcategories_count > 0) href="#widget-category-{{ $category->id }}" class="collapsed" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="widget-category-{{ $category->id }}" @else href="#" @endif>
                                            {{ $category->name }}<span class="products-count">({{ $category->subcategories_count }})</span>
                                            @if($category->subcategories_count > 0)
                                            <span class="toggle"></span>
                                            @endif
                                        </a>
                                        @if($category->subcategories_count > 0)
                                        <div class="collapse" id="widget-category-{{ $category->id }}">
                                            <ul class="cat-sublist">
                                                @foreach ($category->subcategories as $subcategory)
                                                <li>
                                                    <a href="{{ route('subcategories.show', $subcategory->slug) }}">
                                                        {{ $subcategory->name }}<span class="products-count">({{ count($subcategory->products) }})</span>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Price</a>
                        </h3>

                        <div class="collapse show" id="widget-body-3">
                            <div class="widget-body pb-0">
                                <form action="#">
                                    <div class="price-slider-wrapper">
                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .price-slider-wrapper -->

                                    <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="filter-price-text">
                                            Price:
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->

                                        <button type="submit" class="btn btn-primary font2">Filter</button>
                                    </div><!-- End .filter-price-action -->
                                </form>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget widget-color">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Color</a>
                        </h3>

                        <div class="collapse show" id="widget-body-4">
                            <div class="widget-body pb-0">
                                <ul class="config-swatch-list">
                                    <li class="active">
                                        <a href="#" style="background-color: #000;"></a>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #0188cc;"></a>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #81d742;"></a>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #6085a5;"></a>
                                    </li>
                                    <li>
                                        <a href="#" style="background-color: #ab6e6e;"></a>
                                    </li>
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    {{-- <div class="widget widget-size">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-5" role="button" aria-expanded="true" aria-controls="widget-body-5">Size</a>
                        </h3>

                        <div class="collapse show" id="widget-body-5">
                            <div class="widget-body">
                                <ul class="config-size-list">
                                    <li class="active"><a href="#">XL</a></li>
                                    <li><a href="#">L</a></li>
                                    <li><a href="#">M</a></li>
                                    <li><a href="#">S</a></li>
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget --> --}}

                    {{-- <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-6" role="button" aria-expanded="true" aria-controls="widget-body-6">Brand</a>
                        </h3>

                        <div class="collapse show" id="widget-body-6">
                            <div class="widget-body pb-0">
                                <ul class="brand-list">
                                    <li><a href="#">Adidas</a></li>
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div> --}}

                    <div class="widget widget-featured">
                        <h3 class="widget-title">Featured</h3>

                        <div class="widget-body">
                            <div class="owl-carousel widget-featured-products">
                                <div class="featured-col">
                                    @foreach ($featuredProducts as $product)
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="{{ route('products.show', $product->slug) }}">
                                                <img src="{{ $product->featured_image }}" width="75" height="75" alt="product">
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
                                                </div><!-- End .product-ratings -->
                                            </div><!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">{{ $product->sale_price }}</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                    @endforeach
                                </div><!-- End .featured-col -->
                                
                                <div class="featured-col">
                                    @foreach ($popularProducts as $product)
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="{{ route('products.show', $product->slug) }}">
                                                <img src="{{ $product->featured_image }}" width="75" height="75" alt="{{ $product->title }}">
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
                                                </div><!-- End .product-ratings -->
                                            </div><!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">{{ $product->sale_price }}</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                    @endforeach
                                </div><!-- End .featured-col -->
                            </div><!-- End .widget-featured-slider -->
                        </div><!-- End .widget-body -->
                    </div><!-- End .widget -->
                </div><!-- End .sidebar-wrapper -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container-fluid -->
</main>
<!-- End .main -->
@endsection

@section('scripts')
    <script src="/js/nouislider.min.js"></script>
    <script>
        $(document).ready(function() {
            // on select change
            $('select[name="orderby"]').on('change', function() {
                var selected = $(this).val();
                
                // if selected is not empty
                if (selected != '') {
                    // get the url
                    var url = '{{ $url }}';
                    
                    // append the selected value to the url
                    url += '?sort=' + selected;
                    
                    // redirect to the url
                    window.location.href = url;
                }
            });
        });
    </script>
@endsection