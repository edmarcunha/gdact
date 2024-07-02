<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AvaliacaoServidorController;

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
        $avaliadorId = $request->query('id_servidor_avaliador');
        $avaliacoes = app(AvaliacaoServidorController::class)->getAvaliacoes($request)['avaliacoes'];

        return view('home', compact('avaliacoes', 'avaliadorId'));
    }
}
