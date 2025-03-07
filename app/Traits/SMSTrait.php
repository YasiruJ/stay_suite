<?php

namespace App\Traits;

use App\Models\HospitalDoctor;
use App\Models\User;
use Illuminate\Support\Facades\Log;

trait SMSTrait
{
    public function send_sms(int $phone, string $message)
    {

        $user_phone = $phone;
        $user_phone = preg_replace('/\s+/', '', $user_phone);
        $user_phone = preg_replace('/^0/', '', $user_phone);
        $user_phone = str_replace('+', '', "94$user_phone");

        if ($user_phone != null && $user_phone != '') {
            try {
                $url = 'https://app.notify.lk/api/v1/send';
                $data = [
                    'user_id' => config('sms.notify_lk_user_id'),
                    'api_key' => config('sms.notify_lk_api_key'),
                    'sender_id' => config('sms.notify_lk_sender_id'),
                    'to' => $user_phone,
                    'message' => $message,
                    'type' => 'unicode',
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);

                return $response;
            } catch (\Exception $e) {
                Log::error('SMS Error', [$e]);
            }
        }
    }

}
