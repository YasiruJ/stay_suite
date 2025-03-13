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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Stay Suite</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Packages</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Subscription</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add New Subscription</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="container-fluid">
            <form id="subscriptionForm">
                <div class="row">
                    <div class="col-12 card">
                        <div class="card-body">
                            <h4 class="header-title mb-4">Subscription information</h4>
                            <div class="row">
                                <div class="col-xl-6 form-group">
                                    <label for="">Select User</label>
                                    <select class="form-control" id="propertyRatingSelect" name="user_id">
                                        @foreach ($users as $user)

                                        <option value="{{$user->id}}">{{$user->username}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6 form-group">
                                    <label for="">Select Package</label>
                                    <select class="form-control" id="propertyRatingSelect" name="package_id">
                                        @foreach ($packages as $package)
                                        <option value="{{$package->id}}">{{$package->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer" style="background-color: white;">
                            <button type="submit" id="btn_submit" class="btn btn-success btn-md">Save</button>
                        </div>

                    </div>
                </div>


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

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#subscriptionForm').on('submit', function(event) {
        event.preventDefault();
        $("#btn_submit").prop('disabled', true);
        console.log(this);
        $.ajax({
            url: "{{ url('admin/packages/subscriptions/save') }}",
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
                        title: 'Oops!',
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


@endsection
