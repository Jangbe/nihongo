@extends('layout.admin')
@section('title', 'Tambah Pola Kalimat')
@section('body')
<div class="container">
    <form action="" method="post">
        @csrf
        <h5 class="center-align">Pola Kalimat</h5>
        <div class="row">
            <div class="input-field col m4 s5">
                <label for="jumlah">Tambah Pola Kalimat</label>
                <input type="number" class="pola" value="2" min="1">
            </div>
            <div class="input-field col s5 offset-s2">
                <select name="bab">
                  <option disabled selected>Pilihan Bab</option>
                  @for($i = 1; $i <= 25; $i++)
                  <option value="{{$i}} ">Bab {{$i}} </option>
                  @endfor
                </select>
                <label>Pilih Bab</label>
            </div>
        </div>
        <div class="row" id="pola">
            <div class="col m6 s12" id="1">
                <div class="card">
                    <div class="card-content white-text">
                        <h6 class="red-text">No 1</h6>
                        <div class="input-field">
                            <label for="kal">Kalimat</label>
                            <input type="text" id="kal" name="kalimat[]" autofocus>
                        </div>
                        <div class="input-field">
                            <label for="arti">Arti</label>
                            <input type="text" id="arti" name="arti[]">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col m6 s12" id="pola2">
                <div class="card">
                    <div class="card-content white-text">
                        <h6 class="red-text">No 2</h6>
                        <div class="input-field">
                            <label for="kal2">Kalimat</label>
                            <input type="text" id="kal2" name="kalimat[]">
                        </div>
                        <div class="input-field">
                            <label for="arti2">Terjemah kalimat</label>
                            <input type="text" id="arti2" name="arti[]">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="center-align">Contoh Kalimat</h5>
        <div class="row">
            <div class="input-field col m4 s5">
                <label for="jumlah">Tambah Contoh Kalimat</label>
                <input type="number" class="contoh" value="5" min="1">
            </div>
        </div>
        <div class="row" id="contoh">

        </div>
        <h5 class="center-align">Percakapan</h5>
        <div class="row">
            <div class="col s6">
                <div class="input-field">
                    <label for="judul">Judul</label>
                    <input type="text" id="judul" name="judul">
                </div>
            </div>
            <div class="col s6">
                <div class="input-field">
                    <label for="tjudul">Terjemah Judul</label>
                    <input type="text" id="tjudul" name="tjudul">
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content white-text">
                        <div class="row">
                            <div class="col s6"><br>
                                <h6 class="red-text">Bahasa Jepangnya</h6>
                            </div>
                            <div class="input-field col s6">
                                <input type="number" class="cakap" value="2" min="2">
                            </div>
                        </div>
                        <div class="row" id="cakap">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content white-text">
                        <div class="row">
                            <div class="col s12"><br>
                                <h6 class="red-text center-align">Terjermahanya</h6><br>
                            </div>
                        </div>
                        <div class="row" id="terjemah">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button class="btn col s12">Tambahkan</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        //untuk pola kalimat
        var pola = $('.pola').val();
        if(pola > 2){
            for (let i = 3; i <= pola; i++) {
                $('#row').append(templatePola(i));
            }
        }else if(pola < 2){
            $('#pola2').remove();
        }
        function templatePola(id){
            return '<div class="col m6 s12" id="pola'+id+'"><div class="card"><div class="card-content white-text"><h6 class="red-text">No '+id+'</h6><div class="input-field"><label for="kal'+id+'">Kalimat</label><input type="text" id="kal'+id+'" name="kalimat[]"></div><div class="input-field"><label for="arti'+id+'">Terjemah kalimat</label><input type="text" id="arti'+id+'" name="arti[]"></div></div></div></div>';
        }
        $('.pola').change(function(){
            var a = $(this).val();
            if(pola < a){
                for (let i = pola; i < a; i++) {
                    pola++;
                    $('#pola').append(templatePola(pola));
                }
            }else{
                for(let b = pola; b > a; b--){
                    $('#pola'+b).remove();
                }
                pola = a;
            }
        });

        //untuk contoh kalimat
        var contoh = $('.contoh').val();
        for (let a = 1; a <= 5; a++) {
            $('#contoh').append(templatecontoh(a));
        }
        if(contoh > 5){
            for (let i = 6; i <= contoh; i++) {
                $('#contoh').append(templatecontoh(i));
            }
        }else if(contoh < 5){
            for (let i = 4; i >= contoh; i--) {
                $('#contoh'+i).remove();
            }
        }else{}

        function templatecontoh(id){
            return '<div class="col m6 s12" id="contoh'+id+'"><div class="card"><div class="card-content white-text"><h6 class="red-text">No '+id+' </h6><div class="input-field"><label for="tanya'+id+'">Tanya</label><input type="text" id="tanya'+id+'" name="tanya[]"></div><div class="input-field"><label for="jawab'+id+'">Jawab</label><input type="text" id="jawab'+id+'" name="jawab[]"></div><div class="input-field"><label for="artanya'+id+'">Terjemah tanya</label><input type="text" id="artanya'+id+'" name="artanya[]"></div><div class="input-field"><label for="arjawab'+id+'">Terjemah jawab</label><input type="text" id="arjawab'+id+'" name="arjawab[]"></div></div></div></div>';
        }
        $('.contoh').change(function(){
            var a = $(this).val();
            if(contoh < a){
                for (let i = contoh; i < a; i++) {
                    contoh++;
                    $('#contoh').append(templatecontoh(contoh));
                }
            }else{
                for(let b = contoh; b > a; b--){
                    $('#contoh'+b).remove();
                }
                contoh = a;
            }
        });

        //Untuk percakapan
        var cakap = $('.cakap').val();
        for (let a = 1; a <= 2; a++) {
            $('#cakap').append(templatecakap(a, 'nama', 'cakap'));
            $('#terjemah').append(templatecakap(a, 'arnama', 'arcakap'));
        }
        if(cakap > 2){
            for (let i = 3; i <= cakap; i++) {
                $('#cakap').append(templatecakap(i, 'nama', 'cakap'));
                $('#terjemah').append(templatecakap(i, 'arnama', 'arcakap'));
            }
        }else if(cakap < 2){
            for (let i = 1; i >= cakap; i--) {
                $('.cakap'+i).remove();
            }
        }

        function templatecakap(id, nama, cakap){
            return '<div class="input-field col s3 '+cakap+id+'"><label for="'+nama+id+'">Nama</label><input type="text" id="'+nama+id+'" name="'+nama+'[]"></div><div class="input-field col s9 '+cakap+id+'"><label for="'+cakap+id+'">Percakapan</label><input type="text" id="'+cakap+id+'" name="'+cakap+'[]"></div>';
        }
        $('.cakap').change(function(){
            var a = $(this).val();
            if(cakap < a){
                for (let i = cakap; i < a; i++) {
                    cakap++;
                    $('#cakap').append(templatecakap(cakap, 'nama', 'cakap'));
                    $('#terjemah').append(templatecakap(cakap, 'arnama', 'arcakap'));
                }
            }else{
                for(let b = cakap; b > a; b--){
                    $('.cakap'+b).remove();
                    $('.arcakap'+b).remove();
                }
                cakap = a;
            }
        });

    });
</script>
@endsection
