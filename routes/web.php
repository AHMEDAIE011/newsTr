<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\SearchController;
use App\Models\NewSubscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\NewSubscriberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group([
'as'=>'frontend.',
],function () {
    
    Route::get('/',[HomeController::class,'index'])->name('index');
    Route::post('news-subscribe',[NewSubscriberController::class,'store'])->name('news.subscribe');
    Route::get('category/{slug}',CategoryController::class)->name('category.posts');
    Route::match(['get','post'],'search',SearchController::class)->name('search');





    // PostController group
    Route::controller( PostController::class)->name('post.')->prefix('post/')->group(function(){
        Route::get('{slug}','show')->name('show');        
        Route::get('comment/{slug}','getAllComment')->name('getAllComment');        
        Route::post('comment/store','saveComment')->name('comment.store');        
    });
    // PostController group
    Route::controller( ContactController::class)->name('contact.')->prefix('contact-us')->group(function(){
        Route::get('','index')->name('index');
        Route::post('/store','store')->name('store');
    });     

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
