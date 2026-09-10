<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GreetingController extends Controller
{
    public function greet(Request $request)
    {
        $name = $request->query('first_name','Guest');
        return response()->json([
            "data" => [
                "greeting" => "Hello, {$name}",
                "version" => "v2" 
            ],
        ]);
    }
}
