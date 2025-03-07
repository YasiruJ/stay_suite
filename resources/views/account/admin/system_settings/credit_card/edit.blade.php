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
                <form id="credit_card_type_edit_form">
                    <div class="form-group">
                        <label>Credit Card Type</label>
                        <input type="text" class="form-control" id="card_type" name="card_type" value="{{ $credit_cards->card_type }}" />
                    </div>
                    <div class="form-group">
                        <label>Credit Card Image </label>
                        <input type="file" class="dropify1" data-max-file-size="1M" data-default-file="{{ url('storage/credit_card_image/'.$credit_cards->credit_card_image) }}" name="input_img" />
                    </div>
                    <button type="submit" id="card_type_add" class="add btn btn-primary">Update</button>
                </form>
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
    $('#credit_card_type_edit_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/system_settings/credit_card_type/edit/'.$credit_cards->id.'/update') }}",
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
@stop
