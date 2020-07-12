<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\HttpFoundation\Response;
use Cookie;

class Kotoba extends Model
{
    protected $guarded = 'id';
    public static function reset($request){
        $cookie = $request->cookie('soal', '', -60);
        return response('benar')->cookie($cookie);
    }
}
