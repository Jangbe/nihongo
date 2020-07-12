@extends('layout.main')
@section('title', 'Quizz')
@section('3', 'active')
@section('body')
<div class="container">
    <h5 class="center-align">Pilih Quizz yang anda mau coba!</h5>
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col m7 s12">
                <h6>Pilih Bab :</h6>
                <ul class="collection">
                @for($i = 1; $i <= $total; $i++)
                    <li class="collection-item">
                        <label>
                            @if ($i == 1)
                                <input name="bab" type="radio" value="{{ $i }}" checked>
                            @else
                                <input name="bab" type="radio" value="{{ $i }}">
                            @endif
                            <span>Quiz kotoba bab {{$i}} </span>
                        </label>
                    </li>
                    @endfor
                </ul>
            </div>
            <div class="col m5 s12">
                <h6>Pilih Jenis Huruf :</h6>
                <ul class="collection">
                    <li class="collection-item">
                        <label>
                            <input name="huruf" type="radio" value="k" checked>
                            <span>Kanji</span>
                        </label>
                    </li>
                    <li class="collection-item">
                        <label>
                            <input name="huruf" type="radio" value="h">
                            <span>Hiragana / Katakana</span>
                        </label>
                    </li>
                    <li class="collection-item">
                        <label>
                            <input name="huruf" type="radio" value="r">
                            <span>Romaji</span>
                        </label>
                    </li>
                </ul>
                <h6>Pilih Durasi Waktu :</h6>
                <ul class="collection">
                    <li class="collection-item">
                        <label>
                            <input name="waktu" type="radio" value="10" checked>
                            <span>5 menit</span>
                        </label>
                    </li>
                    <li class="collection-item">
                        <label>
                            <input name="waktu" type="radio" value="15">
                            <span>10 menit</span>
                        </label>
                    </li>
                    <li class="collection-item">
                        <label>
                            <input name="waktu" type="radio" value="20">
                            <span>15 menit</span>
                        </label>
                    </li>
                    <li class="collection-item">
                        <label>
                            <input name="waktu" type="radio" value="0">
                            <span>20 menit</span>
                        </label>
                    </li>
                </ul>
                <button type="submit" class="btn col m12 s12">Next</button>
            </div>
        </div>
    </form>
</div>
@endsection
