@extends('home.customer.layouts.master')
@section('content')
<div class="dashboard-wraper">

    <!-- Basic Information -->
    <div class="form-submit">
        <h4>Change Your Password</h4>
        <div class="submit-section">
            <div class="form-row">

                <div class="form-group col-lg-12 col-md-6">
                    <label>Old Password</label>
                    <input type="password" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label>New Password</label>
                    <input type="password" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label>Confirm password</label>
                    <input type="password" class="form-control">
                </div>

                <div class="form-group col-lg-12 col-md-12">
                    <button class="btn btn-theme" type="submit">Save Changes</button>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
<!-- this is the test stage commit -->