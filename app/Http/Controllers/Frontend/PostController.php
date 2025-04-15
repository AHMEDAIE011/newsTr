<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
   public function show($slug){
    $meanPost = Post::active()->with(['comments' => function ($query) {
       $query->latest()->limit(3);
    }])->whereSlug($slug)->first();

    $category = $meanPost->category;
    $posts_belongsTo_category = $category->posts()->limit(5)->get();    
    return view('frontend.show',compact('meanPost','posts_belongsTo_category'));
   }

   

   public function getAllComment($slug){
      $post = Post::active()->whereSlug($slug)->first();
      $comments = $post->comments()->with('user')->get();
      return response()->json($comments);
      }


public function saveComment(Request $request){
   
   $request->validate([ 
      'user_id'=> ['required','exists:users,id'],
      'comment'=> ['required','string','max:200'],
      ]);
      $comment = Comment::create([ 
         'user_id'=> $request->user_id,
         'comment'=> $request->comment,
         'post_id'=> $request->post_id,
         'ip_address'=> $request->ip(),
      ]) ;
      $comment->load('user');

      if (!$comment) {
         return response()->json([
            'message'=> 'oprition feild',
            'status' => '403',

         ]);
      }

      
      return response()->json([
         'message'=> 'oprition feild',
         'comment'=> $comment,
         'status' => '200',
      ]);
}
}