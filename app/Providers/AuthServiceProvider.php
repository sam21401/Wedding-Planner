<?php

namespace App\Providers;

use App\Models\Collaborator;
use App\Models\Task;
use App\Models\TaskNote;
use App\Models\Menu;
use App\Models\Guest;
use App\Models\Post;

use App\Policies\CollaboratorPolicy;
use App\Policies\TaskPolicy;
use App\Policies\TaskNotePolicy;
use App\Policies\MenuPolicy;
use App\Policies\GuestPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Collaborator::class => CollaboratorPolicy::class,
        Task::class => TaskPolicy::class,
        TaskNote::class => TaskNotePolicy::class,
        Menu::class => MenuPolicy::class,
        Guest::class => GuestPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }

}
