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
                            <li><a href="#">support@gimanhal.com</a></li>
                        </ul>
                    </div>

                    <div class="topbar-right">
                        <ul class="tp-list">
                            <li><a href="#">076 553 6774</a></li>
                        </ul class="tp-list">
                        <ul class="tp-list ml-2">
                            @if (Auth::check())
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                    <span class="ml-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"> Logout</span>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                            @else
                            <li><a href="#login" data-toggle="modal">Login</a></li>
                            <li><a  data-toggle="modal" href="#signup" data-target="#signup">Sign Up</a></li>
                            @endif

                        </ul>
                        {{-- <ul class="tp-list nbr ml-2">
                            <li class="dropdown dropdown-currency hidden-xs hidden-sm">
                                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">USD<i class="ml-1 fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu mlix-wrap">
                                    <li><a href="#">EUR</a>
                                    </li>
                                    <li><a href="#">AUD</a></li>
                                </ul>
                            </li>
                        </ul> --}}
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
                    <img src="{{ URL('assets/img/logo.png') }}" class="logo" alt="gimanhal logo" />
                </a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">

                    <li class="{{ Request::path() ==  '/' ? 'active' : '' }}"><a href="{{ URL('/') }}">Home<span class="submenu-indicator"></span></a>
                    </li>

                    <li class="{{ Request::path() ==  'properties/list/all' ? 'active' : '' }}"><a href="{{ URL('properties/list/all') }}">Properties<span class="submenu-indicator"></span></a>
                    </li>

                    <!-- <li><a href="JavaScript:Void(0);">Pages<span class="submenu-indicator"></span></a>
                        <ul class="nav-dropdown nav-submenu">
                            <li><a href="{{ URL('/about_us') }}">About Us</a></li>
                            <li><a href="blog.html">Blog Page</a></li>
                            <li><a href="faq.html">FAQ Page</a></li>
                            <li><a href="contact.html">Get in Touch</a></li>
                            <li><a href="404.html">Error Page</a></li>
                            <li><a href="elements.html">Elements</a></li>
                        </ul>
                    </li> -->
                    {{-- <li><a href="JavaScript:Void(0);">Properties<span class="submenu-indicator"></span></a>
                        <ul class="nav-dropdown nav-submenu">
                            <li><a href="#">Tour Listing<span class="submenu-indicator"></span></a>
                                <ul class="nav-dropdown nav-submenu">
                                    <li><a href="tour-list-sidebar.html">List Layout Sidebar</a></li>
                                    <li><a href="tour-grid-sidebar.html">Grid Layout Sidebar</a></li>
                                    <li><a href="tour-detail.html">Tour Detail</a></li>
                                </ul>
                            </li>
                            <li><a href="JavaScript:Void(0);">Property Listing<span class="submenu-indicator"></span></a>
                                <ul class="nav-dropdown nav-submenu">
                                    <li><a href="{{ URL('/property_details') }}">property Detail</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ URL('properties/list/all') }}">property List</a>
                            </li>
                        </ul>
                    </li> --}}
                    <li class="{{ Request::path() ==  'contact' ? 'active' : '' }}">
                        <a href="{{ URL('/contact') }}">Contact</a>
                    </li>

                </ul>

                <ul class="nav-menu nav-menu-social align-to-right">

                    <li class="add-listing theme-bg"><a href="{{ URL('properties/list/all') }}">Book Now</a></li>

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
