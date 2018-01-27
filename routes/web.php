<?php

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

Route::get('/', [
    'as' => 'web.index',
    'uses' => 'GruposController@index'
]);

Route::view('/contacto', 'contacto.index')->name('web.contacto');

Route::get('/grupos/preguntas/{id}', [
    'as' => 'grupos.obtenerPreguntas',
    'uses' => 'GruposController@obtenerPreguntas'
]);

Route::post('/preguntas/responder', [
    'as' => 'preguntas.responder',
    'uses' => 'PreguntasController@responder'
]);
