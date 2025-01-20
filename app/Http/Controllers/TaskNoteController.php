<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskNote;
use Illuminate\Http\Request;

class TaskNoteController extends Controller
{
    public function index(Task $task)
    {
        $this->authorize('viewAny', [TaskNote::class, $task]);

        return response()->json($task->notes);
    }

    public function store(Request $request, Task $task)
    {
        $this->authorize('create', [TaskNote::class, $task]);

        $validated = $request->validate([
            'note' => 'required|string',
        ]);

        $note = new TaskNote();
        $note->task_id = $task->id;
        $note->note = $validated['note'];
        $note->created_by = $request->user()->id;
        $note->save();

        return response()->json($note, 201);
    }

    public function show(TaskNote $taskNote)
    {
        $this->authorize('view', $taskNote);

        return response()->json($taskNote);
    }

    public function update(Request $request, TaskNote $taskNote)
    {
        $this->authorize('update', $taskNote);

        $validated = $request->validate([
            'note' => 'required|string',
        ]);

        $taskNote->update($validated);

        return response()->json(['message' => 'Task note updated successfully.']);
    }

    public function destroy(TaskNote $taskNote)
    {
        $this->authorize('delete', $taskNote);

        $taskNote->delete();

        return response()->json(['message' => 'Task note deleted successfully.']);
    }
}
