@extends('layouts.app')

@section('title')
    About Us
@endsection

@section('content')
<main class="main about">
    <div class="page-header page-header-bg text-left" style="background-image: url(/images/site/dark-surface-with-reflections-smooth-minimal-black-waves-background-blurry-silk-waves-minimal-soft-grayscale-ripples-flow.jpg); background-color: #111">
        <div class="container-fluid">
            <h1 class="text-white"><span>About</span>Lovebites</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <div class="about-section bg-gray">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <img src="/images/site/HP_KV_desktop_1920x839_DOT.jpg" alt="About">
                </div><!-- End .col-lg-6 -->

                <div class="col-lg-6 padding-left-lg">
                    <h2 class="subtitle">WHO WE ARE</h2>
                    <p>Lovebites.com</p>
                    <p>
                        We deliver sexual happiness straight to your door through our wide selection of products made for adults.
                        Our experienced and passionate team is always up-to-date and selecting the best products for grown-ups for all tastes.
                    </p>

                    {{-- <ul>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Nulla id nisi a nulla rhoncus sodales et ac lectus.</li>
                        <li>In sagittis diam et lorem egestas, ac sodales dolor venenatis.</li>
                    </ul> --}}
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->

            <hr>

            <div class="row">
                <div class="col-md-4">
                    <h2 class="subtitle mb-2">OUR MISSION</h2>
                    <p>We aim to make you happy and satisfied.

                        We keep high standards of excellence and strive for 100% customer satisfaction.
                        
                        We love to sharing with us your experience with our products and receiving your reviews.
                        
                        Our customer service team is always available for you!</p>
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <h2 class="subtitle mb-2">OUR VISION</h2>
                    <p>Sexual education is very important for us and we aim to be part of an inclusive society where all adults feel happy with their sexuality and free to explore their pleasures. We embrace inclusion, we commit to support diversity and sexual wellness for all.</p>
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <h2 class="subtitle mb-2">OUR VALUE</h2>
                    <p>
                        USP (Unique Selling Proposition).
                        What makes Lovebites different?
                        Our team is carefully selecting the best products at a fair pricing that delivered directly to your door in discreet packaging for all tastes.
                    </p>
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .about-section -->

    <div class="counters-section" style="background-image: url(images/bg-counters.jpg); background-color: #111;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 col-md-4 count-container text-center">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="150" data-speed="1000" data-refresh-interval="50">100</span><span>+</span>
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">Sold Products</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container text-center">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="280" data-speed="1000" data-refresh-interval="50">280</span><span>+</span>
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">Happy Buyers</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container text-center">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="50" data-speed="1000" data-refresh-interval="50">50</span><span>+</span>
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">Employees</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container text-center">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="300" data-speed="1000" data-refresh-interval="50">300</span>+
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">Products</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container text-center">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="24" data-speed="2000" data-refresh-interval="50">24</span><span>HR+</span>
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">Support Available</h4>
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .counters-section -->

    <div class="testimonials-section">
        <div class="container-fluid">
            <h2 class="subtitle text-center">BUYERS REVIEW</h2>

            <div class="testimonials-slider owl-carousel owl-theme" data-togggle="owl" data-owl-options="{
                    'dots': false,
                    'nav': true
                }">
                <div class="testimonial">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                        has been the industry's standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make.</p>

                    <h4>Client Name</h4>
                </div><!-- End .testimonial -->

                <div class="testimonial">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                        has been the industry's standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make.</p>

                    <h4>Client Name</h4>
                </div><!-- End .testimonial -->
            </div><!-- End .testimonials-slider -->
        </div><!-- End .container -->
    </div><!-- End .testimonials-section -->

    <div class="info-boxes-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="info-box">
                        <i class="icon-support"></i>

                        <div class="info-box-content">
                            <h4>ONLINE SUPPORT</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="info-box">
                        <i class="icon-shipping"></i>

                        <div class="info-box-content">
                            <h4>FREE SHIPPING & RETURN</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="info-box">
                        <i class="icon-money"></i>

                        <div class="info-box-content">
                            <h4>MONEY BACK GUARANTEE</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="info-box">
                        <i class="icon-cat-shirt"></i>

                        <div class="info-box-content">
                            <h4>NEW STYLES EVERY DAY</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                </div>
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .info-boxes-container -->
</main>
<!-- End .main -->
@endsection
