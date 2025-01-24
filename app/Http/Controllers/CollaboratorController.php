<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(title="Collaborators API", version="1.0")
 * @OA\Tag(name="Collaborators", description="API for managing collaborators")
 */
class CollaboratorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/collaborators",
     *     summary="Display a listing of collaborators",
     *     tags={"Collaborators"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all collaborators",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Collaborator"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Collaborator::all());
    }

    /**
     * @OA\Post(
     *     path="/api/collaborators",
     *     summary="Store a newly created collaborator",
     *     tags={"Collaborators"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"user_id"},
     *             @OA\Property(property="user_id", type="integer", description="ID of the user")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Collaborator created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Collaborator")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
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
     * @OA\Get(
     *     path="/api/collaborators/{id}",
     *     summary="Display the specified collaborator",
     *     tags={"Collaborators"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the collaborator",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Collaborator details",
     *         @OA\JsonContent(ref="#/components/schemas/Collaborator")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Collaborator not found"
     *     )
     * )
     */
    public function show(Collaborator $collaborator)
    {
        return response()->json($collaborator);
    }

    /**
     * @OA\Put(
     *     path="/api/collaborators/{id}",
     *     summary="Update the specified collaborator",
     *     tags={"Collaborators"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the collaborator",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"user_id"},
     *             @OA\Property(property="user_id", type="integer", description="ID of the user")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Collaborator updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Collaborator")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Collaborator not found"
     *     )
     * )
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
     * @OA\Delete(
     *     path="/api/collaborators/{id}",
     *     summary="Remove the specified collaborator",
     *     tags={"Collaborators"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the collaborator",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Collaborator removed successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Collaborator removed successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Collaborator not found"
     *     )
     * )
     */
    public function destroy(Collaborator $collaborator)
    {
        $collaborator->delete();
        return response()->json(['message' => 'Collaborator removed successfully.']);
    }
}

