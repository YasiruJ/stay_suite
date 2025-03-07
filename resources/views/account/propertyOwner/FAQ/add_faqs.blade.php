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
                <div class="card-box">
                    <div class="row">
                        <div class="col-xl-12">
                            <form id="faqForm">
                                <div class="form-group">
                                    <label>Question</label>
                                    <input type="text" name="question" id="question" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label><strong>Answer :</strong></label>
                                    <textarea class="ckeditor form-control" id="answer" name="answer"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="Faq_add" class="btn btn-primary btn-md ml-3">Save</button>
                                    <button type="button" id="Faq_update" class="btn btn-warning waves-effect waves-light my-3" style="display: none;">Update</button>
                                    <input type="hidden" value="{{ $properties->id }}" name="property_id" id="property_id">
                                </div>
                            </form>
                            <div class="province-table my-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-box">
                                            <h4 class="header-title">Default Example</h4>
                                            <p class="sub-header">
                                                DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                            </p>
                                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Question</th>
                                                        <td>Edit</td>
                                                        <td>Delete</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($property_has_faqs as $property_has_faq)
                                                    <tr>
                                                        <td>{{ $property_has_faq->id }}</td>
                                                        <td>{{ $property_has_faq->question }}</td>
                                                        <td><button class="editFaq btn waves-effect waves-light btn-warning" id="btn_edit_faq" onclick="editFaq('{{ $property_has_faq->id }}','{{ $property_has_faq->question }}','{{ $property_has_faq->answer }}')"> <i class="fas fa-edit"></i> </button></td>
                                                        <td><button class="deleteFaq btn waves-effect waves-light btn-danger" id="btn_delete_faq" data-id="{{ $property_has_faq->id }}"> <i class="mdi mdi-close"></i> </button></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
        </div>
    </div><!-- end col -->
</div>
@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $('.ckeditor').ckeditor();

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#Faq_add').click(function(event) {
        event.preventDefault();
        var question = $("#question").val()
        var property_id = $("#property_id").val()
        var answer = CKEDITOR.instances.answer.getData();
        console.log(answer);

        $.ajax({
            url: "{{ url('/property-owner/FAQs/save') }}",
            method: "POST",
            data: "question=" + question + "&property_id=" + property_id + "&answer=" + answer,
            dataType: 'JSON',
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

    var table = $('#datatable').DataTable();

    $(".deleteFaq").click(function() {
        $('#btn_delete_faq').prop("disabled", true);
        var id = $(this).data("id");

        $.ajax({
            url: " {{ url('/property-owner/FAQs/delete') }}" + '/' + id,
            type: 'DELETE',
            success: function(response) {
                if (!response.success) {
                    $.confirm({
                        icon: 'fa fa-exclamation-triangle',
                        theme: 'modern',
                        animation: 'right',
                        type: 'red',
                        title: 'Deleted',
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

    function editFaq(id, question, answer) {
        $("editFaq").prop("disabled", true);

        $('#Faq_update').show();
        $('#Faq_add').hide();
        $('#question').val(question);
        CKEDITOR.instances.answer.setData(answer);
        console.log(answer);
        $('#Faq_update').click(function() {
            var question = $("#question").val()
            var answer = CKEDITOR.instances.answer.getData();

            $.ajax({
                url: "{{ URL('/property-owner/FAQs/update') }}" + '/' + id,
                method: "POST",
                data: "question=" + question + "&answer=" + answer,
                dataType: 'JSON',
                success: function(response) {
                    if (response.success) {

                        $.confirm({
                            icon: 'fa fa-check',
                            theme: 'modern',
                            animation: 'left',
                            type: 'green',
                            title: 'Update!',
                            content: response.message,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    $('#Faq_update').hide();
                                    $('#Faq_add').show();
                                }
                            }
                        });
                    }
                }
            });
        });
    }
</script>
@endsection
