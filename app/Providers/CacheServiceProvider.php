<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
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
        if (!Cache::has('read_more_posts')) {
            $read_more_posts = Post::select('id','title','slug')->latest()->limit(10)->get();
            Cache::remember('read_more_posts', 3600, function () use ($read_more_posts) {
               return $read_more_posts; 
            });
        }

        if (!Cache::has('latest_three_posts')) {
            $latest_three_posts = Post::select('id','title','slug')->latest()->limit(5)->get();
            Cache::remember('latest_three_posts', 3600, function () use ($latest_three_posts) {
               return $latest_three_posts; 
            });
        }

        if (!Cache::has('gretest_posts_comments')) {
            $gretest_posts_comments = Post::select('id','title','slug')->latest()->limit(5)->get();
            Cache::remember('gretest_posts_comments', 3600, function () use ($gretest_posts_comments) {
               return $gretest_posts_comments; 
            });
        }



        $latest_three_posts = Cache::get('latest_three_posts');
        $read_more_posts = Cache::get('read_more_posts');
        $gretest_posts_comments = Cache::get('gretest_posts_comments');

        view()->share([
            'read_more_posts' => $read_more_posts,
            'latest_three_posts' => $latest_three_posts,
            'gretest_posts_comments' => $gretest_posts_comments,
        ]);















    }
}
