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
                                <li class="breadcrumb-item"><a href="{{ URL('/property-owner/dashboard') }}">Gimanhal</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Bookings</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">All Bookings</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        {{-- <h4 class="header-title">property Details</h4> --}}


                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    {{-- <th>Active</th> --}}
                                    <th>ID</th>
                                    <th>Property_name</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Customer Phone</th>
                                    <th>amount (LKR)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        {{-- <td><input type="checkbox" data-id="{{ $property->id }}" class="js-switch"
                                                name="js-switch" {{ $property->property_active ? 'checked' : '' }} /></td> --}}
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->property->name }}</td>
                                        <td>{{ $booking->check_in_date }}</td>
                                        <td>{{ $booking->check_out_date }}</td>
                                        <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                        <td>{{ $booking->email }}</td>
                                        <td>{{ $booking->phone }}</td>
                                        <td>{{ $booking->property_owner_fee }}</td>
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
                                            @elseif ($booking->bookingStatus->type == 'rejected')
                                            <span id="owner_status_{{ $booking->id }}"
                                                class="badge badge-danger  even-larger-badge my-2"
                                                style="font-size: 1em;">{{ $booking->bookingStatus->type }}</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ URL('property-owner/bookings/details/' . $booking->id) }}"><button
                                                    class="btn waves-effect waves-light btn-warning"><i
                                                        class="mdi mdi-wrench"></i> </button></a>

                                            @if($booking->bookingStatus->type !== 'confirmed')
                                                <button type="button" onclick="changeStatues('confirmed',{{$booking->id}})"
                                                    class="btn waves-effect waves-light btn-primary">Confirm </button>
                                            @endif
                                            @if($booking->bookingStatus->type !== 'rejected')
                                            <button type="button" onclick="changeStatues('rejected',{{$booking->id}})"
                                                class="btn waves-effect waves-light btn-danger">Reject </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->

        </div> <!-- end container-fluid -->

    </div> <!-- end content -->
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            var switchery = new Switchery(html);
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




        var switchStatus = false;
        var propertyID
        $(".js-switch").on('change', function() {
            if ($(this).is(':checked')) {
                switchStatus = $(this).is(':checked');
                propertyID = $(this).data('id');
            } else {
                switchStatus = $(this).is(':checked');
                propertyID = $(this).data('id');

            }
            // console.log(switchStatus, propertyID);

            $.ajax({
                url: "{{ url('property-owner/property/status/update') }}" + '/' + propertyID,
                type: 'POST',
                data: {
                    switchStatus: switchStatus,

                },
                dataType: 'json',
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
                }
            })
        });
    </script>
@endsection
