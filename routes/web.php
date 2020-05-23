<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// LLamando al objeto image
//use App\Image;


//RUTAS GENERALES
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//USUARIOS
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
Route::get('/gente/{search?}','UserController@index')->name('user.index');

//IMAGENES
Route::get('/subir-imagen','ImageController@create')->name('Image.create');
Route::post('/image/save','ImageController@save')->name('Image.save');
Route::get('/image/{filename}','ImageController@getImage')->name('Image.file');
Route::get('/imagen/{id}','ImageController@detail')->name('Image.detail');
Route::get('/imagen/delete/{id}', 'ImageController@delete')->name('Image.delete');
Route::get('/imagen/editar/{id}', 'ImageController@edit')->name('Image.edit');
Route::post('/image/update','ImageController@update')->name('Image.update');

//COMENTARIOS
Route::post('/comment/save','CommentController@save')->name('Comment.save');
Route::get('/comment/delete/{id}','CommentController@delete')->name('Comment.delete');

//LIKES
Route::get('/like/{image_id}','LikeController@like')->name('Like.like');
Route::get('/dislike/{image_id}','LikeController@dislike')->name('Like.dislike');
Route::get('/likes','LikeController@likes')->name('Like.likes');




Route::get('/perfil/{user_id}','UserController@profile')->name('profile');