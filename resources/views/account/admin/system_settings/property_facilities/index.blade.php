@extends('account.layouts.master')
@section('content')

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
            <div class="card-box">
                <h4 class="header-title mb-4">Input Types</h4>
                <form id="property_facility_form">
                    <div class="form-group">
                        <label>property Facility</label>
                        <input type="text" class="form-control" id="property_facility_name" name="property_facility_name" placeholder="Enter property Facility">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="form-control" id="property_facility_description" name="property_facility_description" placeholder="Enter property Description Breifly" rows="3"></textarea>
                    </div>
                    <button type="submit" id="facility_add" class="btn btn-primary">Save</button>
                    <button type="button" id="facility_update" class="update btn btn-warning my-3" style="display: none;">Update Facility</button>

                </form>
                <div class="row my-4">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Default Example</h4>
                            <p class="sub-header">
                                DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                            </p>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <th>ID</th>
                                    <th>Facility Name</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    @foreach ($property_facilities as $property_facility)
                                    <tr>
                                        <td>{{ $property_facility->id }}</td>
                                        <td>{{ $property_facility->name }}</td>
                                        <td>{{ $property_facility->description }}</td>
                                        <td><button class="editFacility btn waves-effect waves-light btn-warning" onclick="editPropertyFaclity('{{ $property_facility->id }}','{{ $property_facility->name }}','{{ $property_facility->description }}')" data-token="{{ csrf_token() }}"> <i class="fas fa-edit"></i> </button></td>
                                        <td><button class="deleteFacility btn waves-effect waves-light btn-danger" id="btn_delete" data-id="{{ $property_facility->id }}" data-token="{{ csrf_token() }}"> <i class="mdi mdi-close"></i> </button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    </div>
    <!-- end row -->
</div><!-- end col -->

@endsection

@section('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#facility_add').click(function() {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/system_settings/property_facilities/save') }}",
            method: "POST",
            data: $("#property_facility_form").serialize(),
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
                                location.href = "{{ URL('/admin/system_settings/property_facilities') }}";
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

    var table = $('#datatable').DataTable();


    $(".deleteFacility").click(function() {
        $('#btn_delete').prop("disabled", true);
        var id = $(this).data("id");
        console.log(id);
        $.ajax({
            url: "{{ URL('/admin/system_settings/property_facilities/delete') }}" + '/' + id,
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

    function editPropertyFaclity(id, name, description) {
        // console.log(id, name, description);
        $(this).prop("disabled", true);
        $('#facility_update').show();
        $('#facility_add').hide();
        $('#property_facility_name').val(name);
        $('#property_facility_description').val(description);
        $('#facility_update').click(function() {

            $.ajax({
                url: "{{ URL('/admin/system_settings/property_facilities/update') }}" + '/' + id,
                method: "POST",
                data: $("#property_facility_form").serialize(),
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
                                    $('#facility_update').hide();
                                    $('#facility_add').show();
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
