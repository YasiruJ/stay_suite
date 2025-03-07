@extends('home.layouts.master')
@section('content')
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->

<!-- ============================ Page Title Start================================== -->
<div class="image-cover page-title" style="background:url(https://via.placeholder.com/1920x900) no-repeat;" data-overlay="6">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <h2 class="ipt-title">Get in Touch</h2>
                <span class="ipn-subtitle text-light">Who we are & our mission</span>

            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Who We Are Start ================================== -->
<section>
    <div class="container">

        <div class="row mb-4">

            <div class="col-lg-4 col-md-4">
                <div class="contact-box">
                    <a href=""><i class="ti-map-alt"></i></a>
                    <h4>Head Offices</h4>
                    5th floor,<br>
                    285 Main Road Attidiya
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="contact-box">
                    <i class="ti-email"></i>
                    <h4>Drop a Mail</h4>
                    info@gimanhal.com
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="contact-box">
                    <i class="ti-headphone"></i>
                    <h4>Call Us</h4>
                    076 553 6774
                </div>
            </div>

        </div>

        <div class="row mt-5 row align-items-center">

            <div class="col-lg-5 col-md-5">
                <img src="assets/img/about.png" class="img-fluid" alt="" />
            </div>
            <div class="col-lg-7 col-md-7">
                @if (session()->has('success_message'))
                <div class="alert-success" style="height: 35px;padding-top: 6px;">
                    {{ session()->get('success_message') }}
                </div>
                @endif
                <div class="contact-form">
                    <form action="{{ url('contact/send') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea class="form-control" name="message" id="message" placeholder="Type Here..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Send Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
@endsection
<!-- ============================ Who We Are End ================================== -->
