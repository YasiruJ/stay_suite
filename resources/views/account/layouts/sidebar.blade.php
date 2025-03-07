<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ URL('/admin/dashboard') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-google-pages"></i>
                        <span> Properties </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ URL('admin/properties/add') }}">Add Property</a></li>
                        <li><a href="{{ URL('admin/properties/all') }}">All properties</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(1);">
                        <i class="mdi mdi-google-pages"></i>
                        <span> Booking </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ URL('admin/booking/add') }}">Add Booking</a></li>
                        <li><a href="{{ URL('admin/booking/all') }}">All Booking</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(1);">
                        <i class="mdi mdi-google-pages"></i>
                        <span> System Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ URL('admin/system_settings/locations') }}">Locations</a></li>
                        <li><a href="{{ URL('admin/system_settings/property_facilities') }}">Property Facilities</a></li>
                        <li><a href="{{ URL('admin/system_settings/room_facilities') }}">Room Facilities</a></li>
                        <li><a href="{{ URL('admin/system_settings/room_type') }}">Room Type</a></li>
                        <li><a href="{{ URL('admin/system_settings/property_type') }}">Property Type</a></li>
                        <li><a href="{{ URL('admin/system_settings/bed_type') }}">Bed Type</a></li>
                        <li><a href="{{ URL('admin/system_settings/credit_card_type') }}">Credit Card</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(2);">
                        <i class="mdi mdi-google-pages"></i>
                        <span>property Owner</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ URL('admin/property_owner/add') }}">Add Owner</a></li>
                        <li><a href="{{ URL('admin/property_owner/all') }}">All Property Owners</a></li>
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(2);">
                        <i class="mdi mdi-google-pages"></i>
                        <span>Offers</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ URL('admin/offer/add') }}">Add Offers</a></li>
                        <li><a href="{{ URL('admin/offer/all') }}">All Offers</a></li>
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(2);">
                        <i class="mdi mdi-google-pages"></i>
                        <span>Review Management</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ URL('admin/offer/add') }}">Add Review</a></li>
                        <li><a href="{{ URL('admin/offer/all') }}">All Offers</a></li>
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(2);">
                        <i class="mdi mdi-google-pages"></i>
                        <span>User Management</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ URL('admin/user_management/property_owner/details') }}">Property Owner</a></li>
                        <li><a href="{{ URL('admin/user_management/customer/details') }}">Customer</a></li>
                        <li><a href="{{ URL('admin/user_management/call_center/details') }}">Call-Center</a></li>
                        <li><a href="{{ URL('admin/user_management/referral_user/details') }}">Referral-User</a></li>
                    </ul>

                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
