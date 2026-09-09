<?php

namespace App\Http\Controllers;

use App\Services\GreetingService;
use Illuminate\Http\Request;
use InvalidArgumentException;

class GreetingController extends Controller
{
    public function __construct(private GreetingService $greeting){}
    public function greeting(Request $request)
    {
        $name = $request->query('name');
        try {
            if($name === null || $name === ""){
                throw new InvalidArgumentException('Name Required!');
            }
            $result =$this->greeting->welcomeUser($name);
            return response()->json($result);
        } catch(InvalidArgumentException $e){
            return response()->json(["error"=>$e->getMessage()],422);
        }
    }
}
