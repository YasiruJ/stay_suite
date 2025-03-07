<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Gimanhal - The finest hotels at the best price</title>
    <meta name="title" content="Gimanhal">
    <meta name="keywords" content="gimanhal,booking,rooms,offers,hotel offers">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="The finest hotels at the best price.Sri Lanka's Largest Travel Platform.Browse thousands of Hotel offers from one place">
    <!-- All Plugins Css -->
    <link rel="stylesheet" href="{{ URL('assets/css/plugins.css') }}">
    <!-- Custom CSS -->
    <link href="{{ URL('assets/css/styles.css') }}" rel="stylesheet">
    <!-- Custom Color Option -->
    <link href="{{ URL('assets/css/colors.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">

</head>
<body class="orange-skin">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <div class="gray">
            @include('home.layouts.header')
            <div class="container">
                <div class="row equal">
                    <div class="col-md-7">
                        <img src="{{ URL('assets/img/login_img.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-5 my-auto">
                        <div class="container">
                            <h4 class="modal-header-title">Log <span class="theme-cl">In</span></h4>
                            <div class="login-form">
                                <form method="POST" action="{{ route('login') }}?returnURL={{ url()->previous() }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-with-icon">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="input-with-icon">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md full-width pop-login">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-divider"><span>Or login via</span></div>
                            <div class="social-login mb-3">
                                <ul>
                                    <li><a href="#" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
                                    <li><a href="#" class="btn connect-twitter"><i class="ti-twitter"></i>Twitter</a></li>
                                </ul>
                            </div>
                            <div class="text-center">
                                <p class="mt-5"><a href="#" class="link">Forgot password?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('home.layouts.footer')
        </div>
        <!-- End Modal -->
        <!-- End Modal -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>

    <script src="{{ URL('assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL('assets/js/circleMagic.min.js') }}"></script>
    <script src="{{ URL('assets/js/popper.min.js') }}"></script>
    <script src="{{ URL('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL('assets/js/rangeslider.js') }}"></script>
    <script src="{{ URL('assets/js/select2.min.js') }}"></script>
    <script src="{{ URL('assets/js/aos.js') }}"></script>
    <script src="{{ URL('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ URL('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ URL('assets/js/slick.js') }}"></script>
    <script src="{{ URL('assets/js/slider-bg.js') }}"></script>
    <script src="{{ URL('assets/js/lightbox.js') }}"></script>
    <script src="{{ URL('assets/js/imagesloaded.js') }}"></script>
    <script src="{{ URL('assets/js/isotope.min.js') }}"></script>

    <script src="{{ URL('assets/js/custom.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->

    <!-- Date Booking Script -->
    <script src="{{ URL('assets/js/moment.min.js') }}"></script>
    <script src="{{ URL('assets/js/daterangepicker.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>

</body>

</html>
