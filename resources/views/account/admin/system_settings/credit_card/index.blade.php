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
                <form id="credit_card_type_form">
                    <div class="form-group">
                        <label>Credit Card Type</label>
                        <input type="text" class="form-control" id="card_type" name="card_type" placeholder="Enter Credit Card Type">
                    </div>
                    <div class="form-group">
                        <label>Credit Card Image </label>
                        <input type="file" class="dropify1" data-max-file-size="1M" name="input_img" />
                    </div>
                    <button type="submit" id="card_type_add" class="add btn btn-primary">Save</button>
                </form>
                <div class="row my-4">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Default Example</h4>
                            <p class="sub-header">
                                DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                            </p>
                            <table id="credit_card_type_table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <th>ID</th>
                                    <th>Credit Card Type</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    @foreach ($credit_cards as $credit_card)
                                    <tr>
                                        <td>{{ $credit_card->id }}</td>
                                        <td>{{ $credit_card->card_type }}</td>
                                        <td><a href="{{ url('admin/system_settings/credit_card_type/edit/'.$credit_card->id) }}"><button class="editCardType btn waves-effect waves-light btn-warning"> <i class="fas fa-edit"></i></button></a></td>
                                        <td><button class="deleteCardType btn waves-effect waves-light btn-danger" id="btn_delete_card_type" data-id="{{ $credit_card->id }}" data-token="{{ csrf_token() }}"> <i class="mdi mdi-close"></i> </button></td>
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
<script src="{{ URL('dashboard_assets/libs/dropify/dropify.min.js') }}"></script>
<script src="{{ URL('dashboard_assets/js/pages/form-fileuploads.init.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#credit_card_type_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/system_settings/credit_card_type/save') }}",
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

    var table = $('#credit_card_type_table').DataTable();


    $(".deleteCardType").click(function() {
        $('#btn_delete_card_type').prop("disabled", true);
        var id = $(this).data("id");
        $.ajax({
            url: " {{ url('/admin/system_settings/credit_card_type/delete') }}" + '/' + id,
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
</script>
@stop
