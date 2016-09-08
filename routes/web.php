<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home.index');
});


// Route::get('/cidades', 'CidadesController@getIndex');
// Route::get('/cidades/edit/{$id}', 'CidadesController@getEdit');
// Route::get('/cidades/view/{$id}', 'CidadesController@getView');
// Route::post('/cidades/edit', 'CidadesController@postEdit');
// Route::post('/cidades/delete', 'CidadesController@postDelete');

Route::get('cidades/{id}/delete', 'CidadesController@delete');
Route::resource('cidades', 'CidadesController');


Route::get('bairros/{id}/delete', 'BairrosController@delete');
Route::resource('bairros', 'BairrosController');
Route::resource('contatos', 'ContatosController');

Route::resource('home', 'HomeController', ['only' => [
    'index'
]]);

// GET	/photos	index	photos.index
// GET	/photos/create	create	photos.create
// POST	/photos	store	photos.store
// --- GET	/photos/{photo}	show	photos.show
// GET	/photos/{photo}/edit	edit	photos.edit
// --- PUT/PATCH	/photos/{photo}	update	photos.update
// DELETE	/photos/{photo}	destroy	photos.destroy
