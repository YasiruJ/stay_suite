@extends('account.propertyOwner.layouts.master')
@section('styles')
<!-- Custom CSS -->
<link href="{{ URL('dashboard_assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
<link href="{{ URL('dashboard_assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL('dashboard_assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL('dashboard_assets/libs/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ URL('dashboard_assets/libs/clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Bookings</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Booking - {{ $booking->id }} -
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
                     </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <form id="propertyForm">
                    <div class="card-box">

                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="header-title mb-4">Booking Details</h4>
                            </div>

                            <div class="col-md-3" style="text-align: right;">
                                @if ($booking->bookingStatus->type == 'pending')
                                <button type="button" onclick="changeStatues('confirmed',{{ $booking->id }})"
                                    class="btn waves-effect waves-light btn-primary">Confirm Booking</button>

                                <button type="button" onclick="changeStatues('rejected',{{ $booking->id }})"
                                    class="btn waves-effect waves-light btn-danger">Reject Booking</button>
                                @endif
                                @if ($booking->bookingStatus->type == 'confirmed')
                                <button type="button" onclick="changeStatues('booking-done',{{ $booking->id }})"
                                    class="btn waves-effect waves-light btn-success">Booking Completed</button>

                                <button type="button" onclick="changeStatues('absent',{{ $booking->id }})"
                                    class="btn waves-effect waves-light btn-danger">Customer Not showed up</button>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Booking Id</label>
                                    <input type="text" class="form-control" id="" value="{{ $booking->id }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="">Property Name</label>

                                    <input type="text" class="form-control" id="" value="{{ $booking->properties->name }}" disabled>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="form-group">
                                    <label>Check In Date</label>
                                    <input type="text" class="form-control" id="" value="{{ date('Y-m-d', strtotime($booking->check_in_date)) }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Check Out Date</label>
                                    <input type="text" class="form-control" id="" value="{{ date('Y-m-d', strtotime($booking->check_out_date)) }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Customer Name</label>
                                    <input type="text" class="form-control" id="" value="{{ $booking->first_name }} {{ $booking->last_name }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="">Customer Email</label>
                                    <input type="text" class="form-control" id="" value="{{ $booking->email }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Customer Phone</label>
                                    <input type="text" class="form-control" id="" value="{{ $booking->phone }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="">Customer Address</label>
                                    <input type="text" class="form-control" id="" value="{{ $booking->address }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Special Requests</label>
                                    <div>
                                        <textarea class="form-control" rows="3" disabled>{{ $booking->special_request }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title mb-6">Room Details</h4>
                                <table id="table" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Room Type</th>
                                        <th>Sleeps</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking_sub_rooms as $booking_sub_room)

                                        <tr>

                                            <td>{{ $booking_sub_room->id }}</td>
                                            <td>{{ $booking_sub_room->rooms->roomTypes->type }}</td>
                                            <td>{{ $booking_sub_room->subRooms->sleep_count }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                </div>
                            </div>
                    </div>


                    </div>
                </form>
            </div><!-- end row -->
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->
</div> <!-- end container-fluid -->
</div> <!-- end content -->

@endsection

@section('scripts')
<script src="{{ URL('dashboard_assets/libs/moment/moment.min.js') }}"></script>
<script src="{{ URL('dashboard_assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL('dashboard_assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ URL('dashboard_assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL('dashboard_assets//libs/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL('dashboard_assets/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ URL('dashboard_assets/libs/dropify/dropify.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


<!-- Init js-->
<script src="{{ URL('dashboard_assets/js/pages/form-pickers.init.js') }}"></script>
<script src="{{ URL('dashboard_assets/js/pages/form-fileuploads.init.js') }}"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function changeStatues(status,booking_id) {

        Swal.fire({
            title: 'Are you sure?',
            text: "Booking will confirm after this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm!'
            }).then((result) => {
            if (result.isConfirmed) {


                $.ajax({
                    url: "{{ url('property-owner/booking/status/update') }}",
                    type: 'POST',
                    data: {
                        status: status,
                        booking_id: booking_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                            'Updated!',
                            response.message,
                            'success'
                            ).then((result) => {

                                location.reload();
                            });

                        }
                    }
                })

            }
        })

        }

    $('#propertyForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('property-owner/properties/save') }}",
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
</script>
@endsection
