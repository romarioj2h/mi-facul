<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreguntasController extends Controller
{
    public function responder(Request $request)
    {
        $preguntas = $request->input('preguntas');
        echo "<pre>";
        print_r($preguntas);
        echo "</pre>";
        die();
    }
}
