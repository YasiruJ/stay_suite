@extends('home.customer.layouts.master')
@section('content')
<div class="dashboard-wrapers">
    <div class="dashboard-gravity-list">

        <h4>Booking Requests</h4>
        <ul>

            <li class="pending-booking">
                <div class="list-box-listing bookings">
                    <div class="list-box-listing-img"><img src="https://image.flaticon.com/icons/png/512/145/145849.png" alt=""></div>
                    <div class="list-box-listing-content">
                        <div class="inner">
                            <h3>Shivraj Modern Apartment <span class="booking-status pending">Pending</span><span class="booking-status unpaid">Unpaid</span></h3>

                            <div class="inner-booking-list">
                                <h5>Booking Date:</h5>
                                <ul class="booking-list">
                                    <li class="highlighted">22.10.2019 - 25.10.2019</li>
                                </ul>
                            </div>

                            <div class="inner-booking-list">
                                <h5>Booking Details:</h5>
                                <ul class="booking-list">
                                    <li class="highlighted">3 Adults</li>
                                </ul>
                            </div>

                            <div class="inner-booking-list">
                                <h5>Price:</h5>
                                <ul class="booking-list">
                                    <li class="highlighted">$217</li>
                                </ul>
                            </div>

                            <div class="inner-booking-list">
                                <h5>Client:</h5>
                                <ul class="booking-list">
                                    <li>Shiv Raj</li>
                                    <li>shivraj@example.com</li>
                                    <li>123-456-789</li>
                                </ul>
                            </div>

                            <a href="#small-dialog" class="rate-review"><i class="ti-email"></i> Send Message</a>

                        </div>
                    </div>
                </div>
                <div class="buttons-to-right">
                    <a href="#" class="button gray reject"><i class="ti-close"></i> Reject</a>
                    <a href="#" class="button gray approve"><i class="ti-trash"></i> Approve</a>
                </div>
            </li>

            <li class="approved-booking">
                <div class="list-box-listing bookings">
                    <div class="list-box-listing-img"><img src="https://image.flaticon.com/icons/png/512/145/145849.png" alt=""></div>
                    <div class="list-box-listing-content">
                        <div class="inner">
                            <h3>Burger Houses <span class="booking-status">Approved</span></h3>

                            <div class="inner-booking-list">
                                <h5>Booking Date:</h5>
                                <ul class="booking-list">
                                    <li class="highlighted">12.12.2019 at 10:20 pm - 12:20 pm</li>
                                </ul>
                            </div>

                            <div class="inner-booking-list">
                                <h5>Booking Details:</h5>
                                <ul class="booking-list">
                                    <li class="highlighted">3 Adults, 3 Children</li>
                                </ul>
                            </div>

                            <div class="inner-booking-list">
                                <h5>Client:</h5>
                                <ul class="booking-list">
                                    <li>Lita Andrew</li>
                                    <li>litha@support.com</li>
                                    <li>123-456-789</li>
                                </ul>
                            </div>

                            <a href="#small-dialog" class="rate-review"><i class="ti-email"></i> Send Message</a>

                        </div>
                    </div>
                </div>
                <div class="buttons-to-right">
                    <a href="#" class="button gray reject"><i class="ti-trash"></i> Cancel</a>
                </div>
            </li>

            <li class="canceled-booking">
                <div class="list-box-listing bookings">
                    <div class="list-box-listing-img"><img src="https://image.flaticon.com/icons/png/512/145/145849.png" alt=""></div>
                    <div class="list-box-listing-content">
                        <div class="inner">
                            <h3>Shiwani Restaurant <span class="booking-status">Canceled</span></h3>

                            <div class="inner-booking-list">
                                <h5>Booking Date:</h5>
                                <ul class="booking-list">
                                    <li class="highlighted">21.10.2019 at 9:30 am - 10:30 am</li>
                                </ul>
                            </div>

                            <div class="inner-booking-list">
                                <h5>Booking Details:</h5>
                                <ul class="booking-list">
                                    <li class="highlighted">3 Adults</li>
                                </ul>
                            </div>

                            <div class="inner-booking-list">
                                <h5>Client:</h5>
                                <ul class="booking-list">
                                    <li>Shivani Singh</li>
                                    <li>shivani@example.com</li>
                                    <li>123-456-789</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</div>
@endsection