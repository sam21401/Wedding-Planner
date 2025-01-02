<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**

    Display a listing of the resource.*/

    public function redirect($provider)
    {
        try {
            return Socialite::driver($provider)->stateless()->redirect();
        } catch (\Exception $e) {
            Log::error('Social login redirect error: ' . $e->getMessage());
            return response()->json(['error' => 'Error during the redirect'], 500);
        }
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            $user = User::updateOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'provider_id' => $socialUser->getId(),
                    'provider' => $provider,
                    'password' => bcrypt(Str::password('16')),
                ]
            );

            return response()->json([
                'message' => 'User successfully authenticated via ' . $provider,
                'user' => $user,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Social login callback error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        //
    }


}
