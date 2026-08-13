<?php

namespace App\Http\Controllers;

use App\Services\NotificationSettingsManager;
use Illuminate\Http\Request;

class NotificationSettingsController extends Controller
{
    public function __construct(private NotificationSettingsManager $notificationSettingsManager){}
    public function getSettings()
    {
        $settings = $this->notificationSettingsManager->all();
        return response()->json([
            'message' => 'Notification settings retrieved successfully',
            'data' => $settings
        ]);

    }

    public function updateSettings(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        $this->notificationSettingsManager->set($key, $value);
        return response()->json([
            'message' => 'Notification settings updated successfully',
            'data' => $this->notificationSettingsManager->all()
        ]);
    }
}
