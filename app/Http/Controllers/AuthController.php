<?php

namespace App\Http\Controllers;

use App\Services\Firebase\Autenticacion\AutenticadorFactory;
use App\Usuarios;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $origen = $request->input('origen');
        $token = $request->input('token');
        $email = $request->input('email');
        $nombre = $request->input('nombre');
        $foto = $request->input('foto');
        $class = AutenticadorFactory::obtenerPorOrigen($origen);
        $esValido = $class::esValido($token);
        if ($esValido) {
            $usuario = Usuarios::obtenerPorEmail($email);
            if ($usuario === false) {
                $usuario = new Usuarios();
            }
            $usuario->nombre = $nombre;
            $usuario->email = $email;
            $usuario->origen = $origen;
            $usuario->foto = $foto;
            $usuario->token = $token;
            $usuario->save();
            $request->session()->put('token', $token);
            $request->session()->put('email', $email);
            $request->session()->put('nombre', $nombre);
            $request->session()->put('foto', $foto);
            $request->session()->put('origen', $origen);
            $request->session()->put('usuarioId', $usuario->id);
        }
        return back();
    }
}
