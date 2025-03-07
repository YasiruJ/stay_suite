@extends('account.layouts.master')
@section('content')

<div class="container-fluid">
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
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title mb-4">Room Facilities Settings</h4>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#key_facility" role="tab" aria-controls="home" aria-expanded="true">Key Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="province-tab" data-toggle="tab" href="#room_facility" role="tab" aria-controls="province">Room Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="city-tab" data-toggle="tab" href="#sub_facility" role="tab" aria-controls="city">Sub Facilities</a>
                    </li>
                </ul>
                <div class="tab-content text-muted" id="myTabContent">
                    <div role="tabpanel" class="tab-pane fade in active show" id="key_facility" aria-labelledby="home-tab">
                        <form id="key_facility_form">
                            <label for="province_name">Key Facility</label>
                            <input class="form-control" id="key_facility_name" name="key_facility_name" placeholder="Enter Key Facility" type="text">
                            <button type="submit" id="key_facility_add" class="btn btn-primary waves-effect waves-light my-3">Save</button>
                            <button type="button" id="key_facility_update" class="update btn btn-warning my-3" style="display: none;">Update Key Facility</button>
                        </form>
                        <div class="province-table my-1">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <h4 class="header-title">Default Example</h4>
                                        <p class="sub-header">
                                            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                        </p>
                                        <table id="datatablekey" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <th>ID</th>
                                                <th>Facility Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($keyFacilities as $keyFacility )
                                                <tr>
                                                    <td>{{ $keyFacility->id }}</td>
                                                    <td>{{ $keyFacility->name }}</td>
                                                    <td><button class="editKeyFacility btn waves-effect waves-light btn-warning button-prevent-multiple-submits" onclick="editKeyFaclity('{{ $keyFacility->id }}','{{ $keyFacility->name }}')" data-token="{{ csrf_token() }}"> <i class="fas fa-edit"></i> </button></td>
                                                    <td><button class="deleteKeyFacility btn waves-effect waves-light btn-danger" id="btn_delete_key_facility" data-id="{{ $keyFacility->id }}" data-token="{{ csrf_token() }}"> <i class="mdi mdi-close"></i> </button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="room_facility" role="tabpane2" aria-labelledby="province-tab">
                        <form id="room_facility_form">
                            <div class="form-group">
                                <label for="facility-name">Name</label>
                                <input class="form-control" id="facility_name" name="facility_name" placeholder="Enter Facility" type="text">

                            </div>
                            <div class="form-group">
                                <label for="description">Facility Description</label>
                                <textarea id="facility_description" name="facility_description" class="form-control" maxlength="150" rows="4" placeholder="Enter Facility Description Breifly" spellcheck="true"></textarea>
                            </div>
                            <button type="submit" id="room_facility_add" class="btn btn-primary waves-effect waves-light my-3">Save</button>
                            <button type="button" id="room_facility_update" class="update btn btn-warning waves-effect waves-light my-3" style="display: none;">Update Rooms Facility</button>
                        </form>
                        <div class="district-table my-1">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <h4 class="header-title">Default Example</h4>
                                        <p class="sub-header">
                                            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                        </p>
                                        <table id="datatableroom" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Facility Name</th>
                                                    <th>Facility Description</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roomFacilities as $roomFacility)
                                                <tr>
                                                    <td>{{ $roomFacility->id }}</td>
                                                    <td>{{ $roomFacility->name }}</td>
                                                    <td>{{ $roomFacility->description }}</td>
                                                    <td><button class=" editRoomFacility btn waves-effect waves-light btn-warning button-prevent-multiple-submits" onclick="editRoomFaclity('{{ $roomFacility->id }}','{{ $roomFacility->name }}','{{ $roomFacility->description }}')" data-token="{{ csrf_token() }}"> <i class="fas fa-edit"></i> </button></td>
                                                    <td><button class=" deleteRoomFacility btn waves-effect waves-light btn-danger" id="btn_delete_room" data-id="{{ $roomFacility->id }}" data-token="{{ csrf_token() }}"> <i class="mdi mdi-close"></i> </button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sub_facility" role="tabpane3" aria-labelledby="city-tab">
                        <form id="sub_facility_form">
                            <div class="form-group">
                                <label for="city_name">City</label>
                                <input class="form-control" id="sub_facility_name" name="sub_facility_name" placeholder="Enter Sub Facility Name" type="text">
                            </div>
                            <button type="submit" id="sub_facility_add" class="btn btn-primary waves-effect waves-light my-2">Save</button>
                            <button type="button" id="sub_facility_update" class="update btn btn-warning waves-effect waves-light my-3" style="display: none;">Update Sub Facility</button>
                        </form>
                        <div class="district-table my-1">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <h4 class="header-title">Default Example</h4>
                                        <p class="sub-header">
                                            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                        </p>
                                        <table id="datatablesub" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Sub Facility Name</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subFacilities as $subFacility)
                                                <tr>
                                                    <td>{{ $subFacility->id }}</td>
                                                    <td>{{ $subFacility->name }}</td>
                                                    <td><button class=" editSubFacility btn waves-effect waves-light btn-warning button-prevent-multiple-submits" onclick="editSubFaclity('{{ $subFacility->id }}','{{ $subFacility->name }}')" data-token="{{ csrf_token() }}"> <i class="fas fa-edit"></i> </button></td>
                                                    <td><button class=" deleteSubFacility btn waves-effect waves-light btn-danger" id="btn_delete_sub" data-id="{{ $subFacility->id }}" data-token="{{ csrf_token() }}"> <i class="mdi mdi-close"></i> </button></td>
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

