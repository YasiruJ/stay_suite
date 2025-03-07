@extends('home.layouts.master')
@section('content')
<div class="main-banner full" style="background-image:url({{ URL('/assets/img/cover.jpg') }});" data-overlay="5">
    <div class="container">
        <div class="col-md-12 col-sm-12">

            <div class="caption text-center cl-white mb-3">
                <span class="stylish">Travel is only glamorous in retrospect</span>
                <h1>Explore and Travel</h1>
            </div>

            <div class="faq-search">
                <form>
                    <input name="search" class="form-control" placeholder="Type a city or location...">
                    <button type="submit"> <i class="ti-search theme-cl"></i> </button>
                </form>
            </div>

        </div>
    </div>
    <div class="shape-bottom" data-negative="true"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100">
            <path class="elementor-shape-fill" fill="#FFF" fill-rule="evenodd" d="M720.99 0C960.78 0 1200.45 33.333 1440 100H0C240.872 33.333 481.202 0 720.99 0z"></path>
        </svg></div>
</div>
<!-- ======================= End Banner ===================== -->

<!-- ================= Travel start ========================= -->
<section class="pt-2 pb-5">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="sec-heading center">
                    <p>Popular Hotels</p>
                    <h2>Latest Travel Packages</h2>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Single Tour Place -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="tour-simple-wrap">
                    <div class="tour-simple-thumb">
                        <a href="tour-detail.html"><img src="https://via.placeholder.com/1200x800" class="img-fluid img-responsive" alt="" /></a>
                    </div>
                    <div class="tour-simple-caption">
                        <div class="ts-caption-left">
                            <h4 class="ts-title"><a href="tour-detail.html">Cologne, Germany</a></h4>
                            <span>5 Tour Package</span>
                        </div>
                        <div class="ts-caption-right">
                            <div class="ts-caption-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star"></i>
                            </div>
                            <h5 class="ts-price">$299.00</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Tour Place -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="tour-simple-wrap">
                    <div class="tour-simple-thumb">
                        <a href="tour-detail.html"><img src="https://via.placeholder.com/1200x800" class="img-fluid img-responsive" alt="" /></a>
                    </div>
                    <div class="tour-simple-caption">
                        <div class="ts-caption-left">
                            <h4 class="ts-title"><a href="tour-detail.html">Monte Carlo, Monaco</a></h4>
                            <span>7 Tour Package</span>
                        </div>
                        <div class="ts-caption-right">
                            <div class="ts-caption-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                            </div>
                            <h5 class="ts-price">$259.00</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Tour Place -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="tour-simple-wrap">
                    <div class="tour-simple-thumb">
                        <a href="tour-detail.html"><img src="https://via.placeholder.com/1200x800" class="img-fluid img-responsive" alt="" /></a>
                    </div>
                    <div class="tour-simple-caption">
                        <div class="ts-caption-left">
                            <h4 class="ts-title"><a href="tour-detail.html">Puebla, Mexico</a></h4>
                            <span>7 Tour Package</span>
                        </div>
                        <div class="ts-caption-right">
                            <div class="ts-caption-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star"></i>
                            </div>
                            <h5 class="ts-price">$350.00</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Tour Place -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="tour-simple-wrap">
                    <div class="tour-simple-thumb">
                        <a href="tour-detail.html"><img src="https://via.placeholder.com/1200x800" class="img-fluid img-responsive" alt="" /></a>
                    </div>
                    <div class="tour-simple-caption">
                        <div class="ts-caption-left">
                            <h4 class="ts-title"><a href="tour-detail.html">Florence, Italy</a></h4>
                            <span>4 Tour Package</span>
                        </div>
                        <div class="ts-caption-right">
                            <div class="ts-caption-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star"></i>
                            </div>
                            <h5 class="ts-price">$799.00</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Tour Place -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="tour-simple-wrap">
                    <div class="tour-simple-thumb">
                        <a href="tour-detail.html"><img src="https://via.placeholder.com/1200x800" class="img-fluid img-responsive" alt="" /></a>
                    </div>
                    <div class="tour-simple-caption">
                        <div class="ts-caption-left">
                            <h4 class="ts-title"><a href="tour-detail.html">Bergen, Norway</a></h4>
                            <span>3 Tour Package</span>
                        </div>
                        <div class="ts-caption-right">
                            <div class="ts-caption-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star"></i>
                            </div>
                            <h5 class="ts-price">$910.00</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Tour Place -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="tour-simple-wrap">
                    <div class="tour-simple-thumb">
                        <a href="tour-detail.html"><img src="https://via.placeholder.com/1200x800" class="img-fluid img-responsive" alt="" /></a>
                    </div>
                    <div class="tour-simple-caption">
                        <div class="ts-caption-left">
                            <h4 class="ts-title"><a href="tour-detail.html">Puerto Vallarta, Mexico</a></h4>
                            <span>5 Tour Package</span>
                        </div>
                        <div class="ts-caption-right">
                            <div class="ts-caption-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star"></i>
                            </div>
                            <h5 class="ts-price">$670.00</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- ========================= End Travel Section ============================ -->

