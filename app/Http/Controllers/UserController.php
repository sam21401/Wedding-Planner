<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUserId(Request $request)
    {
        return response()->json(['id' => $request->user()->id]);
    }
}

