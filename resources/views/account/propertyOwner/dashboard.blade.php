@extends('account.propertyOwner.layouts.master')
@section('content')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Gimanhal</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one">
                        <i class="icon-layers float-right m-0 h2 text-muted"></i>
                        <h6 class="text-muted text-uppercase mt-0">Active Bookings</h6>
                        <h3 class="my-3" data-plugin="counterup">{{ $active_bookings_count }}</h3>
                        {{-- <span class="badge badge-success mr-1"> +11% </span> <span class="text-muted">From previous period</span> --}}
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one">
                        <i class="icon-layers float-right m-0 h2 text-muted"></i>
                        <h6 class="text-muted text-uppercase mt-0">All Bookings</h6>
                        <h3 class="my-3"><span data-plugin="counterup">{{ $all_bookings_count }}</span></h3>
                        {{-- <span class="badge badge-danger mr-1"> -29% </span> <span class="text-muted">From previous period</span> --}}
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one">
                        <i class="icon-chart float-right m-0 h2 text-muted"></i>
                        <h6 class="text-muted text-uppercase mt-0">Credit Balance</h6>
                        <h3 class="my-3">LKR {{ $credit_total }}</span></h3>
                        {{-- <span class="badge badge-pink mr-1"> 0% </span> <span class="text-muted">From previous period</span> --}}
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one">
                        <i class="icon-chart float-right m-0 h2 text-muted"></i>
                        <h6 class="text-muted text-uppercase mt-0">Debit Balance</h6>
                        <h3 class="my-3">LKR <span data-plugin="counterup"> {{ $debit_total }}</h3>
                        {{-- <span class="badge badge-warning mr-1"> +89% </span> <span class="text-muted">Last year</span> --}}
                    </div>
                </div>
            </div>
            <!-- end row -->

{{--
            <div class="row">
                <div class="col-lg-6 col-xl-8">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Sales Statistics</h4>

                        <div class="text-center">
                            <ul class="list-inline chart-detail-list mb-0">
                                <li class="list-inline-item">
                                    <h6 class="text-info"><i class="mdi mdi-circle-outline mr-1"></i>Series A</h6>
                                </li>
                                <li class="list-inline-item">
                                    <h6 class="text-success"><i class="mdi mdi-triangle-outline mr-1"></i>Series B</h6>
                                </li>
                                <li class="list-inline-item">
                                    <h6 class="text-muted"><i class="mdi mdi-square-outline mr-1"></i>Series C</h6>
                                </li>
                            </ul>
                        </div>

                        <div id="morris-bar-stacked" class="morris-chart" style="height: 320px;"></div>

                    </div>
                </div><!-- end col-->

                <div class="col-lg-6 col-xl-4">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Trends Monthly</h4>

                        <div class="text-center mb-3">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-sm btn-secondary">Today</button>
                                <button type="button" class="btn btn-sm btn-secondary">This Week</button>
                                <button type="button" class="btn btn-sm btn-secondary">Last Week</button>
                            </div>
                        </div>

                        <div id="morris-donut-example" class="morris-chart" style="height: 268px;"></div>

                        <div class="text-center">
                            <ul class="list-inline chart-detail-list mb-0 mt-2">
                                <li class="list-inline-item">
                                    <h6 class="text-info"><i class="mdi mdi-circle-outline mr-1"></i>English</h6>
                                </li>
                                <li class="list-inline-item">
                                    <h6 class="text-success"><i class="mdi mdi-triangle-outline mr-1"></i>Italian</h6>
                                </li>
                                <li class="list-inline-item">
                                    <h6 class="text-muted"><i class="mdi mdi-square-outline mr-1"></i>French</h6>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div><!-- end col-->
            </div>
            <!-- end row --> --}}


            <div class="row">
                <div class="col-xl-12">
                    <div class="card-box">

                        <h4 class="header-title mb-3">Latest Bookings</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>CheckIn Date</th>
                                    <th>CheckOut Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($latest_bookings as $booking)
                                    <tr>
                                        <th class="text-muted">{{ $booking->id }}</th>
                                        <td>{{ date('Y-m-d', strtotime($booking->check_in_date)) }}</td>
                                        <td>{{ date('Y-m-d', strtotime($booking->check_out_date)) }}</td>
                                        <td>
                                            @if ($booking->bookingStatus->type == 'pending')
                                            <span id="owner_status_{{ $booking->id }}"
                                                class="badge badge-warning  even-larger-badge my-2"
                                                style="font-size: 1em;">{{ $booking->bookingStatus->type }}</span>
                                            @elseif ($booking->bookingStatus->type == 'confirmed' ||$booking->bookingStatus->type == 'payment-settled'
                                            ||$booking->bookingStatus->type == 'booking-done' )
                                            <span id="owner_status_{{ $booking->id }}"
                                                class="badge badge-success  even-larger-badge my-2"
                                                style="font-size: 1em;">{{ $booking->bookingStatus->type }}</span>
                                            @elseif ($booking->bookingStatus->type == 'rejected' || $booking->bookingStatus->type == 'absent')
                                            <span id="owner_status_{{ $booking->id }}"
                                                class="badge badge-danger  even-larger-badge my-2"
                                                style="font-size: 1em;">{{ $booking->bookingStatus->type }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end col-->

            </div>
            <!-- end row -->

        </div> <!-- end container-fluid -->

    </div> <!-- end content -->

@endsection
