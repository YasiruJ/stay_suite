@extends('home.customer.layouts.master')
@section('content')
<div class="dashboard-wraper">
    <!-- Basic Information -->
    <div class="form-submit">
        <h4>My Account</h4>
        <div class="submit-section mt-4">
            <form id="profileForm">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>First Name</label>
                        <input type="text" class="form-control" value="{{ $user->first_name }}" name="first_name">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Last Name</label>
                        <input type="text" class="form-control" value="{{ $user->last_name }}" name="last_name">
                    </div>

                    <div class="form-group col-md-6">
                        <label>User Name</label>
                        <input type="text" class="form-control" value="{{ $user->username }}" name="username">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" class="form-control" value="{{ $user->phone }}" name="phone">
                    </div>

                    <div class="form-group col-md-12">
                        <label>About</label>
                        <textarea class="form-control" name="description">{{ $user->description }}</textarea>
                    </div>

                </div>
                <button class="btn btn-theme my-2" type="submit">Update Profile</button>
            </form>
        </div>
    </div>

    <!-- <div class="form-submit">
        <h4>Social Accounts</h4>
        <div class="submit-section">
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label>Facebook</label>
                    <input type="text" class="form-control" value="https://facebook.com/">
                </div>

                <div class="form-group col-md-6">
                    <label>Twitter</label>
                    <input type="email" class="form-control" value="https://twitter.com/">
                </div>

                <div class="form-group col-md-6">
                    <label>Google Plus</label>
                    <input type="text" class="form-control" value="https://googleplus.com">
                </div>

                <div class="form-group col-md-6">
                    <label>LinkedIn</label>
                    <input type="text" class="form-control" value="https://linkedin.com/">
                </div>

                <div class="form-group col-lg-12 col-md-12">
                    <button class="btn btn-theme" type="submit">Save Changes</button>
                </div>

            </div>
        </div>
    </div> -->

</div>
@endsection

@section('scripts');
<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#profileForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('customer/my_profile/edit/'.$user->id) }}",
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
@endsection