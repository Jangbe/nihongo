<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kotoba;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\json_decode;

class KotobasController extends Controller
{
    public function huruf()
    {
        $romaji = ['a','i','u','e','o','ka','ki','ku','ke','ko','sa','si','su','se','so','ta','chi','tsu','te','to','na','ni','nu','ne','no','ha','hi','fu','he','ho','ma','mi','mu','me','mo','ya','yu','yo','ra','ri','ru','re','ro','wa','wo','n'];
        $hiragana = ['あ','い','う','え','お','か','き','く','け','こ','さ','し','す','せ','そ','た','ち','つ','て','と','な','に','ぬ','ね','の','は','ひ','ふ','へ','ほ','ま','み','む','め','も','や','ゆ','よ','ら','り','る','れ','ろ','わ','を','ん'];
        $katakana = ['ァ','イ','ウ','エ','オ','カ','キ','ク','ケ','コ','サ','シ','ス','セ','ソ','タ','チ','ツ','テ','ト','ナ','二','ヌ','ネ','ノ','ハ','ヒ','フ','ヘ','ホ','マ','ミ','ム','メ','モ','ヤ','ユ','ヨ','ラ','リ','ル','レ','ロ','ワ','ヲ','ン'];
        for($i = 0; $i < count($romaji); $i++){
            DB::table('huruf')->insert(['hiragana' => $hiragana[$i], 'katakana' => $katakana[$i], 'romaji' => $romaji[$i]]);
        }
    }

    public function prepola()
    {
        $jml = Kotoba::all();
        $total = 0;
        for ($i=0; $i < count($jml); $i++) {
            if ($i != 0) {
                if($jml[$i]->bab != $jml[$i-1]->bab){
                    $total++;
                }
            }
        }
        $data['total'] = $total;
        return view('prepola', $data);
    }

    public function pola(Request $request)
    {
        if(!$request->hasCookie('soal')){
            $data['set'] = [];
            if($request->set != null){
                foreach($request->set as $req){
                    $data['set'][] = $req;
                }
            }
            $data['set'][] = 'arti';
            $data['set'][] = 'huruf';
            $data['set'][] = 'keterangan';
            $data['data'] = Kotoba::where('bab', $request->bab)->select($data['set'])->take(5)->get();
            $data['hal'] = Kotoba::where('bab', $request->bab)->get();
            $data['jml'] = ceil(count($data['hal']) / 5);
            $data['bab'] = $request->bab;
            $data['pola'] = DB::table('pola_kalimats')->where('bab', $request->bab)->get();
            $data['contoh'] = DB::table('contoh_kalimats')->where('bab', $request->bab)->get();
            $cakap = DB::table('percakapans')->where('bab', $request->bab)->get();
            $kaiwa = [];
            foreach($cakap as $ckp){
                $kaiwa[] = ['judul' => explode('-', $ckp->judul), 'cakap' => explode(':', $ckp->percakapan), 'terjemah' => explode(':', $ckp->terjemah)];
            }
            $data['cakap'] = $kaiwa;
            // dd($data);
            return view('polakalimat', $data);
        }else{
            return redirect('/quiz');
        }
    }

    public function terjemah(Request $request)
    {
        $contoh = explode(',', $request->contoh);
        $data['pola'] = DB::table('pola_kalimats')->where('bab', $request->bab)->select([$request->pola])->get();
        $data['contoh'] = DB::table('contoh_kalimats')->where('bab', $request->bab)->select($contoh)->get();
        $cakap = DB::table('percakapans')->where('bab', $request->bab)->select(['judul', $request->cakap])->get();
        $kaiwa = [];
        foreach($cakap as $ckp){
            if($request->cakap == 'terjemah'){
                $kaiwa[] = ['judul' => explode('-', $ckp->judul), 'cakap' => explode(':', $ckp->terjemah)];
            }else{
                $kaiwa[] = ['judul' => explode('-', $ckp->judul), 'cakap' => explode(':', $ckp->percakapan)];
            }
        }
        $data['cakap'] = $kaiwa;
        return $data;
    }

    public function prequiz(Request $data)
    {
        if($data->hasCookie('soal')){
            return redirect('/quiz');
        }else{
            $jml = Kotoba::all();
            $total = 0;
            for ($i=0; $i < count($jml); $i++) {
                if ($i != 0) {
                    if($jml[$i]->bab != $jml[$i-1]->bab){
                        $total++;
                    }
                }
            }
            $data['total'] = $total;
            return view('prequiz', $data);
        }
    }

