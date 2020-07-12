@extends('layout.main')
@section('title', 'Beranda')
@section('1', 'active')
@section('body')
<div class="parallax-container">
    <div class="parallax"><img src="{{ url('img/parallax1.jpg') }}"></div>
</div>
<div class="section white">
    <div class="row container">
        <h4 class="header center-align">みんな　の　日本語</h4>
        <h5><b>Kata Pengantar</b></h5>
        <p class="grey-text text-darken-3 lighten-3">Sesuai dengan judulnya yaitu "<b><i>Minna no Nihongo</i></b>", web ini diambil dari buku "<b><i>Minna no Nihongo</i></b>" yang dirancang serta disusun dalam waktu tiga tahun lebih, agar setiap pelajar pemula bahasa Jepang dapat belajar bahasa Jepang dengan senang hati dan untuk para pengajar dapat mengajarkannya dengan menarik pula.</p>
    </div>
</div>
<div class="parallax-container">
    <div class="parallax"><img src="{{ url('img/parallax2.jpg') }}"></div>
</div>
@endsection
