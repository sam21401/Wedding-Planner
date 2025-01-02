<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return Guest::all();
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'wedding_id' => 'required|exists:weddings,id',
            'name' => 'required|max:255',
            'email' => 'nullable|email',
            'status' => 'in:waiting,confirmed,declined',
        ]);

        $fields['status_updated_at'] = now(); // Set the status update timestamp
        $guest = Guest::create($fields);

        return response()->json($guest, 201);
    }

    public function show(Guest $guest)
    {
        return $guest;
    }

    public function update(Request $request, Guest $guest)
    {
        $fields = $request->validate([
            'name' => 'sometimes|required|max:255',
            'email' => 'nullable|email',
            'status' => 'in:waiting,confirmed,declined',
        ]);

        if (isset($fields['status'])) {
            $fields['status_updated_at'] = now();
        }

        $guest->update($fields);

        return $guest;
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json(['message' => 'Guest deleted']);
    }
}