<!-- ================= Activities start ========================= -->
{{-- <section class="gray">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="sec-heading center">
                    <p>Top Travel Activities</p>
                    <h2>New & featured Travel Activities</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="owl-carousel owl-theme" id="lists-slide">

                    <div class="single-item">
                        <div class="destination-item">
                            <span class="discount-off">-35%</span>
                            <figure class="destination-list-wrap">
                                <a class="destination-listlink" href="search.html">
                                    <img class="cover" src="https://via.placeholder.com/800x980" alt="room">
                                </a>
                            </figure>
                            <div class="destination-listdetails">
                                <span class="destination-list-cat theme-bg">Eat & Drinks</span>
                                <h4 class="title"><a class="title-ln" href="search.html">Machu Picchu, Peru</a></h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>

                    <div class="single-item">
                        <div class="destination-item">
                            <span class="discount-off">-50%</span>
                            <figure class="destination-list-wrap">
                                <a class="destination-listlink" href="search.html">
                                    <img class="cover" src="https://via.placeholder.com/800x980" alt="room">
                                </a>
                            </figure>
                            <div class="destination-listdetails">
                                <span class="destination-list-cat theme-bg">Adventures</span>
                                <h4 class="title"><a class="title-ln" href="search.html">Great Barrier Reef</a></h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>

                    <div class="single-item">
                        <div class="destination-item">
                            <span class="discount-off">-10%</span>
                            <figure class="destination-list-wrap">
                                <a class="destination-listlink" href="search.html">
                                    <img class="cover" src="https://via.placeholder.com/800x980" alt="room">
                                </a>
                            </figure>
                            <div class="destination-listdetails">
                                <span class="destination-list-cat theme-bg">Restaurants</span>
                                <h4 class="title"><a class="title-ln" href="search.html">Pyramids of Giza</a></h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>

                    <div class="single-item">
                        <div class="destination-item">
                            <span class="discount-off">-20%</span>
                            <figure class="destination-list-wrap">
                                <a class="destination-listlink" href="search.html">
                                    <img class="cover" src="https://via.placeholder.com/800x980" alt="room">
                                </a>
                            </figure>
                            <div class="destination-listdetails">
                                <span class="destination-list-cat theme-bg">Property & Rooms</span>
                                <h4 class="title"><a class="title-ln" href="search.html">Heritage of England</a></h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>

                    <div class="single-item">
                        <div class="destination-item">
                            <span class="discount-off">-30%</span>
                            <figure class="destination-list-wrap">
                                <a class="destination-listlink" href="search.html">
                                    <img class="cover" src="https://via.placeholder.com/800x980" alt="room">
                                </a>
                            </figure>
                            <div class="destination-listdetails">
                                <span class="destination-list-cat theme-bg">Hike & Ride</span>
                                <h4 class="title"><a class="title-ln" href="search.html">The City of Lights </a></h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section> --}}
<!-- ========================= End Activities Section ============================ -->

