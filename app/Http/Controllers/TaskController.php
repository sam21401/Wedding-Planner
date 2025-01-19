<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Post $post)
    {
        $this->authorize('viewAny', [Task::class, $post]);

        $tasks = $post->tasks;

        return response()->json($post->tasks);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return response()->json($task);
    }

    

    public function store(Request $request, Post $post)
    {
        $this->authorize('create', [Task::class, $post]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $task = $post->tasks()->create($validated);

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
            'due_date' => 'nullable|date',
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


