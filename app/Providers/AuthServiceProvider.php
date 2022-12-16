<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use App\Policies\BlogPostPolicy;
use App\Policies\CommentPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//        'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy',
        BlogPost::class => BlogPostPolicy::class,
        User::class => UserPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::guessPolicyNamesUsing(function ($modelClass) {
//            return 'App\\Policies\\' . class_basename($modelClass) . 'Policy';
//        });

        Gate::define('home.secret', function ($user){
            return $user->is_admin;
        });
//        Gate::define('update-post',function ($user, $post){
//            return $user->id === $post->user_id;
//        });
//
//        Gate::define('delete-post', function($user, $post){
//            return $user->id === $post->user_id;
//        });

//        Gate::define('update-post', [BlogPostPolicy::class, 'update']);
//        Gate::define('posts.delete', [BlogPostPolicy::class, 'delete']);

//        Gate::resource('posts', BlogPostPolicy::class);

        Gate::before(function ($user, $ability){
            return ($user->is_admin and in_array($ability, ['update','delete'])) ?: null;

        });

//        Gate::after(function ($user, $ability, $result){
//            if ($user->is_admin )
//            {
//                return true;
//            }
//        });
    }
}
