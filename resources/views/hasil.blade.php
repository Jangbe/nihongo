@extends('layout.main')
@section('title', 'Hasil Quizz')
@section('3', 'active')
@section('body')
<div class="container">
<h5 class="center-align">Hasil Quiz Kotoba Anda</h5>
<span>benar {{ $benar.'/'.$jml }} </span>
<div class="progress red lighten-2">
    <div class="determinate green" style="width: {{$progress}}%"></div>
</div>
<br>
<ul class="collection with-header">
    @foreach($hasil as $hsl)
    @if(in_array(strtolower($hsl['jawab']), $hsl['benar']))
        <li class="collection-item green lighten-2"><div class="white-text">{{ $hsl['soal']}} <span class="secondary-content white-text">{{ $hsl['jawab'] }} </span></div></li>
    @elseif($hsl['jawab'] == '')
        <li class="collection-item red lighten-2"><div class="white-text">{{ $hsl['soal']}} <span class="secondary-content white-text"><i>tidak diisi</i></span></div></li>
    @else
        <li class="collection-item red lighten-2"><div class="white-text">{{ $hsl['soal']}} <span class="secondary-content white-text">{{ $hsl['jawab'] }} </span></div></li>
    @endif
    @endforeach
</ul>
<div>
    <a href="{{ url('/')}} "><button class="btn waves-effect">Kembali</button></a>
    <a href="{{ url('/prequiz')}} "><button class="btn waves-effect right">Lagi</button></a>
</div>
</div>
<br>
@endsection
