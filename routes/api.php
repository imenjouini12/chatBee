<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




//public routes for Posts  
Route::get('/posts',[PostController::class,'getPosts']);
Route::get('/posts/{id}',[PostController::class,'getPost']);
Route::get('/posts/{id}/comments',[PostController::class,'getPost']);  // afficher les commentaires d'une puplucations 

//public routes for Comments
Route::get('/comments',[PostController::class,'getComments']);
Route::get('/comments/{id}',[PostController::class,'getComment']);
    
  
    Route::group(['middleware' => ['auth:sanctum']], function () {
     
    //Protected routes for User 
    // Route::post('/createuser',[UserController::class,'createUser']);
    Route::get('/users/{id}',[UserController::class,'getUser']);
    //Protected routes for Posts 
    Route::post('/createpost',[PostController::class,'createPost']).
    Route::put('/updateposts/{id}',[PostController::class,'updatePosts']);  
    Route::delete('/deleteposts/{id}',[PostController::class,'deletePosts']);
    //Protected routes for Comments
    Route::post('/createcomment',[CommentController::class,'createComment']);
    Route::put('/updatecomment',[CommentController::class,'updateComment']);
    Route::delete('/deletecomment',[CommentController::class,'deleteComment']);
       
    });