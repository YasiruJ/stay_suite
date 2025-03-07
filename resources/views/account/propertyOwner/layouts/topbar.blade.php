<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ URL('dashboard_assets/images/users/avatar-1.jpg') }}" alt="user-image" class="rounded-circle">
                <span class="d-none d-sm-inline-block ml-1 font-weight-medium">{{ Auth::user()->username }}</span>
                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                <!-- item-->
                {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-settings-outline"></i>
                    <span>Settings</span>
                </a> --}}

                <div class="dropdown-divider"></div>

                <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout-variant"></i>
                    <span class="ml-2" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"> Logout</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>

            </div>
        </li>


    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="index.html" class="logo text-center logo-dark">
                        <span class="logo-lg">
                            <img src="{{ URL('dashboard_assets/images/logo.png') }}" alt="" height="22">
                            <!-- <span class="logo-lg-text-dark">Gimanhal</span> -->
                        </span>
            <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">U</span> -->
                            <img src="{{ URL('dashboard_assets/images/logo-sm.jpg') }}" alt="" height="24">
                        </span>
        </a>

        <a href="index.html" class="logo text-center logo-light">
                        <span class="logo-lg">
                            <img src="{{ URL('dashboard_assets/images/logo.png') }}" alt="" height="22">
                            <!-- <span class="logo-lg-text-dark">Gimanhal</span> -->
                        </span>
            <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">U</span> -->
                            <img src="{{ URL('dashboard_assets/images/logo-sm.jpg') }}" alt="" height="24">
                        </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>

        {{-- <li class="d-none d-sm-block">
            <form class="app-search">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </li> --}}

        {{-- <li class="dropdown dropdown-mega d-none d-lg-block">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                Mega Menu
                <i class="mdi mdi-chevron-down"></i>
            </a>
            <div class="dropdown-menu dropdown-megamenu p-0">
                <div class="row">
                    <div class="col-sm-5">

                        <div class="p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="font-16 mt-0"><i class="mdi mdi-toolbox-outline mr-1"></i> UI Components</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);">Widgets</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Calendar</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Range Sliders</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Sweet Alerts</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Ratings</a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0);">Treeview Page</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Tour Page</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="font-16 mt-0"><i class="mdi mdi-flip-horizontal mr-1"></i> Layouts</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);">Dark Sidebar</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Small Sidebar</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Sidebar Collapsed</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Unsticky Layout</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Boxed Layout</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Topbar Light</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="p-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <div>
                                                    <i class="fab fa-bootstrap text-purple h2 mb-0"></i>
                                                </div>
                                                <h5 class="font-16">Bootstrap</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center mt-4 mt-md-0">
                                                <div>
                                                    <i class="fab fa-npm text-danger h2 mb-0"></i>
                                                </div>
                                                <h5 class="font-16">Npm</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center mt-4 mt-md-0">
                                                <div>
                                                    <i class="fab fa-sass text-pink h2 mb-0"></i>
                                                </div>
                                                <h5 class="font-16">Sass support</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="text-center mt-4">
                                                <div>
                                                    <i class="fas fa-tablet-alt text-dark h2 mb-0"></i>
                                                </div>
                                                <h5 class="font-16">Responsive</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center mt-4">
                                                <div>
                                                    <i class="fab fa-gulp text-primary h2 mb-0"></i>
                                                </div>
                                                <h5 class="font-16">Gulp Support</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center mt-4">
                                                <div>
                                                    <i class="far fa-file-code text-warning h2 mb-0"></i>
                                                </div>
                                                <h5 class="font-16">Free Landing</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="text-center">
                                    <div class="p-4">
                                        <h4 class="mt-0">Special Discount Sale!</h4>
                                        <h5 class="mt-4">Save up to <span class="text-primary">60%</span> off.</h5>
                                        <p class="text-muted">Get free updates lifetime</p>
                                        <a href="https://1.envato.market/XY7j5" target="_blank" class="btn btn-primary btn-rounded">Download Now</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </li> --}}
    </ul>
</div>
<!-- end Topbar -->
