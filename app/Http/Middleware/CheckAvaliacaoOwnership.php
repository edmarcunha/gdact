<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\AvaliacaoServidor;

class CheckAvaliacaoOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $avaliacao = AvaliacaoServidor::findOrFail($request->id);

        // // Verifique se o usuário autenticado tem permissão para acessar esta avaliação
        // if ($avaliacao->avaliador->login !== Auth::user()->getFirstAttribute('samaccountname')) {
            if ('ecfreitas' !== Auth::user()->getFirstAttribute('samaccountname')) {
            abort(403, 'Acesso Negado');
        }

        return $next($request);
    }
}
