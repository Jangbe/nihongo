<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kotoba;
use Illuminate\Support\Facades\DB;

class AdminsController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function store()
    {
        return view('admin.add');
    }

    public function create(Request $post)
    {
        if($post->bab != null){
            for($a = 0; $a < count($post->huruf); $a++){
                $kanji = ($post->kanji[$a] != null)? $post->kanji[$a] : '';
                $data = [
                    'bab' => $post->bab,
                    'huruf' => $post->huruf[$a],
                    'kanji' => $kanji,
                    'romaji' => $post->romaji[$a],
                    'arti' => $post->arti[$a]
                ];
                Kotoba::insert($data);
            }
            return view('admin.add');
        }else{
            return redirect('/addkotoba');
        }
    }

    public function addpola()
    {
        return view('admin.addpola');
    }

    public function createpola(Request $post)
    {
        // dd($post->arti);
        if($post->bab != null){
            //untuk database pola_kalimats
            for($a = 0; $a < count($post->kalimat); $a++){
                $pola = [
                    'bab' => $post->bab,
                    'pola' => $post->kalimat[$a],
                    'terjemah' => $post->arti[$a]
                ];
                DB::table('pola_kalimats')->insert($pola);
            }

            //untuk database contoh_kalimats
            for($a = 0; $a < count($post->tanya); $a++){
                $contoh = [
                    'bab' => $post->bab,
                    'tanya' => $post->tanya[$a],
                    'jawab' => $post->jawab[$a],
                    'artanya' => $post->artanya[$a],
                    'arjawab' => $post->arjawab[$a]
                ];
                DB::table('contoh_kalimats')->insert($contoh);
            }

            //untuk database percakapans
            for($a = 0; $a < count($post->nama); $a++){
                $cakap = [
                    'bab' => $post->bab,
                    'judul' => $post->judul.'-'.$post->tjudul,
                    'percakapan' => $post->nama[$a].':'.$post->cakap[$a],
                    'terjemah' => $post->arnama[$a].':'.$post->arcakap[$a]
                ];
                DB::table('percakapans')->insert($cakap);
            }

            return redirect('/prepolakalimat');
        }else{
            return redirect('/addpola');
        }
    }
}
