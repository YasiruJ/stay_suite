@extends('account.propertyOwner.layouts.master')
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
                            <li class="breadcrumb-item active">X-editable</li>
                        </ol>
                    </div>
                    <h4 class="page-title">X-editable</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title mb-4">Inline Editor</h4>
                    <div class="table-responsive">
                        <table class="table table-centered table-borderless     -striped mb-0">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Guest Type Name</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Overall Score</th>
                                    <th>Response</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($property_reviews as $property_review)
                                <tr>
                                    <td>{{ $property_review->users->username }}</td>
                                    <td>{{ $property_review->reviewGuestTypes->name }}</td>
                                    <td>{{ $property_review->title }}</td>
                                    <td>{{ $property_review->description }}</td>
                                    <td>{{ $property_review->overall_score }}</td>
                                    <td><a href="{{ url('/property-owner/review/edit/'.$properties->id.'/response/'.$property_review->id) }}"><button class="btn waves-effect waves-light btn-warning"> <i class="fas fa-edit"></i></button></a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end .table-responsive -->
                </div> <!-- end card-box -->
            </div><!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- end container-fluid -->

</div> <!-- end content -->

@endsection

@section('scripts')
<!-- Plugins js -->
<script src="{{ url('dashboard_assets/libs/moment/moment.min.js') }}"></script>
<script src="{{ url('dashboard_assets/libs/x-editable/bootstrap-editable.min.js') }}"></script>

<!-- Init js-->
<script src="{{ url('dashboard_assets/js/pages/form-xeditable.init.js') }}"></script>

@endsection
