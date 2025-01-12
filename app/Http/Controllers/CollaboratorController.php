<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Post;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function index(Post $post)
    {
        $this->authorize('viewAny', [Collaborator::class, $post]);

        return response()->json($post->collaborators);
    }

    public function store(Request $request, Post $post)
    {
        $this->authorize('create', [Collaborator::class, $post]);

        $postId = $post->id;

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => $postId,
        ]);

        $post->collaborators()->attach($validated['user_id']);

        return response()->json(['message' => 'Collaborator added successfully.']);
    }


    public function destroy(Collaborator $collaborator)
    {
        $this->authorize('delete', $collaborator);

        $collaborator->delete();

        return response()->json(['message' => 'Collaborator removed successfully.']);
    }
}
