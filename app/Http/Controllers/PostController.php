<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller 
{
    
    /**  
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        $post = $request->user()->posts()->create($fields);

        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify', $post);

       
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

        return $post;   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify', $post);
        
        $post->delete();
        return ['message' => 'post was deleted'];
    }
}
