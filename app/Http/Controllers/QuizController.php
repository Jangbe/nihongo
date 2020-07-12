<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use function GuzzleHttp\json_decode;

class QuizController extends Controller
{
    public function prequiz()
    {
        $result = DB::table('huruf')->get();
        $data['no'] = [1,6,11,16,21,26,31,36,37,38,39,44,45,46];
        $data['ket'] = ['A','K','S','T','N','H','M','Y','R','W'];
        $no = 0;
        $data['result'] = [];
        $kosong = (object) ['hiragana'=>'','katakana'=>'','romaji'=>''];
        $data['result'][] = [$result[0],$result[1],$result[2],$result[3],$result[4]];
        $data['result'][] = [$result[5],$result[6],$result[7],$result[8],$result[9]];
        $data['result'][] = [$result[10],$result[11],$result[12],$result[13],$result[14]];
        $data['result'][] = [$result[15],$result[16],$result[17],$result[18],$result[19]];
        $data['result'][] = [$result[20],$result[21],$result[22],$result[23],$result[24]];
        $data['result'][] = [$result[25],$result[26],$result[27],$result[28],$result[29]];
        $data['result'][] = [$result[30],$result[31],$result[32],$result[33],$result[34]];
        $data['result'][] = [$result[35],$kosong,$result[36],$kosong,$result[37]];
        $data['result'][] = [$result[38],$result[39],$result[40],$result[41],$result[42]];
        $data['result'][] = [$result[43],$kosong,$result[44],$kosong,$result[45]];
        return view('quiz.prequiz-huruf', $data);
    }

    public function setquiz(Request $request)
    {
        $result = DB::table('huruf')->get();
        $raw = [];
        foreach($result as $rsl){
            if($request->huruf == 'h'){
                $raw[] = ['id' => $rsl->id, 'soal' => $rsl->hiragana, 'jawab' => ''];
            }else{
                $raw[] = ['id' => $rsl->id, 'soal' => $rsl->katakana, 'jawab' => ''];
            }
        }
        shuffle($raw);
        $time = cookie('time_huruf', $request->waktu * 60, 30);
        $soal = cookie('huruf', json_encode($raw), 30);
        $type = ($request->huruf == 'h')? 'Hiragana' : 'Katakana';
        $type = cookie('type', $type, $request->waktu);
        return response(redirect('/quiz-huruf'))->cookie($soal)->cookie($time)->cookie($type);
    }

    public function quiz(Request $request, $no = 1)
    {
        $hasil = json_decode($request->cookie('huruf'));
        $data['jml'] = count($hasil);
        $no = ($no > 0)? $no : 1;
        $data['soal'] = $hasil[$no - 1];
        $data['soals'] = $hasil;
        $data['active'] = $no;
        $data['prev'] = $no - 1;
        $data['next'] = $no + 1;
        $data['progress'] = ($no / $data['jml'] * 100);
        $data['time'] = $request->cookie('time_huruf');
        $data['huruf'] = $request->cookie('type');
        return view('quiz.quiz-huruf', $data);
    }

    public function next(Request $request)
    {
        $no = $request->no;
        $hasil = $request->cookie('huruf');
        $hasil = json_decode($hasil);
        $data['jml'] = count($hasil);
        $data['soal'] = $hasil[$no];
        $data['soals'] = $hasil;
        $data['active'] = $no+1;
        $data['prev'] = $no;
        $data['progress'] = ($no / $data['jml'] * 100);
        $data['time'] = $request->cookie('time_huruf');
        $data['huruf'] = $request->cookie('type');
        return view('quiz.quiz-huruf', $data);
    }

    public function jawab(Request $data)
    {
        $soal = json_decode($data->cookie('huruf'));
        $no = $data->no - 1;
        $soal[$no]->jawab = $data->jawab;
        $cookie = cookie('huruf', json_encode($soal));
        return response($soal)->cookie($cookie);
    }

    public function check(Request $request)
    {
        $soal = DB::table('huruf')->get();
        $jawab = json_decode($request->cookie('huruf'));
        $benar = 0;
        foreach($soal as $sl){
            for($i = 0; $i < count($jawab); $i++){
                if($sl->id == $jawab[$i]->id){
                    if($sl->romaji == strtolower($jawab[$i]->jawab)){
                        $benar++;
                    }
                }
            }
        }
        $cookie = cookie('hasil_huruf', $benar, 30);
        return response(redirect('/result-huruf'))->cookie($cookie);
    }

    public function result(Request $request)
    {
        $hasil = [];
        if($request->hasCookie('hasil_huruf') && $request->hasCookie('huruf')){
            $data['benar'] = $request->cookie('hasil_huruf');
            $soal = DB::table('huruf')->get();
            $jawab = json_decode($request->cookie('huruf'));
            foreach($jawab as $jwb){
                for($i = 0; $i < count($soal); $i++){
                    if($jwb->id == $soal[$i]->id){
                        $hasil[] = ['soal' => $jwb->soal, 'jawab' => $jwb->jawab, 'benar' => $soal[$i]->romaji];
                    }
                }
            }
            $data['hasil'] = $hasil;
            $data['progress'] = $data['benar'] / count($jawab) * 100;
            $data['jml'] = count($jawab);
            $cookie = cookie('huruf', '', -60);
            $benar = cookie('hasil_huruf', '', -60);
            $time = cookie('time_huruf', '', -60);
            $type = cookie('type', '', -60);
            return response(view('quiz.hasil',  $data))->cookie($cookie)->cookie($benar)->cookie($time)->cookie($type);
        }else{
            return redirect('/quiz-huruf');
        }
    }

    public function time(Request $request)
    {
        $time = $request->time;
        $cookie = cookie('time_huruf', $time, 30);
        return response('berhasil')->cookie($cookie);
    }
}
