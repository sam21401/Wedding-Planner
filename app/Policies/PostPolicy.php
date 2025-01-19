<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; 
    }

    

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        
        return $post->user_id === $user->id || 
                (Schema::hasTable('collaborators') &&
               $post->collaborators()->where('user_id', $user->id)->exists());
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {

        return $post->user_id === $user->id || 
                (Schema::hasTable('collaborators') &&
               $post->collaborators()->where('user_id', $user->id)->where('role', 'organizer')->exists());
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
    
        return $post->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return false; 
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false; 
    }
}
