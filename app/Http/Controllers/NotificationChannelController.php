<?php

namespace App\Http\Controllers;

use App\Factories\NotificationChannelFactory;
use Illuminate\Http\Request;

class NotificationChannelController extends Controller
{
    public function __construct(private NotificationChannelFactory $factory){}
    public function send(Request $request, string $channel)
    {
        $to = $request->input('to');
        $message = $request->input('message');
        $notificationChannel = $this->factory->make($channel);
        $result = $notificationChannel->send($to, $message);
        return response()->json($result);
    }
}
