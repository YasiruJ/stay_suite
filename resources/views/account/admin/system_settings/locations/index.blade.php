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
                <h4 class="header-title mb-4">Location Settings</h4>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="true">Provinces</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="province-tab" data-toggle="tab" href="#province" role="tab" aria-controls="province">Districts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="city-tab" data-toggle="tab" href="#city" role="tab" aria-controls="city">Cities</a>
                    </li>
                </ul>
                <div class="tab-content text-muted" id="myTabContent">
                    <div role="tabpanel" class="tab-pane fade in active show" id="home" aria-labelledby="home-tab">
                        <form id="provinceForm">
                            <label for="province_name">Province</label>
                            <input class="form-control" id="province_name_id" name="province_name" placeholder="Enter Provice" type="text">
                            <button type="submit" id="province_add" class="btn btn-primary waves-effect waves-light my-3">Save</button>
                            <button type="button" id="province_update" class="btn btn-warning waves-effect waves-light my-3" style="display: none;">Update</button>
                        </form>
                        <div class="province-table my-2">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <h4 class="header-title">Default Example</h4>
                                        <p class="sub-header">
                                            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                        </p>
                                        <table id="data_table_province" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Edit</th>
                                                    <td>Delete</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($provinces as $province)
                                                <tr>
                                                    <td>{{ $province->id }}</td>
                                                    <td>{{ $province->name }}</td>
                                                    <td><button class="editProvince btn waves-effect waves-light btn-warning button-prevent-multiple-submits" id="btn_edit_province" onclick="editProvince('{{ $province->id }}','{{ $province->name }}')" data-token="{{ csrf_token() }}"> <i class="fas fa-edit"></i> </button></td>
                                                    <td><button class="deleteProvince btn waves-effect waves-light btn-danger" id="btn_delete_province" data-id="{{ $province->id }}" data-token="{{ csrf_token() }}"> <i class="mdi mdi-close"></i> </button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </div>

                    </div>
                    <div class="tab-pane fade" id="province" role="tabpane2" aria-labelledby="province-tab">
                        <form id="districtForm">
                            <div class="form-group">
                                <label for="province_name">District</label>
                                <input class="form-control" id="districtId" name="district_name" placeholder="Enter District" type="text">
                            </div>
                            <div class="form-group">
                                <label for="province_name">Province</label>
                                <select class="form-control" data-placeholder="Choose Categories" name="province_id" id="provinceId">
                                    @foreach ($provinces as $province)
                                    <option value="" selected disabled hidden>Please Select The Provice</option>
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" id="district_add" class="btn btn-primary waves-effect waves-light my-2">Save</button>
                            <button type="button" id="district_update" class="btn btn-warning waves-effect waves-light my-3" style="display: none;">Update</button>
                        </form>
                        <div class="district-table my-1">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <h4 class="header-title">Default Example</h4>
                                        <p class="sub-header">
                                            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                        </p>
                                        <table id="data_table_district" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Province Name</th>
                                                    <th>District Name</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($districts as $district)
                                                <tr>
                                                    <td>{{ $district->id }}</td>
                                                    <td>{{ $district->province->name }}</td>
                                                    <td>{{ $district->name }}</td>
                                                    <td><button class="editdistrict btn waves-effect waves-light btn-warning button-prevent-multiple-submits" onclick="editdistrict('{{ $district->id }}','{{ $district->province->id }}','{{ $district->name }}')" data-token="{{ csrf_token() }}"> <i class="fas fa-edit"></i> </button></td>
                                                    <td><button class="deletedistrict btn waves-effect waves-light btn-danger" id="btn_delete_district" data-id="{{ $district->id }}" data-token="{{ csrf_token() }}"> <i class="mdi mdi-close"></i> </button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="city" role="tabpane3" aria-labelledby="city-tab">
                        <form id="cityForm">
                            <div class="form-group">
                                <label for="city_name">City</label>
                                <input class="form-control" id="city_id" name="city_name" placeholder="Enter District" type="text">
                            </div>
                            <div class="form-group">
                                <label for="city_name">District</label>
                                <select class="form-control" data-placeholder="Choose Categories" name="district_id" id="cityId">
                                    @foreach ($districts as $district)
                                    <option value="" selected disabled hidden>Please Select The City</option>
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" id="city_add" class="btn btn-primary waves-effect waves-light my-2">Save</button>
                            <button type="button" id="city_update" class="btn btn-warning waves-effect waves-light my-3" style="display: none;">Update</button>

                        </form>
                        <div class="district-table my-1">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <h4 class="header-title">Default Example</h4>
                                        <p class="sub-header">
                                            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                        </p>
                                        <table id="data_table_city" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>District Name</th>
                                                    <th>City Name</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cities as $city)
                                                <tr>
                                                    <td>{{ $city->id }}</td>
                                                    <td>{{ $city->district->name }}</td>
                                                    <td>{{ $city->name }}</td>
                                                    <td><button class="editcity btn waves-effect waves-light btn-warning button-prevent-multiple-submits" onclick="editcity('{{ $city->id }}','{{ $city->district->id }}','{{ $city->name }}')"> <i class="fas fa-edit"></i> </button></td>
                                                    <td><button class="deletecity btn waves-effect waves-light btn-danger" id="btn_delete_city" data-id="{{ $city->id }}"> <i class="mdi mdi-close"></i> </button></td>
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

    $('#province_add').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/system_settings/locations/province/save') }}",
            method: "POST",
            data: $("#provinceForm").serialize(),
            dataType: 'JSON',
            //contentType: false,
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
                                location.href = "{{ url('/admin/system_settings/locations') }}";

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

    var table = $('#data_table_province').DataTable();

    $(".deleteProvince").click(function() {
        $('#btn_delete_province').prop("disabled", true);
        var id = $(this).data("id");
        //console.log(btn_delete_key_facility);
        $.ajax({
            url: " {{ url('/admin/system_settings/locations/province/delete') }}" + '/' + id,
            type: 'DELETE',
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

    function editProvince(id, name) {
        $("editProvince").prop("disabled", true);
        // $('#btn_edit_province').siblings('.loading').show();
        //$('.button-prevent-multiple-submits').attr("disabled", true);
        $('#province_update').show();
        $('#province_add').hide();
        $('#province_name_id').val(name);
        $('#province_update').click(function() {


            $.ajax({
                url: "{{ URL('/admin/system_settings/locations/province/update') }}" + '/' + id,
                method: "POST",
                data: $("#provinceForm").serialize(),
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
                                    $('#province_update').hide();
                                    $('#province_add').show();
                                }
                            }
                        });
                    }
                }
            });
        });
    }

    $('#district_add').click(function(event) {
        event.preventDefault();
        $.ajax({

            url: "{{ url('admin/system_settings/locations/district/save') }}",
            method: "POST",
            data: $("#districtForm").serialize(),
            dataType: 'JSON',
            //contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    $('#btnsubmit').prop("disabled", false);
                    // console.log(response.link);

                    $.confirm({
                        icon: 'fa fa-check',
                        theme: 'modern',
                        animation: 'left',
                        type: 'green',
                        title: 'Added!',
                        content: response.message,
                        buttons: {
                            ok: function(data) {
                                console.log(data);
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

    var table = $('#data_table_district').DataTable();

    $(".deletedistrict").click(function() {
        $('#btn_delete_district').prop("disabled", true);
        var id = $(this).data("id");
        //console.log(btn_delete_key_facility);
        $.ajax({
            url: " {{ url('/admin/system_settings/locations/district/delete') }}" + '/' + id,
            type: 'DELETE',
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

    function editdistrict(id, province_id, name) {
        $(this).prop("disabled", true);
        $('.button-prevent-multiple-submits').attr("disabled", true);
        $('#district_update').show();
        $('#district_add').hide();
        $("#provinceId").val(province_id).change();
        $('#districtId').val(name);
        $('#district_update').click(function() {

            $.ajax({
                url: "{{ URL('/admin/system_settings/locations/district/update') }}" + '/' + id,
                method: "POST",
                data: $("#districtForm").serialize(),
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
                                    $('#district_update').hide();
                                    $('#district_add').show();
                                }
                            }
                        });
                    }
                }
            });
        });
    }

    $('#city_add').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/system_settings/locations/city/save') }}",
            method: "POST",
            data: $("#cityForm").serialize(),
            dataType: 'JSON',
            //contentType: false,
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
                                location.href = "{{ url('/admin/system_settings/locations') }}";
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


    var table = $('#data_table_city').DataTable();

    $(".deletecity").click(function() {
        $('#btn_delete_city').prop("disabled", true);
        var id = $(this).data("id");
        //console.log(btn_delete_key_facility);
        $.ajax({
            url: " {{ url('/admin/system_settings/locations/city/delete') }}" + '/' + id,
            type: 'DELETE',
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

    function editcity(id, districtId, name) {

        $(this).prop("disabled", true);
        $('.button-prevent-multiple-submits').attr("disabled", true);
        $('#city_update').show();
        $('#city_add').hide();
        $("#cityId").val(districtId).change();
        $('#city_id').val(name);
        $('#city_update').click(function() {

            $.ajax({
                url: "{{ URL('/admin/system_settings/locations/city/update') }}" + '/' + id,
                method: "POST",
                data: $("#cityForm").serialize(),
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
                                    $('#city_update').hide();
                                    $('#city_add').show();
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
