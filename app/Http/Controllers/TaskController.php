<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;

        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $posts = Post::where('user_id', $userId)->get();

        $tasks = [];
        foreach ($posts as $post) {
            foreach ($post->tasks as $task) {
                $tasks[] = $task;
            }
        }

        return response()->json($tasks);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return response()->json($task);
    }

    public function store(Request $request, Post $post)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'deadline' => 'nullable|date',
        ]);

        $validated['post_id'] = $post->id;

        $task = Task::create($validated);

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'assigned_to' => 'nullable|exists:users,id',
            'deadline' => 'nullable|date',
        ]);

        $task->update($validated);

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task
        ]);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }

    public function tasksByCollaborator(User $collaborator)
    {
        $tasks = Task::where('responsible_user_id', $collaborator->id)->get();
        
        return response()->json($tasks);
    }
}


