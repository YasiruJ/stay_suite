@extends('account.layouts.master')

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">General Elements</li>
                        </ol>
                    </div>
                    <h4 class="page-title">General Elements</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="container-fluid">
            <form id="propertyForm">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Property information</h4>
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="form-group">
                                        <label for="">Property Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter property Name" name="property_name">
                                    </div>
                                </div>
                                <div class="col-xl-3 form-group">
                                    <label for="">Property Owner</label>
                                    <select class="form-control" id="districtSelect" name="user_id">
                                        <option value="" disabled selected style="color:green;">Select Property Owner</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-3 form-group">
                                    <label for="">Property Type</label>
                                    <select class="form-control" id="propertyTypeSelect" name="property_type_id">
                                        <option value="" disabled selected style="color:green;">Select Property Type</option>
                                        @foreach ($property_types as $property_type)
                                        <option value="{{ $property_type->id }}">{{ $property_type->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-3 form-group">
                                    <label for="">Property Rating</label>
                                    <select class="form-control" id="propertyRatingSelect" name="property_rating_id">
                                        <option value="" disabled selected style="color:green;">Select Property Rating</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                        <option value="6">Not Rated</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <div>
                                            <textarea class="form-control" rows="3" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 form-group">
                                    <h4 class="header-title mb-4">property Image</h4>
                                    <input type="file" class="dropify1" data-max-file-size="1M" name="input_img" />
                                </div>
                                <div class="col xl-6 form-group">
                                    <h4 class="header-title mb-4">Sub Images</h4>
                                    <input type="file" class="dropify1" data-max-file-size="1M" name="sub_images[]" multiple />
                                </div>
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
                                <input type="text" class="form-control" id="property_address" placeholder="property No, Street" name="address">
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
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-box">
                            <h4 class="header-title mb-6">property Facilities</h4>
                            <div class="custom-control custom-checkbox mt-3">
                                @foreach ($property_facility as $property_facility)
                                <div class="mt-2">
                                    <input type="checkbox" class="custom-control-input" name="property_facility[]" value="{{ $property_facility->id }}" id="customCheck1.{{ $property_facility->id }}">
                                    <label class="custom-control-label" for="customCheck1.{{ $property_facility->id }}">{{ $property_facility->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6" id="dynamicAddRemove">
                    <label for="districtSelect">Unit Name</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Unit name" name="unit_name[0][subject]">
                        <div class="input-group-append">
                            <button type="button" class="btn waves-effect waves-light btn-success" id="dynamic-ar"> <i class="fas fa-plus"></i> </button>
                        </div>
                    </div>
                </div> -->
                <input type="hidden" id="longitude" name="longitude">
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="place_id" name="place_id">
                <button type="submit" id="btn_submit" class="btn btn-success btn-md">Submit</button>
            </form>
        </div>
    </div>
</div><!-- end col -->
</div>


@endsection

@section('scripts')
<script src="{{ URL('dashboard_assets/libs/dropify/dropify.min.js') }}"></script>
<!-- Init js-->
<script src="{{ URL('dashboard_assets/js/pages/form-fileuploads.init.js') }}"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0cH-gsRcjZEQD5ab9mFyldU2v7T6QURY&libraries=places"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#propertyForm').on('submit', function(event) {
        event.preventDefault();
        $("#btn_submit").prop('disabled', true);
        console.log(this);
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
</script>
<script>
    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {
        var input = document.getElementById('property_address');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            var lat = place.geometry['location'].lat();
            var long = place.geometry['location'].lng();
            $('#longitude').val(lat);
            $('#latitude').val(lat);
            $('#place_id').val(place.place_id);
            console.log(lat);
        });
    }
</script>

@endsection
