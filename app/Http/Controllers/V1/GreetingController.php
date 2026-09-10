<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GreetingResource;
use Illuminate\Http\Request;

class GreetingController extends Controller
{
    public function greet(Request $request)
    {
        $name = $request->query('name','Guest');
        return response()->json(["message"=> "Hello, {$name}"]);
    }
}
