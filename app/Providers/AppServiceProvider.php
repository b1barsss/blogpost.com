<?php

namespace App\Providers;

use App\Contracts\CounterContract;
use App\Http\ViewComposers\ActivityComposer;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Observers\BlogPostObserver;
use App\Observers\CommentObserver;
use App\Services\Counter;
use App\Services\DummyCounter;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::aliasComponent('components.badge', 'badge');
        Blade::aliasComponent('components.updated', 'updated');
        Blade::aliasComponent('components.card', 'card');
        Blade::aliasComponent('components.tags', 'tags');
        Blade::aliasComponent('components.errors', 'errors');
        Blade::aliasComponent('components.comment-form', 'commentForm');
        Blade::aliasComponent('components.comment-list', 'commentList');

        view()->composer(['posts.index','posts.show'], ActivityComposer::class);

        BlogPost::observe(BlogPostObserver::class);
        Comment::observe(CommentObserver::class);

        $this->app->singleton(Counter::class, function ($app){
            return new Counter(
                $app->make(Factory::class),
                $app->make(Session::class),
//                env('COUNTER_TIMEOUT')
                5
            );
        });

        $this->app->bind(
            CounterContract::class,
            Counter::class
        );

//        CommentResource::withoutWrapping();
        JsonResource::withoutWrapping();

//        $this->app->bind(
//            CounterContract::class,
//            DummyCounter::class
//        );

//        $this->app->when(Counter::class)
//            ->needs('$timeout')
//            ->give(env('COUNTER_TIMEOUT'));

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
