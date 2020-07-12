<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;

class Soal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $opsi)
    {
        if($opsi == 'next'){
            if($request->hasCookie('huruf')){
                return $next($request);
            }
            return redirect('/prequiz-huruf');
        }else{
            if($request->hasCookie('huruf')){
                return redirect('/quiz-huruf');
            }
            return $next($request);
        }
    }
}
