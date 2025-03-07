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
                <div class="col-md-12">
                    <form id="roomEditForm">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Update property <span
                                    style="font-size: 1.2rem;color: #157DEC;">{{ $properties->name }}</span> Room
                                Informations</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Room Title</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter Title"
                                            name="room_title" value="{{ $rooms->title }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Room Type</label>
                                        <select id="inputState" class="form-control" name="room_type_id">
                                            @foreach ($room_types as $room_type)
                                                @if ($room_type->id == $rooms->type_id)
                                                    <option value="{{ $room_type->id }}" selected>{{ $room_type->type }}
                                                    </option>
                                                @else
                                                    <option value="{{ $room_type->id }}">{{ $room_type->type }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Room Size</label>
                                    <select class="form-control" id="inlineFormCustomSelect" name="room_size">
                                        <option value="{{ $rooms->room_size }}" selected>{{ $rooms->room_size }}</option>
                                        <option value="Sm">Sm</option>
                                        <option value="Md">Md</option>
                                        <option value="Lg">Lg</option>
                                        <option value="Xl">Xl</option>
                                        <option value="Xmd">Xmd</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <div>
                                    <textarea class="form-control" rows="4" name="description">{{ $rooms->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form row">
                            <div class="col-md-12 form-group">
                                <label>Room Sub Images</label>
                                <input type="file" class="dropify1" data-height="131" name="sub_images[]" multiple>
                            </div>
                        </div>
                        <div class="card-box">
                            <h4 class="header-title mb-4"> Room Facilities</h4>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-md-12">
                                    <select name="property_facility_id[]" class="form-control" id="select_facility"
                                        multiple>
                                        @foreach ($facility as $facility)
                                            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="d-flex flex-wrap my-3" id="sub_facilities">
                                        <div class="custom-control custom-checkbox my-2 mx-3">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- end row -->
            <div class="section">
                <div class="row">
                    <div class="col-md-6 col-md-6  border-right border-dark">
                        <div class="bg-lite clearfix my-3">
                            <h4 class="header-title badge badge-success waves-effect waves-light float-left pt-2 ml-2">
                                Rooms Units</h4>
                            <button type="button"
                                class="btn btn-success waves-effect waves-light width-lg float-right mr-3" id="unit_add"
                                data-toggle="modal" data-target="#unitAddModel">
                                Add Unit
                            </button>
                        </div>
                        <div class="d-flex flex-column">
                            @foreach ($units as $unit)
                                <div class="card">
                                    <div class="card-body">
                                        <a
                                            href="{{ url('/admin/properties/edit/' . $properties->id . '/room/edit/' . $rooms->id . '/unit/delete/' . $unit->id) }}">
                                            <button class="btn waves-effect waves-light btn-danger float-right align-top">
                                                <i class="mdi mdi-close"></i></button>
                                        </a>
                                        <h5 class="card-title">Unit Type <span
                                                style="color: red;">{{ $unit->type }}</span></h5>
                                        <p class="card-text">xxxx</p>
                                        <h5 class="float-right align-top">xxxx</h5>
                                        <button id="{{ $unit->id }}" data-name="{{ $unit->type }}"
                                            class="unit_edit  btn btn-warning waves-effect waves-light width-lg"
                                            data-toggle="modal" data-target="#unitEditModal">Edit</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 col-md-6">
                        <div class="bg-lite clearfix my-3">
                            <h4 class="header-title badge badge-success waves-effect waves-light float-left pt-2 ml-2">Sub
                                Rooms Information</h4>
                            <button type="button"
                                class="btn btn-success waves-effect waves-light width-lg float-right mr-3"
                                data-toggle="modal" data-target="#addNewSubRoom">
                                Add Sub Room
                            </button>
                        </div>
                        <div class="d-flex flex-column">
                            @foreach ($sub_rooms as $sub_room)
                                <div class="card">
                                    <div class="card-body">
                                        <a
                                            href="{{ url('/admin/properties/edit/' . $properties->id . '/room/edit/' . $rooms->id . '/sub_room/delete/' . $sub_room->id) }}">
                                            <button class="btn waves-effect waves-light btn-danger float-right align-top">
                                                <i class="mdi mdi-close"></i></button>
                                        </a>
                                        <h5 class="card-title">Room Type <span
                                                style="color: red;">{{ $sub_room->rooms->title }}</span></h5>
                                        <p class="card-text">{{ $sub_room->rooms->description }}</p>
                                        <h5 class="float-right align-top">Rs: {{ $sub_room->rate }}</h5>
                                        <button id="{{ $sub_room->id }}" data-rate="{{ $sub_room->rate }}"
                                            data-sleep_type_id="{{ $sub_room->sleep_type_id }}"
                                            class="sub_room_edit  btn btn-warning waves-effect waves-light width-lg"
                                            data-toggle="modal" data-target="#subRoomEditModal">Edit</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->
    </div>
    <!-- end row -->
    </div> <!-- end container-fluid -->
    </div> <!-- end content -->

    <div class="modal fade" id="addNewSubRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New sub room add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="subRoomAddForm">
                        <div class="form-row">
                            <div class="form-col-md-12 col-md-12">
                                <div class="row">
                                    <div class="form-col-md-6 col-md-6">
                                        <label for="">Select Sleep Type</label>
                                        <select class="form-control mb-2" id="inlineFormCustomSelect"
                                            name="sleep_type_id">
                                            @foreach ($sleep_types as $sleep_type)
                                                <option value="{{ $sleep_type->id }}">{{ $sleep_type->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-col-md-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">Room Rate</label>
                                            <input type="text" class="form-control" id=""
                                                placeholder="Enter Room rate" name="rate">
                                        </div>
                                    </div>
                                </div>
                                <label for="">Select Meal Types</label>
                                @foreach ($meal_types as $meal_type)
                                    <div class="custom-control custom-checkbox">
                                        <input class="form-check-input" name="meal_type_ids[]" type="checkbox"
                                            value="{{ $meal_type->id }}" id="{{ $meal_type->id }}">
                                        <label class="form-check-label" for="{{ $meal_type->id }}">
                                            {{ $meal_type->type }}
                                        </label>
                                    </div>
                                @endforeach
                                <label for="" class="mt-2">Select Reservation Policies</label>
                                @foreach ($resvation_policies as $resvation_policy)
                                    <div class="custom-control custom-checkbox">
                                        <input class="form-check-input" name="resvation_policy_ids[]" type="checkbox"
                                            value="{{ $resvation_policy->id }}" id="{{ $resvation_policy->id }}">
                                        <label class="form-check-label" for="{{ $resvation_policy->id }}">
                                            {{ $resvation_policy->type }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="subRoomEditModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="subRoomEditForm">
                        <div class="form-row">
                            <input type="text" id="sub_room_id" name="sub_room_id" hidden disabled>
                            <div class="form-col-md-12 col-md-12">
                                <div class="row">
                                    <div class="form-col-md-6 col-md-6">
                                        <label for="">Select Sleep Type</label>
                                        <select class="form-control mb-2" id="my_select" name="sleep_type_id">
                                            @foreach ($sleep_types as $sleep_type)
                                                <option value="{{ $sleep_type->id }}">{{ $sleep_type->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-col-md-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">Room Rate</label>
                                            <input type="text" class="form-control" id="sub_room_edit_rate"
                                                placeholder="Enter Room rate" name="rate">
                                        </div>
                                    </div>
                                </div>
                                <label for="">Select Meal Types</label>
                                <div id="meal_type_edit"></div>
                                <label for="" class="mt-2">Select Reservation Policies</label>
                                <div id="reservation_type_edit"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unitAddModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="unitAddForm">
                        <div class="form-row">
                            <div class="form-col-md-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Unit Name</label>
                                    <input type="text" class="form-control" id="unit_name"
                                        placeholder="Enter Unit Name" name="unit_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @foreach ($bed_types as $bed_type)
                                    <div class="main-unit-bed-type">
                                        <div class="unit-bed-type custom-control custom-checkbox">
                                            <input class="form-check-input" name="bed_type_ids" type="checkbox"
                                                value="{{ $bed_type->id }}" id="{{ $bed_type->id }}">
                                            <label class="form-check-label" for="{{ $bed_type->id }}">
                                                {{ $bed_type->type }}
                                            </label>
                                        </div>
                                        <div class="ch_for" style="display: none;">
                                            <input type="number" name="bed_count" min="1" value="1">
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unitEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="unitUpdateForm">
                        <div class="form-row">
                            <div class="form-col-md-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Unit Name</label>
                                    <input type="hidden" id="edit_unit_id">
                                    <input type="text" class="form-control" id="edit_unit_name"
                                        placeholder="Enter Unit Name" name="edit_unit_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="main-unit-edit-bed-type" id="main-unit-edit-bed-type">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#roomEditForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ url('admin/properties/edit/' . $properties->id . '/room/edit/' . $rooms->id . '/update') }}",
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

        $('#subRoomAddForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ url()->current() . '/sub_room/save' }}",
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

        $('#subRoomEditForm').on('submit', function(event) {
            event.preventDefault();
            var sub_room_id = $('#sub_room_id').val();
            $.ajax({
                url: "{{ url()->current() . '/sub_room/update' }}" + '/' + sub_room_id,
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

        $('#unitAddForm').on('submit', function(event) {
            event.preventDefault();
            let unit_name = $('#unit_name').val();
            let bed_type_ids = [];
            let count_array = [];

            $('input:checkbox[name="bed_type_ids"]:checked').each(function() {
                bed_type_ids.push($(this).val());
            });
            $('input[name="bed_count"]').each(function() {
                count_array.push($(this).val());
            });

            var filtered_count_array = count_array.filter(e => e != "");

            var obj = new Object();
            obj.unit_name = unit_name;
            obj.bed_type_ids = bed_type_ids;
            obj.filtered_count_array = filtered_count_array;
            console.log(obj);
            $.ajax({
                url: "{{ url()->current() . '/unit/save' }}",
                method: "POST",
                data: obj,
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

        $('#unitUpdateForm').on('submit', function(event) {
            event.preventDefault();
            let unit_name = $('#edit_unit_name').val();
            let = unit_id = $('#edit_unit_id').val();
            let bed_type_ids = [];
            let count_array = [];

            $('input:checkbox[name="bed_type_edit_ids"]:checked').each(function() {
                bed_type_ids.push($(this).val());
            });
            $('input[name="bed_edit_count"]').each(function() {
                count_array.push($(this).val());
            });

            var filtered_count_array = count_array.filter(e => e != "");

            console.log(bed_type_ids);
            console.log(filtered_count_array);


            var obj = new Object();
            obj.unit_name = unit_name;
            obj.bed_type_ids = bed_type_ids;
            obj.filtered_count_array = filtered_count_array;
            console.log(obj);
            $.ajax({
                url: "{{ url()->current() . '/unit/update' }}" + '/' + unit_id,
                method: "POST",
                data: obj,
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
                }
            });
        });
    </script>

    <script>
        $('.sub_room_edit').on('click', function() {

            // console.log("ok");
            var subroom_id = $(this).attr('id');
            var sub_room_rate = $(this).data('rate');
            var sleep_type_id = $(this).data('sleep_type_id');
            $("#my_select").val(sleep_type_id).change();

            $('#sub_room_edit_rate').val(sub_room_rate);
            $('#sub_room_id').val(subroom_id);
            console.log(sleep_type_id);
            $.ajax({
                url: "{{ url('admin/properties/edit/' . $properties->id . '/room/edit/' . $rooms->id . '/sub_room/collect_info') }}",
                method: "POST",
                data: "subroom_id=" + subroom_id,
                dataType: 'JSON',
                success: function(data) {
                    var meal_types = data.meal_types;
                    var resvation_policies = data.resvation_policies;
                    var sub_room_meals_types_ids = data.sub_room_meals_types_ids;
                    var sub_room_reservation_policy_type_ids = data
                    .sub_room_reservation_policy_type_ids;
                    $("#meal_type_edit").empty();
                    for (var i = 0; i < meal_types.length; i++) {
                        const isInArray = sub_room_meals_types_ids.includes(meal_types[i].id);
                        if (isInArray) {
                            $("#meal_type_edit").append('<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="form-check-input" name="meal_type_ids[]"  value="' +
                                meal_types[i].id + '" id="' + meal_types[i].id + '"checked>' +
                                '<label class="form-check-label"  for="' + meal_types[i].id + '">' +
                                meal_types[i].type + '</label>')
                        } else {
                            $("#meal_type_edit").append('<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="form-check-input" name="meal_type_ids[]"  value="' +
                                meal_types[i].id + '" id="' + meal_types[i].id + '">' +
                                '<label class="form-check-label"  for="' + meal_types[i].id + '">' +
                                meal_types[i].type + '</label>')
                        }
                    }

                    $("#reservation_type_edit").empty();
                    resvation_policies.forEach((element, index) => {
                        if (sub_room_reservation_policy_type_ids.includes(element.id)) {
                            $("#reservation_type_edit").append(
                                '<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="form-check-input" name="resvation_policy_ids[]"  value="' +
                                element.id + '" id="' + element.id + '"checked>' +
                                '<label class="form-check-label"  for="' + element.id +
                                '">' + element.type + '</label>')
                        } else {
                            $("#reservation_type_edit").append(
                                '<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="form-check-input" name="resvation_policy_ids[]"  value="' +
                                element.id + '" id="' + element.id + '">' +
                                '<label class="form-check-label"  for="' + element.id +
                                '">' + element.type + '</label>')
                        }
                    });

                }
            });
        });

        $('.unit_edit').on('click', function() {

            // console.log("ok");
            var unit_name = $(this).data('name');
            var unit_id = $(this).attr('id');
            $('#edit_unit_name').val(unit_name);
            $('#edit_unit_id').val(unit_id);

            $.ajax({
                url: "{{ url('admin/properties/edit/' . $properties->id . '/room/edit/' . $rooms->id . '/unit/collect_info') }}" +
                    '/' + unit_id,
                method: "GET",
                success: function(data) {
                    let unit_bed_type = data.unit_bed_type;
                    let bed_types_ids = data.bed_types;
                    var unit_bed_type_ids = new Array()
                    for (let i = 0; i < unit_bed_type.length; i++) {
                        unit_bed_type_ids.push(unit_bed_type[i].bed_type_id)

                    }
                    let j = 0;
                    $('#main-unit-edit-bed-type').empty();
                    for (var i = 0; i < bed_types_ids.length; i++) {
                        const isInArray = unit_bed_type_ids.includes(bed_types_ids[i].id);
                        if (isInArray) {
                            // console.log(unit_bed_type[i].bed_count+"check");
                            $('#main-unit-edit-bed-type').append(
                                '<div class="unit-edit-bed-type custom-control custom-checkbox">' +
                                '<input class="form-check-input" name="bed_type_edit_ids"  type="checkbox" onclick="showInputType(' +
                                bed_types_ids[i].id + ')" value="' + bed_types_ids[i].id +
                                '" id="' + bed_types_ids[i].id + '" checked>' +
                                '<label class="form-check-label" > ' + bed_types_ids[i].type +
                                ' </label>' +
                                '</div>' +
                                '<div class="ch_edit_for">' +
                                '<input type="number" id="input-' + bed_types_ids[i].id +
                                '" name="bed_edit_count" value="' + unit_bed_type[j].bed_count +
                                '" min="1">' +
                                '</div>'
                            )
                            j++;
                        } else {
                            $('#main-unit-edit-bed-type').append(
                                '<div class="unit-edit-bed-type custom-control custom-checkbox">' +
                                '<input class="form-check-input" name="bed_type_edit_ids"  type="checkbox" onclick="showInputType(' +
                                bed_types_ids[i].id + ')" value="' + bed_types_ids[i].id +
                                '" id="' + bed_types_ids[i].id + '" >' +
                                '<label class="form-check-label" > ' + bed_types_ids[i].type +
                                ' </label>' +
                                '</div>' +
                                '<div class="ch_edit_for">' +
                                '<input type="number" id="input-' + bed_types_ids[i].id +
                                '" name="bed_edit_count" style="display: none;" min="1">' +
                                '</div>'
                            )
                        }

                    }
                }
            });
        });
    </script>

    <script>
        $('.unit-bed-type input:checkbox').click(function() {
            $(this).closest('.main-unit-bed-type').find('.ch_for').toggle()
        });

        function showInputType(id) {
            let str = 'input-' + id;
            //console.log(str);
            var x = document.getElementById(str);
            console.log(x);
            if (x.style.display === "none") {
                x.style.display = "block";
                x.value = 1;

            } else {
                x.style.display = "none";
                x.value = "";
            }

        }
    </script>



    <script src="{{ URL('dashboard_assets/libs/dropify/dropify.min.js') }}"></script>
    <!-- Init js-->
    <script src="{{ URL('dashboard_assets/js/pages/form-fileuploads.init.js') }}"></script>
@endsection
