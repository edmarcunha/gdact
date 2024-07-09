<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AvaliacaoServidorController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ServidorController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function index(Request $request)
    {
        $user = Auth::user()->getFirstAttribute('samaccountname');
        
        $servidor = ServidorController::getInfoServidor($user);
        // $servidor = ServidorController::getInfoServidor('sfranca');
        if(!$servidor){
            Auth::logout();
            return redirect()->route('login')->withErrors(['username' => 'Usuário sem avaliações cadastradas.']);
        }
        
        $avaliacoes = app(AvaliacaoServidorController::class)->getAvaliacoes($servidor->id)['avaliacoes'];
        $avaliadorId = $servidor->id;

        return view('home', compact('avaliacoes', 'avaliadorId'));
    }
}
