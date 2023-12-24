<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewCommentNotification;

class CommentController extends Controller
{
    //Afficher tous les commentaires
    public function getComments(){
        $comments = Comment::all();
        return response()->json([
            "liste des commentaire" => $comments
        ],200);

    }
    //Afficher un seule commentaire
    public function getComment($id){
        $comment = Comment::find($id);
        return response()->json([
            "un commentaire trouvé" => $comment
        ],200);
        
    }

    public function createComment(Request $request)
{
    

    $validatedData = $request->validate([
        'content' => "required|string",
        'post_id' => "required"
    ]);
   
     $userId = Auth::id();
    // Créer le commentaire avec l'ID de l'utilisateur extrait automatiquement
    $comment = Comment::create([
       
        'post_id' => $validatedData['post_id'],
        'content' => $validatedData['content'],
        'user_id' => $userId
    ]);

        // la post associé à ce commentaire
        $post = $comment->post;

        // notifier le propriétaire du post
        $postOwner = $post->user;
        $postOwner->notify(new NewCommentNotification($comment, $post));
    

    return response()->json(['message' => 'Commentaire créé avec succès']);
}


    //Modifier un commentaire
    public function updateComment(Request $request, $id){

        $request->validate([
            'content' => 'required|string',
        ]);
       // Récupérez l'utilisateur authentifié
       $user = $request->user();

       // Récupérez le post à mettre à jour
       $comment = Comment::find($id);

       //Vérifier si l'utlisateur connecté est le propriétaire de la post 
       if($user->id !== $comment->user_id ){
        return response()->json([
          'message'=>"Vous n'etes pas autorisé à modifier cette ressource "
        ],403);
       }
       //Modifié la puplication
       $comment->update([
        'content'=>$request->input('content')
       ]);
       return response()->json([
        "message"=>"post modifié avec succeès",
        'post'=> $comment
       ],200);
        
    }
    //Supprimer un commentaire
    public function deleteComment($id){
     Comment::destroy($id);

     return response()->json([
        "message" => "commentaire supprimer avec succeès !"
     ]);
        
    }

}
