<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Eloquent\Relations\Relation;

use App\Observers\CommentObserver;
use App\Comment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Polymorphic Relations için db ye kaydettiğimiz isimlerle modelleri eşleştiriyoruz.
        Relation::morphMap([
            'post' => 'App\Post',
            'video' => 'App\Video',
        ]);

        Comment::observe(CommentObserver::class);

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
