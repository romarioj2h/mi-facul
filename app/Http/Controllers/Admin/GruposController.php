<?php

namespace App\Http\Controllers\Admin;

use App\Grupos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GruposController extends Controller
{
    public function index() {
        return view('admin.grupos.index', [
            'grupos' => Grupos::paginate(Grupos::ITEMS_POR_PAGINA)
        ]);
    }
}
