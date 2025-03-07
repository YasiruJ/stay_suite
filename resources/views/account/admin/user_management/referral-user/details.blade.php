@extends('account.layouts.master')

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Tables</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Tables</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title">Referral User Details</h4>
                    <p class="sub-header">
                        DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Active</th>
                                <th>ID</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>ContactNumber</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td><input type="checkbox" data-id="{{ $user->id }}" class="js-switch" name="js-switch" {{ ($user->is_blocked) ? "checked" : "" }} /></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @if ($user->is_blocked)
                                    <span id="status_{{ $user->id }}" class="badge badge-success  even-larger-badge my-2" style="font-size: 1em;">Active</span>
                                    @else
                                    <span id="status_{{ $user->id }}" class="badge badge-danger  even-larger-badge my-2" style="font-size: 1em;">Inactive</span>
                                    @endif
                                </td>
                                <td> <a href="{{ URL('admin/referral_user/edit/'.$user->id) }}"><button class="btn waves-effect waves-light btn-warning"><i class="mdi mdi-wrench"></i> </button></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

</div> <!-- end content -->
@endsection

@section('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });

    var switchStatus = false;
    var referralUserID
    $(".js-switch").on('change', function() {
        if ($(this).is(':checked')) {
            switchStatus = $(this).is(':checked');
            referralUserID = $(this).data('id');
        } else {
            switchStatus = $(this).is(':checked');
            referralUserID = $(this).data('id');

        }
        // console.log(switchStatus, propertyID);

        $.ajax({
            url: "{{ url('admin/referral_user/status/update') }}" + '/' + referralUserID,
            type: 'POST',
            data: {
                switchStatus: switchStatus,

            },
            dataType: 'json',
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
            }
        })
    });
</script>
@endsection
