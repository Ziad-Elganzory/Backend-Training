<?php

namespace App\Http\Controllers;

use App\Helpers\AppSettings;
use Illuminate\Http\Request;

class SingletonController extends Controller
{
    public function settings(){
        $settings1 = AppSettings::getInstance();
        $settings1->set('currency', 'EGP');

        $settings2 = AppSettings::getInstance();
        return response()->json([
            "message" => $settings1 === $settings2 ? "Same instance" : "Different instances",
            "settings1" => $settings1->get('currency'),
            "settings2" => $settings2->get('currency'),
        ]);
    }
}
