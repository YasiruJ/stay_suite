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
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <form id="roomForm">
                        <div class="card-box">
                            <h4 class="header-title mb-4">property <span style="font-size: 1.2rem;color: #157DEC;">{{ $properties->name }}</span> Room Informations</h4>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Room Title</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter Title" name="room_title">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Room Type</label>
                                        <select id="inputState" class="form-control" name="room_type_id">
                                            <option value="" disabled selected hidden>Select Room Type</option>
                                            @foreach ($room_types as $room_type)
                                            <option value="{{ $room_type->id }}">{{ $room_type->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xl-6">
                                    <label for="">Room Size</label>
                                    <select class="form-control" id="inlineFormCustomSelect" name="room_size">
                                        <option value="" disabled selected hidden>Select Room Size</option>
                                        <option value="Sm">Sm</option>
                                        <option value="Md">Md</option>
                                        <option value="Lg">Lg</option>
                                        <option value="Xl">Xl</option>
                                        <option value="XXl">XXl</option>
                                    </select>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Room Count</label>
                                        <input type="number" class="form-control" id="" placeholder="Enter Room count" name="room_count">
                                    </div>
                                </div>
                                {{-- <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Rate</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter Rate" name="rate">
                                    </div>
                                </div> --}}
                                {{-- <div class="col-xl-3">
                                    <div class="form-group">
                                        <label for="">No of Rooms</label>
                                        <input type="number" class="form-control" id="myNumber" placeholder="Select No of Rooms" name="no_of_room">
                                    </div>
                                </div> --}}

                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <div>
                                    <textarea class="form-control" rows="3" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form row">
                                <div class="col-md-12 form-group">
                                    <label>Room Sub Images</label>
                                    <input type="file" class="dropify1" data-height="131" name="sub_images[]" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="card-box">
                            <h4 class="header-title mb-4"> Room Facilities</h4>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xl-12">
                                    <select name="property_facility_id[]" class="form-control" id="select_facility" multiple>
                                        @foreach ( $facility as $facility)
                                        <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="d-flex flex-wrap my-3" id="sub_facilities">
                                        <div class="custom-control custom-checkbox my-2 mx-3">

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div><!-- end row -->
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

    $('#roomForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/properties/edit/'.$properties->id.'/room/save') }}",
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
                                location.href = "{{ URL('/admin/properties/edit/'.$properties->id.'') }}";
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

    $('select[name="property_facility_id[]"]').on('change', function() {

        var property_facility_id = $(this).val();

        $.ajax({
            url: "{{ url('admin/properties/edit/'.$properties->id.'/sub_facilities') }}",
            method: "POST",
            data: "property_facility_id=" + property_facility_id,
            dataType: 'JSON',
            success: function(data) {
                //console.log(data);
                $("#sub_facilities").empty();
                for (var i = 0; i < data.length; i++) {
                    var obj = data[i];
                    console.log(obj);
                    $.each(obj, function(index, value) {
                        //  console.log(value)
                        $("#sub_facilities").append('<div class="custom-control custom-checkbox my-1 mx-3">' +
                            '<input type="checkbox" class="custom-control-input" id="' + value.id + '" value="' + value.id + '" name="sub_facilities[]">' +
                            '<label class="custom-control-label" for="' + value.id + '">' + value.name + '</label>');
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
