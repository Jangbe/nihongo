@extends('layout.main')
@section('title', 'Kosakata & Pola Kalimat')
@section('2', 'active')
@section('body')
<div class="container">
    <br>
    <h5 class="center-align">Pilih Bab Pembelajaran</h5><br>
    <div class="row">
        <form action="{{ url('/polakalimat') }} " method="post">
        @csrf
        <div class="col m4 s12 push-m8">
            <div class="collection">
                <div class="collection-item">
                    <label>
                        <input type="checkbox" class="filled-in" checked="checked" name="set[]" value="huruf" disabled />
                        <span>Hiragana / Katakana</span>
                    </label>
                </div>
                <div class="collection-item">
                    <label>
                        <input type="checkbox" class="filled-in" checked="checked" name="set[]" value="kanji" />
                        <span>Kanji</span>
                    </label>
                </div>
                <div class="collection-item">
                    <label>
                        <input type="checkbox" class="filled-in" checked="checked" name="set[]" value="romaji" />
                        <span>Romaji</span>
                    </label>
                </div>
                <div class="collection-item">
                    <label>
                        <input type="checkbox" class="filled-in" checked="checked" name="set[]" value="arti" disabled />
                        <span>Arti</span>
                    </label>
                </div>
            </div>
            <button class="btn waves-effect col s12 hide-on-small-only">Next</button>
        </div>
        <div class="col m8 s12 pull-m4">
            <div class="collection">
                @for($i = 1; $i <= $total; $i++)
                @if ($i == 1)
                <div class="collection-item"><label> <input type="radio" checked name="bab" value="{{$i}} "> <span>Pembelajaran Bab {{$i}}</span> </label></div>
                @else
                <div class="collection-item"><label> <input type="radio" name="bab" value="{{$i}} "> <span>Pembelajaran Bab {{$i}}</span> </label></div>
                @endif
                @endfor
            </div>
        </div>
        <div class="col s12 hide-on-med-and-up">
            <button class="btn waves-effect col s12">Next</button>
        </div>
        </form>
    </div>
<br>
</div>
@endsection
