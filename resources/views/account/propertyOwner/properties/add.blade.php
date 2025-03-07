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
                            <li class="breadcrumb-item"><a href="{{ URL('/property-owner/dashboard') }}">Gimanhal</a></li>
                            <li class="breadcrumb-item active"><a href="javascript: void(0);">Add Property</a></li>
                            {{-- <li class="breadcrumb-item ">General Elements</li> --}}
                        </ol>
                    </div>
                    <h4 class="page-title">General Elements</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <form id="propertyForm">
                    <div class="card-box">
                        <h4 class="header-title mb-4">property information</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">property Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter property Name" name="property_name">
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="">Property Type</label>
                                <select class="form-control" id="propertyTypeSelect" name="property_type_id">
                                    <option value="" disabled selected style="color:green;">Select Property Type</option>
                                    @foreach ($property_types as $property_type)
                                    <option value="{{ $property_type->id }}">{{ $property_type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <div>
                                        <textarea required class="form-control" rows="3" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="form-group">
                                    <label>Check In Start Time</label>
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" id="timepicker_in_start" name="timepicker_in_start" value="9.30">
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
                                        <input type="text" class="form-control" id="timepicker_in_end" name="timepicker_in_end" value="13:14">
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
                                        <input class="form-control" id="single-input" id="timepicker_out_start" name="timepicker_out_start" value="21.00">
                                        <span class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label>Check Out End Time</label>
                                    <div class="input-group clockpicker" data-placement="top" data-align="top">
                                        <input type="text" class="form-control" id="timepicker_out_end" name="timepicker_out_end" value="23.00">
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
                                        <option value="" disabled selected style="color:green;">Select Pet Allowed Status</option>
                                        <option value="1">Pets are Allowed</option>
                                        <option value="0">Pets are Not Allowed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age Restriction</label>
                                    <div>
                                        <input type="number" class="form-control" id="age_restriction" name="age_restriction" min="0" max="18" placeholder="Select Age" />
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="card-box">
                                    <h4 class="header-title mb-6">Credit Card Type</h4>
                                    <div class="custom-control custom-checkbox mt-3">
                                        @foreach ($credit_cards as $credit_card)
                                        <div class="mt-3">
                                            <input type="checkbox" class="custom-control-input" name="card_type[]" value="{{ $credit_card->id }}" id="customCheck1.{{ $credit_card->id }}">
                                            <label class="custom-control-label" for="customCheck1.{{ $credit_card->id }}">{{ $credit_card->card_type }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="card-box">
                                    <h4 class="header-title mb-4">property Image</h4>
                                    <input type="file" class="dropify1" data-max-file-size="1M" name="input_img" />
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="card-box">
                                    <h4 class="header-title mb-4">Sub Images</h4>
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
                                    <label for="">property Address</label>
                                    <input type="text" class="form-control" id="" placeholder="property No, Street" name="address">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="districtSelect">District</label>
                                        <select class="form-control" id="districtSelect" name="district_id">
                                            @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
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
                                        <input type="text" class="form-control" id="longtitude" placeholder="Enter longtitude" name="longitude">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" class="form-control" id="latitude" placeholder="Enter latitude" name="latitude">

                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                        <label for="districtSelect">Longtitute</label>
                                        <select class="form-control" id="districtSelect" name="longitude">
                                            <option value="1">12.2</option>
                                            <option value="2">5.5</option>
                                            <option value="3">2.5</option>
                                            <option value="4">2.5</option>
                                            <option value="5">4.5</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
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
                                <h4 class="header-title mb-6">property Facilities</h4>
                                <div class="custom-control custom-checkbox mt-3">
                                    @foreach ($property_facilities as $property_facility)
                                    <div class="mt-2">
                                        <input type="checkbox" class="custom-control-input" name="property_facility[]" value="{{ $property_facility->id }}" id="customCheck1.{{ $property_facility->id }}">
                                        <label class="custom-control-label" for="customCheck1.{{ $property_facility->id }}">{{ $property_facility->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md ml-3">Submit</button>
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
