<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     summary="Display a listing of the posts",
     *     tags={"Posts"},
     *     @OA\Response(
     *         response=200,
     *         description="List of posts",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Post"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $posts = Post::where('user_id', $user->id)
                     ->select('id', 'title')
                     ->get();

        return response()->json($posts);
    }

/**
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     required={"title", "content", "created_at"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Title of the post",
 *         example="My first post"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         description="Content of the post",
 *         example="This is the content of the post"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The time when the post was created",
 *         example="2025-01-24T12:00:00Z"
 *     )
 * )
 */

    public function store(Request $request)
    {
        $user = $request->user();

        $fields = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'wedding_date' => 'nullable|date',
            'venue_name' => 'nullable|string',
            'venue_address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'theme' => 'nullable|string',
            'estimated_cost' => 'nullable|numeric',
            'dress_code' => 'nullable|string',
            'food_options' => 'nullable|string',
            'rsvp_deadline' => 'nullable|date',
            'transportation_notes' => 'nullable|string',
            'gifts' => 'nullable|string',
            'music_type' => 'nullable|string',
            'host' => 'nullable|string',
            'with_children' => 'nullable|boolean',
        ]);

        $post = $user->posts()->create($fields);

        return response()->json($post, 201);
    }


    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $fields = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'wedding_date' => 'nullable|date',
            'venue_name' => 'nullable|string',
            'venue_address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'theme' => 'nullable|string',
            'estimated_cost' => 'nullable|numeric',
            'dress_code' => 'nullable|string',
            'food_options' => 'nullable|string',
            'rsvp_deadline' => 'nullable|date',
            'transportation_notes' => 'nullable|string',
            'gifts' => 'nullable|string',
            'music_type' => 'nullable|string',
            'host' => 'nullable|string',
            'with_children' => 'nullable|boolean',
        ]);

        $post->update($fields);

        return response()->json($post);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     summary="Display the specified post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post details",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     )
     * )
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        return response()->json($post);
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     summary="Remove the specified post from storage",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Post deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     )
     * )
     */
    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}/landing-page",
     *     summary="Display post landing page information",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post landing page details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="wedding_date", type="string"),
     *             @OA\Property(property="food_options", type="string"),
     *             @OA\Property(property="transportation_notes", type="string"),
     *             @OA\Property(property="gifts", type="string"),
     *             @OA\Property(property="music_type", type="string"),
     *             @OA\Property(property="host", type="string"),
     *             @OA\Property(property="with_children", type="boolean"),
     *             @OA\Property(property="venue_name", type="string"),
     *             @OA\Property(property="venue_address", type="string"),
     *             @OA\Property(property="latitude", type="number"),
     *             @OA\Property(property="longitude", type="number"),
     *             @OA\Property(property="theme", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     )
     * )
     */
    public function landingPage(Post $post)
    {
        return response()->json([
            'description' => $post->description,
            'wedding_date' => $post->wedding_date,
            'food_options' => $post->food_options,
            'transportation_notes' => $post->transportation_notes,
            'gifts' => $post->gifts,
            'music_type' => $post->music_type,
            'host' => $post->host,
            'with_children' => $post->with_children,
            'venue_name' => $post->venue_name,
            'venue_address' => $post->venue_address,
            'latitude' => $post->latitude,
            'longitude' => $post->longitude,
            'theme' => $post->theme,
        ]);
    }
}
