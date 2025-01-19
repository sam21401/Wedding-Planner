<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskNote;
use Illuminate\Http\Request;

class TaskNoteController extends Controller
{

    public function index(Task $task)
    {
        return response()->json($task->notes);
    }


    public function store(Request $request, Task $task)
    {
        $note = new TaskNote();
        $note->task_id = $task->id;
        $note->note = $request->input('note');
        $note->created_by = $request->user()->id;
        $note->save();

        return response()->json($note, 201);
    }
}
