<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ URL('/property-owner/dashboard') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                {{-- <li>
                    <a href="{{ URL('/property-owner/booking-availability') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Booking Availability </span>
                    </a>
                </li> --}}

                <li>
                    <a href="{{ URL('property-owner/properties/all') }}">
                        <i class="mdi mdi-google-pages"></i>
                        <span> Properties </span>
                    </a>
                </li>
                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-google-pages"></i>
                        <span> Properties </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ URL('property-owner/properties/add') }}">Add Property</a></li>
                        <li><a href="{{ URL('property-owner/properties/all') }}">All properties</a></li>
                    </ul>
                </li> --}}

                <li>
                    <a href="{{ URL('property-owner/bookings/all') }}">
                        <i class="mdi mdi-google-pages"></i>
                        <span> Bookings </span>
                    </a>
                </li>

                <li>
                    <a href="{{ URL('property-owner/payments/all') }}">
                        <i class="mdi mdi-google-pages"></i>
                        <span> Payments </span>
                    </a>
                </li>
                {{-- <li>
                    <a href="javascript: void(2);">
                        <i class="mdi mdi-google-pages"></i>
                        <span>Offers</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="#">Add Offers</a></li>
                        <li><a href="#">All Offers</a></li>
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(2);">
                        <i class="mdi mdi-google-pages"></i>
                        <span>Review Management</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <!-- <li><a href="{{ URL('admin/offer/add') }}">Add Review</a></li> -->
                        <li><a href="{{ URL('property-owner/review/all') }}">All Reviews</a></li>
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(2);">
                        <i class="mdi mdi-google-pages"></i>
                        <span>FAQ</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ URL('property-owner/FAQs/properties/all') }}">All FAQ</a></li>
                    </ul>

                </li> --}}
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
