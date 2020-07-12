@extends('layout.admin')
@section('title', 'Add Kotoba')
@section('body')
<div class="container">
    <h4 class="center-align">Tambahkan Kotoba</h4>
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="input-field col s4">
                <label for="jumlah">Tambah Kotoba</label>
                <input type="number" id="jumlah" value="2" min="1">
            </div>
            <div class="input-field col s5 offset-s3">
                <select name="bab">
                  <option disabled selected>Pilihan Bab</option>
                  @for($i = 1; $i <= 25; $i++)
                  <option value="{{$i}} ">Bab {{$i}} </option>
                  @endfor
                </select>
                <label>Pilih Bab</label>
            </div>
        </div>
        <div class="row" id="row">
            <div class="col m6 s12" id="1">
                <div class="card">
                    <div class="card-content white-text">
                        <h6 class="red-text">No 1</h6>
                        <div class="input-field">
                            <label for="huruf">Huruf</label>
                            <input type="text" id="huruf" name="huruf[]" autofocus>
                        </div>
                        <div class="input-field">
                            <label for="kanji">Kanji</label>
                            <input type="text" id="kanji" name="kanji[]">
                        </div>
                        <div class="input-field">
                            <label for="romaji">Romaji</label>
                            <input type="text" id="romaji" name="romaji[]">
                        </div>
                        <div class="input-field">
                            <label for="arti">Arti</label>
                            <input type="text" id="arti" name="arti[]">
                        </div>
                        <div class="input-field">
                            <textarea id="textarea1" class="materialize-textarea" name="ket[]"></textarea>
                            <label for="textarea1">Keterangan Arti</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col m6 s12" id="2">
                <div class="card">
                    <div class="card-content white-text">
                        <h6 class="red-text">No 2</h6>
                        <div class="input-field">
                            <label for="huruf">Huruf</label>
                            <input type="text" id="huruf" name="huruf[]">
                        </div>
                        <div class="input-field">
                            <label for="kanji">Kanji</label>
                            <input type="text" id="kanji" name="kanji[]">
                        </div>
                        <div class="input-field">
                            <label for="romaji">Romaji</label>
                            <input type="text" id="romaji" name="romaji[]">
                        </div>
                        <div class="input-field">
                            <label for="arti">Arti</label>
                            <input type="text" id="arti" name="arti[]">
                        </div>
                        <div class="input-field">
                            <textarea id="textarea1" class="materialize-textarea" name="ket[]"></textarea>
                            <label for="textarea1">Keterangan Arti</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button class="btn waves-effect col s12">Submit</button>
            </div>
        </div>
    </form>
</div>
<br><br><br>
<script>
$(document).ready(function(){
    var jml = $('#jumlah').val();
    if(jml > 2){
        for (let i = 3; i <= jml; i++) {
            $('#row').append(template(i));
        }
    }else if(jml < 2){
        $('#2').remove();
    }
    function template(id){
        return '<div class="col m6 s12" id="'+id+'"><div class="card"><div class="card-content white-text"><h6 class="red-text">No '+id+'</h6><div class="input-field"><label for="huruf">Huruf</label><input type="text" id="huruf" name="huruf[]"></div><div class="input-field"><label for="kanji">Kanji</label><input type="text" id="kanji" name="kanji[]"></div><div class="input-field"><label for="romaji">Romaji</label><input type="text" id="romaji" name="romaji[]"></div><div class="input-field"><label for="arti">Arti</label><input type="text" id="arti" name="arti[]"></div><div class="input-field"><textarea id="textarea1" class="materialize-textarea" name="ket[]"></textarea><label for="textarea1">Keterangan Arti</label></div></div></div></div>';
    }
    $('#jumlah').change(function(){
        var a = $(this).val();
        if(jml < a){
            for (let i = jml; i < a; i++) {
                jml++;
                $('#row').append(template(jml));
            }
        }else{
            for(let b = jml; b > a; b--){
                $('#'+b).remove();
            }
            jml = a;
        }
    });
});
</script>
@endsection
