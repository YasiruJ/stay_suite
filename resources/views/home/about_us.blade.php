<!DOCTYPE html>
<html lang="zxx">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Travlio - Tour & Travel Agency HTML Template</title>

        <!-- All Plugins Css -->
        <link rel="stylesheet" href="{{ URL('assets/css/plugins.css') }}">


        <!-- Custom CSS -->
        <link href="{{ URL('assets/css/styles.css') }}" rel="stylesheet">

		<!-- Custom Color Option -->
		<link href="{{ URL('assets/css/colors.css') }}" rel="stylesheet">

    </head>

    <body class="orange-skin">

		 <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>

        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">

            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            <!-- Start Navigation -->
			<div class="topbar-head">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="topbar-wrap">

								<div class="topbar-left">
									<ul class="tp-list">
										<li><a href="#"><i class="ti-facebook"></i></a></li>
										<li><a href="#"><i class="ti-twitter"></i></a></li>
										<li><a href="#"><i class="ti-instagram"></i></a></li>
									</ul>
									<ul class="tp-list ml-2 nbr">
										<li><a href="#">support@bookly.com</a></li>
									</ul>
								</div>

								<div class="topbar-right">
									<ul class="tp-list">
										<li><a href="#">(41) 123 548 548</a></li>
									</ul class="tp-list">
									<ul class="tp-list ml-2">
										<li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
										<li><a href="#" data-toggle="modal" data-target="#signup">Sign Up</a></li>
									</ul>
									<ul class="tp-list nbr ml-2">
										<li class="dropdown dropdown-currency hidden-xs hidden-sm">
											<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">USD<i class="ml-1 fa fa-angle-down"></i></a>
											<ul class="dropdown-menu mlix-wrap">
												<li><a href="#">EUR</a>
												</li><li><a href="#">AUD</a></li>
											</ul>
										</li>
									</ul>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header header-light">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<a class="nav-brand" href="#">
								<img src="assets/img/logo.png" class="logo" alt="" />
							</a>
							<div class="nav-toggle"></div>
						</div>
						<div class="nav-menus-wrapper" style="transition-property: none;">
							<ul class="nav-menu">

								<li class="active"><a href="JavaScript:Void(0);">Home<span class="submenu-indicator"></span></a>
									<ul class="nav-dropdown nav-submenu">
										<li><a href="index.html">Home Style 1</a></li>
										<li><a href="home-2.html">Home Style 2</a></li>
										<li><a href="home-3.html">Home Style 3</a></li>
										<li><a href="home-4.html">Home Style 4</a></li>
										<li><a href="home-5.html">Home Style 5</a></li>
										<li><a href="home-6.html">Home Style 6</a></li>
										<li><a href="home-7.html">Home Style 7</a></li>
										<li><a href="video.html">Video Home</a></li>
									</ul>
								</li>

								<li><a href="JavaScript:Void(0);">Browse<span class="submenu-indicator"></span></a>
									<ul class="nav-dropdown nav-submenu">
										<li><a href="#">Tour Listing<span class="submenu-indicator"></span></a>
											<ul class="nav-dropdown nav-submenu">
												<li><a href="tour-list-sidebar.html">List Layout Sidebar</a></li>
												<li><a href="tour-grid-sidebar.html">Grid Layout Sidebar</a></li>
												<li><a href="tour-detail.html">Tour Detail</a></li>
											</ul>
										</li>
										<li><a href="JavaScript:Void(0);">Hotel Listing<span class="submenu-indicator"></span></a>
											<ul class="nav-dropdown nav-submenu">
												<li><a href="property-list-sidebar.html">List Layout Sidebar</a></li>
												<li><a href="property-list-sidebar-2.html.html">List Layout 2 Sidebar</a></li>
												<li><a href="property-grid-sidebar.html">Grid Layout Sidebar</a></li>
												<li><a href="property-detail.html">property Detail</a></li>
											</ul>
										</li>
										<li>
											<a href="map-search.html">Half Map Screen</a>
										</li>
										<li><a href="JavaScript:Void(0);">Dashboard<span class="submenu-indicator"></span></a>
											<ul class="nav-dropdown nav-submenu">
												<li><a href="dashboard.html">Dashboard Home</a></li>
												<li><a href="my-booking.html">My Booking</a></li>
												<li><a href="my-profile.html">My Profile</a></li>
												<li><a href="bookmark-list.html">Bookmark List</a></li>
												<li><a href="checkout.html">Checkout Page</a></li>
												<li><a href="dashboard-invoice.html">Dashboard Invoice</a></li>
											</ul>
										</li>
									</ul>
								</li>

								<li><a href="JavaScript:Void(0);">Pages<span class="submenu-indicator"></span></a>
									<ul class="nav-dropdown nav-submenu">
										<li><a href="about-us.html">About Us</a></li>
										<li><a href="blog.html">Blog Page</a></li>
										<li><a href="faq.html">FAQ Page</a></li>
										<li><a href="contact.html">Get in Touch</a></li>
										<li><a href="404.html">Error Page</a></li>
										<li><a href="elements.html">Elements</a></li>
									</ul>
								</li>

								<li>
									<a href="contact.html">Contact</a>
								</li>

							</ul>

							<ul class="nav-menu nav-menu-social align-to-right">

								<li><a href="#" data-toggle="modal" data-target="#login"><i class="fas fa-user-circle text-info mr-1"></i>Log In</a></li>
								<li><a href="#" data-toggle="modal" data-target="#signup"><i class="fas fa-arrow-alt-circle-right text-warning mr-1"></i>Sign Up</a></li>
								<li class="login-attri">
									<div class="btn-group account-drop">
										<button type="button" class="btn btn-order-by-filt theme-cl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="ti-shopping-cart-full"></i>
											<span class="cart-count">3</span>
										</button>
										<div class="dropdown-menu p-0 dm-lg pull-right animated flipInX">
											<div class="cart-card">
												<div class="cart-card-header">
													<h4>Your Cart</h4>
												</div>

												<div class="cart-card-body">

													<!-- Single Cart Wrap -->
													<div class="single-cart-wrap">
														<a href="#" class="cart-close"><i class="ti-close"></i></a>
														<div class="single-cart-thumb">
															<img src="assets/img/hotel/hotel-1.jpg" alt=""/>
														</div>
														<div class="single-cart-detail">
															<h3 class="sc-title">Goa To Mumbai</h3>
															<span><i class="ti-location-pin mr-1"></i>Canada</span>
															<h4 class="sc-price theme-cl">$120</h4>
														</div>
													</div>

													<!-- Single Cart Wrap -->
													<div class="single-cart-wrap">
														<a href="#" class="cart-close"><i class="ti-close"></i></a>
														<div class="single-cart-thumb">
															<img src="assets/img/hotel/hotel-1.jpg" alt=""/>
														</div>
														<div class="single-cart-detail">
															<h3 class="sc-title">Goa To Mumbai</h3>
															<span><i class="ti-location-pin mr-1"></i>Canada</span>
															<h4 class="sc-price theme-cl">$120</h4>
														</div>
													</div>

													<!-- Single Cart Wrap -->
													<div class="single-cart-wrap">
														<a href="#" class="cart-close"><i class="ti-close"></i></a>
														<div class="single-cart-thumb">
															<img src="assets/img/hotel/hotel-1.jpg" alt=""/>
														</div>
														<div class="single-cart-detail">
															<h3 class="sc-title">Goa To Mumbai</h3>
															<span><i class="ti-location-pin mr-1"></i>Canada</span>
															<h4 class="sc-price theme-cl">$120</h4>
														</div>
													</div>

												</div>

												<div class="cart-card-footer">
													<a href="#" class="btn btn-theme">Go To Checkout</a>
													<h4 class="totla-prc">$516</h4>
												</div>

											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->

			<!-- ============================ Page Title Start================================== -->
			<div class="image-cover page-title" style="background:url(https://via.placeholder.com/1920x900) no-repeat;" data-overlay="6">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">

							<h2 class="ipt-title">About Us</h2>
							<span class="ipn-subtitle text-light">Who we are & our mission</span>

						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->

			<!-- ============================ Our Story Start ================================== -->
			<section>

				<div class="container">

					<!-- row Start -->
					<div class="row align-items-center">

						<div class="col-lg-6 col-md-6">
							<img src="https://via.placeholder.com/600x800" class="img-fluid" alt="" />
						</div>

						<div class="col-lg-6 col-md-6">
							<div class="story-wrap explore-content">

								<span class="ipn-subtitle">Our Company</span>
								<h2>Mission statement</h2>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>

							</div>
						</div>

					</div>
					<!-- /row -->

				</div>

			</section>
			<!-- ============================ Our Story End ================================== -->

			<!-- ================= Our Team================= -->
			<section class="pt-0">
				<div class="container">

					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<h2>Meet Our Team</h2>
								<p>Professional & Dedicated Team</p>
							</div>
						</div>
					</div>

					<div class="row">

						<!-- Single Teamm -->
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="team-grid">

								<div class="teamgrid-user">
									<img src="https://via.placeholder.com/400x400" alt="" class="img-fluid" />
								</div>

								<div class="teamgrid-content">
									<h4>Shaurya Preet</h4>
									<span>Co-Founder</span>
								</div>

								<div class="teamgrid-social">
									<ul>
										<li><a href="#" class="f-cl"><i class="ti-facebook"></i></a></li>
										<li><a href="#" class="t-cl"><i class="ti-twitter"></i></a></li>
										<li><a href="#" class="i-cl"><i class="ti-instagram"></i></a></li>
										<li><a href="#" class="l-cl"><i class="ti-linkedin"></i></a></li>
									</ul>
								</div>

							</div>
						</div>

						<!-- Single Teamm -->
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="team-grid">

								<div class="teamgrid-user">
									<img src="https://via.placeholder.com/400x400" alt="" class="img-fluid" />
								</div>

								<div class="teamgrid-content">
									<h4>Shivangi Preet</h4>
									<span>Content Writer</span>
								</div>

								<div class="teamgrid-social">
									<ul>
										<li><a href="#" class="f-cl"><i class="ti-facebook"></i></a></li>
										<li><a href="#" class="t-cl"><i class="ti-twitter"></i></a></li>
										<li><a href="#" class="i-cl"><i class="ti-instagram"></i></a></li>
										<li><a href="#" class="l-cl"><i class="ti-linkedin"></i></a></li>
									</ul>
								</div>

							</div>
						</div>

						<!-- Single Teamm -->
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="team-grid">

								<div class="teamgrid-user">
									<img src="https://via.placeholder.com/400x400" alt="" class="img-fluid" />
								</div>

								<div class="teamgrid-content">
									<h4>Yash Preet</h4>
									<span>Content Writer</span>
								</div>

								<div class="teamgrid-social">
									<ul>
										<li><a href="#" class="f-cl"><i class="ti-facebook"></i></a></li>
										<li><a href="#" class="t-cl"><i class="ti-twitter"></i></a></li>
										<li><a href="#" class="i-cl"><i class="ti-instagram"></i></a></li>
										<li><a href="#" class="l-cl"><i class="ti-linkedin"></i></a></li>
									</ul>
								</div>

							</div>
						</div>

						<!-- Single Teamm -->
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="team-grid">

								<div class="teamgrid-user">
									<img src="https://via.placeholder.com/400x400" alt="" class="img-fluid" />
								</div>

								<div class="teamgrid-content">
									<h4>Dhananjay Preet</h4>
									<span>CEO & Manager</span>
								</div>

								<div class="teamgrid-social">
									<ul>
										<li><a href="#" class="f-cl"><i class="ti-facebook"></i></a></li>
										<li><a href="#" class="t-cl"><i class="ti-twitter"></i></a></li>
										<li><a href="#" class="i-cl"><i class="ti-instagram"></i></a></li>
										<li><a href="#" class="l-cl"><i class="ti-linkedin"></i></a></li>
									</ul>
								</div>

							</div>
						</div>

						<!-- Single Teamm -->
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="team-grid">

								<div class="teamgrid-user">
									<img src="https://via.placeholder.com/400x400" alt="" class="img-fluid" />
								</div>

								<div class="teamgrid-content">
									<h4>Rahul Gilkrist</h4>
									<span>App Designer</span>
								</div>

								<div class="teamgrid-social">
									<ul>
										<li><a href="#" class="f-cl"><i class="ti-facebook"></i></a></li>
										<li><a href="#" class="t-cl"><i class="ti-twitter"></i></a></li>
										<li><a href="#" class="i-cl"><i class="ti-instagram"></i></a></li>
										<li><a href="#" class="l-cl"><i class="ti-linkedin"></i></a></li>
									</ul>
								</div>

							</div>
						</div>

						<!-- Single Teamm -->
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="team-grid">

								<div class="teamgrid-user">
									<img src="https://via.placeholder.com/400x400" alt="" class="img-fluid" />
								</div>

								<div class="teamgrid-content">
									<h4>Adam Wilcard</h4>
									<span>Web Developer</span>
								</div>

								<div class="teamgrid-social">
									<ul>
										<li><a href="#" class="f-cl"><i class="ti-facebook"></i></a></li>
										<li><a href="#" class="t-cl"><i class="ti-twitter"></i></a></li>
										<li><a href="#" class="i-cl"><i class="ti-instagram"></i></a></li>
										<li><a href="#" class="l-cl"><i class="ti-linkedin"></i></a></li>
									</ul>
								</div>

							</div>
						</div>

					</div>
				</div>
			</section>
			<!-- =============================== Our Team ================================== -->


			{{-- <!-- ============================ Newsletter Start ================================== -->
			<section class="alert-wrap pt-5 pb-5" style="background:#ff5722 url(assets/img/bg-new.png);">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="jobalert-sec">
								<h3 class="mb-1 text-light">Get New Jobs Notification!</h3>
								<p class="text-light">Subscribe & get all related jobs notification.</p>
							</div>
						</div>

						<div class="col-lg-6 col-md-6">
							<div class="input-group">
							  <input type="text" class="form-control" placeholder="Enter Your Email">
							  <div class="input-group-append">
								<button type="button" class="btn btn-black black">Subscribe</button>
							  </div>
							</div>
						</div>
					</div>
				</div>
			</section> --}}
			<!-- ============================ Newsletter Start ================================== -->

			<!-- ============================ Footer Start ================================== -->
			<footer class="light-footer skin-light-footer">
				<div>
					<div class="container">
						<div class="row">

							<div class="col-lg-3 col-md-3">
								<div class="footer-widget">
									<img src="assets/img/logo.png" class="img-footer" alt="" />
									<div class="footer-add">
										<p><strong>Email:</strong></br><a href="#">hello@workstock.com</a></p>
										<p><strong>Call:</strong></br>91 855 742 62548</p>
										<ul class="footer-bottom-social mt-2">
											<li><a href="#"><i class="ti-facebook"></i></a></li>
											<li><a href="#"><i class="ti-twitter"></i></a></li>
											<li><a href="#"><i class="ti-instagram"></i></a></li>
											<li><a href="#"><i class="ti-linkedin"></i></a></li>
										</ul>
									</div>

								</div>
							</div>
							<div class="col-lg-2 col-md-3">
								<div class="footer-widget">
									<h4 class="widget-title">Navigations</h4>
									<ul class="footer-menu">
										<li><a href="video.html">Video Home Page</a></li>
										<li><a href="#">Browse Candidates</a></li>
										<li><a href="#">Browse Employers</a></li>
										<li><a href="#">Advance Search</a></li>
										<li><a href="#">Job With Map</a></li>
									</ul>
								</div>
							</div>

							<div class="col-lg-2 col-md-3">
								<div class="footer-widget">
									<h4 class="widget-title">The Highlights</h4>
									<ul class="footer-menu">
										<li><a href="#">Home Page 2</a></li>
										<li><a href="#">Home Page 3</a></li>
										<li><a href="#">Home Page 4</a></li>
										<li><a href="#">Home Page 5</a></li>
										<li><a href="#">LogIn</a></li>
									</ul>
								</div>
							</div>

							<div class="col-lg-2 col-md-3">
								<div class="footer-widget">
									<h4 class="widget-title">My Account</h4>
									<ul class="footer-menu">
										<li><a href="#">Dashboard</a></li>
										<li><a href="#">Applications</a></li>
										<li><a href="#">Packages</a></li>
										<li><a href="#">resume.html</a></li>
										<li><a href="#">SignUp Page</a></li>
									</ul>
								</div>
							</div>

							<div class="col-lg-3 col-md-12">
								<div class="footer-widget">
									<h4 class="widget-title">Download Apps</h4>
									<a href="#" class="other-store-link">
										<div class="other-store-app">
											<div class="os-app-icon">
												<i class="ti-android theme-cl"></i>
											</div>
											<div class="os-app-caps">
												Google Play
												<span>Get It Now</span>
											</div>
										</div>
									</a>
									<a href="#" class="other-store-link">
										<div class="other-store-app">
											<div class="os-app-icon">
												<i class="ti-apple theme-cl"></i>
											</div>
											<div class="os-app-caps">
												App Store
												<span>Now it Available</span>
											</div>
										</div>
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="footer-bottom">
					<div class="container">
						<div class="row align-items-center">

							<div class="col-lg-6 col-md-6">
								<p class="mb-0">© 2020 Travlio. Designd By Pixel Experts. All Rights Reserved</p>
							</div>

							<div class="col-lg-6 col-md-6 text-right">
								<img src="assets/img/payment.svg" class="img-fluid" alt="" />
							</div>

						</div>
					</div>
				</div>
			</footer>
			<!-- ============================ Footer End ================================== -->

			<!-- Log In Modal -->
			<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Log In</h5>
					<span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
				  </div>
				  <div class="modal-body icon-form">
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
							<li><a href="#" class="btn connect-google"><i class="ti-google"></i>Google</a></li>
							<li><a href="#" class="btn connect-twitter"><i class="ti-twitter"></i>Twitter</a></li>
						</ul>
					</div>
					<div class="text-center">
						<p class="mt-3"><a href="#" class="link">Forgot password?</a></p>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<!-- End Modal -->

			<!-- Sign Up Modal -->
			<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel1">Create An Account</h5>
					<span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
				  </div>
				  <div class="modal-body icon-form">
					<div class="login-form">
						<form>

							<div class="form-group">
								<label>Full Name</label>
								<div class="input-with-icon">
									<input type="text" class="form-control" placeholder="Full Name">
									<i class="ti-user"></i>
								</div>
							</div>

							<div class="form-group">
								<label>Email ID</label>
								<div class="input-with-icon">
									<input type="text" class="form-control" placeholder="Email ID">
									<i class="ti-email"></i>
								</div>
							</div>

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
							<li><a href="#" class="btn connect-google"><i class="ti-google"></i>Google</a></li>
							<li><a href="#" class="btn connect-twitter"><i class="ti-twitter"></i>Twitter</a></li>
						</ul>
					</div>
					<div class="text-center">
						<p class="mt-3">Already Have an Account? <a href="#" class="link">Login</a></p>
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

        <script src="{{ URL('assets/js/custom.js') }}"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->

        <!-- Date Booking Script -->
        <script src="{{ URL('assets/js/moment.min.js') }}"></script>
        <script src="{{ URL('assets/js/daterangepicker.js') }}"></script>

	</body>
</html>
