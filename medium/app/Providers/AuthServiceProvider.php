<?php

namespace App\Providers;

use App\Contracts\Likeable;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage_users', function (User $user, Post $post) {

            return $post->user_id == $user->id;
        });

        Gate::define('manage_comments', function (User $user, Comment $comment) {

            return $user->id == $comment->user_id;

        });

        Gate::define('like', function (User $user, Likeable $likeable) {
            if (!$likeable->exists) {
                return Response::deny("Cannot like an object that doesn't exists");
            }

            if ($user->hasLiked($likeable)) {
                return Response::deny("Cannot like the same thing twice");
            }

            return Response::allow();
        });

        Gate::define('unlike', function (User $user, Likeable $likeable) {
            if (!$likeable->exists) {
                return Response::deny("Cannot unlike an object that doesn't exists");
            }

            if (!$user->hasLiked($likeable)) {
                return Response::deny("Cannot unlike without liking first");
            }

            return Response::allow();
        });
    }
}