<?php

namespace App\Http\Controllers;

use App\User;
use Symfony\Contracts\EventDispatcher\Event;
use Illuminate\Http\Request;
use App\Usuario;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
        $usuarios = User::all();
        $eventos = Usuario::eventosProximos($id);
        return view('painel')->with('usuarios',$usuarios)->with('eventos',$eventos);
    }

    public function painel1()
    {
        $id = Auth::id();
        $usuarios = Usuario::online();
        $eventos = Usuario::eventosProximos($id);
        return view('painelv2')->with('usuarios',$usuarios)->with('eventos',$eventos);
    }

    public function agenda(){
        $id = Auth::id();
        $eventos = Usuario::eventosProximos($id);
        return view('agenda')->with('eventos',$eventos);
    }
}
