<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("hello", function () {
    return response()->json(["message" => "Halo Dunia"]);
});

Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);

