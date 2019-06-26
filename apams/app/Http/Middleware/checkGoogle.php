<?php

namespace ApamsServer\Http\Middleware;

use Closure;
use Auth;

class checkGoogle
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
        if(Auth::user()->google == 1){
            return $next($request);
        }
        else {
            return redirect('/home')->with('msg', 'Apenas usuários vinculados ao Google podem realizar essa ação!');
        }


    }
}
