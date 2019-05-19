<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        //primero vamos a usar auth()->check para verificar que el usuario ha iniciado sesión este metodo auth()->check() nos permite saber si un usuario ha iniciado sesión o no
        if(!auth()->user()->admin){
            //en caso de que el usuario no se administrador lo redirigiremos a la ruta de inicio de sesión
            return redirect('/');
        }
        return $next($request);
    }
}
