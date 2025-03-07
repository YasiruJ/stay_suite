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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form id="propertyForm">
                <div class="card-box">
                    <h4 class="header-title mb-4">property Owner information</h4>
                    <div class="row">
                        <div class="col xl-6">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="" placeholder="Enter First Name">
                            </div>
                        </div>
                        <div class="col xl-6">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" id="" name="last_name" placeholder="Enter Last Name">
                            </div>
                        </div>
                        <div class="col xl-6">
                            <div class="form-group">
                                <label for="">User Name</label>
                                <input type="text" class="form-control" id="" name="username" placeholder="Enter a Valid User Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col xl-6 form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter a valid Email" required onchange="validateEmail()">
                            <div id="email_message" class="text-danger mb-2" style="font-size: 13px;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col xl-6 form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter a Valid Password">
                        </div>
                        <div class="col xl-6 form-group">
                            <label for="exampleComfirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <div class="col xl-6 form-group">
                            <label for="">Mobile Number</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter a valid Mobile Number" required onchange="validateContactNumber()">
                            <div id="phone_messsage" class="text-danger mb-2" style="font-size: 13px;"></div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-xl-6 form-group">
                            <div class="card-box my-2">
                                <h4 class="header-title mb-4"> Image</h4>
                                <input type="file" class="dropify1" data-max-file-size="1M" />
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex flex-column">

                                <div class="form-group form-row px-2">
                                    <label class="col-sm-3"> Active User</label>

                                    <div class="radio col-sm-2">
                                        <input type="radio" name="radio" id="radio1" value="option1" checked="">
                                        <label for="radio1">
                                            YES
                                        </label>

                                    </div>
                                    <div class="radio col-sm-2">
                                        <input type="radio" name="radio" id="radio2" value="option1" checked="">
                                        <label for="radio1">
                                            NO
                                        </label>

                                    </div>
                                </div>
                                <div class="form-group form-row  px-2">
                                    <label class="col-sm-3"> Active Profile</label>

                                    <div class="radio col-sm-2">
                                        <input type="radio" name="radio" id="radio1" value="option1" checked="">
                                        <label for="radio1">
                                            YES
                                        </label>

                                    </div>
                                    <div class="radio col-sm-2">
                                        <input type="radio" name="radio" id="radio2" value="option1" checked="">
                                        <label for="radio1">
                                            NO
                                        </label>

                                    </div>
                                </div>
                                <div class="form-group form-row  px-2">
                                    <label class="col-sm-3"> Blocked</label>

                                    <div class="radio col-sm-2">
                                        <input type="radio" name="radio" id="radio1" value="option1" checked="">
                                        <label for="radio1">
                                            YES
                                        </label>

                                    </div>
                                    <div class="radio col-sm-2">
                                        <input type="radio" name="radio" id="radio2" value="option1" checked="">
                                        <label for="radio1">
                                            NO
                                        </label>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> -->
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                </div>
            </form>
        </div>




    </div><!-- end row -->
</div>
</div><!-- end col -->
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

    $('#propertyForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('admin/property_owner/add/save') }}",
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

    function validateContactNumber() {
        const phone = document.getElementById('phone')
        var validNo = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;


        if (!phone.value.match(validNo)) {
            var message = 'Please enter valid phone number';
            $('#phone_messsage').html(message);

        } else {
            $('#phone_messsage').empty();
        }
    }

    $(document).ready(function() {
        $("#phone").attr('maxlength', '12');
    });

//     $("input[name='phone']").keyup(function() {
//         var curchr = this.value.length;
//         var curval = $(this).val();
//         if (curchr == 3) {
//             $("input[name='phone']").val(curval + " ");
//         } else if (curchr == 7) {
//             $("input[name='phone']").val(curval + " ");
//         }
//     });

    $("input[name='phone']").keydown(function(e) {
        var letters_numbers_array = [];
        for (var i = 65; i <= 90; i++) {
            letters_numbers_array.push(i);
        }
        var ingnore_key_codes = letters_numbers_array;
        if ($.inArray(e.keyCode, ingnore_key_codes) >= 0) {
            e.preventDefault();
        }
    });

    function validateEmail() {


        const email = document.getElementById('email')
        var valid = /\S+@\S+\.\S+/;


        if (!email.value.match(valid)) {
            var meessage = "please enter a valid email address"
            $('#email_message').html(meessage);
        } else {
            $('#email_message').empty();
        }
    }
</script>
@endsection
