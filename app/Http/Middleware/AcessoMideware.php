<?php

namespace App\Http\Middleware;
use Auth;
use App\User;
use Closure;
use Illuminate\Support\Facades\Hash;



class AcessoMideware
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

        if(Auth::user()->admpanel == 1){
            
            return $next($request);

        } else{
            Auth::logout();
            return redirect()->back()->with('error', 'Você não tem acesso a este Painel! Por favor, contate o administrador.');

        }
    }
}
