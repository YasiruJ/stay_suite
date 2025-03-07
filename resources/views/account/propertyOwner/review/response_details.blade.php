@extends('account.propertyOwner.layouts.master')
@section('styles')
<!-- Custom CSS -->
<link href="{{ URL('assets/css/styles.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Gimanhal</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">General Elements</li>
                        </ol>
                    </div>
                    <!-- <h4 class="page-title">General Elements</h4> -->
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="rating-bars">
                                @foreach ($rating_categories as $rating_category )
                                <div class="rating-bars-item">
                                    <span class="rating-bars-name">{{ $rating_category->name }}</span>
                                    <span class="rating-bars-inner">
                                        <span class="rating-bars-rating high">
                                            <span class="rating-bars-rating-inner" style="width: 85%;"></span>
                                        </span>
                                        <strong>{{ $rating_category->rating }}</strong>
                                    </span>
                                </div>
                                @endforeach
                            </div>
                            <form id="addResponseForm">
                                <div class="form-group">
                                    <label>Add Response</label>
                                    <div>
                                        <textarea required class="form-control" rows="3" name="response"></textarea>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <input type="hidden" value="{{ $property_reviews->id }}" name="review_id">
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
        </div>
    </div><!-- end col -->
</div>
@endsection

@section('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#addResponseForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('/property-owner/review/save_response') }}",
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
                                location.href = "{{ url('/property-owner/review/edit/'.$properties->id) }}";
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

    $(document).ready(function() {

        var slideContainers = document.getElementsByClassName("rating-bars-item");
        console.log(slideContainers);
        console.log(slideContainers.length);
        for (var i = 0; i < slideContainers.length; i++) {
            var slider = slideContainers[i].getElementsByClassName("rating-bars");
            // var width = {{ (($rating_category->rating)/10)*100 }};
            var width = "<?php echo (($rating_category->rating) / 10) * 100; ?>";
            console.log(width);
            // slider.css('width', width + "%");
            slider.attr('style', 'width: ' + width + ' + ' % ' + important');
            updateLabel.call(slider);
            slider.oninput = updateLabel;
        }

    });
</script>

<script src="{{ URL('dashboard_assets/libs/dropify/dropify.min.js') }}"></script>
<!-- Init js-->
<script src="{{ URL('dashboard_assets/js/pages/form-fileuploads.init.js') }}"></script>
@endsection
