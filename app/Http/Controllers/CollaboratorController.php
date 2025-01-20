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

        if ($post->collaborators()->where('user_id', $validated['user_id'])->exists()) {
            return response()->json(['message' => 'This user is already a collaborator on this post.'], 400);
        }

        $post->collaborators()->attach($validated['user_id']);

        return response()->json(['message' => 'Collaborator added successfully.']);
    }

    public function show(Collaborator $collaborator)
    {
        $this->authorize('view', $collaborator);

        return response()->json($collaborator);
    }

    public function update(Request $request, Collaborator $collaborator)
    {
        $this->authorize('update', $collaborator);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $collaborator->update($validated);

        return response()->json(['message' => 'Collaborator updated successfully.']);
    }

    public function destroy(Collaborator $collaborator)
    {
        $this->authorize('delete', $collaborator);

        $collaborator->delete();

        return response()->json(['message' => 'Collaborator removed successfully.']);
    }
}