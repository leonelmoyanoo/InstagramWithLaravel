<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('Image.create');
    }

    public function save(Request $request){
        //Validacion
        $validate = $this->validate($request,[
            'description' => ['required'],
            'image_path' => ['required','image'],
        ]);

        $description = $request->input('description');
        $image_path = $request->file('image_path');

        //Asignar valores al objeto
            $user = \Auth::user();

            $image = new Image();
            $image->user_id = $user->id;
            $image->image_path=null;
            $image->description=$description;

            //Subir fichero
            if ($image_path) {
                $image_path_name = time().$image_path->getClientOriginalName();
                Storage::disk('images')->put($image_path_name, File::get($image_path));
                $image->image_path=$image_path_name;
            }

            $image->save();

            return redirect()->route('home')->with([
                                'message' => 'Imagen publicada con éxito'
                            ]);
    }

    public function getImage($filename){
        $file = storage::disk('images')->get($filename);
        return new Response($file,200);
    }
    public function detail($id){
        $image = Image::find($id);

        return view('Image.detail',[
            'image' =>$image
        ]);
    }
    public function delete($id){
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id',$id)->get();
        $likes = Like::where('image_id',$id)->get();
        $message = 'No se puso eliminar la imagen';
        if ($user && $image && $image->user->id == $user->id) {
            //Eliminar comentarios
            if ($comments && count($comments)>0) {
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
            //Eliminar los likes
            if ($likes && count($likes)>0) {
                foreach($likes as $like){
                    $like->delete();
                }
            }
            //Eliminar ficheros de imagen
            Storage::disk('images')->delete($image->image_path);
            //Eliminar registro imagen
            $image->delete();
            $message = 'Imagen eliminada con éxito';
        }
        return redirect()->route('home')->with(['message'=>$message]);
    }

    public function edit($id){
        $user = \Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user->id && $user->id) {
            return view('Image.edit',[
                'image' =>$image
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function update(Request $request){
        //Validacion
        $validate = $this->validate($request,[
            'description' => ['required'],
            'image_path' => ['image'],
            'image_id' =>['required']
        ]);

        $description = $request->input('description');
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');


        //Asignar valores al objeto
            $user = \Auth::user();

            $image = Image::find($image_id);
            $image->description=$description;

            //Subir fichero
            if ($image_path) {
                //Eliminar ficheros de imagen
                Storage::disk('images')->delete($image->image_path);

                $image_path_name = time().$image_path->getClientOriginalName();
                Storage::disk('images')->put($image_path_name, File::get($image_path));
                $image->image_path=$image_path_name;
            }

            $image->update();

            return redirect()->route('Image.detail',['id'=>$image_id])
                            ->with([
                                'message' => "Actualizado con éxito"
                            ]);
    }
}
