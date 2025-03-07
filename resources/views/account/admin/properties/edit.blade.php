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

        <div class="row">
            <div class="col-12">
                <form id="propertyEditForm">
                    <div class="card-box">
                        <div class="clearfix">
                            <h4 class="header-title mb-4 float-left">Property information</h4>
                            <a href="{{ URL('admin/properties/delete/'.$properties->id) }}"><button type="button" class="btn btn-danger waves-effect waves-light float-right">
                                    <span class="btn-label"><i class="mdi mdi-close"></i>
                                    </span>Delete property</button></a>
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
                                    <div class="form-group col-xl-6">
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
                                    </div>
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

                <div class="section">
                    <div class="bg-lite clearfix my-3">
                        <h4 class="header-title badge badge-success waves-effect waves-light float-left pt-2 ml-2">Room Information</h4>
                        <a href="{{ URL('admin/properties/edit/'.$properties->id.'/room') }}"><button type="button" class="btn btn-success waves-effect waves-light width-lg float-right mr-3">Add New Room</button></a>
                    </div>
                    <div class="d-flex flex-column">
                        @foreach ($rooms as $room)
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ URL('admin/properties/edit/'.$properties->id.'/room/delete/'.$room->id) }}">
                                    <button class="btn waves-effect waves-light btn-danger float-right align-top"> <i class="mdi mdi-close"></i></button>
                                </a>
                                <h5 class="card-title">Room Type <span style="color: red;">{{ $room->title }}</span></h5>
                                <p class="card-text">{{ $room->description }}</p>
                                <a href="{{ URL('admin/properties/edit/'.$properties->id.'/room/edit/'.$room->id) }}"><button type="submit" class="btn btn-warning waves-effect waves-light width-lg">Edit</button></a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
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
            url: "{{ url('admin/properties/edit/'.$properties->id.'/update') }}",
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
<script src="{{ URL('dashboard_assets/libs/dropify/dropify.min.js') }}"></script>
<!-- Init js-->
<script src="{{ URL('dashboard_assets/js/pages/form-fileuploads.init.js') }}"></script>
@endsection
