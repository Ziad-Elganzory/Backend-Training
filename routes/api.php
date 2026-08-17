<?php

use App\Observers\CreateUserProfileObserver;
use App\Observers\LogUserRegistrationObserver;
use App\Observers\SendWelcomeEmailObserver;
use App\Subjects\UserRegisteredSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/user/register",function(Request $request){
    $name = $request->input("name");
    $email = $request->input("email");

    $userSubject = new UserRegisteredSubject();

    $userSubject->attach(new SendWelcomeEmailObserver());
    $userSubject->attach(new CreateUserProfileObserver());
    $userSubject->attach(new LogUserRegistrationObserver());

    $userSubject->registerUser([
        "name" => $name,
        "email" => $email
    ]);
    return response()->json([
        "message" => "User Created Successfully"
    ],200);
});