<!-- ================= Download App start ========================= -->
<section class="bg-image" style="background:#ff5722 url(assets/img/app-banner.png);">
    <div class="ht-80"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-5">
                <div class="app-stores-wrap">

                    <h2>Get the App</h2>
                    <p>Download the app and go to travel the world.</p>
                    <a href="#" class="btn btn-theme btn-black arrow-btn mr-1">App Store<span><i class="ti-apple"></i></span></a>
                    <a href="#" class="btn btn-theme btn-black arrow-btn">Google Play<span><i class="ti-android"></i></span></a>

                </div>
            </div>
        </div>
    </div>
    <div class="ht-80"></div>
</section>
<!-- ========================= End Download App Section ============================ -->


<!-- ================= Recent Blog start ========================= -->
{{-- <section class="min">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="sec-heading center">
                    <p>Recent Blogs</p>
                    <h2>Recent Blog & Articles</h2>
                </div>
            </div>
        </div>

        <div class="row align-items-center">

            <div class="col-lg-7 col-md-12">
                <div class="featured-hm-post">
                    <figure class="featured-hm-post-wrap">
                        <a href="blog-detail.html">
                            <img class="cover" src="https://via.placeholder.com/1280x800" alt="room">
                        </a>
                    </figure>
                    <div class="hm-post-caption">
                        <span class="cat theme-bg bg-1">Nature</span>
                        <h2 class="title"><a class="title-ln" href="room_details.html">Most Visit Places in Manali</a></h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        <a class="fmp-readmore theme-cl" href="">Read More<i class="ti-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <article class="small-hm-post">
                    <div class="small-hm-post-outer">
                        <div class="small-hm-inner">
                            <div class="small-hm-post-thumb">
                                <a href="#"><img src="https://via.placeholder.com/1280x800" class="img-responsive" alt="" /></a>
                            </div>
                        </div>

                        <div class="small-hm-inner">
                            <div class="small-hm-post-caption">
                                <ul class="post-categories">
                                    <li><a href="#" class="theme-cl">Lifestyle</a>
                                    </li>
                                </ul>
                                <h2 class="entry-title"><a href="blog-detail.html">The Best Travel Accessories for Designers</a></h2>
                                <ul class="post-meta">
                                    <li class="meta-author"><span class="author"><a class="url fn n" href="#">Joanna Wellick</a></span></li>
                                    <li class="meta-date"><a href="#" rel="bookmark">May 24, 2019</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </article>
                <article class="small-hm-post">
                    <div class="small-hm-post-outer">
                        <div class="small-hm-inner">
                            <div class="small-hm-post-thumb">
                                <a href="#"><img src="https://via.placeholder.com/1280x800" class="img-responsive" alt="" /></a>
                            </div>
                        </div>

                        <div class="small-hm-inner">
                            <div class="small-hm-post-caption">
                                <ul class="post-categories">
                                    <li><a href="#" class="theme-cl">Lifestyle</a>
                                    </li>
                                </ul>
                                <h2 class="entry-title"><a href="blog-detail.html">The Best Travel Accessories for Designers</a></h2>
                                <ul class="post-meta">
                                    <li class="meta-author"><span class="author"><a class="url fn n" href="#">Joanna Wellick</a></span></li>
                                    <li class="meta-date"><a href="#" rel="bookmark">May 24, 2019</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </article>
                <article class="small-hm-post">
                    <div class="small-hm-post-outer">
                        <div class="small-hm-inner">
                            <div class="small-hm-post-thumb">
                                <a href="#"><img src="https://via.placeholder.com/1280x800" class="img-responsive" alt="" /></a>
                            </div>
                        </div>

                        <div class="small-hm-inner">
                            <div class="small-hm-post-caption">
                                <ul class="post-categories">
                                    <li><a href="#" class="theme-cl">Lifestyle</a>
                                    </li>
                                </ul>
                                <h2 class="entry-title"><a href="blog-detail.html">The Best Travel Accessories for Designers</a></h2>
                                <ul class="post-meta">
                                    <li class="meta-author"><span class="author"><a class="url fn n" href="#">Joanna Wellick</a></span></li>
                                    <li class="meta-date"><a href="#" rel="bookmark">May 24, 2019</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </article>
            </div>

        </div>

    </div>
</section> --}}
@endsection
