<?php

namespace App\Http\Controllers;

use App\User;
use Symfony\Contracts\EventDispatcher\Event;
use Illuminate\Http\Request;
use App\Usuario;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Hash;

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

    public function agenda(){
        $id = Auth::id();
        $eventos = Usuario::eventosProximos($id);
        return view('agenda')->with('eventos',$eventos);
    }

    public function registro(Request $request)
{
        $rules = [
            'nome' => ['required', 'string','min:8', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'senha' => ['required', 'string', 'min:8', 'confirmed'],
            'acesso' => 'required',
        ];

        $this->validate($request, $rules);

        User::create([
            'nome' => $request['nome'],
            'email' => $request['email'],
            'senha' => Hash::make($request['senha']),
            'acesso' => $request['acesso'],
        ]);        

        return back()->with("status", "Usuário criado.");
}


}
