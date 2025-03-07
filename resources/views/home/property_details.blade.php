@extends('home.layouts.master')
@section('styles')
    <!-- Custom CSS -->
    <link href="{{ URL('assets/css/review.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- ============================ Hero Banner  Start================================== -->
    <!-- <div class="featured-slick">
            <div class="featured-slick-slide">
                <div><a href="" class="mfp-gallery"><img src="{{ URL('storage/property_image/' . $property->main_image) }}" class="img-fluid mx-auto" alt="" style="object-fit: contain;" /></a></div>
                @foreach ($property_images as $property_image)
    <div><a href="http://via.placeholder.com/1280x800" class="mfp-gallery"><img src="{{ URL('storage/property_image/property_sub_images/' . $property_image->name) }}" style="object-fit: contain;" class="img-fluid mx-auto" alt="" /></a></div>
    @endforeach
            </div>
        </div> -->
    <!-- ============================ Hero Banner End ================================== -->
    <!-- ============================ Property Detail Start ================================== -->
    <div class="container">
        <div class="st-hotel-header">
            <div class="left">
                <div class="st-stars">
                    @for ($i = 0; $i < $property->star_rating; $i++)
                        <i class="fa fa-star"></i>
                    @endfor
                </div>
                <h2 class="st-heading">{{ $property->name }}</h2>
                <div class="sub-heading"> <i class="input-icon field-icon fa"><svg width="16px" height="16px"
                            viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g id="Ico_maps" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                stroke-linecap="round" stroke-linejoin="round">
                                <g id="Group" transform="translate(4.000000, 0.000000)" stroke="#A0A9B2">
                                    <g id="pin-1" transform="translate(-0.000000, 0.000000)">
                                        <path
                                            d="M15.75,8.25 C15.75,12.471 12.817,14.899 10.619,17.25 C9.303,18.658 8.25,23.25 8.25,23.25 C8.25,23.25 7.2,18.661 5.887,17.257 C3.687,14.907 0.75,12.475 0.75,8.25 C0.75,4.10786438 4.10786438,0.75 8.25,0.75 C12.3921356,0.75 15.75,4.10786438 15.75,8.25 Z"
                                            id="Shape"></path>
                                        <circle id="Oval" cx="8.25" cy="8.25" r="3"></circle>
                                    </g>
                                </g>
                            </g>
                        </svg></i>{{ $property->address }} <a href="" class="st-link font-medium" data-toggle="modal"
                        data-target="#st-modal-show-map"> View on map</a>
                    <div class="modal fade modal-map" id="st-modal-show-map" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header"> <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close"> <i class="input-icon field-icon fa"><svg width="24px"
                                                height="24px" viewBox="0 0 24 24" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <desc>Created with Sketch.</desc>
                                                <defs></defs>
                                                <g id="Ico_close" stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                                    <g id="Group" stroke="#1A2B48" stroke-width="1.5">
                                                        <g id="close">
                                                            <path d="M0.75,23.249 L23.25,0.749" id="Shape"></path>
                                                            <path d="M23.25,23.249 L0.75,0.749" id="Shape"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></i></button>
                                    <h4 class="modal-title">Hyatt Centric Times Square</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="st-map mt30">
                                        <div class="google-map gmap3" id="list_map"
                                            data-data_show="{&quot;0&quot;:{&quot;id&quot;:6556,&quot;name&quot;:&quot;Hyatt Centric Times Square&quot;,&quot;post_type&quot;:&quot;st_hotel&quot;,&quot;lat&quot;:&quot;37.22668164367746&quot;,&quot;lng&quot;:&quot;-77.40168461878301&quot;,&quot;icon_mk&quot;:&quot;https:\/\/mixmap.travelerwp.com\/wp-content\/themes\/traveler\/v2\/images\/markers\/ico_mapker_hotel.png&quot;,&quot;content_html&quot;:&quot;<div class=\&quot;item-service-map\&quot;><div class=\&quot;thumb\&quot;><a href=\&quot;\&quot;><img src=\&quot;https:\/\/mixmap.travelerwp.com\/wp-content\/uploads\/2017\/06\/79746510.jpg\&quot; alt=\&quot;Hyatt Centric Times Square\&quot; class=\&quot;img-responsive\&quot;  style =\&quot;width: 150px;height:120px;object-fit: cover;\&quot;\/> <\/a><\/div><div class=\&quot;content\&quot;><h4 class=\&quot;service-title\&quot;><a href=\&quot;#\&quot;>Hyatt Centric Times Square<\/a><\/h4><p class=\&quot;service-location\&quot;><\/p><\/div><\/div>&quot;}}"
                                            data-lat="37.22668164367746" data-lng="-77.40168461878301"
                                            data-icon="https://mixmap.travelerwp.com/wp-content/uploads/2018/11/ico_mapker_hotel-1.png"
                                            data-zoom="13" data-disablecontrol="true" data-showcustomcontrol="true"
                                            data-style="normal" style="position: relative; overflow: hidden;">
                                            <div
                                                style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                                                <div style="overflow: hidden;"></div>
                                                <div class="gm-style"
                                                    style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;">
                                                    <div tabindex="0" aria-label="Map" aria-roledescription="map"
                                                        role="group"
                                                        style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; touch-action: pan-x pan-y;">
                                                        <div
                                                            style="z-index: 1; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);">
                                                            <div
                                                                style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
                                                                <div
                                                                    style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                                                    <div
                                                                        style="position: absolute; z-index: 987; transform: matrix(1, 0, 0, 1, -175, -27);">
                                                                        <div
                                                                            style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px;">
                                                                            <div style="width: 256px; height: 256px;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;">
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;">
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;">
                                                                <div
                                                                    style="position: absolute; left: 0px; top: 0px; z-index: -1;">
                                                                    <div
                                                                        style="position: absolute; z-index: 987; transform: matrix(1, 0, 0, 1, -175, -27);">
                                                                        <div
                                                                            style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: 0px;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    style="width: 40px; height: 50px; overflow: hidden; position: absolute; left: -20px; top: -50px; z-index: 0;">
                                                                    <img alt=""
                                                                        src="https://mixmap.travelerwp.com/wp-content/themes/traveler/v2/images/markers/ico_mapker_hotel.png"
                                                                        draggable="false"
                                                                        style="position: absolute; left: 0px; top: 0px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 32px; height: 40px;">
                                                                </div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                                            </div>
                                                        </div>
                                                        <div class="gm-style-pbc"
                                                            style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; opacity: 0;">
                                                            <p class="gm-style-pbt"></p>
                                                        </div>
                                                        <div
                                                            style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; touch-action: pan-x pan-y;">
                                                            <div
                                                                style="z-index: 4; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);">
                                                                <div
                                                                    style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;">
                                                                </div>
                                                                <div
                                                                    style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;">
                                                                </div>
                                                                <div
                                                                    style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;">
                                                                    <div title="" role="button" tabindex="0"
                                                                        style="width: 40px; height: 50px; overflow: hidden; position: absolute; cursor: pointer; touch-action: none; left: -20px; top: -50px; z-index: 0;">
                                                                        <img alt=""
                                                                            src="https://maps.gstatic.com/mapfiles/transparent.png"
                                                                            draggable="false"
                                                                            style="width: 40px; height: 50px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><iframe aria-hidden="true" frameborder="0" tabindex="-1"
                                                        __idm_frm__="535"
                                                        style="z-index: -1; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; border: none;"></iframe>
                                                    <div
                                                        style="pointer-events: none; width: 100%; height: 100%; box-sizing: border-box; position: absolute; z-index: 1000002; opacity: 0; border: 2px solid rgb(26, 115, 232);">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="review-score">
                    <div class="head clearfix">
                        <div class="left"> <span class="head-rating">Excellent</span> <span class="text-rating">from 5
                                reviews</span></div>
                        <div class="score">{{ $property->average_review_score }}<span>/10</span></div>
                    </div>
                    <div class="foot"> 100% of guests recommend</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 mb-2">
                <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">
                    @foreach ($property_images as $property_image)
                        <img src="{{ URL('storage/property_image/property_sub_images/' . $property_image->name) }}">
                    @endforeach
                </div>
            </div>
            {{-- <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                <div id="property_map" class="mb-3"></div>
                <div class="exlip-page-sidebar">

                    <!-- Find New Property -->
                    <div class="sidebar-widgets">

                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Destination">
                                <i class="ti-location-pin"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="text" class="form-control check-in-out" name="dates"
                                    value="01/01/2018 - 01/15/2018" />
                                <i class="ti-calendar"></i>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <select id="inputState" class="form-control">
                                <option selected>Adults</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12 row m-0">
                            <div class="form-group col-md-12">
                                <select id="inputState" class="form-control">
                                    <option selected>No of rooms</option>
                                    <option>...</option>
                                </select>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </div> --}}
             <!-- property Sidebar -->
             <div class="col-lg-4 col-md-12 col-sm-12 order-lg-2 order-md-1 order-1">
                <div class="tr-single-box">
                    <div class="tr-single-header">
                        <h4><i class="ti-direction"></i> Listing Info</h4>
                    </div>
                    <div class="tr-single-body">
                        <ul class="extra-service">
                            <li>
                                <div class="icon-box-icon-block">
                                    <a href="#">
                                        <div class="icon-box-round">
                                            <i class="lni-map-marker"></i>
                                        </div>
                                        <div class="icon-box-text">
                                            285 Main Road, Attidiya
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="icon-box-icon-block">
                                    <a href="#">
                                        <div class="icon-box-round">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                        <div class="icon-box-text">
                                            +94 76-553-6774
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="icon-box-icon-block">
                                    <a href="#">
                                        <div class="icon-box-round">
                                            <i class="lni-envelope"></i>
                                        </div>
                                        <div class="icon-box-text">
                                            <span>support@gimanhal.com</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="icon-box-icon-block">
                                    <a href="#">
                                        <div class="icon-box-round">
                                            <i class="lni-world"></i>
                                        </div>
                                        <div class="icon-box-text">
                                            www.gimanhal.com
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <!-- property main detail -->
            <div class="col-lg-8 col-md-12 col-sm-12 order-lg-1 order-md-2 order-2">
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    <div class="block-header">
                        <h4 class="block-title">Description</h4>
                    </div>
                    <div class="block-body">
                        <p>{{ $property->description }}</p>
                    </div>
                </div>
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    <div class="block-header">
                        <h4 class="block-title">property Facilities</h4>
                    </div>
                    <div class="block-body">
                        <ul class="avl-features third">
                            @foreach ($property->facilities as $property_facility)
                                <li>{{ $property_facility->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="room-list-web col-lg-12 col-md-12 col-sm-12 order-lg-1 order-md-2 order-2">
                <!-- Review Block Wrap -->
                <div class="block-wrap">
                    <div class="block-header">
                        <h4 class="block-title">Availability</h4>
                        @if (!$date_selected)
                        <p style="color: red;">Select dates to see this property's availability and prices</p>
                        @endif
                    </div>
                    {{-- ============================== --}}
                    <div>
                        <form id="availabilityForm">
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <div class="form-group col-md-12 row m-0">
                                <div class="form-group col-md-4 pr-2">
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control check-in-out" id="dates_details" name="dates_details"
                                            @if ($date_selected) value="{{ $set_date }}" @endif/>
                                        <i class="ti-calendar"></i>
                                    </div>
                                </div>

                                {{-- <div class="form-group col-md-4 pr-2">
                                    <select  class="form-control" id="no_of_adults" name="no_of_adults">
                                        <option selected>No of Adults</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div> --}}

                                <div class="form-group col-md-4 ">
                                    <button type="submit" class="btn btn-primary w-100">Search</button>
                                </div>

                            </div>
                        </form>
                    </div>

                    {{-- ================================= --}}
                    <div class="room-list block-body table-responsive">
                        <table class="table table-bordered" id="rooms_table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:40%" class="fixed-header">Room Type</th>
                                    <th scope="col" style="width:10%" class="fixed-header">Sleeps</th>
                                    @if ($date_selected)
                                    <th class="price" scope="col" style="width:10%" class="fixed-header">Today's Price</th>
                                    <th scope="col" style="width:25%" class="fixed-header">Your Choices</th>
                                    <th scope="col" style="width:5%" class="fixed-header">Select rooms</th>
                                    @endif
                                    <th scope="col" style="width:15%" class="fixed-header"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    @if ($room->is_available)

                                    @foreach ($room->subRooms as $subroom)
                                        @if ($loop->first)
                                            <tr>
                                                <th rowspan="{{ $loop->count }}" class="align-top" scope="rowgroup">
                                                    <div class="room-title">
                                                        <a href="#{{ $room->id }}" data-toggle="modal">
                                                            {{ $room->roomType->type }}</a>
                                                    </div>
                                                    @foreach ($room->units as $room_units)
                                                        @if ($loop->count > 1)
                                                            <div class="unit_bed_types">
                                                                <span>
                                                                    <li>{{ $room_units->type }}</li>
                                                                </span>
                                                                {{-- @foreach ($room_units->bedTypes as $room_unit_bed_types)
                                                                    <div class="bed-types">
                                                                        {{ $room_unit_bed_types->pivot->bed_count }} &nbsp;
                                                                 {{ $room_unit_bed_types->type }}
                                                                        &nbsp;
                                                                        <i class="fa fa-{{ $room_unit_bed_types->icon }}"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                @endforeach --}}

                                                            </div>
                                                        @else
                                                            {{-- @foreach ($room_units->bedTypes as $room_unit_bed_types)
                                                                <div class="bed-types">
                                                                    {{ $room_unit_bed_types->pivot->bed_count }}
                                                                    &nbsp;{{ $room_unit_bed_types->type }} &nbsp;
                                                                    <i class="fa fa-{{ $room_unit_bed_types->icon }}"
                                                                        aria-hidden="true"></i>
                                                                </div>
                                                            @endforeach --}}
                                                        @endif
                                                    @endforeach
                                                    <div class="sub-room-facility my-2">
                                                        <ul>
                                                            <div
                                                                class="d-flex flex-row flex-wrap align-items-md-center mb-2">

                                                                @foreach ($room->roomSubFacilities as $room_facilities)
                                                                    <li>
                                                                        <div class="facility-box">
                                                                            <svg class="bk-icon" fill="#008009"
                                                                                height="14" width="14"
                                                                                viewBox="0 0 128 128" role="presentation"
                                                                                aria-hidden="true" focusable="false">
                                                                                <path
                                                                                    d="M56.33 100a4 4 0 0 1-2.82-1.16L20.68 66.12a4 4 0 1 1 5.64-5.65l29.57 29.46 45.42-60.33a4 4 0 1 1 6.38 4.8l-48.17 64a4 4 0 0 1-2.91 1.6z">
                                                                                </path>
                                                                            </svg>
                                                                            <span>{{ $room_facilities->name }}</span>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </th>
                                                <th scope="row" class="align-top">
                                                    @if ($subroom->sleep_count < 5)
                                                        @for ($i = 0; $i < $subroom->sleep_count; $i++)
                                                            <i class="fas fa-user-alt"></i>
                                                        @endfor
                                                    @else
                                                        {{ $subroom->sleep_count }}*&nbsp;<i
                                                            class="fas fa-user-alt"></i>
                                                    @endif
                                                </th>
                                                @if ($date_selected)
                                                <td class="align-top"><b>LKR {{ (int) $subroom->rate }} </b></td>

                                                <td class="your-choices">
                                                    <ul class="pl-1">
                                                        @foreach ($subroom->mealTypes as $subRoomMealsTypes)
                                                            <li> <span class="text-monospace">
                                                                    {{ $subRoomMealsTypes->type }}
                                                                </span></li>
                                                        @endforeach
                                                    </ul>
                                                    <ul class="pl-1">
                                                        @foreach ($subroom->reservationPolicies as $reservationPolicies)
                                                            <li> <span class="privacy-policy">
                                                                    {{ $reservationPolicies->type }}
                                                                </span></li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="align-baseline">
                                                    <select name="room_count" id="room_count1" class="room_count">
                                                        @for ($i = 0; $i < $room->room_count; $i++)
                                                            <option value="{{ $i }}-{{ $subroom->rate }}-{{ $room->id }}-{{ $subroom->id }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </td>


                                                <td class="align-booking" rowspan="{{ $loop->count }}" style="vertical-align:top">
                                                    <form method="post" action="{{ URL('/booking/details') }}">
                                                        @csrf
                                                    <div class="final_rate" style="font-weight: bold;display:none;">
                                                        <b id="final_amount" name="final_amount"></b>
                                                        <input id="rooms" name="rooms" type="hidden" value="{{ $rooms }}">
                                                        <input id="picked_rooms" name="picked_rooms" type="hidden">
                                                        <input id="final_rate" name="final_rate" type="hidden">
                                                        <input id="gimanhal_fee" name="gimanhal_fee" type="hidden" val="{{ $gimanhal_fee }}">
                                                        <input id="property_id" name="property_id" type="hidden" value="{{ $property->id }}">
                                                        <input id="start_date" name="start_date" type="hidden" value="{{ $start_date }}">
                                                        <input id="end_date" name="end_date" type="hidden" value="{{ $end_date }}">
                                                        <button type="submit"class="btn btn-primary" style="display: none;" id="btn_reserve">I'll reserve</button>
                                                    </div>

                                                    </form>
                                                </td>

                                                @else
                                                <td class="align-booking" rowspan="{{ $loop->count }}">
                                                    <button type="button"class="btn btn-primary" id="btn_show_price">Show Prices</button>
                                                </td>
                                                @endif


                                            </tr>
                                        @endif
                                        @if ($loop->iteration > 1)
                                            <tr>
                                                <th scope="row" class="align-top">
                                                    @if ($subroom->sleep_count < 5)
                                                        @for ($i = 0; $i < $subroom->sleep_count; $i++)
                                                            <i class="fas fa-user-alt"></i>
                                                        @endfor
                                                    @else
                                                        {{ $subroom->sleep_count }}*&nbsp;<i
                                                            class="fas fa-user-alt"></i>
                                                    @endif
                                                </th>
                                                @if ($date_selected)
                                                <td class="align-top"><b>LKR {{ (int) $subroom->rate }} </b>
                                                </td>
                                                <td class="your-choices">
                                                    <ul class="pl-1">
                                                        @foreach ($subroom->mealTypes as $subRoomMealsTypes)
                                                            <li> <span>
                                                                    {{ $subRoomMealsTypes->type }}
                                                                </span></li>
                                                        @endforeach
                                                    </ul>
                                                    <ul class="pl-1">
                                                        @foreach ($subroom->reservationPolicies as $reservationPolicies)
                                                            <li> <span class="privacy-policy">
                                                                    {{ $reservationPolicies->type }}
                                                                </span></li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="align-baseline">
                                                    <select name="room_count" id="room_count" class="room_count">
                                                        @for ($i = 0; $i < $room->room_count; $i++)
                                                        <option value="{{ $i }}-{{ $subroom->rate }}-{{ $room->id }}-{{ $subroom->id }}">{{ $i }}</option>
                                                    @endfor
                                                    </select>
                                                </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach

                                    @endif
                                    <div class="modal fade bd-example-modal-md" id="{{ $room->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Room Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="room-details-left-container">
                                                        <div class="room-images-slide-show">
                                                            <div id="image-slider" class="splide">
                                                                <div class="splide__track">
                                                                    <ul class="splide__list">

                                                                        @foreach ($room->roomImages as $room_images)
                                                                            <li class="splide__slide">
                                                                                <img style="width : 100%;height: auto;"
                                                                                    src="{{ url('storage/room_image/room_sub_images/' . $room_images->name) }}">
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div id="secondary-slider" class="splide my-3">
                                                                <div class="splide__track">
                                                                    <ul class="splide__list">
                                                                        @foreach ($room->roomImages as $room_images)
                                                                            <li class="splide__slide">
                                                                                <img style="width : 100%;height: auto;"
                                                                                    src="{{ url('storage/room_image/room_sub_images/' . $room_images->name) }}">
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="room-details-right-container">
                                                        <div>
                                                            <h1 class="rt-lightbox-title mb-2 mb-2"
                                                                id="hp_rt_room_gallery_modal_room_name"
                                                                style="font-size: 118%;margin: bottom 10px;">
                                                                {{ $room->title }}</h6>
                                                                {{-- <h2>Room Size :</h2> <br>
                                                                @foreach ($room_units->bedTypes as $room_unit_bed_types)
                                                                    <div class="bed-types">
                                                                        {{ $room_unit_bed_types->pivot->bed_count }} *
                                                                        {{ $room_unit_bed_types->type }}
                                                                        &nbsp;
                                                                        <i class="fa fa-{{ $room_unit_bed_types->icon }}"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                @endforeach --}}
                                                                <div class="my-2"></div>
                                                                @foreach ($room->roomFacilities as $room_facilities)
                                                                    <h2 class="my-2" style="color: black;">
                                                                        {{ $room_facilities->name }}</h2>
                                                                    <ul class="hprt-lightbox-list js-lightbox-facilities"
                                                                        data-nr-of-facilities="5">
                                                                        @foreach ($room->roomSubFacilities as $room_sub_facilities)
                                                                            @if ($room_sub_facilities->facility_id == $room_facilities->id)
                                                                                <li class="hprt-lightbox-list__item js-lightbox-facility"
                                                                                    data-name-en="Upper floor reachable by stairs only"
                                                                                    data-id="133">
                                                                                    <span>
                                                                                        <svg class="bk-icon -streamline-checkmark"
                                                                                            fill="" size="small"
                                                                                            width="14" height="14"
                                                                                            viewBox="0 0 128 128">
                                                                                            <path
                                                                                                d="M56.33 100a4 4 0 0 1-2.82-1.16L20.68 66.12a4 4 0 1 1 5.64-5.65l29.57 29.46 45.42-60.33a4 4 0 1 1 6.38 4.8l-48.17 64a4 4 0 0 1-2.91 1.6z">
                                                                                            </path>
                                                                                        </svg>{{ $room_sub_facilities->name }}
                                                                                    </span>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row room-list-mobile" hidden>
            @foreach ($rooms as $room)
                @foreach ($room->subRooms as $subroom)
                    <div class="col-12">
                        <div class="block-wrap">
                            <div class="block-header clearfix">
                                <h6 class="block-title float-left">{{ $room->title }}</h6>
                                <i data-target="#mobile_{{ $room->id }}" data-toggle="modal"
                                    class="fas fa-image float-right"></i>
                            </div>
                            <div class="room-sleep-mobile">
                                <span>Price For &nbsp;
                                    @if ($subroom->sleep_type_id < 5)
                                        @for ($i = 0; $i < $subroom->sleep_type_id; $i++)
                                            <i class="fas fa-user-alt"></i>
                                        @endfor
                                    @else
                                        {{ $subroom->sleep_type_id }}*&nbsp;<i class="fas fa-user-alt"></i>
                                    @endif
                                </span>
                            </div>
                            @foreach ($room->units as $room_units)
                                @if ($loop->count > 1)
                                    <div class="mobile_unit_bed_types">
                                        <ul>
                                            <span>{{ $room_units->type }} : </span>
                                            {{-- @foreach ($room_units->bedTypes as $room_unit_bed_types)
                                                <li>
                                                    {{ $room_unit_bed_types->pivot->bed_count }}
                                                    {{ $room_unit_bed_types->type }}
                                                    &nbsp;
                                                    <span><i class="fa fa-{{ $room_unit_bed_types->icon }}"
                                                            aria-hidden="true"></i></span>
                                                </li>
                                            @endforeach --}}
                                        </ul>
                                    </div>
                                @else
                                    <div class="mobile-bed-types">
                                        <ul>
                                            {{-- @foreach ($room_units->bedTypes as $room_unit_bed_types)
                                                <li class="mr-2">
                                                    {{ $room_unit_bed_types->pivot->bed_count }}
                                                    &nbsp;{{ $room_unit_bed_types->type }} &nbsp;
                                                    <span><i class="fa fa-{{ $room_unit_bed_types->icon }}"
                                                            aria-hidden="true"></i></span>
                                                </li>
                                            @endforeach --}}
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                            <div class="meal-choice-mobile">
                                <ul class="p-0">
                                    @foreach ($subroom->mealTypes as $subRoomMealsTypes)
                                        <li class="meal_types"> <span>
                                                {{ $subRoomMealsTypes->type }}
                                            </span></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="reservation-choice-mobile">
                                <ul class="pl-0">
                                    @foreach ($subroom->reservationPolicies as $reservationPolicies)
                                        <li> <span class="privacy-policy">
                                                <svg class="bk-icon" fill="#008009" height="14" width="14"
                                                    viewBox="0 0 128 128" role="presentation" aria-hidden="true"
                                                    focusable="false">
                                                    <path
                                                        d="M56.33 100a4 4 0 0 1-2.82-1.16L20.68 66.12a4 4 0 1 1 5.64-5.65l29.57 29.46 45.42-60.33a4 4 0 1 1 6.38 4.8l-48.17 64a4 4 0 0 1-2.91 1.6z">
                                                    </path>
                                                </svg> &nbsp;{{ $reservationPolicies->type }}
                                            </span></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-4 mobile-price clearfix">
                                <div class="float-left">
                                    <div class="price">
                                        <h5>Rs: {{ $subroom->rate }}</h5>
                                        <p>Price for </p>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <div class="stbooking-footer-bottom">
                                        <a href="#" class="books-btn btn-theme">Reserve</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="modal fade mobile-modal bd-example-modal" id="mobile_{{ $room->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Room Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h1>{{ $room->title }}</h1>
                                <h6>{{ $property->name }}</h6>
                                <div class="mobile-room-image-slider">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($room->roomImages as $room_images)
                                                @if ($loop->first)
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100"
                                                            src="{{ url('storage/room_image/room_sub_images/' . $room_images->name) }}"
                                                            alt="First slide">
                                                    </div>
                                                @else
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100"
                                                            src="{{ url('storage/room_image/room_sub_images/' . $room_images->name) }}"
                                                            alt="Second slide">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    <div class="mobile-room-description px-2 my-1">
                                        <p class="pb-2">{{ $room->description }}</p>
                                    </div>

                                </div>
                                <div class="mobile-room-main-details px-2">
                                    <h2>Room Size :</h2>
                                    {{-- @foreach ($room_units->bedTypes as $room_unit_bed_types)
                                        <div class="bed-types">
                                            {{ $room_unit_bed_types->pivot->bed_count }} *
                                            {{ $room_unit_bed_types->type }}
                                            &nbsp;
                                            <i class="fa fa-{{ $room_unit_bed_types->icon }}" aria-hidden="true"></i>
                                        </div>
                                    @endforeach --}}
                                    @foreach ($room->roomFacilities as $room_facilities)
                                        <ul class="pl-0">
                                            <h2 class="mt-2" style="color: black;"> {{ $room_facilities->name }}</h2>
                                            @foreach ($room->roomSubFacilities as $room_sub_facilities)
                                                @if ($room_sub_facilities->facility_id == $room_facilities->id)
                                                    <li>
                                                        <span>
                                                            <svg class="bk-icon -streamline-checkmark" fill=""
                                                                size="small" width="14" height="14"
                                                                viewBox="0 0 128 128">
                                                                <path
                                                                    d="M56.33 100a4 4 0 0 1-2.82-1.16L20.68 66.12a4 4 0 1 1 5.64-5.65l29.57 29.46 45.42-60.33a4 4 0 1 1 6.38 4.8l-48.17 64a4 4 0 0 1-2.91 1.6z">
                                                                </path>
                                                            </svg>{{ $room_sub_facilities->name }}
                                                        </span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 order-lg-1 order-md-2 order-2">
                <!-- Review Block Wrap -->
                <div class="rating-overview">
                    <div class="rating-overview-box">
                        <span class="rating-overview-box-total">{{ $property->average_review_score }}</span>
                        <span class="rating-overview-box-percent">out of 10.0</span>
                        <div class="star-rating" data-rating="5">
                            @php $rating = $property->average_review_score/2; @endphp
                            @foreach (range(1, 5) as $i)
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    @if ($rating > 0)
                                        @if ($rating > 0.5)
                                            <i class="fas fa-star fa-stack-1x"></i>
                                        @else
                                            <i class="fas fa-star-half fa-stack-1x"></i>
                                        @endif
                                    @endif
                                    @php $rating--; @endphp
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="rating-bars">
                        @foreach ($property_review_categories_avg_rating as $property_review_category_avg_rating)
                            <div class="rating-bars-item">
                                <span
                                    class="rating-bars-name">{{ $property_review_category_avg_rating->review_category_name }}</span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating high" data-rating="4.7">
                                        <span class="rating-bars-rating-inner"
                                            style="width:{{ $property_review_category_avg_rating->average_rating * 10 }}%;"></span>
                                    </span>
                                    <strong>{{ $property_review_category_avg_rating->average_rating }}</strong>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Reviews Comments -->
                <div class="list-single-main-item fl-wrap">
                    <div class="list-single-main-item-title fl-wrap">
                        <div class="row">
                            <div>
                                <h3>Item Reviews - <span> 3</span></h3>
                            </div>
                            <div style="padding-left: 15px;">
                                @if (Auth::check())
                                    <a class="btn btn-primary btn-sm btn-rounded" data-toggle="modal"
                                        data-target="#reviewModal">Write Review</a>
                                @else
                                    <a class="btn btn-primary btn-sm btn-rounded" data-toggle="modal"
                                        data-target="#authPage">Write Review</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="reviews-comments-wrap">
                        <!-- reviews-comments-item -->
                        @foreach ($reviews as $review)
                            <div class="reviews-comments-item">
                                <div class="review-comments-avatar">
                                    <img src="https://via.placeholder.com/400x400" class="img-fluid" alt="">
                                </div>
                                <div class="reviews-comments-item-text">
                                    <h4><a href="#">{{ $review->users->first_name }}&nbsp
                                            {{ $review->users->last_name }}</a><span class="reviews-comments-item-date"><i
                                                class="ti-calendar theme-cl"></i>27 Oct 2019</span></h4>

                                    <div class="listing-rating high" data-starrating2="5"><i
                                            class="ti-star active"></i><i class="ti-star active"></i><i
                                            class="ti-star active"></i><i class="ti-star active"></i><i
                                            class="ti-star active"></i><span
                                            class="review-count">{{ $review->overall_score }}</span> </div>
                                    <div class="clearfix"></div>
                                    <h5>{{ $review->title }}</h5>
                                    <p>{{ $review->description }}</p>
                                    <div class="pull-left reviews-reaction">
                                        <a href="#" class="comment-like active"><i class="ti-thumb-up"></i> 12</a>
                                        <a href="#" class="comment-dislike active"><i class="ti-thumb-down"></i>
                                            1</a>
                                        <a href="#" class="comment-love active"><i class="ti-heart"></i> 07</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!--reviews-comments-item end-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row faq-box">
            <div class="col-lg-3 col-sm-5 col-md-4 pr-0">
                <div class="faq-title">
                    <h4>Faqs about <br>{{ $property->name }}</h4>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-7  pl-0">
                <div class="tab-content" id="myTabContent">
                    <!-- general Query -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="accordion" id="generalac">
                            @foreach ($property->faqs as $property_faqs)
                                @if ($loop->first)
                                    <div class="card">
                                        <div class="card-header" id="heading_{{ $property_faqs->id }}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapse_{{ $property_faqs->id }}" aria-expanded="true"
                                                    aria-controls="collapse_{{ $property_faqs->id }}">
                                                    {{ $property_faqs->question }}

                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapse_{{ $property_faqs->id }}" class="collapse show"
                                            aria-labelledby="heading_{{ $property_faqs->id }}" data-parent="#generalac">
                                            <div class="card-body">
                                                <div class="ac-para">
                                                    {!! html_entity_decode($property_faqs->answer) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($loop->iteration >= 2)
                                    <div class="card">
                                        <div class="card-header" id="heading_{{ $property_faqs->id }}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapse_{{ $property_faqs->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapse_{{ $property_faqs->id }}">
                                                    {{ $property_faqs->question }}
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapse_{{ $property_faqs->id }}" class="collapse"
                                            aria-labelledby="heading_{{ $property_faqs->id }}" data-parent="#generalac">
                                            <div class="card-body">
                                                <div class="ac-para">
                                                    {!! html_entity_decode($property_faqs->answer) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq-box-mobile d-none">
            <div class="row">
                <div class="col-12">
                    <div class="faq-title-mobile">
                        <h4>Faqs about {{ $property->name }}</h4>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                            aria-labelledby="general-tab">
                            <div class="accordion" id="generalac">
                                @foreach ($property->faqs as $property_faqs)
                                    @if ($loop->first)
                                        <div class="card">
                                            <div class="card-header" id="mobile_heading_{{ $property_faqs->id }}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#mobile_collapse_{{ $property_faqs->id }}"
                                                        aria-expanded="true"
                                                        aria-controls="mobile_collapse_{{ $property_faqs->id }}">
                                                        {{ $property_faqs->question }}
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="mobile_collapse_{{ $property_faqs->id }}" class="collapse show"
                                                aria-labelledby="mobile_heading_{{ $property_faqs->id }}"
                                                data-parent="#generalac">
                                                <div class="card-body">
                                                    <div class="ac-para">
                                                        {!! html_entity_decode($property_faqs->answer) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($loop->iteration >= 2)
                                        <div class="card">
                                            <div class="card-header" id="mobile_heading_{{ $property_faqs->id }}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#mobile_collapse_{{ $property_faqs->id }}"
                                                        aria-expanded="false" aria-controls="">
                                                        {{ $property_faqs->question }}
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="mobile_collapse_{{ $property_faqs->id }}" class="collapse"
                                                aria-labelledby="mobile_heading_{{ $property_faqs->id }}"
                                                data-parent="#generalac">
                                                <div class="card-body">
                                                    <div class="ac-para">
                                                        {!! html_entity_decode($property_faqs->answer) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <!-- property main detail -->
            <div class="col-lg-11 col-md-11 col-sm-12">
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    <div class="block-header">
                        <h4 class="block-title">House Rules</h4>
                    </div>
                    <div class="block-body">
                        <div class="row mt-5">
                            <div class="col-md-3 col-12 d-flex flex-row mb-4 align-items-center">
                                <i class="fas fa-calendar-check mr-2"> </i>
                                <span class="progress-bar-lable">Check In </span>
                            </div>
                            <div class="col-md-4 col-12 px-0 mt-2">
                                <span class="timebar__label"
                                    id="checkin__label_start">{{ \Carbon\Carbon::createFromFormat('H:i:s', $property->check_in_start_time)->format('H:i') }}</span>
                                <span class="timebar__label"
                                    id="checkin__label_end">{{ \Carbon\Carbon::createFromFormat('H:i:s', $property->check_in_end_time)->format('H:i') }}</span>
                                <div class="progress">

                                    <div class="progress-bar" id="checkIn" role="progressbar" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3 d-flex flex-row mb-4 align-items-center">
                                <i class="fas fa-calendar-check mr-2"> </i>
                                <span class="progress-bar-lable">Check Out </span>
                            </div>
                            <div class="col-md-4 px-0 mt-2">
                                <span class="timebar__label"
                                    id="checkout__label_start">{{ \Carbon\Carbon::createFromFormat('H:i:s', $property->check_out_start_time)->format('H:i') }}</span>
                                <span class="timebar__label"
                                    id="checkout__label_end">{{ \Carbon\Carbon::createFromFormat('H:i:s', $property->check_out_end_time)->format('H:i') }}</span>
                                <div class="progress">
                                    <div class="progress-bar" id="checkOut" role="progressbar" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3 col-12 d-flex flex-row mb-2">
                                <i class="fas fa-exclamation-circle mr-2"> </i>
                                <span class="progress-bar-lable"> Cancellation Prepayment</span>
                            </div>
                            <div class="col-md-9 col-12">
                                <p>Cancellation and prepayment policies vary according to accommodation type.please<a
                                        href="#" class=""> enter the dates of your stay</a> and check the
                                    conditions of your required room.</p>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3 d-flex flex-row ">
                            <i class="fas fa-user-times mr-2"></i>
                            <span class="progress-bar-lable"> Age Restricted</span>
                        </div>
                        <div class="col-md-9">
                            @if ($property->age_restriction == 0)
                                <p>There is no age requirement for check-in</p>
                            @else
                                <p>Under <span class="text-danger font-weight-bold"> {{ $property->age_restriction }}
                                        years </span> Children not allowed for check-in</p>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3 col-12 d-flex flex-row mb-2">
                            <i class="fas fa-paw mr-2"> </i>
                            <span class="progress-bar-lable"> Pets</span>
                        </div>
                        <div class="col-md-9">
                            @if ($property->pet_allowed == 0)
                                <p>Pets are not allowed</p>
                            @else
                                <p>Pets are allowed</p>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3 col-12 d-flex flex-row mb-3">
                            <i class="fas fa-credit-card mr-2"> </i>
                            <span class="progress-bar-lable"> Cards accepted at this hotel</span>
                        </div>
                        <div class="col-md-9 col-12">
                            @foreach ($property_credit_cards as $property_credit_card)
                                <img class="mr-2" style="width : 50px;height: auto;"
                                    src="{{ url('storage/credit_card_image/' . $property_credit_card->credit_card_image) }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- property room details open model -->


    <!-- Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title review_title" id="exampleModalLabel">Submit Booking details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="first">
                        <div class="mb-3">
                            <div class="col-xs-4">
                                <input type="text" class="form-control" id="bookingNumber" name="bookingNumber"
                                    aria-describedby="Booking" placeholder="Enter Booking Number">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="pinNumber" name="pinNumber"
                                placeholder="Enter Pin Number">
                        </div>
                    </div>
                    <div class="second" style="display:none;">
                        <div class="mb-3">
                            <form id="reviewForm">
                                <div class="giv-averg-rate">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row">
                                                <?php $i = 0; ?>
                                                <input type="hidden" id="booking_no" name="booking_id">
                                                @foreach ($review_categories as $review_category)
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label>{{ $review_category->name }}</label>
                                                        <div class="slidecontainer my-3">
                                                            <input type="range" min="1" max="10"
                                                                value="" class="slider" id="reviewCategories"
                                                                name="{{ $review_category->id }}">
                                                            <p class="text-danger">Value: <span class="demo"></span></p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-form-box form-submit">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                            <label for="">Review Guest Type</label>
                                            <select class="form-control" id="reviewGuestTypeSelect"
                                                name="review_guest_type">
                                                <option value="" disabled selected style="color:green;">Select
                                                    Review Guest Type</option>
                                                @foreach ($review_guest_types as $review_guest_type)
                                                    <option value="{{ $review_guest_type->id }}">
                                                        {{ $review_guest_type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                            <div class="form-group">
                                                <!-- <label for="title">Title</label> -->
                                                <input class="form-control" type="text"
                                                    placeholder="Please Enter Title" id="title" name="title">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                            <div class="form-group">
                                                <!-- <label>Review</label> -->
                                                <textarea class="form-control ht-140" placeholder="Please Enter Your Review" id="description" name="description"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" id="property_id" name="property_id"
                                            value="{{ $property->id }}">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-theme" id="btn-submit">Submit
                                                    Review</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <input type="button" class="btn btn-primary first" id="btn_review" onclick="reviewCheck()"
                        value="submit">
                    {{-- <input type="submit" class="btn btn-primary" id="btn_review" value="submit"> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="authPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gimanhal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you already a member</p>
                    <a href="{{ url('login') }}"><button type="button" class="btn btn-primary"> Login</button></a>
                    <a href="{{ url('register') }}"><button type="button"
                            class="btn btn-primary">Register</button></a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================ Property Detail End ================================== -->
@endsection

@section('script')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0cH-gsRcjZEQD5ab9mFyldU2v7T6QURY&callback=initMap&libraries=&v=weekly&channel=2"
        async></script>


        <script>
             // Daterange Script
            //  var date = new Date();
            $('input[name="dates_details"]').daterangepicker({
                minDate: new Date(),
            });
        </script>


        <script>

             $('#availabilityForm').on('submit', function(event) {
                event.preventDefault();
                let dates = $('#dates_details').val();

                // let no_of_adults = $('#no_of_adults').val();

                let dates_array = dates.split("-").map(item => item.trim());

                let url = new URL(window.location.href);
                let href = url.href;
                let url_without_parameters = href.split('?')[0];

                let from_date = dates_array[0];
                let to_date = dates_array[1];
                // console.log('====================================');
                // console.log(d);
                // console.log(dates_array);



                new_url =  url_without_parameters + '?' + 'from_date=' + from_date +  '&to_date=' + to_date;
                window.location.href = new_url;

            });


        </script>

        {{-- rate calculation --}}
        <script>
            var total = 0;
            var booking = {
                details : [],
                total : 0
            };
            var final_rate = 0;
            var room_details = [];
            $( ".room_count" ).change(function() {
                let dropdown_value = $(this).val();

                const myArray = dropdown_value.split("-");
                let room_count = myArray[0];
                let rate = myArray[1];
                let room_id = myArray[2];
                let subroom_id = myArray[3];
                var details = booking.details;

                console.log("check thiiiiiiiiiiiiiiiiiiis"+myArray);


                const createRateObject = async() => {
                    if(room_details.some(item => item.subroom_id === subroom_id)) {

                            room_details.some(item => {
                                if(item.subroom_id === subroom_id) {
                                    item.room_count = room_count;
                                    item.rate = rate*room_count;
                                }

                            });

                    }
                    else {
                            let rate_cal = rate*room_count;
                            detailsArr = {"room_id":room_id,"subroom_id":subroom_id,"room_count": room_count,"rate":rate_cal};
                            room_details.push(detailsArr);

                    }

                    return room_details;
                }

                const picked_rooms = [];


                createRateObject().then((room_details) => {
                    // console.log("yiiiiiiiiii"+JSON.stringify(room_details));
                    final_rate = 0;
                    room_details.forEach((element,index) => {

                        if(element['rate'] !== 0) {
                            picked_rooms.push(element);
                        }
                        final_rate = final_rate + element['rate'];
                        // console.log(JSON.stringify(element['rate']));
                    });


                    // console.log(JSON.stringify(picked_rooms));
                    $('#picked_rooms').val(JSON.stringify(picked_rooms));
                    $('#final_rate').val(final_rate);
                    $('#final_amount').html("LKR "+ final_rate);
                    // console.log(room_details);
                    if(final_rate === 0) {
                        $('.final_rate').hide();
                        $('#btn_reserve').hide();
                    }
                    else {
                        $('.final_rate').show();
                        $('#btn_reserve').show();
                    }



                });
                // createRateObject().then((room_details) => {
                //     final_rate = 0;
                //     room_details.forEach((element,index) => {
                //         final_rate = final_rate + element['rate'];
                //     });
                // });
                // console.log('====================================');
                // console.log("yooo check this out"+ JSON.stringify(room_details));
                // console.log('====================================');



                // console.log("rates:"+ final_rate);



            });
        </script>

    <script>
        var longitude = <?php echo json_encode($property->longitude); ?>;
        var latitude = <?php echo json_encode($property->latitude); ?>;

        function initMap() {
            // The location of Uluru
            const uluru = {
                lat: longitude,
                lng: latitude
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("property_map"), {
                zoom: 17,
                center: uluru,

            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var checkInStartTime = <?php echo json_encode($property->check_in_start_time); ?>;
            var chechInEndTime = <?php echo json_encode($property->check_in_end_time); ?>;
            var checkOutStartTime = <?php echo json_encode($property->check_out_start_time); ?>;
            var checkOutEndTime = <?php echo json_encode($property->check_out_end_time); ?>;

            var checkIn = diff(checkInStartTime, chechInEndTime);

            var foo = document.getElementById('checkIn');
            foo.style.marginLeft = checkIn[1] + '%';
            foo.style.backgroundColor = 'green'
            foo.style.width = checkIn[0] + '%';

            var fooStartLable = document.getElementById('checkin__label_start');
            fooStartLable.style.left = checkIn[1] + '%';
            fooStartLable.style.marginLeft = '-14px';

            var fooEndLable = document.getElementById('checkin__label_end');
            fooEndLable.style.left = checkIn[2] + '%';
            fooEndLable.style.marginLeft = '-14px';

            var checkOut = diff(checkOutStartTime, checkOutEndTime);

            var foo = document.getElementById('checkOut');
            foo.style.marginLeft = checkOut[1] + '%';
            foo.style.backgroundColor = 'green'
            foo.style.width = checkOut[0] + '%';

            var fooStartLable = document.getElementById('checkout__label_start');
            fooStartLable.style.left = checkOut[1] + '%';
            fooStartLable.style.marginLeft = '-14px';

            var fooEndLable = document.getElementById('checkout__label_end');
            fooEndLable.style.left = checkOut[2] + '%';
            fooEndLable.style.marginLeft = '-14px';

            function diff(st, et) {
                let startTimeArray = st.split(':');
                let endTimeArray = et.split(':');

                let startTime = new Date(0, 0, 0, startTimeArray[0], endTimeArray[1], 0);
                let endTime = new Date(0, 0, 0, endTimeArray[0], endTimeArray[1], 0);
                let timeDiff = (endTime.getTime() - startTime.getTime()) / 1000;
                let startTimeSeconds = (+startTimeArray[0]) * 60 * 60 + (+startTimeArray[1]) * 60 + (+
                    startTimeArray[2]);

                timeDiff /= 60;
                let timeDiffPresentage = Math.abs(((timeDiff / 1440 * 100)));

                let startLabelLeftPre = Math.abs((startTimeSeconds / (24 * 60 * 60)) * 100);
                let endLabelLeftPre = startLabelLeftPre + timeDiffPresentage;

                const timeDiffrentArray = new Array(timeDiffPresentage, startLabelLeftPre, endLabelLeftPre);
                return timeDiffrentArray;
            }

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var secondarySlider = new Splide('#secondary-slider', {
                rewind: true,
                fixedWidth: 100,
                fixedHeight: 100,
                isNavigation: true,
                gap: 9,
                lazyLoad: 'nearby',
                focus: 'center',
                pagination: false,
                cover: true,
                breakpoints: {
                    '600': {
                        fixedWidth: 66,
                        fixedHeight: 40,
                    }
                }
            }).mount();

            var primarySlider = new Splide('#image-slider', {
                fixedWidth: 674,
                fixedHeight: 350,
                cover: true,
            });

            primarySlider.sync(secondarySlider).mount();


        });
    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateLabel() {
            var limit = this.parentElement.getElementsByClassName("demo")[0];
            limit.innerHTML = this.value;
        }
        var slideContainers = document.getElementsByClassName("slidecontainer");

        for (var i = 0; i < slideContainers.length; i++) {
            var slider = slideContainers[i].getElementsByClassName("slider")[0];
            updateLabel.call(slider);
            slider.oninput = updateLabel;
        }


        $('#propertyForm').on('click', function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ url('admin/properties/add/save') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $.confirm({
                            icon: 'fa fa-check',
                            theme: 'modern',
                            animation: 'left',
                            type: 'green',
                            title: 'Added!',
                            content: response.message,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                }
                            }
                        });
                    }

                    if (!response.success) {
                        $.confirm({
                            icon: 'fa fa-exclamation-triangle',
                            theme: 'modern',
                            animation: 'right',
                            type: 'red',
                            title: 'Update!',
                            content: response.message,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                }
                            }
                        });
                    }
                }
            });
        });

        function reviewCheck() {

            var booking_number = $('#bookingNumber').val();
            var pin_number = $('#pinNumber').val();
            var property_id = $('#property_id').val();

            if (booking_number == "" || pin_number == "") {
                alert("Enter booking number and pin number");
                return false;
            } else {

                $.ajax({
                    url: "{{ url('/properties/details/add_review') }}",
                    method: "POST",
                    data: "bookingNumber=" + booking_number + "&pinNumber=" + pin_number + "&property_id=" +
                        property_id,
                    dataType: 'JSON',
                    success: function(response) {
                        var bookingNumber = response.bookingNumber;
                        console.log(bookingNumber);
                        if (response.success) {
                            $('.first').hide();
                            $('.second').show();
                            $('.review_title').html("Submit Your Review");

                            $('#booking_no').val(bookingNumber);

                        }

                        if (!response.success) {
                            alert(response.message);
                            return false;
                        }
                    }
                });
            }

        }

        $('#reviewForm').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ url('properties/details/save_review') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        location.href = "{{ url('/properties/details/' . $property->id) }}";
                    }

                    if (!response.success) {
                        alert(response.message);
                        return false;
                    }
                }
            });
        });
    </script>
@endsection
