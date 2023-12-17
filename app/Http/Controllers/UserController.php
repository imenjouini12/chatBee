<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json(['users'=> $users],200);
    }
     //This function is reserved for admin
    public function createUser(Request $request){
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json(['message'=>'utilisateur ajouté avec succeès','user'=>$user],201);

    }
    
    public function getUser($id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        return response()->json(['user' => $user], 200);


    }

}
