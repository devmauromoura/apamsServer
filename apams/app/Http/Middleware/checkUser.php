<?php

namespace ApamsServer\Http\Middleware;

use Closure;
use ApamsServer\User;
use Auth;

class checkUser
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
        if (Auth::user()->active == 1){
            return $next($request);
        }else {
            return redirect('/home')->with('msg', 'Seu cadastro não está ativo,  contate um administrador!');
        }
    }

}