    public function setquiz(Request $request)
    {
        $hasil = Kotoba::where('bab', $request->bab)->get();
        $a = [];

        if($request->waktu == '10'){
            $minute = 5;
        }else if($request->waktu == '15'){
            $minute = 10;
        }else if($request->waktu == '20'){
            $minute = 15;
        }else{
            $minute = 20;
        }

        foreach ($hasil as $key => $value) {
            if($request->huruf == 'k'){
                if($value->kanji == ''){
                    $a[] = ['id' => $value->id,'soal' => $value->huruf, 'jawab' => ''];
                }else{
                    $a[] = ['id' => $value->id,'soal' => $value->kanji, 'jawab' => ''];
                }
            }else if($request->huruf == 'h'){
                $a[] = ['id' => $value->id,'soal' => $value->huruf, 'jawab' => ''];
            }else{
                $a[] = ['id' => $value->id,'soal' => $value->romaji, 'jawab' => ''];
            }
        }
        shuffle($a);

        if($request->hasCookie('soal')){
            return redirect('/quiz');
        }else{
            $time = cookie('time', ($minute * 60), $minute);
            $cookie = cookie('soal', json_encode($a), $minute);
            // dd($cookie);
            $bab = cookie('bab', $request->bab);
            return response(Redirect('/quiz'))->cookie($cookie)->cookie($time)->cookie($bab);
        }
    }

    public function time(Request $data)
    {
        $time = $data->time;
        $cookie = cookie('time', $time, 30);
        return response('berhasil')->cookie($cookie);
    }

    public function quiz(Request $request, $no = 1)
    {
        if($request->hasCookie('soal')){
            $hasil = $request->cookie('soal');
            $hasil = json_decode($hasil);
            $data['jml'] = count($hasil);
            $no = ($no > 0)? $no : 1;
            $data['soal'] = $hasil[$no - 1];
            $data['soals'] = $hasil;
            $data['active'] = $no;
            $data['prev'] = $no - 1;
            $data['next'] = $no + 1;
            $data['progress'] = ($no / $data['jml'] * 100);
            $data['time'] = $request->cookie('time');
            $data['bab'] = $request->cookie('bab');
            return view('quiz', $data);
        }else{
            return redirect('/prequiz');
        }
    }

    public function next(Request $request)
    {
        $no = $request->no;
        $hasil = $request->cookie('soal');
        $hasil = json_decode($hasil);
        $data['jml'] = count($hasil);
        $data['soal'] = $hasil[$no];
        $data['soals'] = $hasil;
        $data['active'] = $no+1;
        $data['prev'] = $no;
        $data['progress'] = ($no / $data['jml'] * 100);
        $data['time'] = $request->cookie('time');
        $data['bab'] = $request->cookie('bab');
        return view('quiz', $data);
    }

    public function check(Request $data)
    {
        $soal = json_decode($data->cookie('soal'));
        $no = $data->no - 1;
        $soal[$no]->jawab = $data->jawab;
        $cookie = cookie('soal', json_encode($soal));
        return response($soal)->cookie($cookie);
    }

    public function result(Request $request)
    {
        $soal = Kotoba::all();
        $jawab = json_decode($request->cookie('soal'));
        $benar = 0;
        foreach($soal as $sl){
            for($i = 0; $i < count($jawab); $i++){
                if($sl->id == $jawab[$i]->id){
                    $arti = explode(', ', strtolower($sl->arti));
                    if(in_array(strtolower($jawab[$i]->jawab), $arti)){
                        $benar++;
                    }
                }
            }
        }
        $cookie = cookie('hasil', $benar, 30);
        return response(redirect('/result'))->cookie($cookie);
    }

    public function hasil(Request $request)
    {
        $hasil = [];
        if($request->hasCookie('hasil') && $request->hasCookie('soal')){
            $data['benar'] = $request->cookie('hasil');
            $soal = Kotoba::all();
            $jawab = json_decode($request->cookie('soal'));
            foreach($jawab as $jwb){
                for($i = 0; $i < count($soal); $i++){
                    if($jwb->id == $soal[$i]->id){
                        $hasil[] = ['soal' => $jwb->soal, 'jawab' => $jwb->jawab, 'benar' => explode(', ',strtolower($soal[$i]->arti))];
                    }
                }
            }
            $data['hasil'] = $hasil;
            $data['progress'] = $data['benar'] / count($jawab) * 100;
            $data['jml'] = count($jawab);
            $cookie = cookie('soal', '', -60);
            $benar = cookie('hasil', '', -60);
            $time = cookie('time', '', -60);
            $bab = cookie('bab', '', -60);
            return response(view('hasil',  $data))->cookie($cookie)->cookie($benar)->cookie($time)->cookie($bab);
        }else{
            return redirect('/quiz');
        }
    }

    public function page(Request $request)
    {
        $limit = $request->limit;
        $hal = $request->hal;
        $hal = ($hal>1) ? ($hal * $limit) - $limit : 0;
        $set = explode('-', $request->set);
        $hasil = Kotoba::where('bab', $request->bab)->select($set)->take($limit)->skip($hal)->get();
        return $hasil;
    }
}
