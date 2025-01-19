<?php

namespace App\Policies;

use App\Models\Collaborator;
use App\Models\Post;
use App\Models\User;

class CollaboratorPolicy
{
    public function viewAny(User $user, Post $post): bool
    {
        return $post->user_id === $user->id ||
               $post->collaborators->contains('id', $user->id);
    }

    public function create(User $user, Post $post): bool
    {
        return $post->user_id === $user->id;
    }

    public function update(User $user, Collaborator $collaborator): bool
    {
        return $collaborator->post->user_id === $user->id || 
               $collaborator->user_id === $user->id;
    }

    public function delete(User $user, Collaborator $collaborator): bool
    {
        return $collaborator->post->user_id === $user->id || 
               $collaborator->user_id === $user->id;
    }
}
