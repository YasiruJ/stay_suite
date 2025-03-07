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
                                <li class="breadcrumb-item active"><a href="javascript: void(0);">Payments</a></li>
                                {{-- <li class="breadcrumb-item active">General Elements</li> --}}
                            </ol>
                        </div>
                        <h4 class="page-title">Payments Summary</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="section">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Payment details</h4>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#subRoom"
                                        role="tab" aria-controls="home" aria-expanded="true">Credit Payments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="province-tab" data-toggle="tab" href="#unit"
                                        role="tab" aria-controls="province">Debit Payments</a>
                                </li>
                            </ul>
                            <div class="tab-content text-muted" id="myTabContent">
                                <div role="tabpanel" class="tab-pane fade in active show" id="subRoom"
                                    aria-labelledby="home-tab">
                                    <div class="bg-lite clearfix my-3">
                                        <h4
                                            class="header-title badge badge-success waves-effect waves-light float-left p-3 ml-2">
                                            Credit Payments Total : LKR {{ $credit_total }}</h4>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="example-date-input">From Date</label>
                                            <input class="form-control" type="date" value="" id="example-date-input">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="example-date-input">To Date</label>
                                            <input class="form-control" type="date" value="" id="example-date-input1">
                                        </div>
                                        <div class="col-md-3" style="padding: 27px 0;">
                                            <button type="button" class="btn waves-effect waves-light btn-primary" >Filter</button>
                                            <button type="button" class="btn waves-effect waves-light btn-danger" >Clear Filters</button>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="card-box">

                                                <table id="data_table_subRoom"
                                                    class="table table-bordered dt-responsive nowrap"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Booking ID</th>
                                                            <th>Date</th>
                                                            <th>Property Name</th>
                                                            <td>Full Amount (LKR)</td>
                                                            <th>Property Fee (LKR) </th>
                                                            <th>Gimanhal Commission (LKR) </th>
                                                            <th>Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($credit_bookings as $booking)
                                                            <tr>
                                                                <td>
                                                                    {{ $booking->id }}
                                                                </td>
                                                                <td>{{ $booking->property->name }}</td>
                                                                <td>{{ date('Y-m-d', strtotime($booking->created_at)) }}</td>

                                                                <td>{{ $booking->total }}</td>

                                                                <td>
                                                                    {{ $booking->property_owner_fee }}
                                                                </td>
                                                                <td>
                                                                    {{ $booking->gimanhal_fee }}
                                                                </td>
                                                                <td>
                                                                    @if ($booking->bookingStatus->type == 'payment-settled')
                                                                        <span id="booking_status"
                                                                            class="badge badge-success  even-larger-badge my-2"
                                                                            style="font-size: 1em;">{{ $booking->bookingStatus->type }}</span>
                                                                    @else
                                                                        <span id="booking_status"
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
                                    </div> <!-- end row -->
                                </div>
                                <div class="tab-pane fade" id="unit" role="tabpane2"
                                    aria-labelledby="province-tab">
                                    <div class="bg-lite clearfix my-3">
                                        <h4
                                        class="header-title badge badge-success waves-effect waves-light float-left p-3 ml-2">
                                        Debit Payments Total : LKR {{ $debit_total }}</h4>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="card-box">


                                                <table id="data_table_unit"
                                                    class="table table-bordered dt-responsive nowrap"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Booking ID</th>
                                                            <th>Date</th>
                                                            <th>Property Name</th>
                                                            <td>Full Amount (LKR)</td>
                                                            <th>Gimanhal Commission (LKR) </th>
                                                            <th>Property Fee (LKR) </th>
                                                            <th>Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($debit_bookings as $booking)
                                                            <tr>
                                                                <td>
                                                                    {{ $booking->id }}
                                                                </td>
                                                                <td>{{ date('Y-m-d', strtotime($booking->created_at)) }}</td>
                                                                <td>{{ $booking->properties->name }}</td>

                                                                <td>{{ $booking->total }}</td>
                                                                <td>
                                                                    {{ $booking->gimanhal_fee }}
                                                                </td>

                                                                <td>
                                                                    {{ $booking->property_owner_fee }}
                                                                </td>

                                                                <td>
                                                                    @if ($booking->bookingStatus->type == 'payment-settled')
                                                                        <span id="booking_status"
                                                                            class="badge badge-success  even-larger-badge my-2"
                                                                            style="font-size: 1em;">{{ $booking->bookingStatus->type }}</span>
                                                                    @else
                                                                        <span id="booking_status"
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
                                    </div> <!-- end row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->
    </div>
    <!-- end row -->
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

        var switchStatus = false;
        var subRoomID
        $(".js-switch").on('change', function() {
            if ($(this).is(':checked')) {
                switchStatus = $(this).is(':checked');
                subRoomID = $(this).data('id');
            } else {
                switchStatus = $(this).is(':checked');
                subRoomID = $(this).data('id');

            }


            $.ajax({
                url: "{{ url('property-owner/sub_room/status/update') }}" + '/' + subRoomID,
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

        $('#roomEditForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ url('property-owner/properties/edit/room/edit/update') }}",
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

        $('#subRoomAddForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ url('/sub_room/save') }}",
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

        $('#subRoomEditForm').on('submit', function(event) {
            event.preventDefault();
            var sub_room_id = $('#sub_room_id').val();
            $.ajax({
                url: "{{ url('/sub_room/save') }}" + '/' + sub_room_id,
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

        $('#unitAddForm').on('submit', function(event) {
            event.preventDefault();
            let unit_name = $('#unit_name').val();
            let bed_type_ids = [];
            let count_array = [];

            $('input:checkbox[name="bed_type_ids"]:checked').each(function() {
                bed_type_ids.push($(this).val());
            });
            $('input[name="bed_count"]').each(function() {
                count_array.push($(this).val());
            });

            var filtered_count_array = count_array.filter(e => e != "");

            var obj = new Object();
            obj.unit_name = unit_name;
            obj.bed_type_ids = bed_type_ids;
            obj.filtered_count_array = filtered_count_array;
            console.log(obj);
            $.ajax({
                url: "{{ url('/sub_room/save') }}",
                method: "POST",
                data: obj,
                dataType: 'JSON',
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

        $('#unitUpdateForm').on('submit', function(event) {
            event.preventDefault();
            let unit_name = $('#edit_unit_name').val();
            let = unit_id = $('#edit_unit_id').val();
            let bed_type_ids = [];
            let count_array = [];

            $('input:checkbox[name="bed_type_edit_ids"]:checked').each(function() {
                bed_type_ids.push($(this).val());
            });
            $('input[name="bed_edit_count"]').each(function() {
                count_array.push($(this).val());
            });

            var filtered_count_array = count_array.filter(e => e != "");

            console.log(bed_type_ids);
            console.log(filtered_count_array);


            var obj = new Object();
            obj.unit_name = unit_name;
            obj.bed_type_ids = bed_type_ids;
            obj.filtered_count_array = filtered_count_array;
            console.log(obj);
            $.ajax({
                url: "{{ url('/sub_room/save') }}" + '/' + unit_id,
                method: "POST",
                data: obj,
                dataType: 'JSON',
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
            });
        });

        $('select[name="property_facility_id[]"]').on('change', function() {

            var property_facility_id = $(this).val();
            console.log(property_facility_id);

            $.ajax({
                url: "{{ url('property-owner/properties/edit/sub_facilities') }}",
                method: "POST",
                data: "property_facility_id=" + property_facility_id,
                dataType: 'JSON',
                success: function(data) {
                    //console.log(data);
                    $("#sub_facilities").empty();
                    for (var i = 0; i < data.length; i++) {
                        var obj = data[i];
                        //console.log(obj);
                        $.each(obj, function(index, value) {
                            //  console.log(value)
                            $("#sub_facilities").append(
                                '<div class="custom-control custom-checkbox my-1 mx-3">' +
                                '<input type="checkbox" class="custom-control-input" id="' +
                                value.id + '" value="' + value.id +
                                '" name="sub_facilities[]">' +
                                '<label class="custom-control-label" for="' + value.id +
                                '">' + value.name + '</label>');
                        });
                    }
                }
            });

        });
    </script>

    <script>
        $('.sub_room_edit').on('click', function() {

            // console.log("ok");
            var subroom_id = $(this).attr('id');
            var sub_room_rate = $(this).data('rate');
            var sleep_type_id = $(this).data('sleep_type_id');
            $("#my_select").val(sleep_type_id).change();

            $('#sub_room_edit_rate').val(sub_room_rate);
            $('#sub_room_id').val(subroom_id);
            console.log(sleep_type_id);
            $.ajax({
                url: "{{ url('property-owner/properties/edit/room/edit/sub_room/collect_info') }}",
                method: "POST",
                data: "subroom_id=" + subroom_id,
                dataType: 'JSON',
                success: function(data) {
                    var meal_types = data.meal_types;
                    var resvation_policies = data.resvation_policies;
                    var sub_room_meals_types_ids = data.sub_room_meals_types_ids;
                    var sub_room_reservation_policy_type_ids = data
                    .sub_room_reservation_policy_type_ids;
                    $("#meal_type_edit").empty();
                    for (var i = 0; i < meal_types.length; i++) {
                        const isInArray = sub_room_meals_types_ids.includes(meal_types[i].id);
                        if (isInArray) {
                            $("#meal_type_edit").append('<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="form-check-input" name="meal_type_ids[]"  value="' +
                                meal_types[i].id + '" id="' + meal_types[i].id + '"checked>' +
                                '<label class="form-check-label"  for="' + meal_types[i].id + '">' +
                                meal_types[i].type + '</label>')
                        } else {
                            $("#meal_type_edit").append('<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="form-check-input" name="meal_type_ids[]"  value="' +
                                meal_types[i].id + '" id="' + meal_types[i].id + '">' +
                                '<label class="form-check-label"  for="' + meal_types[i].id + '">' +
                                meal_types[i].type + '</label>')
                        }
                    }

                    $("#reservation_type_edit").empty();
                    resvation_policies.forEach((element, index) => {
                        if (sub_room_reservation_policy_type_ids.includes(element.id)) {
                            $("#reservation_type_edit").append(
                                '<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="form-check-input" name="resvation_policy_ids[]"  value="' +
                                element.id + '" id="' + element.id + '"checked>' +
                                '<label class="form-check-label"  for="' + element.id +
                                '">' + element.type + '</label>')
                        } else {
                            $("#reservation_type_edit").append(
                                '<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="form-check-input" name="resvation_policy_ids[]"  value="' +
                                element.id + '" id="' + element.id + '">' +
                                '<label class="form-check-label"  for="' + element.id +
                                '">' + element.type + '</label>')
                        }
                    });

                }
            });
        });

        $('.unit_edit').on('click', function() {

            //console.log("ok");
            var unit_name = $(this).data('name');
            var unit_id = $(this).attr('id');
            $('#edit_unit_name').val(unit_name);
            $('#edit_unit_id').val(unit_id);
            //console.log(unit_id);

            $.ajax({
                url: "{{ url('property-owner/properties/edit/room/edit/unit/collect_info') }}" +
                    '/' + unit_id,
                method: "GET",
                success: function(data) {
                    let unit_bed_type = data.unit_bed_type;
                    let bed_types_ids = data.bed_types;
                    console.log(unit_bed_type);
                    var unit_bed_type_ids = new Array()
                    for (let i = 0; i < unit_bed_type.length; i++) {
                        unit_bed_type_ids.push(unit_bed_type[i].bed_type_id)

                    }
                    let j = 0;
                    $('#main-unit-edit-bed-type').empty();
                    for (var i = 0; i < bed_types_ids.length; i++) {
                        const isInArray = unit_bed_type_ids.includes(bed_types_ids[i].id);
                        if (isInArray) {
                            // console.log(unit_bed_type[i].bed_count+"check");
                            $('#main-unit-edit-bed-type').append(
                                '<div class="unit-edit-bed-type custom-control custom-checkbox">' +
                                '<input class="form-check-input" name="bed_type_edit_ids"  type="checkbox" onclick="showInputType(' +
                                bed_types_ids[i].id + ')" value="' + bed_types_ids[i].id +
                                '" id="' + bed_types_ids[i].id + '" checked>' +
                                '<label class="form-check-label" > ' + bed_types_ids[i].type +
                                ' </label>' +
                                '</div>' +
                                '<div class="ch_edit_for">' +
                                '<input type="number" id="input-' + bed_types_ids[i].id +
                                '" name="bed_edit_count" value="' + unit_bed_type[j].bed_count +
                                '" min="1">' +
                                '</div>'
                            )
                            j++;
                        } else {
                            $('#main-unit-edit-bed-type').append(
                                '<div class="unit-edit-bed-type custom-control custom-checkbox">' +
                                '<input class="form-check-input" name="bed_type_edit_ids"  type="checkbox" onclick="showInputType(' +
                                bed_types_ids[i].id + ')" value="' + bed_types_ids[i].id +
                                '" id="' + bed_types_ids[i].id + '" >' +
                                '<label class="form-check-label" > ' + bed_types_ids[i].type +
                                ' </label>' +
                                '</div>' +
                                '<div class="ch_edit_for">' +
                                '<input type="number" id="input-' + bed_types_ids[i].id +
                                '" name="bed_edit_count" style="display: none;" min="1">' +
                                '</div>'
                            )
                        }

                    }
                }
            });
        });

        $('.unit-bed-type input:checkbox').click(function() {
            $(this).closest('.main-unit-bed-type').find('.ch_for').toggle()
        });

        function showInputType(id) {
            let str = 'input-' + id;
            //console.log(str);
            var x = document.getElementById(str);
            console.log(x);
            if (x.style.display === "none") {
                x.style.display = "block";
                x.value = 1;

            } else {
                x.style.display = "none";
                x.value = "";
            }
        }

        $('#data_table_subRoom').dataTable({
            "pageLength": 5
        });
        $('#data_table_unit').dataTable({
            "pageLength": 5
        });
    </script>

    <script src="{{ URL('dashboard_assets/libs/dropify/dropify.min.js') }}"></script>
    <!-- Init js-->
    <script src="{{ URL('dashboard_assets/js/pages/form-fileuploads.init.js') }}"></script>
@endsection
