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
    'uses' => 'WebController@index'
]);

Route::get('/gruposPreguntas', [
    'as' => 'grupos.index',
    'uses' => 'GruposController@index'
]);

Route::view('/contacto', 'contacto.index')->name('web.contacto');
Route::view('/paginas/terminos-servicio', 'paginas.terminosCondiciones')->name('web.paginas.terminosServicio');

Route::post('/contacto/guardar', [
    'as' => 'web.contacto.guardar',
    'uses' => 'ContactosController@guardar'
]);
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

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->prefix('/admin')->group(function() {
    Route::prefix('/servicios')->group(function() {
        Route::get('/', [
            'as' => 'admin.servicios.index',
            'uses' => 'Admin\ServiciosController@index'
        ]);
        Route::get('/agregar', [
            'as' => 'admin.servicios.agregar',
            'uses' => 'Admin\ServiciosController@agregar'
        ]);
        Route::get('/aprobar/{id}', [
            'as' => 'admin.servicios.aprobar',
            'uses' => 'Admin\ServiciosController@aprobar'
        ]);
        Route::get('/editar/{id}', [
            'as' => 'admin.servicios.editar',
            'uses' => 'Admin\ServiciosController@editar'
        ]);
        Route::get('/borrar/{id}', [
            'as' => 'admin.servicios.borrar',
            'uses' => 'Admin\ServiciosController@borrar'
        ]);
        Route::patch('/modificar', [
            'as' => 'admin.servicios.modificar',
            'uses' => 'Admin\ServiciosController@guardar'
        ]);
        Route::post('/guardar', [
            'as' => 'admin.servicios.guardar',
            'uses' => 'Admin\ServiciosController@guardar'
        ]);
    });

    Route::prefix('/contactos')->group(function () {
        Route::get('/', [
            'as' => 'admin.contactos.index',
            'uses' => 'Admin\ContactosController@index'
        ]);
        Route::post('/modificarEstado/{id}', [
            'as' => 'admin.contactos.modificarEstado',
            'uses' => 'Admin\ContactosController@modificarEstado'
        ]);
    });

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

Route::prefix('/servicios')->group(function() {
    Route::get('/', [
        'as' => 'web.servicios.obtenerGrupos',
        'uses' => 'ServiciosController@obtenerGrupos'
    ]);
    Route::middleware('login.sitio')->get('/mis', [
        'as' => 'web.servicios.mis',
        'uses' => 'ServiciosController@mis'
    ]);
    Route::get('/busca', [
        'as' => 'web.servicios.busca',
        'uses' => 'ServiciosController@buscar'
    ]);
    Route::get('/{id}', [
        'as' => 'web.servicios.obtenerServicios',
        'uses' => 'ServiciosController@obtenerServicios'
    ]);
});

Route::prefix('/servicio')->group(function() {
    Route::middleware('login.sitio')->get('/agregar', [
        'as' => 'web.servicio.agregar',
        'uses' => 'ServicioController@agregar'
    ]);

    Route::middleware('login.sitio')->get('/editar/{id}', [
        'as' => 'web.servicio.editar',
        'uses' => 'ServicioController@editar'
    ]);

    Route::middleware('login.sitio')->get('/borrar/{id}', [
        'as' => 'web.servicio.borrar',
        'uses' => 'ServicioController@borrar'
    ]);

    Route::middleware('login.sitio')->post('/guardar', [
        'as' => 'web.servicio.guardar',
        'uses' => 'ServicioController@guardar'
    ]);

    Route::middleware('login.sitio')->patch('/guardar', [
        'as' => 'web.servicio.guardar',
        'uses' => 'ServicioController@guardar'
    ]);

    Route::get('/{id}/{slug}', [
        'as' => 'web.servicio.obtener',
        'uses' => 'ServicioController@obtener'
    ]);

    Route::middleware('login.sitio')->post('/{id}/comentar', [
        'as' => 'web.servicio.comentar',
        'uses' => 'ComentariosController@comentar'
    ]);

    Route::middleware('login.sitio')->post('/{id}/evaluar', [
        'as' => 'web.servicio.evaluar',
        'uses' => 'EvaluacionesController@evaluar'
    ]);
});

Route::get('/socialLogin', [
    'as' => 'web.login.obtener',
    'uses' => 'AuthController@obtener'
]);
Route::post('/socialLogin', [
    'as' => 'web.login',
    'uses' => 'AuthController@login'
]);
Route::middleware('login.sitio')->get('/socialLogout', [
    'as' => 'web.logout',
    'uses' => 'AuthController@logout'
]);