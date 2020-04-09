<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Illuminate\Support\Facades\Auth;
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
        $id = Auth::id();
        $usuarios = Usuario::online();
        $eventos = Usuario::eventosProximos($id);
        
        return view('painel')->with('usuarios',$usuarios)->with('eventos',$eventos);
    }
}
