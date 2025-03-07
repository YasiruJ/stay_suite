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
                                <li class="breadcrumb-item"><a href="{{ URL('/property-owner/dashboard') }}">Gimanhal</a></li>
                                <li class="breadcrumb-item active"><a href="javascript: void(0);" >All Properties</a></li>
                                {{-- <li class="breadcrumb-item active">all</li> --}}
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
                        <h4 class="header-title">Property Details</h4>


                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Active</th>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $property)
                                    <tr>
                                        <td><input type="checkbox" data-id="{{ $property->id }}" class="js-switch"
                                                name="js-switch" {{ $property->property_active ? 'checked' : '' }} /></td>
                                        <td>{{ $property->id }}</td>
                                        <td>{{ $property->user->username }}</td>
                                        <td>{{ $property->name }}</td>
                                        <td>{{ $property->user->email }}</td>
                                        <td>{{ $property->city->name }}</td>
                                        <td>{{ $property->description }}</td>
                                        <td>
                                            @if ($property->property_active)
                                                <span id="owner_status_{{ $property->id }}"
                                                    class="badge badge-success  even-larger-badge my-2"
                                                    style="font-size: 1em;">Active</span>
                                            @else
                                                <span id="owner_status_{{ $property->id }}"
                                                    class="badge badge-danger  even-larger-badge my-2"
                                                    style="font-size: 1em;">Inactive</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ URL('property-owner/properties/edit/' . $property->id) }}"><button
                                                    class="btn waves-effect waves-light btn-warning"><i
                                                        class="mdi mdi-wrench"></i> </button></a></td>
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
        var propertyID
        $(".js-switch").on('change', function() {
            if ($(this).is(':checked')) {
                switchStatus = $(this).is(':checked');
                propertyID = $(this).data('id');
            } else {
                switchStatus = $(this).is(':checked');
                propertyID = $(this).data('id');

            }
            // console.log(switchStatus, propertyID);

            $.ajax({
                url: "{{ url('property-owner/property/status/update') }}" + '/' + propertyID,
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
