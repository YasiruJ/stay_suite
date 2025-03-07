<?php

namespace App\Http\Controllers\Server\Booking;

use App\Http\Controllers\Controller;
use App\Traits\SMSTrait;
use App\Models\Booking;
use App\Models\BookingHasSubroom;
use App\Models\GimanhalFee;
use App\Models\OtpCodes;
use App\Models\Property;
use App\Models\Room;
use App\Models\RoomHasFacility;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    use SMSTrait;

    public function index()
    {
        return view('home.booking.booking');
    }

    public function checkBookingDetails(Request $request)
    {
        $rooms = json_decode($request->input('rooms'));
        $picked_rooms = json_decode($request->input('picked_rooms'));


        $final_rate = $request->input('final_rate');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $final_rooms = [];
        $final_sub_rooms = [];
        $room_facilities = collect();
        $property = Property::where('id', $request->input('property_id'))->first();

        foreach ($picked_rooms as $key => $picked) {
            $room = Room::where('id',$picked->room_id)->first();
            $room_facilities = RoomHasFacility::where('room_id',$room->id)->get();
            // $room->room_facilities = $room_facilities;
            foreach ($room->subRooms as $key => $sub_room) {
                if($sub_room->id == $picked->subroom_id) {
                    $sub_room->room_facilities = $room_facilities;
                    $sub_room->room_count = $picked->room_count;
                    $final_sub_rooms[] = $sub_room;
                    $final_rooms[] = $room;
                }
            }
        //    dump($picked);
        }
        // dd($final_sub_rooms);
        // foreach ($rooms as $key => $room) {

        //     foreach ($picked_rooms as $key => $picked) {
        //         if($room->id == $picked->room_id) {
        //             // $final_rooms[] = $room;
        //             $room_facilities = RoomHasFacility::where('room_id',$room->id)->get();
        //             $room->room_facilities = $room_facilities;

        //             foreach ($room->sub_rooms as $key => $sub_room) {
        //                 // dump($room->sub_rooms);

        //                 if($sub_room->id == $picked->subroom_id){
        //                     $final_sub_rooms[] = $sub_room;
        //                     $room->sub_rooms = $final_sub_rooms;
        //                     $final_rooms[] = $room;
        //                 }

        //             }

        //         }
        //     }
        // }

        // dd($final_sub_rooms[0]->rooms->roomTypes->type);
        // dd($final_rooms);
        // dd($picked_rooms);
        $fee = GimanhalFee::first()->fee;
        return view('home.booking.booking',['rooms'=>$final_rooms ,'final_rate'=>$final_rate,'start_date'=>$start_date ,'end_date'=>$end_date,
        'sub_rooms'=>$final_sub_rooms,'room_facilities'=>$room_facilities,'fee'=>$fee,'picked_rooms'=> $picked_rooms,
        'property'=> $property]);
        // dump($final_sub_rooms);

        return view('home.booking.booking', ['rooms' => $final_rooms, 'final_rate' => $final_rate, 'start_date' => $start_date, 'end_date' => $end_date,
            'sub_rooms' => $final_sub_rooms, 'room_facilities' => $room_facilities, 'fee' => $fee,
            'property' => $property]);
        // dump($final_sub_rooms);
    }

    public function sendOTP(Request $request)
    {
        // dd($request->all());

        $phone = $request->input('phone');
            // sms sending part
        $otp = random_int(100000, 999999);


        $ssn_id = Session::getId();


        $otp_record = OtpCodes::where('session_id',$ssn_id)->first();

        if($otp_record) {
            $otp_record->otp = $otp;
            $otp_record->save();
        }
        else {
            $otp_record = new OtpCodes();
            $otp_record->session_id = $ssn_id;
            $otp_record->otp = $otp;
            $otp_record->save();
        }


        $message = "Gimanhal OTP is $otp";
        $this->send_sms($phone,$message);
//  dd($otp_record);
        $res['success'] = true;
        $res['id'] = $ssn_id;
        return response($res);
    }

    public function verifyOTP(Request $request)
    {
        $otp = $request->input('otp');
        $ssn_id = $request->input('ssn_id');

        $otp_record = OtpCodes::where('session_id',$ssn_id)->first();

        if($otp_record->otp == $otp) {
            $res['success'] = true;
            $res['message'] = 'Phone no verified';
            return response($res);
        }
        else {
            $res['success'] = false;
            $res['message'] = 'Otp is not correct';
            return response($res);
        }
        // dd($ssn_id);
    }

    public function submitBookingDetails(Request $request)
    {
        $property_id = $request->input('property_id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $city = $request->input('city');
        $zip_code = $request->input('zip_code');
        $special_request = $request->input('special_request');
        $arrival_time = $request->input('arrival_time');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $paymentType = $request->input('paymentType');
        $encode_picked_rooms = $request->input('picked_rooms');
        $picked_rooms = json_decode($encode_picked_rooms);
        $encode_rooms = $request->input('rooms');
        $rooms = json_decode($encode_rooms);
        $property_owner_fee = $request->input('property_owner_fee');
        $gimanhal_fee = $request->input('gimanhal_fee');
        $total = $request->input('total');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        // dd($paymentType);
        $property = Property::where('id',$property_id)->first();

        $user_check = User::where('email', $email)->first();
        $user_type = '';

        if ($user_check) {
            $user_id = $user_check->id;
            $user_type = 'user';
        } else {
            $user_id = Session::getId();
            $user_type = 'guest';
        }
        if($paymentType == 'pay_at_location') {

            $last_booking = Booking::latest()->first();
            if($last_booking) {
                $last_booking_id = $last_booking->id;
            }
            else {
                $last_booking_id = 0;
            }
            $generate_id = $last_booking_id + 1;

            $year = date("Y");
            $booking_generated_id = "giman-$generate_id-$year";
            // dd($picked_rooms);
            // $booking = new Booking();
            // $booking->booking_id = $booking_generated_id;
            // $booking->property_id = $property_id;
            // $booking->check_in_date = new DateTime($start_date);
            // $booking->check_out_date = new DateTime($end_date);
            // $booking->user_id = $user_id;
            // $booking->user_type = $user_type;
            // $booking->special_request = $special_request;
            // $booking->arrival_time = $arrival_time;
            // $booking->first_name = $first_name;
            // $booking->last_name = $last_name;
            // $booking->address = $address;
            // $booking->city = $city;
            // $booking->zip_code = $zip_code;
            // $booking->phone = $phone;
            // $booking->email = $email;
            // $booking->property_owner_fee = $property_owner_fee;
            // $booking->gimanhal_fee = $gimanhal_fee;
            // $booking->total = $total;
            // $booking->payment_type = $paymentType;
            // $booking->status_id = 2;

            // $booking->save();
            // $booking_id = $booking->id;
            // foreach($picked_rooms as $room) {

            //     $index = $room->room_count;

            //     for($i=0;$i<$index;$i++) {
            //         $booking_has_room = new BookingHasSubroom();
            //         $booking_has_room->booking_id = $booking_id;
            //         $booking_has_room->room_id = $room->room_id;
            //         $booking_has_room->subroom_id = $room->subroom_id;
            //         $booking_has_room->save();
            //     }


            // }

            // sms sending part
            $message = 'Your Booking has confirmed';
            $this->send_sms($phone,$message);
                dd("test");
            //email sending  part
                // $name = $property->name;
                // $check_in = $start_date;
                // $check_out = $end_date;
                // $phone = $property->user->phone;
                // $to_name = $first_name;


                // $data = [
                //     'name' => $name,
                //     'check_in' => $check_in,
                //     'check_out' => $check_out,
                //     'phone' => $phone,
                //     'total' => $total,
                //     'customer_name' => $to_name,
                // ];

                // try {
                //     $smtp_mail_from_name = env('MAIL_FROM_NAME');
                //     $smtp_mail_from_id = env('MAIL_FROM_ADDRESS');
                //     $to_email = $email;


                //     Mail::send('emails.contact_send', $data, function ($message) use ($to_name, $to_email, $smtp_mail_from_id, $smtp_mail_from_name) {
                //         $message->to($to_email, $to_name)
                //             ->subject('Gimanhal Booking Confirmed')
                //             ->from($smtp_mail_from_id, $smtp_mail_from_name);
                //     });
                // } catch (\Throwable $th) {
                //     Log::error($th);
                //     dd($th);
                // }


                return redirect("/booking/booking_confirm/$booking_generated_id");
                // return view('home.booking.booking_confirm',['final_rate'=>$total,'start_date'=>$start_date ,'end_date'=>$end_date,
                // 'property'=> $property]);

        }

        if ($paymentType == 'online') {
            // dd("test");

            $last_booking = Booking::latest()->first();

            if($last_booking) {
                $last_booking_id = $last_booking->id;
            }
            else {
                $last_booking_id = 0;
            }

            $generate_id = $last_booking_id + 1;

            $year = date("Y");
            $booking_generated_id = "giman-$generate_id-$year";

            $booking = new Booking();
            $booking->booking_id = $booking_generated_id;
            $booking->property_id = $property_id;
            $booking->booking_id = $property_id;
            $booking->check_in_date = new DateTime($start_date);
            $booking->check_out_date = new DateTime($end_date);
            $booking->user_id = $user_id;
            $booking->user_type = $user_type;
            $booking->special_request = $special_request;
            $booking->arrival_time = $arrival_time;
            $booking->first_name = $first_name;
            $booking->last_name = $last_name;
            $booking->address = $address;
            $booking->city = $city;
            $booking->zip_code = $zip_code;
            $booking->phone = $phone;
            $booking->email = $email;
            $booking->property_owner_fee = $property_owner_fee;
            $booking->gimanhal_fee = $gimanhal_fee;
            $booking->total = $total;
            $booking->payment_type = $paymentType;
            $booking->status_id = 1;

            $booking->save();

            $booking_id = $booking->id;
            foreach($rooms as $room) {
                foreach ($room->sub_rooms as $key => $sub_room) {
                    $booking_has_room = new BookingHasSubroom();
                    $booking_has_room->booking_id = $booking_id;
                    $booking_has_room->room_id = $sub_room->room_id;
                    $booking_has_room->subroom_id = $sub_room->id;
                    $booking_has_room->save();
                }
            }

            $booking_generated_id = "giman-$booking_id-2023";
            $app_id = '9WG9118C088F0C6A3C7B8';
            $hash_salt = 'F1HS118C088F0C6A3C7E2';
            $app_token = 'dcff433270e160360fd6cfc0415256db05a7078b4fe0894dd8501c226a2f46aa5ff92a78c6f1665c.EELD118C088F0C6A3C7F8';

            $onepay_args = [

                "amount" => floatval($total),
                "app_id"=> $app_id,
                "reference" => "{$booking_generated_id}",
                "customer_first_name" => $first_name,
                "customer_last_name"=> $last_name,
                "customer_phone_number" => $phone,
                "customer_email" => $email,
                "transaction_redirect_url" => "https://gimanhal.com/booking/booking_confirm/$booking_id",

            ];

            $data = json_encode($onepay_args, JSON_UNESCAPED_SLASHES);

            $data_json = $data . '' . $hash_salt;

            $hash_result = hash('sha256', $data_json);

            $curl = curl_init();

            $url = 'https://merchant-api-live-v2.onepay.lk/api/ipg/gateway/request-transaction/?hash=';
            $url .= $hash_result;

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => [
                    'Authorization:' . '' . $app_token,
                    'Content-Type:application/json',
                ],
            ]);

            $response = curl_exec($curl);

            curl_close($curl);

            $result = json_decode($response, true);

            //   dd($result['data']['gateway']['redirect_url']);
            Log::error('onepay result :', [$result]);
            if ($result['status'] == 1000) {
                $booking = Booking::where('id',$booking_id)->first();
                $booking->transaction_id = $result['data']['ipg_transaction_id'];
                $booking->save();
                $url = $result['data']['gateway']['redirect_url'];

                return Redirect::to($url);
            }
        }


    }

    public function confirmBooking($booking_id)
    {

        // dd($booking_id);
        $booking = Booking::where('id',$booking_id)->first();

        if($booking->payment_type == 'online') {

            if($booking->status == 6) {
                $total = $booking->total;
                $start_date = $booking->check_in_date;
                $end_date = $booking->check_out_date;
                $property = $booking->property;
                return view('home.booking.booking_confirm',['final_rate'=>$total,'start_date'=>$start_date ,'end_date'=>$end_date,

                'property'=> $property]);
            }
            else {
                return view('home.booking.booking_fail');
            }

        }
        else {
            return redirect('/');
        }

    }
    public function checkTransaction(Request $request)
    {
        // dd($request->all());

        // $data = [];
        // $all_data = $request->all();
        $transaction_id = $request->input('transaction_id');;
        $booking = Booking::where('transaction_id',$transaction_id)->first();
        $booking->status_id = 6;
        $booking->save();
        Log::error('onepay payment data :' , [$request->all()]);

    }
}
