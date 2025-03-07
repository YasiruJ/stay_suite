<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL('assets/css/jquery-confirm.css') }}" />
    <title>Travlio - Tour & Travel Agency HTML Template</title>

    <!-- All Plugins Css -->
    <link rel="stylesheet" href="{{ URL('assets/css/plugins.css') }}">



    <!-- Custom CSS -->
    <link href="{{ URL('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Custom Color Option -->
    <link href="{{ URL('assets/css/colors.css') }}" rel="stylesheet">

</head>

<body class="goodred-skin">
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

        <!-- ============================================================== -->
        <!-- Top header  -->

        <!-- ============================================================== -->
        <!-- Start Navigation -->
        @include('home.layouts.header');
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->

        <!-- ============================ Page Title Start================================== -->
        @include('home.customer.layouts.page_title');
        <!-- ============================ Page Title End ================================== -->

        <!-- ============================ Dashboard Start ================================== -->
        <section class="gray">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        @include('home.customer.layouts.slide_bar');
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12">
                        @yield('content');
                    </div>
                </div>
            </div>
        </section>


        <!-- ============================ Dashboard End ================================== -->

        <!-- ============================ Footer Start ================================== -->
        @include('home.customer.layouts.footer');
        <!-- ============================ Footer End ================================== -->

        <!-- Log In Modal -->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content" id="registermodal">
                    <span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <h4 class="modal-header-title">Log <span class="theme-cl">In</span></h4>
                        <div class="login-form">
                            <form>

                                <div class="form-group">
                                    <label>User Name</label>
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control" placeholder="Username">
                                        <i class="ti-user"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-with-icon">
                                        <input type="password" class="form-control" placeholder="*******">
                                        <i class="ti-unlock"></i>
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
        <!-- End Modal -->

        <!-- Sign Up Modal -->
        <div class="modal fade signup" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content" id="sign-up">
                    <span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <h4 class="modal-header-title">Sign <span class="theme-cl">Up</span></h4>
                        <div class="login-form">
                            <form>

                                <div class="row">

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" placeholder="First name">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" placeholder="Last name">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" placeholder="Username">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="email" class="form-control" placeholder="Email">
                                                <i class="ti-email"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="password" class="form-control" placeholder="Password">
                                                <i class="ti-unlock"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <input type="password" class="form-control" placeholder="Confirm Password">
                                                <i class="ti-unlock"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-md full-width pop-login">Sign Up</button>
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
                            <p class="mt-5"><i class="ti-user mr-1"></i>Already Have An Account? <a href="#" class="link">Go For LogIn</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>



    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
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
    <script src="{{ URL('assets/js/jquery-confirm.js') }}"></script>
    <script src="{{ URL('assets/js/custom.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->

    <!-- Date Booking Script -->
    <script src="{{ URL('assets/js/moment.min.js') }}"></script>
    <script src="{{ URL('assets/js/daterangepicker.js') }}"></script>

    @yield('scripts')

</body>

</html>

<!-- this is the test stage commit -->