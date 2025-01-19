<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
{
    $user = $request->user();

    $posts = Post::where('user_id', $user->id)
                 ->select('id', 'title')
                 ->get();

    return response()->json($posts);
}

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

    public function show(Post $post)
    {
        $this->authorize('view', $post);

        return response()->json($post);
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

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