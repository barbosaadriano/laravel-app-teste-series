<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;

class SelecionarEmpresa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('empresa') &&
            !$this->selectIfOne()) {
            return redirect('/empresas/selecionar');
        }
        return $next($request);
    }

    public function selectIfOne():bool
    {
        $user = auth()->user();
        if ($user->empresasGerenciadas->count()==1) {
            session()->put('empresa',$user->empresasGerenciadas[0]);
            return true;
        }
        return false;
    }
}
