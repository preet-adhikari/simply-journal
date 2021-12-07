<?php

use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $posts = Post::all();
    $categories = Category::all();
    return view('blog.index',compact('posts','categories'));
});

Route::post('/addBlog',[PostController::class,'store']);
Route::get('/post/{post:slug}',[PostController::class,'view']);
Route::get('post/edit/{slug}',[PostController::class,'edit']);
Route::post('/post/edit/{slug}',[PostController::class,'update']);
Route::delete('/post/delete/{slug}',[PostController::class,'delete']);
