<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
   public function register(Request $request) {
    $fields = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
    ]);

    $user = User::create($fields);

    $token = $user->createToken($request->name);

    return [
        'user' => $user,
        'token' => $token->plainTextToken
    ];

   }

   public function login(Request $request) {
    $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)){
        return [
            'message' => 'The provided credentials are incorrect.'
        ];
    }
    $token = $user->createToken($user->name);
    return [
        'user' => $user,
        'token' => $token->plainTextToken
    ];
   }

   public function logout(Request $request) {
    $request->user()->token()->delete();
    return [
        'message' => 'You are logged out.'
    ];
   }

   public function user(Request $request)
    {
        return $request->user(); 
    }
    public function changeEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $user->email = $request->input('email');
        $user->save();

        return response()->json(['message' => 'Email updated successfully'], 200);
    }
}
