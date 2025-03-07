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
                <form id="bed_type_form">
                    <div class="form-group">
                        <label>Bed Type</label>
                        <input type="text" class="form-control" id="bed_type" name="bed_type" placeholder="Enter Bed Type">
                    </div>
                    <div class="form-group">
                        <label>Bed Capacity</label>
                        <input type="text" class="form-control" id="bed_capacity" name="bed_capacity" placeholder="Enter Bed Capacity">
                    </div>
                    <div class="form-group">
                        <label>Bed Icon</label>
                        <input type="text" class="form-control" id="bed_icon" name="bed_icon" placeholder="Enter Bed Icon">
                    </div>
                    <button type="submit" id="bed_type_add" class="add btn btn-primary">Save</button>
                    <button type="button" id="bed_type_update" class="update btn btn-warning my-3" style="display: none;">Update Bed Type</button>
                </form>
                <div class="row my-4">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Default Example</h4>
                            <p class="sub-header">
                                DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                            </p>
                            <table id="bed_type_table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <th>ID</th>
                                    <th>Bed Type</th>
                                    <th>Bed Capacity</th>
                                    <th>Bed Icon</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    @foreach ($bed_types as $bed_type)
                                    <tr>
                                        <td>{{ $bed_type->id }}</td>
                                        <td>{{ $bed_type->type }}</td>
                                        <td>{{ $bed_type->capacity }}</td>
                                        <td>{{ $bed_type->icon }}</td>
                                        <td><button class="editBedType btn waves-effect waves-light btn-warning" onclick="editBedType('{{ $bed_type->id }}','{{ $bed_type->type }}','{{ $bed_type->capacity }}','{{ $bed_type->icon }}')" data-token="{{ csrf_token() }}"> <i class="fas fa-edit"></i> </button></td>
                                        <td><button class="deleteBedType btn waves-effect waves-light btn-danger" id="btn_delete_bed_type" data-id="{{ $bed_type->id }}" data-token="{{ csrf_token() }}"> <i class="mdi mdi-close"></i> </button></td>
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
    $('#bed_type_add').click(function() {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/system_settings/bed_type/save') }}",
            method: "POST",
            data: $("#bed_type_form").serialize(),
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
                                location.href = "{{ url('admin/system_settings/bed_type') }}";
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

    var table = $('#bed_type_table').DataTable();


    $(".deleteBedType").click(function() {
        $('#btn_delete_bed_type').prop("disabled", true);
        var id = $(this).data("id");
        $.ajax({
            url: " {{ url('/admin/system_settings/bed_type/delete') }}" + '/' + id,
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

    function editBedType(id, type, capacity, icon) {
        $(this).prop("disabled", true);
        $('.editBedType').attr("disabled", true);
        $('#bed_type_update').show();
        $('#bed_type_add').hide();
        $('#bed_type').val(type);
        $('#bed_capacity').val(capacity);
        $('#bed_icon').val(icon);
        $('#bed_type_update').click(function() {

            $.ajax({
                url: "{{ URL('/admin/system_settings/bed_type/update') }}" + '/' + id,
                method: "POST",
                data: $("#bed_type_form").serialize(),
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
                                    $('#bed_type_update').hide();
                                    $('#bed_type_add').show();
                                }
                            }
                        });
                    }
                }
            });
        });
    }
</script>
@stop
