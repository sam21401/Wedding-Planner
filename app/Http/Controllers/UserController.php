<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/user",
     *     summary="Get the authenticated user's ID",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="Authenticated user's ID",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function showUserId(Request $request)
    {
        return response()->json(['id' => $request->user()->id]);
    }
}
