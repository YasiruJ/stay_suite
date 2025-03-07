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
                            <li class="breadcrumb-item"><a href="{{ URL('/property-owner/dashboard') }}">Stay Suite</a></li>
                            <li class="breadcrumb-item"><a href="{{ URL('property-owner/properties/all') }}">Properties</a></li>

                            <li class="breadcrumb-item active">Edit Property</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Property Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <form id="propertyEditForm">
                    <div class="card-box">
                        <div class="clearfix">
                            {{-- <h4 class="header-title mb-4 float-left">Property information</h4> --}}
                            {{-- <a href="{{ URL('property-owner/properties/delete/'.$properties->id) }}"><button type="button" class="btn btn-danger waves-effect waves-light float-right">
                                    <span class="btn-label"><i class="mdi mdi-close"></i>
                                    </span>Delete property</button></a> --}}
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label for="">property Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter property Name" name="property_name" value="{{ $properties->name }}">
                                </div>
                            </div>
                            <div class="col-xl-4 form-group">
                                <label for="">property Owner</label>
                                <select class="form-control" id="districtSelect" name="user_id">
                                    @foreach ($users as $user)
                                    @if ($user->id==$properties->user_id)
                                    <option value="{{ $user->id }}" selected>{{ $user->username }}</option>
                                    @else
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-4 form-group">
                                <label for="">Property Type</label>
                                <select class="form-control" id="propertyTypeSelect" name="property_type_id">
                                    @foreach ($property_types as $property_type)
                                    @if ($property_type->id==$properties->property_type_id)
                                    <option value="{{ $property_type->id }}" selected>{{ $property_type->type }}</option>
                                    @else
                                    <option value="{{ $property_type->id }}">{{ $property_type->type }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <div>
                                        <textarea required class="form-control" rows="3" name="description">{{ $properties->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="form-group">
                                    <label>Check In Start Time</label>
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" id="timepicker_in_start" name="timepicker_in_start" value="{{ $properties->check_in_start_time }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Check In End Time</label>
                                    <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
                                        <input type="text" class="form-control" id="timepicker_in_end" name="timepicker_in_end" value="{{ $properties->check_in_end_time }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Check Out Start Time</label>
                                    <div class="input-group">
                                        <input class="form-control" id="single-input" id="timepicker_out_start" name="timepicker_out_start" value="{{ $properties->check_out_start_time }}">
                                        <span class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label>Check Out End Time</label>
                                    <div class="input-group clockpicker" data-placement="top" data-align="top">
                                        <input type="text" class="form-control" id="timepicker_out_end" name="timepicker_out_end" value="{{ $properties->check_out_end_time }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Pet Allowed Status</label>
                                    <select class="form-control" id="pet_allowed" name="pet_allowed">
                                        @if ($properties->pet_allowed == 0)
                                        <option value="0">Pets are not allowed</option>
                                        <option value="1">Pets are allowed</option>
                                        @else
                                        <option value="1">Pets are allowed</option>
                                        <option value="0">Pets are not allowed</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age Restriction</label>
                                    <div>
                                        <input type="number" class="form-control" id="age_restriction" name="age_restriction" min="0" max="18" placeholder="Select Age" value="{{ $properties->age_restriction }}" />
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="card-box">
                                    <h4 class="header-title mb-6">Credit Card Type</h4>
                                    <div class="custom-control custom-checkbox mt-3">
                                        @foreach ($credit_cards as $credit_card)
                                        <div class="mt-3">
                                            <input type="checkbox" class="custom-control-input" name="card_type[]" value="{{ $credit_card->id }}" id="customCheck1.{{ $credit_card->id }}" {{ in_array($credit_card->id,$property_has_credit_cards)?'checked':'' }}>
                                            <label class="custom-control-label" for="customCheck1.{{ $credit_card->id }}">{{ $credit_card->card_type }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col xl-6 form-group">
                                <div class="card-box">
                                    <h4 class="header-title mb-4">Property Image</h4>
                                    <input type="file" class="dropify1" data-default-file="{{ URL('storage/property_image/'.$properties->main_image) }}" data-max-file-size="1M" name="input_img">
                                </div>
                            </div>
                            <div class="col xl-6 form-group">
                                <div class="card-box">
                                    <h4 class="header-title mb-4">Property Sub Images</h4>
                                    <input type="file" class="dropify1" data-max-file-size="1M" name="sub_images[]" multiple />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-box">
                                <h4 class="header-title mb-6">Location</h4>
                                <div class="form-group">
                                    <label for="">Property Address</label>
                                    <input type="text" class="form-control" id="" placeholder="Property No, Street" name="address">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-xl-6">
                                        <label for="districtSelect">District</label>
                                        <select class="form-control" id="districtSelect" name="district_id">
                                            @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <label for="districtSelect">City</label>
                                        <select class="form-control" id="districtSelect" name="city_id">
                                            @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="longtitude">Longtitute</label>
                                        <input type="text" class="form-control" id="longtitude" placeholder="Enter longtitude" value="{{$properties->longitude}}" name="longitude">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" class="form-control" id="latitude" placeholder="Enter latitude" value="{{$properties->latitude}}" name="latitude">

                                    </div>
                                    {{-- <div class="form-group col-xl-6">
                                        <label for="districtSelect">Longtitute</label>
                                        <select class="form-control" id="districtSelect" name="longitude">
                                            <option value="1">12.2</option>
                                            <option value="2">5.5</option>
                                            <option value="3">2.5</option>
                                            <option value="4">2.5</option>
                                            <option value="5">4.5</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <label for="districtSelect">Latitude</label>
                                        <select class="form-control" id="districtSelect" name="latitude">
                                            <option value="1">12.2</option>
                                            <option value="2">5.5</option>
                                            <option value="3">2.5</option>
                                            <option value="4">2.5</option>
                                            <option value="5">4.5</option>
                                        </select>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-box">
                                <h4 class="header-title mb-6">Property Facilities</h4>
                                <div class="custom-control custom-checkbox mt-3">
                                    @foreach ($property_facilities as $Property_facility)
                                    <div class="mt-2">
                                        <input type="checkbox" class="custom-control-input" name="Property_facility[]" value="{{ $Property_facility->id }}" id="customCheck1.{{ $Property_facility->id }}" {{ in_array($Property_facility->id,$property_has_facilities)?'checked':'' }}>
                                        <label class="custom-control-label" for="customCheck1.{{ $Property_facility->id }}">{{ $Property_facility->name }}</label>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning btn-md ml-3">Edit</button>
                    </div>
                </form>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="bg-lite clearfix my-3">
                                <h4 class="header-title badge badge-success waves-effect waves-light float-left pt-2 ml-2">Room Information</h4>
                                <a href="{{ URL('property-owner/properties/edit/'.$properties->id.'/room') }}"><button type="button" class="btn btn-success waves-effect waves-light width-lg float-right mr-3">Add New Room</button></a>
                            </div>
                            <table id="datatable5" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Active</th>
                                        <th>ID</th>
                                        <th>Room Type</th>
                                        <th>Room Count</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)
                                    <tr>
                                        <td><input type="checkbox" data-id="{{ $room->id }}" class="js-switch" name="js-switch" {{ ($room->active) ? "checked" : "" }} /></td>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->title }}</td>
                                        <td>{{ $room->room_count }}</td>
                                        <td>
                                            @if ($room->active)
                                            <span id="status_{{ $room->id }}" class="badge badge-success  even-larger-badge my-2" style="font-size: 1em;">Active</span>
                                            @else
                                            <span id="status_{{ $room->id }}" class="badge badge-danger  even-larger-badge my-2" style="font-size: 1em;">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ URL('property-owner/properties/edit/'.$properties->id.'/room/edit/'.$room->id) }}"><button type="submit" class="btn waves-effect waves-light btn-warning"><i class="mdi mdi-wrench"></i></button></a>
                                        </td>
                                        <td><a href="{{ URL('property-owner/properties/edit/'.$properties->id.'/room/delete/'.$room->id) }}">
                                                <button class="btn waves-effect waves-light btn-danger align-top"> <i class="mdi mdi-close"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->
                <!-- <div class="section">
                    <div class="bg-lite clearfix my-3">
                        <h4 class="header-title badge badge-success waves-effect waves-light float-left pt-2 ml-2">Room Information</h4>
                        <a href="{{ URL('property-owner/properties/edit/'.$properties->id.'/room') }}"><button type="button" class="btn btn-success waves-effect waves-light width-lg float-right mr-3">Add New Room</button></a>
                    </div>
                    <div class="d-flex flex-column">
                        @foreach ($rooms as $room)
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ URL('property-owner/properties/edit/'.$properties->id.'/room/delete/'.$room->id) }}">
                                    <button class="btn waves-effect waves-light btn-danger float-right align-top"> <i class="mdi mdi-close"></i></button>
                                </a>
                                <h5 class="card-title">Room Type <span style="color: red;">{{ $room->title }}</span></h5>
                                <p class="card-text">{{ $room->description }}</p>
                                <a href="{{ URL('property-owner/properties/edit/'.$properties->id.'/room/edit/'.$room->id) }}"><button type="submit" class="btn btn-warning waves-effect waves-light width-lg">Edit</button></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> -->
            </div><!-- end row -->
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

    $('#propertyEditForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('property-owner/properties/edit/'.$properties->id.'/update') }}",
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

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });

    var switchStatus = false;
    var roomID
    $(".js-switch").on('change', function() {
        if ($(this).is(':checked')) {
            switchStatus = $(this).is(':checked');
            roomID = $(this).data('id');
        } else {
            switchStatus = $(this).is(':checked');
            roomID = $(this).data('id');

        }
        // console.log(switchStatus, propertyID);

        $.ajax({
            url: "{{ url('property-owner/room/status/update') }}" + '/' + roomID,
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

    $('#datatable5').dataTable({
        "pageLength": 5
    });
</script>
<script src="{{ URL('dashboard_assets/libs/moment/moment.min.js') }}"></script>
<script src="{{ URL('dashboard_assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL('dashboard_assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ URL('dashboard_assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL('dashboard_assets//libs/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL('dashboard_assets/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>

<script src="{{ URL('dashboard_assets/js/pages/form-pickers.init.js') }}"></script>
<script src="{{ URL('dashboard_assets/libs/dropify/dropify.min.js') }}"></script>
<!-- Init js-->
<script src="{{ URL('dashboard_assets/js/pages/form-fileuploads.init.js') }}"></script>
@endsection
