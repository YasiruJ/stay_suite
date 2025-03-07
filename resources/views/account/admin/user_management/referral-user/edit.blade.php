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
                <form id="referralUserDetailsForm">
                    <div class="card-box">
                        <div class="clearfix">
                            <h4 class="header-title mb-4 float-left">Referral User information</h4>
                            <a href="{{ URL('admin/referral_user/delete/'.$referral_user_details->id) }}"><button type="button" class="btn btn-danger waves-effect waves-light float-right">
                                    <span class="btn-label"><i class="mdi mdi-close"></i>
                                    </span>Delete property</button></a>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter First Name" name="first_name" value="{{ $referral_user_details->first_name }}">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter Last Name" name="last_name" value="{{ $referral_user_details->last_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter Contact Number" name="phone" value="{{ $referral_user_details->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col xl-6">
                                <div class="form-group">
                                    <label for="">User Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter User Name" name="user_name" value="{{ $referral_user_details->username }}">
                                </div>
                            </div>

                            <div class="col xl-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter Email" name="email" value="{{ $referral_user_details->email }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning btn-md ml-3">Edit</button>
                    </div>
                </form>
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

    $('#referralUserDetailsForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/referral_user/edit/'.$referral_user_details->id.'/update') }}",
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
                                location.href = "{{ url('admin/user_management/referral_user/details') }}";
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
