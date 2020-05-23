<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
class LikeController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function like($image_id){
        //Recoger datos del usuario y la imagen
        $user = \Auth::user();

        //Verificar si ya existe el like y no duplicarlo
        $isset_like = Like::where('user_id',$user->id)
                            ->where('image_id',$image_id)
                            ->count();

        if ($isset_like==0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
    
            //Guardar
            $like->save();
        }
        return response()->json([
            'like' => $isset_like==0
        ]);

    }
    
    public function dislike($image_id){
        //Recoger datos del usuario y la imagen
        $user = \Auth::user();

        $image_id = (int)$image_id;
        $like = Like::where('user_id',$user->id)
                            ->where('image_id',$image_id)
                            ->first();

        $like_confirm=false;
        if ($like) {
            //Eliminar like
            $like->delete();
            $like_confirm=true;
        }
        return response()->json([
            'like' => $like_confirm
        ]);
    }

    public function likes(){
        $user = \Auth::user();
        $likes = Like::where('user_id',$user->id)
                        ->orderBy('id','desc')
                        ->paginate(5);
        return view('like.likes',[
            'likes' =>$likes
        ]);
    }
}
