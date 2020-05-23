<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){
        //Validacion
        $validate = $this->validate($request,[
            'image_id' => ['required','integer'],
            'content' => ['required','string']
        ]);
        //Recoger datos
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        $user = \Auth::user();
        

        //Asigno los valores al nuevo objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //Guardar en la base de datos
        $comment->save();

        //Redireccion
        return redirect()->route('Image.detail',['id' => $image_id])
                        ->with([
                            'message' =>"Comentario publciado con éxito"
                        ]);
    }

    public function delete($id){
        //Conseguir datos del usuario logueado
        $user = \Auth::user();

        //Conseguir objeto del comentario
        $comment = Comment::find($id);

        //Comprobar si es el dueño del comentario o de la publicación
        
        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();
            $message = "Comentario eliminado con éxito";
        }else{
            $message = "No tienes permitido eliminar este comentario";
        }
        
        return redirect()->route('Image.detail',['id' => $comment->image->id])
                        ->with([
                            'message' =>$message
                        ]);

    }
}
