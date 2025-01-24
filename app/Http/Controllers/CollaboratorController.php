<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of collaborators.
     */
    public function index()
    {
        return response()->json(Collaborator::all());
    }

    /**
     * Store a newly created collaborator.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $collaborator = Collaborator::create($request->only('user_id'));

        return response()->json($collaborator, 201);
    }

    /**
     * Display the specified collaborator.
     */
    public function show(Collaborator $collaborator)
    {
        return response()->json($collaborator);
    }

    /**
     * Update the specified collaborator.
     */
    public function update(Request $request, Collaborator $collaborator)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $collaborator->update($request->only('user_id'));

        return response()->json($collaborator);
    }

    /**
     * Remove the specified collaborator from storage.
     */
    public function destroy(Collaborator $collaborator)
    {
        $collaborator->delete();
        return response()->json(['message' => 'Collaborator removed successfully.']);
    }
}
