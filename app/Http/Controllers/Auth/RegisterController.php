<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                        'name' => ['required', 'string', 'max:255'],
                        'surname' => ['required', 'string', 'max:255'],
                        'nickname' => ['required', 'string', 'max:255', 'unique:users'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        //'image_path' => ['required']
                    ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /*
        //Subir la imagen
        $image_path = $data['image_path'];

        $valor =false;
        if ($image_path) {
            //Le pongo un nombre único
            $image_path_name = time().$image_path->getClientOriginalName();

            //Guardar en carpeta storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            
        }*/
        $valor = User::create([
            'role' => 'user',
            'name' => $data['name'],
            'surname' => $data['surname'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => null
        ]);
        return $valor;

    }
}
