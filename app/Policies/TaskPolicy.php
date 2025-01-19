<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;
use App\Models\Post;

class TaskPolicy
{
    public function viewAny(User $user, Post $post)
    {
        return $user->id === $post->user_id || 
               $post->collaborators()->where('user_id', $user->id)->exists();
    }

    public function view(User $user, Task $task)
    {
        return $user->id === $task->post->user_id || 
               $task->post->collaborators()->where('user_id', $user->id)->exists() || 
               $task->assigned_to === $user->id;
    }

    public function create(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function update(User $user, Task $task)
    {
        return $user->id === $task->post->user_id || 
               $task->post->collaborators()->where('user_id', $user->id)->exists() ||
               $task->assigned_to === $user->id;
    }

    public function delete(User $user, Task $task)
    {
        return $user->id === $task->post->user_id;
    }
}

