<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
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



//public routes for User  
Route::post('/login',[AuthController::class,'login']);
Route::get('/users',[UserController::class,'index']);  
Route::post('/register',[AuthController::class,'register']);


//public routes for Posts  
Route::get('/posts',[PostController::class,'getPosts']);
Route::get('/post/{id}',[PostController::class,'getPost']);
Route::get('/posts/{id}/comments',[PostController::class,'getCommentsForPost']);  // afficher les commentaires d'une puplucations 

//public routes for Comments
Route::get('/comments',[CommentController::class,'getComments']);
Route::get('/comments/{id}',[CommentController::class,'getComment']); 




//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout',[AuthController::class,'logout']);
    //Protected routes for User 
    // Route::post('/createuser',[UserController::class,'createUser']);
    Route::get('/users/{id}',[UserController::class,'getUser']);  
    //Protected routes for Posts 
    Route::post('/createpost',[PostController::class,'createPost']);
    Route::put('/updatepost/{id}',[PostController::class,'updatePost']);  
    Route::delete('/deletepost/{id}',[PostController::class,'deletePost']);
    //Protected routes for Comments
    Route::post('/createcomment',[CommentController::class,'createComment']);
    Route::put('/updatecomment/{id}',[CommentController::class,'updateComment']);
    Route::delete('/deletecomment/{id}',[CommentController::class,'deleteComment']);  

});