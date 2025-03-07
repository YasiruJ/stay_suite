@extends('account.layouts.master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Gimanhal</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Properties</a></li>
                        <li class="breadcrumb-item active">Update Property Owner</li>
                    </ol>
                </div>
                <h4 class="page-title">Gimanhal</h4>
            </div>
        </div>
         <div class="col-12">
            <form id="propertyEditForm">
                <div class="card-box">
                    <div class="clearfix">
                        <h4 class="header-title mb-4 float-left">property Owner information</h4>
                             <a href="{{ URL('admin/user/login') }}/{{ $user->id }}" style="left:0;" class="btn btn-success waves-effect waves-light float-right">Login as Owner</a>
                        <a href="{{ URL('admin/property_owner/delete/'.$user->id) }}" style="left:0;margin-right: 2px;" class="btn btn-danger waves-effect waves-light float-right">Delete Owner</a>
                    </div>
                    <div class="row">
                        <div class="col xl-6">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="" placeholder="Enter First Name" value="{{ $user->first_name }}">
                            </div>
                        </div>
                        <div class="col xl-6">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" id="" name="last_name" placeholder="Enter Last Name" value="{{ $user->last_name }}">
                            </div>
                        </div>
                        <div class="col xl-6">
                            <div class="form-group">
                                <label for="">User Name</label>
                                <input type="text" class="form-control" id="" name="username" placeholder="Enter a Valid User Name" value="{{ $user->username }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col xl-6 form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" id="" name="email" placeholder="Enter a valid Email" value="{{ $user->email }}">
                        </div>
                        <div class="col xl-6 form-group">
                            <label for="">Mobile Number</label>
                            <input type="tel" class="form-control" name="phone" id="" placeholder="Enter a valid Mobile Number" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col xl-6 form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter a Valid Password">
                        </div>
                        <div class="col xl-6 form-group">
                            <label for="exampleComfirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
                        </div>
                        <div class="col xl-6 form-group">
                            <label for="">Status</label>
                            <select name="status" id="propertyOwner_status_value" class="form-control">
                                @if ($user->is_blocked == 1)
                                <option value="1" style="color: green;" selected>Active</option>
                                <option value="0" style="color: red;">Blocked</option>
                                @else
                                <option value="1" style="color: green;">Active</option>
                                <option value="0" style="color: red;" selected>Blocked</option>
                                @endif
                            </select>
                        </div>
                        <input type="hidden" name="owner_id" id="owner_id" value="{{ $user->id }}">
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts');
<script src="{{ URL('dashboard_assets/libs/dropify/dropify.min.js') }}"></script>
<!-- Init js-->
<script src="{{ URL('dashboard_assets/js/pages/form-fileuploads.init.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#propertyEditForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/property_owner/update') }}",
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
            },
            error: function(err) {

                if (err.status == 422) { // when status code is 422, it's a validation issue
                    console.log(err.responseJSON);
                    $('#success_message').fadeIn().html(err.responseJSON.message);

                    // you can loop through the errors object and show it to the user
                    console.warn(err.responseJSON.errors);
                    // display errors on each form field
                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        el.after($('<span style="color: red;">' + error[0] + '</span>'));
                    });
                }
            }
        });
    });
</script>
@endsection
