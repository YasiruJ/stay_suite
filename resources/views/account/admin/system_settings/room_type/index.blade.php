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
                <form id="room_type_form">
                    <div class="form-group">
                        <label>Room Type</label>
                        <input type="text" class="form-control" id="room_type" name="room_type" placeholder="Enter Room Type">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="form-control" id="room_type_description" name="room_type_description" placeholder="Enter Description Breifly" rows="3"></textarea>
                    </div>
                    <button type="submit" id="room_type_add" class="add btn btn-primary">Save</button>
                    <button type="button" id="room_type_update" class="update btn btn-warning my-3" style="display: none;">Update Room Type</button>
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
                                    @foreach ($room_types as $room_type)
                                    <tr>
                                        <td>{{ $room_type->id }}</td>
                                        <td>{{ $room_type->type }}</td>
                                        <td>{{ $room_type->description }}</td>
                                        <td><button class="editRoomType btn waves-effect waves-light btn-warning button-prevent-multiple-submits" onclick="editRoomType('{{ $room_type->id }}','{{ $room_type->type }}','{{ $room_type->description }}')" data-token="{{ csrf_token() }}"> <i class="fas fa-edit"></i> </button></td>
                                        <td><button class="deleteRoomType btn waves-effect waves-light btn-danger" id="btn_delete_Room_Type" data-id="{{ $room_type->id }}" data-token="{{ csrf_token() }}"> <i class="mdi mdi-close"></i> </button></td>
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

    $('#room_type_add').click(function() {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/system_settings/room_type/save') }}",
            method: "POST",
            data: $("#room_type_form").serialize(),
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
                                location.href = "{{ url('admin/system_settings/room_type') }}";
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

    var table = $('#datatable').DataTable();


    $(".deleteRoomType").click(function() {
        $('#btn_delete_Room_Type').prop("disabled", true);
        var id = $(this).data("id");
        // console.log(btn_delete_Room_Type);
        $.ajax({
            url: " {{ url('/admin/system_settings/room_type/delete') }}" + '/' + id,
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

    function editRoomType(id, type, description) {
        $(this).prop("disabled", true);
        $('.button-prevent-multiple-submits').attr("disabled", true);
        $('#room_type_update').show();
        $('#room_type_add').hide();
        $('#room_type').val(type);
        $('#room_type_description').val(description);
        $('#room_type_update').click(function() {

            $.ajax({
                url: "{{ URL('/admin/system_settings/room_type/update') }}" + '/' + id,
                method: "POST",
                data: $("#room_type_form").serialize(),
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
                                    $('#room_type_update').hide();
                                    $('#room_type_add').show();
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
