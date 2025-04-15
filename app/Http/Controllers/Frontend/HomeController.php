<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
      $gretest_posts_views = Post::active()->orderBy('num_of_views','desc')->limit(3)->get();
      $posts = Post::active()->with('images')->latest()->paginate(9); 
      $oldest_news = Post::active()->oldest()->limit(3)->get();
      $gretest_posts_comment = Post::active()->withCount('comments')->orderBy('comments_count','desc')->limit(3)->get();

      $categories = Category::all();
      $categories_with_posts = $categories->map(function ($category) {
        $category->posts = $category->posts()->limit(4)->get();
      return $category;

      });

      // return $categories_with_posts;



        return view('frontend.index',compact(
          'posts',
        'gretest_posts_views',
        'oldest_news',
        'gretest_posts_comment',
        'categories_with_posts',
      ));
    }
}
        