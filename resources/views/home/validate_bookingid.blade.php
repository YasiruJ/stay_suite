<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>

<body>
    <div class="text-center">
        <h2>Enter Your Booking Details</h2>
        <form action="{{ url('/properties/details/'.$properties->id.'/add_review') }}" method="get">
            @if (session()->has('error_message'))
            <div class="alert-success" style="height: 35px;padding-top: 6px;">
                {{ session()->get('error_message') }}
            </div>
            @endif
            <div class="mb-3">
                <div class="col-xs-4">
                    <input type="text" class="form-control" id="bookingNumber" name="bookingNumber" aria-describedby="Booking" placeholder="Enter Booking Number">
                </div>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="pinNumber" name="pinNumber" placeholder="Enter Pin Number">
            </div>
            <input type="submit" class="btn btn-primary" value="submit">
        </form>
    </div>
</body>

</html>
