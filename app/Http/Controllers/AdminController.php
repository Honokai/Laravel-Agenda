<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function painel()
    {
        $usuarios = Usuario::online();
        return view('painel')->with('usuarios',$usuarios);
    }
}
