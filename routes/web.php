<?php

use Illuminate\Support\Facades\Route;
use App\Models\{User, Album};

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
use App\Http\Controllers\
{
	PagesController, AlbumsController, PhotosController,
};

route::get('/', [AlbumsController::class, 'index']);



Route::patch('albums/{id}', [AlbumsController::class, 'store']);

Route::get('albums/{id}', [AlbumsController::class, 'create']);

Route::post('albums/create', [AlbumsController::class, 'save']);

Route::get('album/{album}/delete', [AlbumsController::class, 'delete']);
Route::get('photo/{photo}/delete', [PhotosController::class, 'delete']);

Route::get('album/{albums}/edit', [AlbumsController::class, 'edit']);

Route::get('album/{album}/images', [AlbumsController::class, 'getImages'])
	->name('album.getImages')
	->where('album', '[0-9]+');


route::get('about', [PagesController::class, 'about']);

//route::resource('photos', ['PhotosController']);
 Route::resource('photos', PhotosController::class);

Route::get('/users', function(){
	return User::paginate(5);
});

