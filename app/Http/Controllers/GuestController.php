<?php

namespace App\Http\Controllers;

use App\Enums\GuestStatus;
use App\Http\Requests\GuestRequest;
use App\Mail\GuestEmail;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->getAuthIdentifier();

        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $guests = Guest::with('user')
        ->where('user_id', $userId)
        ->paginate(25);

        return response()->json($guests);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(GuestRequest $guestRequest)
    {
        $userId = auth()->user()->getAuthIdentifier();
        $validatedData = array_merge($guestRequest->validated(), ['user_id' => $userId]);
        $guest = Guest::create($validatedData);
        $token = Str::random(16);
        $guest->update(['token' => $token]);

        //Url from email messages
        $acceptUrl = route('guest.accept', ['guest' => $guest->id]) . '?token=' . $token;
        $declineUrl = route('guest.decline', ['guest' => $guest->id]) . '?token=' . $token;


        if ($guest) {
            $email = $guest->email;
            $mailed = Mail::to($email)->send(new GuestEmail($acceptUrl, $declineUrl));
            if ($mailed) {
                $guest->status = GuestStatus::PENDING;
                $guest->save();
            }
        }

        return response()->json($guest, 201);
    }

    public function accept(Guest $guest, Request $request)
    {
        $tokenFromUrl = $request->query('token');
        if ($guest->token !== $tokenFromUrl) {
            return response()->json(['error' => 'Invalid token'], 400);
        }
        $guest->status = GuestStatus::APPROVED;
        $guest->save();
        return response()->json(['message' => 'invited accepted'], 200);
    }

    public function decline(Guest $guest, Request $request)
    {
        $tokenFromUrl = $request->query('token');
        if ($guest->token !== $tokenFromUrl) {
            return response()->json(['error' => 'Invalid token'], 400);
        }
        $guest->status = GuestStatus::DECLINED;
        $guest->save();
        return response()->json(['message' => 'invited declined'], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return response()->json($guest, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuestRequest $guestRequest, Guest $guest)
    {
        $guest->update($guestRequest->validated());
        return response()->json(['message' => 'Guest updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json(['message' => 'Guest deleted successfully'], 200);
    }

    public function generateCsv(){
        $userId = auth()->user()->getAuthIdentifier();
        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $guests = Guest::where('user_id', $userId)->get();
        $csv = "Name, Email, Status\n";
        foreach($guests as $guest){
            $csv .= $guest->name . ',' . $guest->email . ',' . $guest->status . "\n";

        }
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="guests.csv"');

    }

    public function getResponsePercentage()
    {
        $userId = auth()->user()->getAuthIdentifier();
        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $totalGuests = Guest::where('user_id', $userId)->count();
        if ($totalGuests === 0) {
            return response()->json(['message' => 'No guests found', 'percentage' => 0], 200);
        }

        $respondedGuests = Guest::where('user_id', $userId)
            ->where('status', '!=', GuestStatus::PENDING)
            ->count();

        $percentage = round(($respondedGuests / $totalGuests) * 100, 2);

        return response()->json(['percentage' => $percentage], 200);
    }

}
