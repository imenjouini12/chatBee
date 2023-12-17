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


Route::get('/users',[UserController::class,'index']);  
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
//public routes for Posts  
Route::get('/posts',[PostController::class,'getPosts']);
Route::get('/posts/{id}',[PostController::class,'getPost']);
Route::get('/posts/{id}/comments',[PostController::class,'getCommentsForPost']);  // afficher les commentaires d'une puplucations 
//public routes for Comments
Route::get('/comments',[PostController::class,'getComments']);
Route::get('/comments/{id}',[PostController::class,'getComment']);
    
Route::get('/test', function () {
    return response()->json(['message' => 'Route de test']);
});
Route::group(['middleware' => ['auth:sanctum']], function () {


    Route::post('/logout',[AuthController::class,'logout']);
  

    //Protected routes for User 
    // Route::post('/createuser',[UserController::class,'createUser']);
    Route::get('/users/{id}',[UserController::class,'getUser']);  
    //Protected routes for Posts 
    Route::post('/createpost',[PostController::class,'createPost']);
    Route::put('/updateposts/{id}',[PostController::class,'updatePosts']);  
    Route::delete('/deleteposts/{id}',[PostController::class,'deletePosts']);
    //Protected routes for Comments
    Route::post('/createcomment',[CommentController::class,'createComment']);
    Route::put('/updatecomment',[CommentController::class,'updateComment']);
    Route::delete('/deletecomment',[CommentController::class,'deleteComment']);
       
});