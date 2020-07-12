@extends('layout.main')
@section('title', 'Hasil Quizz')
@section('4', 'active')
@section('body')
<div class="container">
<h5 class="center-align">Hasil Test Huruf Jepang Anda</h5>
<span>benar {{ $benar.'/'.$jml }} </span>
<div class="progress red lighten-2">
    <div class="determinate green" style="width: {{$progress}}%"></div>
</div>
<br>
<ul class="collection with-header">
    @foreach($hasil as $hsl)
    @if($hsl['jawab'] == $hsl['benar'])
        <li class="collection-item "><div class="green-text">{{ $hsl['soal']}} <span class="secondary-content green-text">{{ $hsl['jawab'] }} </span></div></li>
    @elseif($hsl['jawab'] == '')
        <li class="collection-item "><div class="red-text">{{ $hsl['soal']}} <span class="secondary-content red-text"><i>tidak diisi</i></span></div></li>
    @else
        <li class="collection-item "><div class="red-text">{{ $hsl['soal']}} <span class="secondary-content red-text">{{ $hsl['jawab'] }} </span></div></li>
    @endif
    @endforeach
</ul>
<div>
    <a href="{{ url('/')}} "><button class="btn waves-effect">Kembali</button></a>
    <a href="{{ url('/prequiz-huruf')}} "><button class="btn waves-effect right">Lagi</button></a>
</div>
</div>
<br>
@endsection
