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


    @yield('styles')

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
                <div class="booking-summery">
                    <div class="row">
                        <div class="col-8">
                            <div class="booking-main-contanet my-2">
                                <div class="card">
                                    <div class="card-body propery-good-to-know">
                                        <h5 class="card-title">Your Booking in {{ $property->districts->name }} is confirmed</h5>
                                        <div class="bui-card__text mt-3">

                                                <div class="bui-group bui-group__item-inline">
                                                    <div class="bui-inline-container__start">
                                                        <span class="bui-icon bui-icon--medium" role="presentation">
                                                            <svg class="bk-icon-good-to-know" fill="#008009" height="16" role="presentation" width="16" viewBox="0 0 128 128" aria-hidden="true" focusable="false">
                                                                <path d="M56.62 93.54a4 4 0 0 1-2.83-1.18L28.4 67a4 4 0 1 1 5.65-5.65l22.13 22.1 33-44a4 4 0 1 1 6.4 4.8L59.82 91.94a4.06 4.06 0 0 1-2.92 1.59zM128 64c0-35.346-28.654-64-64-64C28.654 0 0 28.654 0 64c0 35.346 28.654 64 64 64 35.33-.039 63.961-28.67 64-64zm-8 0c0 30.928-25.072 56-56 56S8 94.928 8 64 33.072 8 64 8c30.914.033 55.967 25.086 56 56z"></path>
                                                            </svg>
                                                        </span>
                                                    </div>

                                                    <div class="bui-inline-container__main">
                                                        <p class="bui-text--variant-body_2">
                                                            Your Booking Confirmation is in your email.
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="bui-group bui-group__item-inline">
                                                    <div class="bui-inline-container__start">
                                                        <span class="bui-icon bui-icon--medium" role="presentation">
                                                            <svg class="bk-icon-good-to-know" fill="#008009" height="16" role="presentation" width="16" viewBox="0 0 128 128" aria-hidden="true" focusable="false">
                                                                <path d="M56.62 93.54a4 4 0 0 1-2.83-1.18L28.4 67a4 4 0 1 1 5.65-5.65l22.13 22.1 33-44a4 4 0 1 1 6.4 4.8L59.82 91.94a4.06 4.06 0 0 1-2.92 1.59zM128 64c0-35.346-28.654-64-64-64C28.654 0 0 28.654 0 64c0 35.346 28.654 64 64 64 35.33-.039 63.961-28.67 64-64zm-8 0c0 30.928-25.072 56-56 56S8 94.928 8 64 33.072 8 64 8c30.914.033 55.967 25.086 56 56z"></path>
                                                            </svg>
                                                        </span>
                                                    </div>

                                                    <div class="bui-inline-container__main">
                                                        <p class="bui-text--variant-body_2">
                                                            The payment will be handled by the property.
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- <div class="bui-group bui-group__item-inline">
                                                    <div class="bui-inline-container__start">
                                                        <span class="bui-icon bui-icon--medium" role="presentation">
                                                            <svg class="bk-icon-good-to-know" fill="#008009" height="16" role="presentation" width="16" viewBox="0 0 128 128" aria-hidden="true" focusable="false">
                                                                <path d="M56.62 93.54a4 4 0 0 1-2.83-1.18L28.4 67a4 4 0 1 1 5.65-5.65l22.13 22.1 33-44a4 4 0 1 1 6.4 4.8L59.82 91.94a4.06 4.06 0 0 1-2.92 1.59zM128 64c0-35.346-28.654-64-64-64C28.654 0 0 28.654 0 64c0 35.346 28.654 64 64 64 35.33-.039 63.961-28.67 64-64zm-8 0c0 30.928-25.072 56-56 56S8 94.928 8 64 33.072 8 64 8c30.914.033 55.967 25.086 56 56z"></path>
                                                            </svg>
                                                        </span>
                                                    </div>

                                                    <div class="bui-inline-container__main">
                                                        <p class="bui-text--variant-body_2">
                                                            Booking for tonight?
                                                            No credit card needed!
                                                        </p>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-customer-details-header my-2">
                                    <div class="bui-inline-container">
                                        <div class="bui-inline-container__main">
                                            <h3>Your Booking Summary</h3>
                                            {{-- <div class="bui-customer-details-text">
                                                Almost done! Just fill in the <span style="color: red;">*</span> required info
                                            </div> --}}
                                        </div>
                                        {{-- <div class="bui-inline-container__main-profile">
                                            <div class="customer-profile">
                                                <div class="customer-img">
                                                    <img src="https://images.unsplash.com/photo-1466112928291-0903b80a9466?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8cHJvZmlsZXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
                                                </div>
                                                <div class="customer-name">
                                                    <span>
                                                        <h6>Takesha Kaluarchchi</h6>
                                                    </span>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="card  my-2" style="width: 100%;">
                                    <div class="card-body">
                                        <div class="booking-hotel-main-card">
                                            <div class="bp-property-details__photo">
                                                <img src="{{ URL('storage/property_image/' . $property->main_image) }}" alt="..." class="img-fluid">
                                            </div>
                                            <div class="hotel-main-description">
                                                <div class="bui-group">
                                                    <div class="bui-group__item">
                                                        <div class="bui-spacer--smaller">
                                                            {{-- <div class="bui-group__item mr-2">
                                                                <span class="bui-text--property-name">
                                                                    {{ $property->propertyTypes->type }}
                                                                </span>
                                                            </div> --}}
                                                            {{-- <div class="bui-property-star">
                                                                <div class="st-stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <h3 class="bg-propery-main-card mb-2">{{ $property->name }}</h3>
                                                </div>
                                                <div class="bui-group bui-group__item-inline">
                                                    <div class="bui-inline-container__start">
                                                        <span class="bui-icon bui-icon--medium" role="presentation">
                                                            <i class="fa fa-tag"></i>
                                                        </span>
                                                    </div>

                                                    <div class="bui-inline-container__main">
                                                        <p class="bui-text--variant-body_2" style="font-weight: bold;">
                                                            Total Price : LKR {{ $final_rate }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="bui-group bui-group__item-inline">
                                                    <div class="bui-inline-container__start">
                                                        <span class="bui-icon bui-icon--medium" role="presentation">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>

                                                    <div class="bui-inline-container__main">
                                                        <p class="bui-text--variant-body_2" style="font-weight: bold;">
                                                            {{ $start_date }} - {{ $end_date }}
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-customer-details-header my-2">

                                        <div class="bui-inline-container__main">
                                            <h3>Contact Property</h3>
                                            <div class="card mt-2">
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12 pl-1">
                                                            <label for="">Email : {{ $property->user->email }}</label> <br>
                                                            <label for="">Phone : {{ $property->user->phone }}</label>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            {{-- <div class="bui-customer-details-text">
                                                Almost done! Just fill in the <span style="color: red;">*</span> required info
                                            </div> --}}
                                        </div>
                                        {{-- <div class="bui-inline-container__main-profile">
                                            <div class="customer-profile">
                                                <div class="customer-img">
                                                    <img src="https://images.unsplash.com/photo-1466112928291-0903b80a9466?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8cHJvZmlsZXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
                                                </div>
                                                <div class="customer-name">
                                                    <span>
                                                        <h6>Takesha Kaluarchchi</h6>
                                                    </span>
                                                </div>
                                            </div>
                                        </div> --}}

                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="booking-summery-mobile" hidden>
                    <div class="row">
                        <div class="col-md-12 col-sm12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="booking-hotel-main-card">
                                        <div class="bp-property-details__photo">
                                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=750&q=80" alt="..." class="img-fluid">
                                        </div>
                                        <div class="hotel-main-description">
                                            <div class="bui-group">
                                                <div class="bui-group__item">
                                                    <div class="bui-spacer--smaller">
                                                        <div class="bui-group__item mr-2">
                                                            <span class="bui-text--property-name">
                                                                Hotel
                                                            </span>
                                                        </div>
                                                        <div class="bui-property-star">
                                                            <div class="st-stars">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="bg-propery-main-card mb-2">Shangri-La Colombo</h3>
                                            </div>
                                            <div class="bg-propery-main-address">
                                                <address>
                                                    1 Galle Face, Colombo 02 , 00200 Colombo, Sri Lanka
                                                </address>
                                                <div class="bg-propery-main-addresss-description">
                                                    <p class="text-success">This property has an excellent location. Guests have rated it 9.3!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="booking-divider booking-divider-mobile">
                                    <div class="booking-date-range">
                                        <div class="booking-date-range-item">
                                            <div class="booking-date-lable">
                                                <label for=""> Check-in</label>
                                            </div>
                                            <div class="booking-date">
                                                <span class="bui-date__title">Fri 24 Sept 2021</span>
                                                <span class="bui-date__subtitle">
                                                    14:00 – 23:30
                                                </span>
                                            </div>
                                        </div>
                                        <div class="booking-date-range-item">
                                            <div class="booking-date-lable">
                                                <label for=""> Check-out</label>
                                            </div>
                                            <div class="booking-date">
                                                <span class="bui-date__title">Fri 24 Sept 2021</span>
                                                <span class="bui-date__subtitle">
                                                    14:00 – 23:30
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="selected-room-mobile pl-4">
                                        <div class="bui-group bui-group--small">
                                            <div class="bui-f-font-strong">You selected:</div>
                                            <ul class="bui-list bui-list--text bp-list--compact">
                                                {{-- @foreach ($rooms as $room)
                                                <li class="bui-list__item">
                                                    <div>
                                                        {{ $room->room_types->type }}
                                                    </div>
                                                </li>
                                                @endforeach --}}

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="total-price mb-2">
                                        <div class="price-lable">
                                            <div class="price-heading">Price</div>
                                            <div class="your-currency">(Your Choice)</div>
                                        </div>
                                        <div class="total-booking-price-value">
                                            LKR &nbsp; 4500
                                        </div>
                                    </div>
                                    <div class="bui-group">
                                        <h3 class="bui-f-font-strong">Additional charges</h3>
                                        <ul class="bp-price-details__charges">
                                            <li class="bp-price-details__charge-line">
                                                <div class="bp-price-details__charge-type js-price-details__charge-type">
                                                    <div class="bp-price-details__charge-name">
                                                        VAT
                                                    </div>
                                                </div>
                                                <div class="bp-price-details__charge-value">
                                                    LKR&nbsp;548
                                                </div>
                                            </li>
                                            <li class="bp-price-details__charge-line">
                                                <div class="bp-price-details__charge-type js-price-details__charge-type">
                                                    <div class="bp-price-details__charge-name">
                                                        City tax
                                                    </div>
                                                </div>
                                                <div class="bp-price-details__charge-value">
                                                    LKR&nbsp;498
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr class="booking-divider">
                                    <div class="booking-summery-description">
                                        <p class="bui-f-font-caption e2e-price-details__currency-exchange-info">
                                            <span>*</span>
                                            This price is converted to show you the approximate cost in LKR. You'll pay in <b>US$</b> or <b>LKR</b>. The exchange rate may change before you pay.
                                        </p>
                                        <p class="bui-f-font-caption e2e-price-details__currency-exchange-info">
                                            Bear in mind that your card issuer may charge you a foreign transaction fee.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-danger my-3">
                                <div class="card-body bui-alert--error">
                                    <div class="bui-alert">
                                        <span class="bui-alert__icon">
                                            <svg class="bk-icon-goot-to-know -streamline-alarm" height="24" width="24" viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false">
                                                <path d="M20.25 12.75a8.25 8.25 0 1 1-16.5 0 8.25 8.25 0 0 1 16.5 0zm1.5 0C21.75 7.365 17.385 3 12 3s-9.75 4.365-9.75 9.75S6.615 22.5 12 22.5s9.75-4.365 9.75-9.75zM6.67 23.585l1.387-2.77a.75.75 0 1 0-1.342-.672L5.33 22.915a.75.75 0 1 0 1.342.671zM12 12H8.609a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5zm-.75-4.5v5.25a.75.75 0 0 0 1.5 0V7.5a.75.75 0 0 0-1.5 0zM1.969 4.336l3.75-3A.75.75 0 1 0 4.78.164l-3.75 3a.75.75 0 1 0 .938 1.172zM18.67 22.915l-1.386-2.772a.75.75 0 1 0-1.342.67l1.386 2.772a.75.75 0 1 0 1.342-.67zm4.297-19.75l-3.75-3a.75.75 0 0 0-.936 1.17l3.75 3a.75.75 0 1 0 .936-1.17z"></path>
                                            </svg>
                                        </span>
                                        <div class="bui-alert-description">
                                            <span class="bui-alert__title">Limited supply in Nuwara Eliya for your dates:</span>
                                            <div class="bui-alert-text">
                                                8 guest houses like this are already unavailable on our site
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body text-center">
                                    <p class="card-text mb-1">
                                        Signed in as
                                        <span class="booking-email-mobile">takeshafx@gmail.com</span>
                                    </p>
                                    <a href="#" class="btn btn-primary btn-sm">Sign out</a>
                                </div>
                            </div>
                            <div class="bui-inline-container__main my-3 text-center">
                                <h6>Enter your details</h6>
                                <div class="bui-customer-details-text">
                                    Almost done! Just fill in the <span style="color: red;">*</span> required info
                                </div>
                            </div>
                            <div class="card booking-customer-form mt-2">
                                <div class="card-body">
                                    <div class="col-md-12 col-sm-12 col-12 px-0">
                                        <div class="form-group">
                                            <label for="">First Name</label>
                                            <input type="text" class="form-control" placeholder="First Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Last Name</label>
                                            <input type="text" class="form-control" placeholder="Last Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress">Address</label>
                                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress2">City</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress2">Zip Code</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contact No</label>
                                            <input type="text" class="form-control" placeholder="First Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card booking-customer-form my-3">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <h5 class="booking-card-title float-left">Deluxe Double Room</h5>
                                        <div class="remove-subroom float-right">
                                            <span class="close-icon"><i class="fas fa-times"></i></span>
                                            <a href="javascript:void(0);">Remove</a>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column my-2">
                                        <div class="mb-2">
                                            <ul class="p-0 room-derails-choices-mobile">
                                                <li>
                                                    <i class="fa fa-check mr-2" aria-hidden="true"></i>
                                                    <span><b>FREE</b> cancellation anytime</span>
                                                </li>
                                                <li>
                                                    <i class="fa fa-check mr-2" aria-hidden="true"></i>
                                                    <span><b>FREE</b> cancellation anytime</span>
                                                </li>
                                                <li>
                                                    <i class="fa fa-check mr-2" aria-hidden="true"></i>
                                                    <span><b>FREE</b> cancellation anytime</span>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="sub-room-facility my-2">
                                            <ul>
                                                <div class="d-flex flex-row flex-wrap align-items-md-center mb-2">
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>Toilet
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span> view
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>ggf
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>ffdert
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>Mountain rdsd
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>ssdr
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>dfg
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>Mountain view
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>Toilet
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>Toilet
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>Mountain view
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="facility-box">
                                                            <span class="facility-icon mr-1"><i class="fa fa-bath" aria-hidden="true"></i>
                                                            </span>Toilet
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bui-group">
                                        <div class="gest-count mb-2">
                                            <label class="text-dark"> Guest Count </label>
                                            <select class="custom-select" id="inlineFormCustomSelect">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                        <div class="guest-full-name">
                                            <div class="form-group form-inline">
                                                <label class="mr-3 text-dark" for="formGroupExampleInput">Guest Full Name</label>
                                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <hr class="booking-divider">
                                    <div class="booking-breakfast">
                                        <div class="bui-group  bui-group__item-inline">
                                            <div class="bui-group__item">
                                                <div class="breakfast-checkbox">
                                                    <input id="a-1" class="checkbox-custom" name="a-1" type="checkbox">
                                                    <label for="a-1" class="checkbox-custom-label">Breakfast</label>
                                                </div>
                                                <div class="breakfast-details">
                                                    <p>Enjoy a convenient Breakfast at the property for LKR 1,797 per person per night.</p>
                                                </div>
                                            </div>
                                            <div class="bui-group__item">
                                                <span class="total_price_amount">LKR&nbsp;3,594</span>
                                                <span class="total_price_explanation">2 guests, 1 night</span>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="mobile_unit_bed_types">
                                        <ul>
                                            <span><b>Bedroom1 :</b>  </span>
                                            <li>
                                               <span class="bed-type-mobile">1 *&nbsp;Single Bed &nbsp;</span>
                                                <span><i class="fa fa-bed" aria-hidden="true"></i></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card booking-customer-form my-3">
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <div class="special-note-description">
                                            <p>Special requests cannot be guaranteed – but the property will do its best to meet your needs. You can always make a special request after your booking is complete!</p>
                                        </div>
                                        <div class="special-request">
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea3"><b>Please write your requests in English. (optional)</b> </label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary float-right mb-2">Complete Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('home.layouts.footer')
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

    @yield('script');


    <script>
        $('input[type=radio][name=paymentType]').change(function() {
            if (this.value == 1) {
                // ...
            }
            else if (this.value == 'transfer') {
                // ...
            }
        });
    </script>
</body>

</html>
