<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Gimanhal - The finest hotels at the best price</title>
    <meta name="title" content="Gimanhal">
    <meta name="keywords" content="gimanhal,booking,rooms,offers,hotel offers">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="The finest hotels at the best price.Sri Lanka's Largest Travel Platform.Browse thousands of Hotel offers from one place">
    <!-- All Plugins Css -->
    <link rel="stylesheet" href="{{ URL('assets/css/plugins.css') }}">
    <!-- Custom CSS -->
    <link href="{{ URL('assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ URL('assets/css/review.css') }}" rel="stylesheet">
    <!-- Custom Color Option -->
    <link href="{{ URL('assets/css/colors.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL('assets/css/semantic.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL('dashboard_assets/css/jquery-confirm.css') }}" />


</head>

<body class="orange-skin">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>



    <section class="gray pt-5">
        <div class="container">
            @if (session('status'))
            <div class="alert alert-sucess">
                {{ session('status') }}
            </div>
            @endif
            <div class="row">
                <!-- property main detail -->
                <div class="col-lg-8 col-md-12 col-sm-12 order-lg-1 order-md-2 order-2">
                    <div class="block-wrap">
                        <div class="block-header">
                            <h4 class="block-title text-center">Add Review</h4>
                        </div>
                        <div class="block-body">
                            <form id="reviewForm">
                                <div class="giv-averg-rate">

                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <div class="row">
                                                <input type="hidden" value="{{ Request::query('bookingNumber') }}" name="bookingId">
                                                <?php $i = 0 ?>
                                                @foreach ($review_categories as $review_category)
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label>{{ $review_category->name }}</label>
                                                    <div class="slidecontainer">
                                                        <input type="range" min="1" max="10" value="" class="slider" id="reviewCategories" name="{{ $review_category->id }}">
                                                        <p>Value: <span id="demo"></span></p>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="avg-total-pilx">
                                                <h4 class="high">4.9</h4>
                                                <span>Average Ratting</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-form-box form-submit">

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="">Review Guest Type</label>
                                            <select class="form-control" id="reviewGuestTypeSelect" name="review_guest_type">
                                                <option value="" disabled selected style="color:green;">Select Review Guest Type</option>
                                                @foreach ($review_guest_types as $review_guest_type)
                                                <option value="{{ $review_guest_type->id }}">{{ $review_guest_type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control" type="text" placeholder="Title" id="title" name="title">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Review</label>
                                                <textarea class="form-control ht-140" placeholder="Review" id="description" name="description"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-theme" id="btn-submit">Submit Review</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- ============================ Property Detail End ================================== -->

    <script src="{{ URL('assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL('assets/js/circleMagic.min.js') }}"></script>
    <script src="{{ URL('assets/js/popper.min.js') }}"></script>
    <script src="{{ URL('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL('assets/js/rangeslider.js') }}"></script>
    <script src="{{ URL('assets/js/select2.min.js') }}"></script>
    <script src="{{ URL('assets/js/aos.js') }}"></script>
    <script src="{{ URL('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ URL('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ URL('assets/js/slick.js') }}"></script>
    <script src="{{ URL('assets/js/slider-bg.js') }}"></script>
    <script src="{{ URL('assets/js/lightbox.js') }}"></script>
    <script src="{{ URL('assets/js/imagesloaded.js') }}"></script>
    <script src="{{ URL('assets/js/isotope.min.js') }}"></script>
    <script src="{{ URL('assets/js/custom.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <script src="{{ URL('dashboard_assets/js/jquery-confirm.js') }}"></script>
    <!-- ============================================================== -->

    <!-- Date Booking Script -->
    <script src="{{ URL('assets/js/moment.min.js') }}"></script>
    <script src="{{ URL('assets/js/daterangepicker.js') }}"></script>
    <script src="{{ URL('assets/js/semantic.min.js') }}"></script>


    <script>
        var slider = document.getElementById("reviewCategories");
        var output = document.getElementById("demo");

        output.innerHTML = slider.value;


        slider.oninput = function() {
            output.innerHTML = this.value;

        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#reviewForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ url('properties/details/'.$properties->id.'/save_review') }}",
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
                                    location.href="{{ url('/properties/details/'.$properties->id) }}";
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
</body>

</html>
