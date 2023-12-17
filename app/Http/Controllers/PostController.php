<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function getPosts(){
        $posts = Post::all();
        return response()->json(['posts'=>$posts],200);

    }
    public function getPosts(){

    }
    public function getPosts(){

    }
    public function getPosts(){

    }
}
