<!-- ============================ Page Title Start================================== -->
@extends('home.layouts.master')
@section('content')
    ;
    <div class="image-cover page-title" data-overlay="6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <h2 class="ipt-title">Property List</h2>
                    <span class="ipn-subtitle text-light">Find the best place to spent your vacation</span>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->

    <!-- =================== Sidebar Search ==================== -->
    <section class="gray">
        <div class="container">
            <div class="row">
                <div class="order-2 col-lg-4 col-md-12 order-lg-1 order-md-2">
                    <!-- property Sidebar -->
                    <div class="exlip-page-sidebar">
                        <!-- Find New Property -->
                        <div class="sidebar-widgets">
                            <form action="{{ URL('properties/list/all/filter') }}" method="get">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <select id="tour-category" name="city_name" class="form-control">
                                            @foreach ($cities as $city)
                                                <!-- @if (Request::query('city_name') != null)
    <option selected hidden>{{ Request::query('city_name') }}</option>
@else
    <div class="default text">Select City</div>
    @endif -->
                                                <option value="{{ $city->name }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="ti-briefcase"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control check-in-out" name="dates"
                                            value="" />
                                        <i class="ti-calendar"></i>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                            <div class="range-slider my-3">
                                <label>Radius</label>
                                <div class="distance-title">around selected destination <span class="theme-cl"></span> km
                                </div>
                                <input class="distance-radius rangeslider--horizontal" type="range" min="1"
                                    max="100" step="1" value="1"
                                    data-title="Radius around selected destination">
                            </div>

                            <div class="ameneties-features mt-3">
                                <label>Star Rating</label>
                                <ul class="no-ul-list">
                                    <li>
                                        <input id="mo-1" class="filter checkbox-custom" value="5"
                                            name="star_rating" type="checkbox"
                                            @if (in_array(5, explode(',', request()->input('filter.star_rating')))) checked @endif />
                                        <label for="mo-1" class="checkbox-custom-label search-review">
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star filled"></i></span>
                                        </label>
                                    </li>
                                    <li>
                                        <input id="mo-2" class="filter checkbox-custom" value="4"
                                            name="star_rating" type="checkbox"
                                            @if (in_array(4, explode(',', request()->input('filter.star_rating')))) checked @endif>
                                        <label for="mo-2" class="checkbox-custom-label search-review">
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </label>
                                    </li>
                                    <li>
                                        <input id="mo-3" class="filter checkbox-custom" value="3"
                                            name="star_rating" type="checkbox"
                                            @if (in_array(3, explode(',', request()->input('filter.star_rating')))) checked @endif>
                                        <label for="mo-3" class="checkbox-custom-label search-review">
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </label>
                                    </li>
                                    <li>
                                        <input id="mo-4" class="filter checkbox-custom" value="2"
                                            name="star_rating" type="checkbox"
                                            @if (in_array(2, explode(',', request()->input('filter.star_rating')))) checked @endif>
                                        <label for="mo-4" class="checkbox-custom-label search-review">
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </label>
                                    </li>
                                    <li>
                                        <input id="mo-5" class="filter checkbox-custom" value="1"
                                            name="star_rating" type="checkbox"
                                            @if (in_array(1, explode(',', request()->input('filter.star_rating')))) checked @endif />
                                        <label for="mo-5" class="checkbox-custom-label search-review">
                                            <span><i class="fa fa-star filled"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </label>
                                    </li>
                                    <li>
                                        <input id="mo-0" class="filter checkbox-custom" value="6"
                                            name="star_rating" type="checkbox"
                                            @if (in_array(6, explode(',', request()->input('filter.star_rating')))) checked @endif />
                                        <label for="mo-0" class="checkbox-custom-label search-review">
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </label>
                                    </li>
                                </ul>

                            </div>
                            <div class="ameneties-features">
                                <label>Property Facilities</label>
                                <ul class="no-ul-list">
                                    @foreach ($property_facilities as $property_facility)
                                        <li>
                                            <input name="facility_name"
                                                id="property_facility_{{ $property_facility->id }}"
                                                value="{{ $property_facility->id }}" class="filter checkbox-custom"
                                                type="checkbox" @if (in_array($property_facility->id, explode(',', request()->input('filter.property_facility')))) checked @endif />
                                            <label for="property_facility_{{ $property_facility->id }}"
                                                class="checkbox-custom-label">{{ $property_facility->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="ameneties-features mt-3">
                                <label>Property Type</label>
                                <ul class="no-ul-list">
                                    @foreach ($property_types as $property_type)
                                        <li>
                                            <input name="property_type" id="property_type_{{ $property_type->id }}"
                                                value="{{ $property_type->id }}" class="filter checkbox-custom"
                                                type="checkbox" @if (in_array($property_type->id, explode(',', request()->input('filter.property_type')))) checked @endif />
                                            <label for="property_type_{{ $property_type->id }}"
                                                class="checkbox-custom-label">{{ $property_type->type }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="ameneties-features mt-3">
                                <label>Reservation Policy</label>
                                <ul class="no-ul-list">
                                    @foreach ($reservation_policies as $reservation_policy)
                                        <li>
                                            <input name="reservation_policy"
                                                id="reservation_policy{{ $reservation_policy->id }}"
                                                value="{{ $reservation_policy->id }}" class="filter checkbox-custom"
                                                type="checkbox" @if (in_array($reservation_policy->id, explode(',', request()->input('filter.reservation_policy')))) checked @endif />
                                            <label for="reservation_policy{{ $reservation_policy->id }}"
                                                class="checkbox-custom-label">{{ $reservation_policy->type }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="ameneties-features mt-3">
                                <label>Review Score</label>
                                <ul class="no-ul-list">
                                    @foreach ($review_scores as $review_score)
                                        <li>
                                            <input name="review_score" id="review_score{{ $review_score->id }}"
                                                value="{{ $review_score->id }}" class="filter checkbox-custom"
                                                type="checkbox" @if (in_array($review_score->id, explode(',', request()->input('filter.review_score')))) checked @endif />
                                            <label for="review_score{{ $review_score->id }}"
                                                class="checkbox-custom-label">{{ $review_score->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="ameneties-features mt-3">
                                <label>Meal Type</label>
                                <ul class="no-ul-list">
                                    @foreach ($meal_types as $meal_type)
                                        <li>
                                            <input name="meal_type" id="meal_type{{ $meal_type->id }}"
                                                value="{{ $meal_type->id }}" class="filter checkbox-custom"
                                                type="checkbox" @if (in_array($meal_type->id, explode(',', request()->input('filter.meal_type')))) checked @endif />
                                            <label for="meal_type{{ $meal_type->id }}"
                                                class="checkbox-custom-label">{{ $meal_type->type }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="ameneties-features mt-3">
                                <label>Room Facility</label>
                                <ul class="no-ul-list">
                                    @foreach ($room_sub_facilities as $room_sub_facility)
                                        <li class="{{ $loop->iteration > 6 ? 'room_facility_hide_class' : '' }}">
                                            <input name="room_sub_facility"
                                                id="room_sub_facility{{ $room_sub_facility->id }}"
                                                value="{{ $room_sub_facility->id }}" class="filter checkbox-custom"
                                                type="checkbox" @if (in_array($room_sub_facility->id, explode(',', request()->input('filter.room_sub_facilities')))) checked @endif />
                                            <label for="room_sub_facility{{ $room_sub_facility->id }}"
                                                class="checkbox-custom-label">{{ $room_sub_facility->name }}</label>
                                        </li>
                                    @endforeach
                                    <label c id="room_facility_see_more" style="color:cornflowerblue;">Show more</label>
                                    <label id="room_facility_see_less" style="color:cornflowerblue;">Show less</label>
                                </ul>

                            </div>
                            <div class="ameneties-features mt-3">
                                <label>Lanhuages</label>
                                <ul class="no-ul-list">
                                    <li>
                                        <input id="ml-1" class="checkbox-custom" name="ml-1" type="checkbox">
                                        <label for="ml-1" class="checkbox-custom-label">English</label>
                                    </li>
                                    <li>
                                        <input id="ml-2" class="checkbox-custom" name="ml-2" type="checkbox">
                                        <label for="ml-2" class="checkbox-custom-label">Fench</label>
                                    </li>
                                    <li>
                                        <input id="ml-3" class="checkbox-custom" name="ml-3" type="checkbox">
                                        <label for="ml-3" class="checkbox-custom-label">Spanish</label>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Sidebar End -->
                <div class="order-1 content-area col-lg-8 col-md-12 order-md-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="shorting-wrap">
                                <h5 class="shorting-title">{{ $properties->total() }} Results
                                    {{ Request::query('city_name') }}</h5>
                                <div class="shorting-right">
                                    <label>Sort By:</label>
                                    <div class="dropdown show">
                                        <a class="btn btn-filter dropdown-toggle" href="#" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="selection">
                                                @if (Request::query('most_viewd') != null)
                                                    Most Viewd
                                                @elseif (Request::query('less_price') != null)
                                                    Less Price
                                                @elseif (Request::query('top_picks') != null)
                                                    Our Top Picks
                                                @endif
                                            </span>
                                        </a>
                                        <div class="drp-select dropdown-menu" id="drp-select">
                                            <!-- <a class="dropdown-item" href="{{ url()->full() . '&' . 'most_rated=true' }}">Most Rated</a> -->
                                            <a class="dropdown-item" href="JavaScript:Void(0);">Our Top Picks</a>

                                            @if (Request::query('city_name') != null)
                                                <a class="dropdown-item"
                                                    href="{{ url()->current() }}?city_name={{ Request::query('city_name') }}&most_viewd=true">Most
                                                    Viewd</a>
                                            @else
                                                <a class="dropdown-item"
                                                    href="{{ url('properties/list/all/filter') . '?' . 'most_viewd=true' }}">Most
                                                    Viewd</a>
                                            @endif
                                            <a class="dropdown-item" href="JavaScript:Void(0);">Top Reviewed</a>

                                            @if (Request::query('city_name') != null)
                                                <a class="dropdown-item"
                                                    href="{{ url()->current() }}?city_name={{ Request::query('city_name') }}&less_price=true">Less
                                                    Price</a>
                                            @else
                                                <a class="dropdown-item"
                                                    href="{{ url('properties/list/all/filter') . '?' . 'less_price=true' }}">Less
                                                    Price</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        @foreach ($properties as $property)
                            <div class="book_list_box popular_item" style="width: 100%;">
                                <div class="row no-gutters">
                                    <div class="col-lg-4 col-md-4">
                                        <figure>
                                            <a href="{{ URL('properties/details/' . $property->id) }}"><img
                                                    src="{{ URL('storage/property_image/' . $property->main_image) }}"
                                                    class="img-responsive" alt="" /></a>
                                        </figure>
                                    </div>
                                    <div class="col-lg-6 col-md-6 pl-5 side-br">
                                        <div class="book_list_header">
                                            <div class="view-ratting">
                                                <i class="fa fa-star filler"></i>
                                                <i class="fa fa-star filler"></i>
                                                <i class="fa fa-star filler"></i>
                                                <i class="fa fa-star filler"></i>
                                                <i class="fa fa-star filler"></i>
                                            </div>
                                            <h4 class="book_list_title"><a
                                                    href="{{ URL('properties/details/' . $property->id) }}">{{ $property->name }}</a>
                                            </h4>
                                            <span class="location"><i
                                                    class="ti-location-pin"></i>{{ $property->districts->name }},{{ $property->city->name }}</span>
                                        </div>
                                        <div class="book_list_description">
                                            <P>{{ $property->description }}</P>
                                        </div>
                                        <div class="book_list_rate">
                                            <h5 class="over_all_rate high"><span class="rating_status">4.8</span>Very
                                                Good<small>(16 Reviews)</small></h5>
                                        </div>
                                        <div class="book_list_offers">
                                            <ul>
                                                @foreach ($property->facilities as $property_facility)
                                                    <li><i class="ti-location-pin">{{ $property_facility->name }}</i></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 padd-l-0">
                                        <div class="book_list_foot">
                                            <span class="off-status theme-cl">Up To 10% Off</span>
                                            @foreach ($property->rooms as $property_rooms)
                                                @if ($loop->first)
                                                    <h4 class="book_list_price">Rs{{ $property_rooms->minimum_rate }}</h4>
                                                @endif
                                            @endforeach
                                            <span class="booking-time">per night</span>
                                            <a href="#" class="book_list_btn btn-theme">Select</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $properties->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- =================== Sidebar Search ==================== -->
@endsection

@section('script')
    <script>
        $('.ui.dropdown').dropdown();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#searchFilter').on('submit', function(event) {
            let city = $('#city_name').val();
            event.preventDefault();
            $.ajax({

                url: "{{ URL('properties/search') }}" + '?' + 'city_name=' + city,
                method: "GET",
                // data: {
                //     city_name: city,
                // },

                success: function(response) {
                    if (response.success) {
                        console.log("pkkkk");
                    }
                }
            });
        });

        $('#drp-select').on('change', function() {
            var value = $(this).val();
            alert(value);
        });
        $('.room_facility_hide_class').hide()
        $('#room_facility_see_less').hide();;

        $('#room_facility_see_more').click(function() {
            $('.room_facility_hide_class').show();
            $('#room_facility_see_more').hide();
            $('#room_facility_see_less').show();
        });
        $('#room_facility_see_less').click(function() {
            $('.room_facility_hide_class').hide();
            $('#room_facility_see_more').show();
            $('#room_facility_see_less').hide();;

        });

        $('.filter').change(function() {
            //console.log($(this).attr('id'));


            let property_facility_ids = getIds("facility_name");
            let property_type_ids = getIds("property_type");
            let room_sub_facility_ids = getIds("room_sub_facility");
            let reservation_policy_ids = getIds("reservation_policy");
            let meal_type_ids = getIds("meal_type");
            let star_rating_ids = getIds("star_rating");
            let review_score_ids = getIds("review_score");
            //console.log(star_rating_ids);
            // console.log(property_type);
            //  throw new Error("Something went badly wrong!");

            current_url = new URL(window.location.href);
            if (current_url.searchParams.get('city_name')) {
                if (current_url.searchParams.get('less_price')) {
                    let city_name = current_url.searchParams.get('city_name');
                    let less_price = current_url.searchParams.get('less_price');
                    let href = "{{ url()->current() }}?city_name=" + city_name + '&' + 'less_price=' + less_price +
                        '&';
                    // console.log(href);
                    if (property_facility_ids.length) {
                        href += 'filter[property_facility]=' + property_facility_ids + '&';
                    }
                    if (property_type_ids.length) {
                        href += 'filter[property_type]=' + property_type_ids + '&';
                    }
                    if (room_sub_facility_ids.length) {
                        href += 'filter[room_sub_facilities]=' + room_sub_facility_ids + '&';
                    }
                    if (reservation_policy_ids.length) {
                        href += 'filter[reservation_policy]=' + reservation_policy_ids + '&';
                    }
                    if (meal_type_ids.length) {
                        href += 'filter[meal_type]=' + meal_type_ids + '&';
                    }
                    if (star_rating_ids.length) {
                        href += 'filter[star_rating]=' + star_rating_ids + '&';
                    }
                    if (review_score_ids.length) {
                        href += 'filter[review_score]=' + review_score_ids + '&';
                    }

                    document.location.href = href;

                } else if (current_url.searchParams.get('most_viewd')) {
                    let city_name = current_url.searchParams.get('city_name');
                    let most_viewd = current_url.searchParams.get('most_viewd');
                    let href = "{{ url()->current() }}?city_name=" + city_name + '&' + 'most_viewd=' + most_viewd +
                        '&';
                    // console.log(href);
                    if (property_facility_ids.length) {
                        href += 'filter[property_facility]=' + property_facility_ids + '&';
                    }
                    if (property_type_ids.length) {
                        href += 'filter[property_type]=' + property_type_ids + '&';
                    }
                    if (room_sub_facility_ids.length) {
                        href += 'filter[room_sub_facilities]=' + room_sub_facility_ids + '&';
                    }
                    if (reservation_policy_ids.length) {
                        href += 'filter[reservation_policy]=' + reservation_policy_ids + '&';
                    }
                    if (meal_type_ids.length) {
                        href += 'filter[meal_type]=' + meal_type_ids + '&';
                    }
                    if (review_score_ids.length) {
                        href += 'filter[review_score]=' + review_score_ids + '&';
                    }
                    document.location.href = href;
                } else {
                    let city_name = current_url.searchParams.get('city_name');
                    let href = "{{ url()->current() }}?city_name=" + city_name + '&';
                    console.log(href);
                    if (property_facility_ids.length) {
                        href += 'filter[property_facility]=' + property_facility_ids + '&';
                    }
                    if (property_type_ids.length) {
                        href += 'filter[property_type]=' + property_type_ids + '&';
                    }
                    if (room_sub_facility_ids.length) {
                        href += 'filter[room_sub_facilities]=' + room_sub_facility_ids + '&';
                    }
                    if (reservation_policy_ids.length) {
                        href += 'filter[reservation_policy]=' + reservation_policy_ids + '&';
                    }
                    if (meal_type_ids.length) {
                        href += 'filter[meal_type]=' + meal_type_ids + '&';
                    }
                    if (star_rating_ids.length) {
                        href += 'filter[star_rating]=' + star_rating_ids + '&';
                    }
                    if (review_score_ids.length) {
                        href += 'filter[review_score]=' + review_score_ids + '&';
                    }

                    document.location.href = href;
                }

            } else {
                if (current_url.searchParams.get('less_price')) {
                    let less_price = current_url.searchParams.get('less_price');
                    let href = "{{ url()->current() }}?less_price=" + less_price + '&';

                    // console.log(href);
                    if (property_facility_ids.length) {
                        href += 'filter[property_facility]=' + property_facility_ids + '&';
                    }
                    if (property_type_ids.length) {
                        href += 'filter[property_type]=' + property_type_ids + '&';
                    }
                    if (room_sub_facility_ids.length) {
                        href += 'filter[room_sub_facilities]=' + room_sub_facility_ids + '&';
                    }
                    if (reservation_policy_ids.length) {
                        href += 'filter[reservation_policy]=' + reservation_policy_ids + '&';
                    }
                    if (meal_type_ids.length) {
                        href += 'filter[meal_type]=' + meal_type_ids + '&';
                    }
                    if (star_rating_ids.length) {
                        href += 'filter[star_rating]=' + star_rating_ids + '&';
                    }
                    if (review_score_ids.length) {
                        href += 'filter[review_score]=' + review_score_ids + '&';
                    }

                    document.location.href = href;

                } else if (current_url.searchParams.get('most_viewd')) {
                    let most_viewd = current_url.searchParams.get('most_viewd');
                    let href = "{{ url()->current() }}?most_viewd=" + most_viewd + '&';
                    //console.log(href);
                    if (property_facility_ids.length) {
                        href += 'filter[property_facility]=' + property_facility_ids + '&';
                    }
                    if (property_type_ids.length) {
                        href += 'filter[property_type]=' + property_type_ids + '&';
                    }
                    if (room_sub_facility_ids.length) {
                        href += 'filter[room_sub_facilities]=' + room_sub_facility_ids + '&';
                    }
                    if (reservation_policy_ids.length) {
                        href += 'filter[reservation_policy]=' + reservation_policy_ids + '&';
                    }
                    if (meal_type_ids.length) {
                        href += 'filter[meal_type]=' + meal_type_ids + '&';
                    }
                    if (star_rating_ids.length) {
                        href += 'filter[star_rating]=' + star_rating_ids + '&';
                    }
                    if (review_score_ids.length) {
                        href += 'filter[review_score]=' + review_score_ids + '&';
                    }

                    document.location.href = href;

                } else {

                    let href = "{{ url('properties/list/all/filter') }}" + '?';
                    let url = "{{ url('properties/list/all/') }}"

                    if (property_facility_ids.length || property_type_ids.length || room_sub_facility_ids.length ||
                        reservation_policy_ids.length || meal_type_ids.length || star_rating_ids.length ||
                        review_score_ids.length) {
                        if (property_facility_ids.length) {
                            href += 'filter[property_facility]=' + property_facility_ids + '&';
                        }
                        if (property_type_ids.length) {
                            href += 'filter[property_type]=' + property_type_ids + '&';
                        }
                        if (room_sub_facility_ids.length) {
                            href += 'filter[room_sub_facilities]=' + room_sub_facility_ids + '&';
                        }
                        if (reservation_policy_ids.length) {
                            href += 'filter[reservation_policy]=' + reservation_policy_ids + '&';
                        }
                        if (meal_type_ids.length) {
                            href += 'filter[meal_type]=' + meal_type_ids + '&';
                        }
                        if (star_rating_ids.length) {
                            href += 'filter[star_rating]=' + star_rating_ids + '&';
                        }
                        if (review_score_ids.length) {
                            href += 'filter[review_score]=' + review_score_ids + '&';
                        }
                        document.location.href = href;

                    } else {
                        document.location.href = url;
                    }

                }
            }
        });

        function getIds(checkboxName) {
            let checkBoxes = document.getElementsByName(checkboxName);
            console.log(checkBoxes);
            let ids = Array.prototype.slice.call(checkBoxes)
                .filter(ch => ch.checked == true)
                .map(ch => ch.value);
            // console.log(ids);
            return ids;
        }

        function abc(event, filter_group_name, id) {

            console.log(filter_group_name, id);
            if (event.checked) {
                console.log(current_url = new URL(window.location.href));
                console.log("checked");
            } else {
                console.log("unchecked");
            }
        }
    </script>
@endsection
