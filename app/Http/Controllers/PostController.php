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
    public function getPost($id){
        $post = Post::find($id);
        return response()->json(['post'=>$post],200);

    }
    public function createPost(Request $request){
      
        
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);
        // Récupérez l'utilisateur authentifié
          $user = $request->user();
        // Créez le post en associant l'utilisateur
    $post = $user->posts()->create([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
    ]);
    return response()->json(['message' => 'Post créé avec succès', 'post' => $post], 200);

    }
    public function updatePost(Request $request,$id){
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
       // Récupérez l'utilisateur authentifié
       $user = $request->user();

       // Récupérez le post à mettre à jour
       $post = Post::find($id);

       //Vérifier si l'utlisateur connecté est le propriétaire de la post 
       if($user->id !== $post->user_id ){
        return response()->json([
          'message'=>"Vous n'etes pas autorisé à modifier cette ressource "
        ],403);
       }
       //Modifié la puplication
       $post->update([
        'title' => $request->input('title'),
        'content'=>$request->input('content')
       ]);
       return response()->json([
        "message"=>"post modifié avec succeès",
        'post'=> $post
       ],200);

      

    }
    public function deletePost($id){
     
        Post::destroy($id);
        return response()->json([
            "message"=>"publication supprimer avec succès"
        ]);

    }
    public function getCommentsForPost($post_id){

     //recupérer la post avec ses commentaires  
     $post = Post::with('comments')->findOrFail($post_id);

     //retournner les commentaires de ce post 

    return response()->json([
       "comments"=> $post->comments
    ],200);


    }
}
