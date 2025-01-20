<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\TaskNote;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskNotePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function create(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function view(User $user, TaskNote $taskNote)
    {
        return $user->id === $taskNote->created_by || $user->id === $taskNote->task->user_id;
    }

    public function update(User $user, TaskNote $taskNote)
    {
        return $user->id === $taskNote->created_by;
    }

    public function delete(User $user, TaskNote $taskNote)
    {
        return $user->id === $taskNote->created_by;
    }
}
