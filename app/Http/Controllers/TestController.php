<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function register(Request $request) {
        return response()->json([
            "status" => "sukses",
            "data" => [
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password
            ]
        ]);
    }
}
