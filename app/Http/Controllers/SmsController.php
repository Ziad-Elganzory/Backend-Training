<?php

namespace App\Http\Controllers;

use App\Factories\SmsSenderFactory;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function send(Request $request)
    {
        if($request->string('to')->toString() === '' || $request->string('message')->toString() === ''){
            return response()->json([
                "error" => "please provide to and message"
            ],400);
        }
        $sms = SmsSenderFactory::make();

        $messageId = $sms->send(
            $request->string('to')->toString(),
            $request->string('message')->toString(),
        );

        return response()->json([
            'message_id'=> $messageId,
            'status' => 'sent'
        ]);
    }
}