@endsection

@section('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#key_facility_add').click(function() {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/system_settings/room_facilities/key_facility/save') }}",
            method: "POST",
            data: $("#key_facility_form").serialize(),
            dataType: 'JSON',
            // contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    $('#btnsubmit').prop("disabled", false);

                    $.confirm({
                        icon: 'fa fa-check',
                        theme: 'modern',
                        animation: 'left',
                        type: 'green',
                        title: 'Added!',
                        content: response.message,
                        buttons: {
                            ok: function() {
                                location.href = "{{ url('/admin/system_settings/room_facilities') }}";
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
                        title: 'Error!',
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

    var table = $('#datatablekey').DataTable();


    $(".deleteKeyFacility").click(function() {
        $('#btn_delete_key_facility').prop("disabled", true);
        var id = $(this).data("id");
        console.log(btn_delete_key_facility);
        $.ajax({
            url: " {{ url('/admin/system_settings/room_facilities/key_facility/delete') }}" + '/' + id,
            type: 'DELETE',
            data: {
                //"id": id,
                //"_method": 'DELETE',
            },
            success: function(response) {
                if (!response.success) {
                    $.confirm({
                        icon: 'fa fa-exclamation-triangle',
                        theme: 'modern',
                        animation: 'right',
                        type: 'red',
                        title: 'Deleted',
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

    function editKeyFaclity(id, name) {
        $(this).prop("disabled", true);
        $('.button-prevent-multiple-submits').attr("disabled", true);
        $('#key_facility_update').show();
        $('#key_facility_add').hide();
        $('#key_facility_name').val(name);
        $('#key_facility_update').click(function() {

            $.ajax({
                url: "{{ URL('/admin/system_settings/room_facilities/key_facility/update') }}" + '/' + id,
                method: "POST",
                data: $("#key_facility_form").serialize(),
                dataType: 'JSON',
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.success) {

                        $.confirm({
                            icon: 'fa fa-check',
                            theme: 'modern',
                            animation: 'left',
                            type: 'green',
                            title: 'Update!',
                            content: response.message,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    $('#key_facility_update').hide();
                                    $('#key_facility_add').show();
                                }
                            }
                        });
                    }
                }
            });
        });
    }

    $('#room_facility_add').click(function() {
        event.preventDefault();

        $.ajax({
            url: "{{ url('admin/system_settings/room_facilities/facility/save') }}",
            method: "POST",
            data: $("#room_facility_form").serialize(),
            dataType: 'JSON',
            // contentType: false,
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
                                location.href = "{{ url('/admin/system_settings/room_facilities') }}";
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
                        title: 'Error!',
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

    var table = $('#datatableroom').DataTable();


    $(".deleteRoomFacility").click(function() {
        $('#btn_delete_room').prop("disabled", true);
        var id = $(this).data("id");
        console.log(id);
        $.ajax({
            url: " {{ url('/admin/system_settings/room_facilities/facility/delete') }}" + '/' + id,
            type: 'DELETE',
            data: {
                //"id": id,
                //"_method": 'DELETE',
            },
            success: function(response) {
                if (!response.success) {
                    $.confirm({
                        icon: 'fa fa-exclamation-triangle',
                        theme: 'modern',
                        animation: 'right',
                        type: 'red',
                        title: 'Deleted',
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

    function editRoomFaclity(id, name, description) {
        $(this).prop("disabled", true);
        $('.button-prevent-multiple-submits').attr("disabled", true);
        $('#room_facility_update').show();
        $('#room_facility_add').hide();
        $('#facility_name').val(name);
        $('#facility_description').val(description);
        //console.log(facility_description);
        $('#room_facility_update').click(function() {

            $.ajax({
                url: "{{ URL('/admin/system_settings/room_facilities/facility/update') }}" + '/' + id,
                method: "POST",
                data: $("#room_facility_form").serialize(),
                dataType: 'JSON',
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.success) {

                        $.confirm({
                            icon: 'fa fa-check',
                            theme: 'modern',
                            animation: 'left',
                            type: 'green',
                            title: 'Update!',
                            content: response.message,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    $('#key_facility_update').hide();
                                    $('#key_facility_add').show();
                                }
                            }
                        });
                    }
                }
            });
        });
    }

    $('#sub_facility_add').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: "{{ url('admin/system_settings/room_facilities/sub_facility/save') }}",
            method: "POST",
            data: $("#sub_facility_form").serialize(),
            dataType: 'JSON',
            // contentType: false,
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
                                location.href = "{{ url('/admin/system_settings/room_facilities') }}";
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
                        title: 'Error!',
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

    var table = $('#datatablesub').DataTable();


    $(".deleteSubFacility").click(function() {
        $('#btn_delete_sub').prop("disabled", true);
        var id = $(this).data("id");
        console.log(btn_delete_sub);
        $.ajax({
            url: " {{ url('/admin/system_settings/room_facilities/sub_facility/delete') }}" + '/' + id,
            type: 'DELETE',
            data: {
                //"id": id,
                //"_method": 'DELETE',
            },
            success: function(response) {
                if (!response.success) {
                    $.confirm({
                        icon: 'fa fa-exclamation-triangle',
                        theme: 'modern',
                        animation: 'right',
                        type: 'red',
                        title: 'Deleted!',
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

    function editSubFaclity(id, name) {
        $(this).prop("disabled", true);
        $('.button-prevent-multiple-submits').attr("disabled", true);
        $('#sub_facility_update').show();
        $('#sub_facility_add').hide();
        $('#sub_facility_name').val(name);
        //console.log(facility_description);
        $('#sub_facility_update').click(function() {

            $.ajax({
                url: "{{ URL('/admin/system_settings/room_facilities/sub_facility/update') }}" + '/' + id,
                method: "POST",
                data: $("#sub_facility_form").serialize(),
                dataType: 'JSON',
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.success) {

                        $.confirm({
                            icon: 'fa fa-check',
                            theme: 'modern',
                            animation: 'left',
                            type: 'green',
                            title: 'Update!',
                            content: response.message,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    $('#sub_facility_update').hide();
                                    $('#sub_facility_add').show();
                                }
                            }
                        });
                    }
                }
            });
        });
    }
</script>
@endsection
