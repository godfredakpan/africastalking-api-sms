<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AfricasTalking\SDK\AfricasTalking;



class SMSController extends Controller
{

    public function SendSms(Request $request)
    {

            // Set your app credentials
            $username   = env('AFRICASTALKING_USERNAME');
            $apiKey     = env('AFRICASTALKING_KEY');

            // Initialize the SDK
            $AT         = new AfricasTalking($username, $apiKey);

            // Get the SMS service
            $sms        = $AT->sms();

            // Set the numbers you want to send to in international format
            $recipients = $request->phone;

            // Set your message
            $message    = $request->message;

            // Set your shortCode or senderId
            $from       = "Company";

            try {
                // Thats it, hit send and we'll take care of the rest
                $result = $sms->send([
                    'to'      => $recipients,
                    'message' => $message,
                    'from'    => $from
                ]);

                    return $result;
            } catch (Exception $e) {
                echo "Error: ".$e->getMessage();
            }

    }



}
