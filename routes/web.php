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

use Illuminate\Support\Facades\Auth;

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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
/*Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');*/

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/admin', 'HomeController@index')->name('home');

Route::prefix('/admin')->group(function() {
    Route::prefix('/grupos')->group(function () {
        Route::get('/', [
            'as' => 'admin.grupos.index',
            'uses' => 'Admin\GruposController@index'
        ]);
        Route::get('/editar/{id}', [
            'as' => 'admin.grupos.editar',
            'uses' => 'Admin\GruposController@editar'
        ]);
        Route::get('/borrar/{id}', [
            'as' => 'admin.grupos.borrar',
            'uses' => 'Admin\GruposController@borrar'
        ]);
        Route::get('/agregar', [
            'as' => 'admin.grupos.agregar',
            'uses' => 'Admin\GruposController@agregar'
        ]);
        Route::patch('/modificar', [
            'as' => 'admin.grupos.modificar',
            'uses' => 'Admin\GruposController@guardar'
        ]);
        Route::post('/guardar', [
            'as' => 'admin.grupos.guardar',
            'uses' => 'Admin\GruposController@guardar'
        ]);
        Route::prefix('/{gruposId}/preguntas')->group(function () {
            Route::get('/', [
                'as' => 'admin.grupos.preguntas.index',
                'uses' => 'Admin\PreguntasController@index'
            ]);
            Route::get('/editar/{id}', [
                'as' => 'admin.grupos.preguntas.editar',
                'uses' => 'Admin\PreguntasController@editar'
            ]);
            Route::get('/borrar/{id}', [
                'as' => 'admin.grupos.preguntas.borrar',
                'uses' => 'Admin\PreguntasController@borrar'
            ]);
            Route::get('/agregar', [
                'as' => 'admin.grupos.preguntas.agregar',
                'uses' => 'Admin\PreguntasController@agregar'
            ]);
            Route::patch('/modificar', [
                'as' => 'admin.grupos.preguntas.modificar',
                'uses' => 'Admin\PreguntasController@guardar'
            ]);
            Route::post('/guardar', [
                'as' => 'admin.grupos.preguntas.guardar',
                'uses' => 'Admin\PreguntasController@guardar'
            ]);
        });
    });
});