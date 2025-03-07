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
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Booking Availability - Properties</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                @foreach ($properties as $property)

                     <div class="col-lg-4 col-xl-4">
                     <a href="{{ URL('/') }}">
                        <div class="card-box">

                            <h4 class="header-title mb-3">{{ $property->name }}</h4>

                            <div class="text-center">
                            <img src="{{ URL('storage/property_image/'.$property->main_image) }}" alt="" style="width: 100px;">
                            </div>

                        </div>
                        </a>
                    </div><!-- end col-->

                @endforeach

            </div>
            <!-- end row -->



        </div> <!-- end container-fluid -->

    </div> <!-- end content -->

@endsection
