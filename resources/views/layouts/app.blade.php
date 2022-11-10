<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title') - LoveBites</title>

    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="@yield('title') - LoveBites">
    <meta name="author" content="felix-codebreaker">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/images/logo/lovebites-favicon.png">

    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:200,300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function (d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="/css/demo18.min.css">
    <link rel="stylesheet" type="text/css" href="/css/all.min.css">

    <style>
        .h-100px { height: 100px;}
        .h-200px { height: 200px;}
        .h-300px { height: 300px;}
        .h-400px { height: 400px;}
        .h-500px { height: 500px;}
    </style>

    @yield('styles')
</head>

<body>
    <div class="page-wrapper">    
        <header class="header @if (Request::is('/') || Route::currentRouteName() == 'about') header-transparent @endif">
            <div class="header-middle sticky-header">
                <div class="container-fluid">
                    <div class="header-left">
                        <button class="mobile-menu-toggler text-white mr-2" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a href="/" class="logo">
                            <img src="/images/logo/lovebites-logo.png" alt="LoveBites Logo">
                        </a>
                    </div>
                    <!-- End .header-left -->

                    <div class="header-center justify-content-between">
                        <nav class="main-nav w-100">
                            <ul class="menu">
                                <li class="@if (Request::is('/')) active @endif">
                                    <a href="/">Home</a>
                                </li>
                                <li class="@if (Route::currentRouteName() == 'products.index') active @endif">
                                    <a href="{{ route('products.index') }}">Shop</a>
                                </li>
                                <li class="@if (Route::currentRouteName() == 'wishlist') active @endif">
                                    <a href="{{ route('wishlist') }}">Wishlist</a>
                                </li>
                                <li class="@if (Route::currentRouteName() == 'contact') active @endif">
                                    <a href="{{ route('contact') }}">Contact Us</a>
                                </li>
                                <li class="@if (Route::currentRouteName() == 'about') active @endif">
                                    <a href="{{ route('about') }}">About Us</a>
                                </li>
                                <li class="d-none d-xxl-block"><a href="#">Special Offer!</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- End .header-center -->

                    <div class="header-right justify-content-end">
                        <div class="header-dropdowns">
                            <div class="header-dropdown ">
                                <a href="#">USD</a>
                                <div class="header-menu">
                                    <ul>
                                        <li><a href="#">USD</a></li>
                                        <li><a href="#">EUR</a></li>
                                    </ul>
                                </div>
                                <!-- End .header-menu -->
                            </div>
                            <!-- End .header-dropown -->

                            <div class="header-dropdown">
                                <a href="#">ENG</a>
                                <div class="header-menu">
                                    <ul>
                                        <li><a href="#">ENG</a>
                                        </li>
                                        <li><a href="#">FRA</a></li>
                                    </ul>
                                </div>
                                <!-- End .header-menu -->
                            </div>
                            <!-- End .header-dropown -->
                        </div>
                        <!-- End .header-dropdowns -->

                        <a href="{{ route('dashboard') }}" class="header-icon" title="dashboard"><i class="icon-user-2"></i></a>

                        <a href="{{ route('wishlist') }}" class="header-icon" title="Wishlist"><i class="icon-wishlist-2"><span class="badge-circle">2</span></i></a>

                        <div class="header-icon header-search header-search-popup header-search-category text-right">
                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                            <form action="#" method="get">
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search..."
                                        required>
                                    <div class="select-custom">
                                        <select id="cat" name="cat">
                                            <option value>All Categories</option>
                                            <option value="4">Fashion</option>
                                            <option value="12">- Women</option>
                                            <option value="13">- Men</option>
                                            <option value="66">- Jewellery</option>
                                            <option value="67">- Kids Fashion</option>
                                            <option value="5">Electronics</option>
                                            <option value="21">- Smart TVs</option>
                                            <option value="22">- Cameras</option>
                                            <option value="63">- Games</option>
                                            <option value="7">Home &amp; Garden</option>
                                            <option value="11">Motors</option>
                                            <option value="31">- Cars and Trucks</option>
                                            <option value="32">- Motorcycles &amp; Powersports</option>
                                            <option value="33">- Parts &amp; Accessories</option>
                                            <option value="34">- Boats</option>
                                            <option value="57">- Auto Tools &amp; Supplies</option>
                                        </select>
                                    </div>
                                    <!-- End .select-custom -->
                                    <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                                </div>
                                <!-- End .header-search-wrapper -->
                            </form>
                        </div>
                        <!-- End .header-search -->

                        @php
                            $cart = session()->get('cart');
                            $subtotal = 0.00;

                            if ($cart) {
                                foreach ($cart as $item) {
                                    $subtotal += $item['price'] * $item['quantity'];
                                }
                            }
                        @endphp

                        <div class="dropdown cart-dropdown">
                            <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="minicart-icon"></i>
                                @if (session()->has('cart'))
                                    <span class="cart-count badge-circle">{{ count($cart) }}</span>
                                @endif
                            </a>

                            <div class="cart-overlay"></div>

                            <div class="dropdown-menu mobile-cart">
                                <a href="#" title="Close (Esc)" class="btn-close">×</a>

                                <div class="dropdownmenu-wrapper custom-scrollbar">
                                    <div class="dropdown-cart-header">Shopping Cart</div>
                                    <!-- End .dropdown-cart-header -->

                                    @if (session()->has('cart') && count($cart) > 0)
                                        <div class="dropdown-cart-products">
                                            @foreach ($cart as $item)
                                                <div class="product">
                                                    <div class="product-details">
                                                        <h4 class="product-title">
                                                            <a href="{{ route('products.show', $item['slug']) }}">
                                                                {{ $item['name'] }}
                                                            </a>
                                                        </h4>

                                                        <span class="cart-product-info">
                                                            <span class="cart-product-qty">{{ $item['quantity'] }}</span>
                                                            x ${{ $item['price'] }}
                                                        </span>
                                                    </div>
                                                    <!-- End .product-details -->

                                                    <figure class="product-image-container">
                                                        <a href="{{ route('products.show', $item['slug']) }}" class="product-image">
                                                            <img src="{{ $item['featured_image'] }}" alt="product">
                                                        </a>
                                                        <a href="{{ route('products.remove-from-cart', $item['slug']) }}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                                    </figure>
                                                </div>
                                                <!-- End .product -->
                                            @endforeach
                                        </div>
                                        <!-- End .cart-product -->

                                        <div class="dropdown-cart-total">
                                            <span>SUBTOTAL:</span>

                                            <span class="cart-total-price float-right">${{ $subtotal }}</span>
                                        </div>
                                        <!-- End .dropdown-cart-total -->

                                        <div class="dropdown-cart-action">
                                            <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">View Cart</a>
                                            <a href="{{ route('checkout') }}"" class="btn btn-dark btn-block">Checkout</a>
                                        </div>
                                        <!-- End .dropdown-cart-total -->

                                    @else
                                        <div class="dropdown-cart-products">
                                            <div class="product">
                                                <div class="product-details">
                                                    <h4 class="product-title">
                                                        <a href="#">No items in cart</a>
                                                    </h4>
                                                </div>
                                                <!-- End .product-details -->
                                            </div>
                                            <!-- End .product -->
                                        </div>
                                        <!-- End .cart-product -->
                                    @endif
                                </div>
                                <!-- End .dropdownmenu-wrapper -->
                            </div>
                            <!-- End .dropdown-menu -->
                        </div>
                        <!-- End .dropdown -->
                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container-fluid -->
            </div>
            <!-- End .header-middle -->
        </header>
        <!-- End .header -->

        <main class="main">
            @yield('content')
        </main>
        <!-- End .main -->

        <footer class="footer font2">
            <div class="container-fluid">
                <div class="footer-top top-border d-flex align-items-center justify-content-between flex-wrap">
                    <div class="footer-left widget-newsletter d-md-flex align-items-center">
                        <div class="widget-newsletter-info">
                            <h5 class="widget-newsletter-title text-white text-uppercase ls-0 mb-0">subscribe newsletter</h5>
                            <p class="widget-newsletter-content mb-0">Get all the latest information on Events, Sales and Offers.</p>
                        </div>
                        <form action="#">
                            <div class="footer-submit-wrapper d-flex">
                                <input type="email" class="form-control" placeholder="Email address..." size="40"
                                    required>
                                <button type="submit" class="btn btn-dark btn-sm">Subscribe</button>
                            </div>
                        </form>
                    </div>
                    <div class="footer-right">
                        <div class="social-icons">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                            <a href="#" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                        </div>
                        <!-- End .social-icons -->
                    </div>
                </div>
                <div class="footer-middle">
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="/">
                                <img src="/images/logo/lovebites-logo.png" alt="Logo" class="logo">
                            </a>

                            <p class="footer-desc">Lorem ipsum dolor sit amet, consectetur adipis.</p>

                            <div class="ls-0 footer-question">
                                <h6 class="mb-0 text-white">QUESTIONS?</h6>
                                <h3 class="mb-3 text-white"><a href="tel:1-888-123-456">1-888-123-456</a></h3>
                            </div>
                        </div>
                        <!-- End .col-lg-3 -->

                        <div class="col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">Account</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="links">
                                            <li><a href="{{ route('about') }}">About us</a></li>
                                            <li><a href="{{ route('contact') }}">Contact us</a></li>
                                            @auth
                                                <li><a href="{{ route('dashboard') }}">My Account</a></li>
                                            @endauth
                                            <li><a href="#">Payment Methods</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="links">
                                            <li><a href="order.html">Order history</a></li>
                                            <li><a href="#">Advanced search</a></li>
                                            @guest
                                                <li><a href="{{ route('login') }}">Login</a></li>
                                            @endguest
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End .widget -->
                        </div>
                        <!-- End .col-lg-3 -->

                        <div class="col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">About</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="links">
                                            <li><a href="{{ route('about') }}">About LoveBites</a></li>
                                            <li><a href="#">Our Guarantees</a></li>
                                            <li><a href="#">Terms And Conditions</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="links">
                                            <li><a href="#">Return Policy</a></li>
                                            <li><a href="#">Intellectual Property Claims</a></li>
                                            <li><a href="#">Site Map</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End .widget -->
                        </div>
                        <!-- End .col-lg-3 -->

                        <div class="col-lg-3">
                            <div class="widget text-lg-right">
                                <h4 class="widget-title">Features</h4>

                                <ul class="links">
                                    <li><a href="#">Powerful Admin Panel</a></li>
                                    <li><a href="#">Mobile &amp; Retina Optimized</a></li>
                                    <li><a href="#">Super Fast HTML Template</a></li>
                                </ul>
                            </div>
                            <!-- End .widget -->
                        </div>
                        <!-- End .col-lg-3 -->
                    </div>
                    <!-- End .row -->
                </div>
                <div class="footer-bottom">
                    <p class="footer-copyright text-lg-center mb-0">&copy; LoveBites eCommerce. 2021. All Rights Reserved
                    </p>
                </div>
                <!-- End .footer-bottom -->
            </div>
            <!-- End .container-fluid -->
        </footer>
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->

    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li><a href="/">Home</a></li>
                    <li>
                        <a href="{{ route('products.index') }}">Categories</a>
                        <ul>
                            <li><a href="category.html">Full Width Banner</a></li>
                            <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a></li>
                            <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a></li>
                            <li><a href="category-sidebar-left.html">Left Sidebar</a></li>
                            <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                            <li><a href="category-off-canvas.html">Off Canvas Filter</a></li>
                            <li><a href="category-horizontal-filter1.html">Horizontal Filter 1</a></li>
                            <li><a href="category-horizontal-filter2.html">Horizontal Filter 2</a></li>
                            <li><a href="#">List Types</a></li>
                            <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll<span
                                        class="tip tip-new">New</span></a></li>
                            <li><a href="category.html">3 Columns Products</a></li>
                            <li><a href="category-4col.html">4 Columns Products</a></li>
                            <li><a href="category-5col.html">5 Columns Products</a></li>
                            <li><a href="category-6col.html">6 Columns Products</a></li>
                            <li><a href="category-7col.html">7 Columns Products</a></li>
                            <li><a href="category-8col.html">8 Columns Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="demo18-product.html">Products</a>
                        <ul>
                            <li>
                                <a href="#" class="nolink">PRODUCT PAGES</a>
                                <ul>
                                    <li><a href="product.html">SIMPLE PRODUCT</a></li>
                                    <li><a href="product-variable.html">VARIABLE PRODUCT</a></li>
                                    <li><a href="product.html">SALE PRODUCT</a></li>
                                    <li><a href="product.html">FEATURED & ON SALE</a></li>
                                    <li><a href="product-sticky-info.html">WIDTH CUSTOM TAB</a></li>
                                    <li><a href="product-sidebar-left.html">WITH LEFT SIDEBAR</a></li>
                                    <li><a href="product-sidebar-right.html">WITH RIGHT SIDEBAR</a></li>
                                    <li><a href="product-addcart-sticky.html">ADD CART STICKY</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="nolink">PRODUCT LAYOUTS</a>
                                <ul>
                                    <li><a href="product-extended-layout.html">EXTENDED LAYOUT</a></li>
                                    <li><a href="product-grid-layout.html">GRID IMAGE</a></li>
                                    <li><a href="product-full-width.html">FULL WIDTH LAYOUT</a></li>
                                    <li><a href="product-sticky-info.html">STICKY INFO</a></li>
                                    <li><a href="product-sticky-both.html">LEFT & RIGHT STICKY</a></li>
                                    <li><a href="product-transparent-image.html">TRANSPARENT IMAGE</a></li>
                                    <li><a href="product-center-vertical.html">CENTER VERTICAL</a></li>
                                    <li><a href="#">BUILD YOUR OWN</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Pages<span class="tip tip-hot">Hot!</span></a>
                        <ul>
                            <li>
                                <a href="{{ route('wishlist') }}">Wishlist</a>
                            </li>
                            <li>
                                <a href="cart.html">Shopping Cart</a>
                            </li>
                            <li>
                                <a href="checkout.html">Checkout</a>
                            </li>
                            <li>
                                <a href="dashboard.html">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                            <li>
                                <a href="forgot-password.html">Forgot Password</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="blog.html">Blog</a></li>
                    <li>
                        <a href="#">Elements</a>
                        <ul class="custom-scrollbar">
                            <li><a href="element-accordions.html">Accordion</a></li>
                            <li><a href="element-alerts.html">Alerts</a></li>
                            <li><a href="element-animations.html">Animations</a></li>
                            <li><a href="element-banners.html">Banners</a></li>
                            <li><a href="element-buttons.html">Buttons</a></li>
                            <li><a href="element-call-to-action.html">Call to Action</a></li>
                            <li><a href="element-countdown.html">Count Down</a></li>
                            <li><a href="element-counters.html">Counters</a></li>
                            <li><a href="element-headings.html">Headings</a></li>
                            <li><a href="element-icons.html">Icons</a></li>
                            <li><a href="element-info-box.html">Info box</a></li>
                            <li><a href="element-posts.html">Posts</a></li>
                            <li><a href="element-products.html">Products</a></li>
                            <li><a href="element-product-categories.html">Product Categories</a></li>
                            <li><a href="element-tabs.html">Tabs</a></li>
                            <li><a href="element-testimonial.html">Testimonials</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="mobile-menu mt-2 mb-2">
                    <li class="border-0">
                        <a href="#">
                            Special Offer!
                        </a>
                    </li>
                    <li class="border-0">
                        <a href="#" target="_blank">
                            Buy LoveBites!
                            <span class="tip tip-hot">Hot</span>
                        </a>
                    </li>
                </ul>

                <ul class="mobile-menu">
                    <li><a href="{{ route('login') }}">My Account</a></li>
                    <li><a href="demo18-contact.html">Contact Us</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="{{ route('wishlist') }}">My Wishlist</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="{{ route('login') }}" class="login-link">Log In</a></li>
                </ul>
            </nav>
            <!-- End .mobile-nav -->

            <form class="search-wrapper mb-2" action="#">
                <input type="text" class="form-control mb-0" placeholder="Search..." required>
                <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
            </form>

            <div class="social-icons">
                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
                </a>
                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
                </a>
                <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
                </a>
            </div>
        </div>
        <!-- End .mobile-menu-wrapper -->
    </div>
    <!-- End .mobile-menu-container -->

    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="/">
                <i class="icon-home"></i>Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('products.index') }}" class>
                <i class="icon-bars"></i>Categories
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('wishlist') }}" class>
                <i class="icon-wishlist-2"></i>Wishlist
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('dashboard') }}" class>
                <i class="icon-user-2"></i>Account
            </a>
        </div>
        <div class="sticky-info">
            <a href="cart.html" class>
                <i class="icon-shopping-cart position-relative">
                    <span class="cart-count badge-circle">3</span>
                </i>Cart
            </a>
        </div>
    </div>

    <div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form"
        style="background: #f1f1f1 no-repeat center/cover url(/images/newsletter_popup_bg.jpg)">
        <div class="newsletter-popup-content">
            <img src="/images/logo/lovebites-logo-black.png" alt="Logo" class="logo-newsletter" width="111" height="44">
            <h2>Subscribe to newsletter</h2>

            <p>
                Subscribe to the LoveBites mailing list to receive updates on new arrivals, special offers and our
                promotions.
            </p>

            <form action="#">
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email"
                        placeholder="Your email address" required>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
            <div class="newsletter-subscribe">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" value="0" id="show-again">
                    <label for="show-again" class="custom-control-label">
                        Don't show this popup again
                    </label>
                </div>
            </div>
        </div>
        <!-- End .newsletter-popup-content -->

        <button title="Close (Esc)" type="button" class="mfp-close">
            ×
        </button>
    </div>
    <!-- End .newsletter-popup -->

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/plugins.min.js"></script>
    <script src="/js/jquery.appear.min.js"></script>

    <!-- Main JS File -->
    {{-- <script src="/js/main.min.js"></script> --}}
    <script src="/js/main.js"></script>

    <!-- Extra JS Includes -->
    @yield('scripts')
</body>

</html>