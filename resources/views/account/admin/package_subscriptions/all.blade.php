@extends('account.layouts.master')

@section('styles')
<style>
    .custom-text-right {
        text-align: right;
    }

    .custom-text-left {
        text-align: left;
    }
</style>
@endsection
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
                            <li class="breadcrumb-item active">Package Subscriptions</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Package Subscriptions</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">

                {{-- <div class="card-header" >
                    <button type="submit" id="btn_submit" class="btn btn-success btn-md">Add New</button>
                </div> --}}
                <div class="card-body card-box">
                    <div class="card-header" style="background-color: white;text-align:right;">
                        <a href="{{URL('admin/packages/subscriptions/add')}}" id="btn_submit" class="btn btn-success btn-md">Add New</a>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Customer name</th>
                                <th>Package</th>
                                <th>Type</th>
                                <th>Expired at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packageSubscriptions as $subscription)
                            <tr>
                                <td>{{ $subscription->user->username }}</td>
                                <td>{{ $subscription->package->name }}</td>
                                <td>{{ \App\Enums\PackageTypeEnum::values()[$subscription->package->type]}}</td>
                                <td>{{ $subscription->expires_at }}</td>
                                <td> <a href="{{ URL('admin/packages/subscriptions/edit/'.$subscription->id) }}"><button class="btn waves-effect waves-light btn-warning"><i class="mdi mdi-wrench"></i> </button></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- end container-fluid -->
</div>
 @endsection
