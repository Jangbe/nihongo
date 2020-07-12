@extends('layout.main')
@section('title', 'Quizz')
@section('2', 'active')
@section('body')
<div class="container">
    <form action="" method="post">
        @csrf
    </form>
    <h4 class="center-align">Kosakata & Pola Kalimat Bab {{$bab}}</h4>
    <div class="row">
        <div class="col push-m10 m2 sl2">
            <ul class="section table-of-contents">
              <li><a href="#kotoba">Kosakata</a></li>
              <li><a href="#pola">Pola Kalimat</a></li>
              <li><a href="#contoh">Contoh Kalimat</a></li>
              <li><a href="#cakap">Percakapan</a></li>
            </ul>
        </div>
        <div class="col m10 pull-m2 s12">
            <div class="section scrollspy" id="kotoba">
                <table class="mt-4 striped centered">
                    <thead>
                        <tr class="red lighten-2 white-text ">
                            <th>No</th>
                            <th>Huruf</th>
                            @if (in_array('kanji', $set))
                                <th>Kanji </th>
                            @endif
                            @if (in_array('romaji', $set))
                                <th>Romaji </th>
                            @endif
                            <th>Arti</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @for ($i = 0; $i < count($data); $i++)
                            <tr>
                                <td>{{ $i + 1 }} </td>
                                <td>{{ $data[$i]->huruf }} </td>
                                @if (in_array('kanji', $set))
                                <td>{{ $data[$i]->kanji }} </td>
                                @endif
                                @if (in_array('romaji', $set))
                                <td>{{ $data[$i]->romaji }} </td>
                                @endif
                                @if ($data[$i]->keterangan)
                                    <td> <span class="tooltipped" data-position="top" data-tooltip="{{ $data[$i]->keterangan }} "> {{ $data[$i]->arti }} </span> </td>
                                @else
                                    <td>{{ $data[$i]->arti }}</td>
                                @endif
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <ul class="pagination center-align">
                    @for ($i = 1; $i <= $jml; $i++)
                    @if ($i == 1)
                    <li class="active waves-effect {{ $i }}"><a href="#!" data-id="{{ $i}} ">{{ $i }} </a></li>
                    @else
                    <li class="waves-effect {{ $i }}"><a href="#!" data-id="{{ $i}} ">{{ $i }} </a></li>
                    @endif
                    @endfor
                </ul>
            </div>
            <br>
            <div class="switch">
                <h6>Terjemahan</h6>
                <label>
                  Off
                  <input type="checkbox">
                  <span class="lever"></span>
                  On
                </label>
              </div>
              <h5 class="center-align">Pola Kalimat</h5>
            <div class="section scrollspy" id="pola">
                @for ($i = 1; $i <= count($pola); $i++)
                    @if ($pola[$i-1])
                        <h6>{{$i}}. {{$pola[$i-1]->pola}} </h6>
                    @endif
                @endfor
            </div>
            <h5 class="center-align">Contoh Kalimat</h5>
            <div class="section scrollspy" id="contoh">
                @for ($i = 1; $i <= count($contoh); $i++)
                    @if ($contoh[$i-1])
                        <h6>{{$i}}. {{$contoh[$i-1]->tanya}}</h6>
                        <h6>......{{$contoh[$i-1]->jawab}}</h6>
                    @endif
                @endfor
            </div>
            <div class="section scrollspy" id="cakap">
                <h5 class="center-align">Percakapan</h5>
                @if ($cakap)
                <h6 class="center-align" id="judul">{{$cakap[0]['judul'][0]}} </h6>
                <div class="row" id="kaiwa">
                    @for ($i = 1; $i <= count($cakap); $i++)
                        <div class="col s2">
                            <h6>{{$cakap[$i-1]['cakap'][0]}} </h6>
                        </div>
                        <div class="col s10">
                            <h6>{{$cakap[$i-1]['cakap'][1]}} </h6>
                        </div>
                    @endfor
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<br>
@php
    $set = implode('-', $set);
@endphp
<script>
    $(document).ready(function(){
        var set = "{{$set}}";
        var csrf = $('input[name=_token]').val();
        var bab = {{ $bab }};
        var aktif = 1;

        function terjemah(pola, contoh, cakap){
            $.ajax({
                method: 'post',
                url: "{{ url('/terjemah') }}",
                data: {_token:csrf, bab:bab, pola:pola, contoh:contoh,cakap:cakap},
                success: function(result) {
                    //untuk pola kalimat
                    $('#pola').empty();
                    $('#contoh').empty();
                    $('#kaiwa').empty();
                    var tpola = result.pola;
                    for(i=1;i<=tpola.length;i++){
                        if(pola == 'terjemah'){
                            $('#pola').append('<h6>'+i+'. '+tpola[i-1].terjemah+' </h6>');
                        }else{
                            $('#pola').append('<h6>'+i+'. '+tpola[i-1].pola+' </h6>');
                        }
                    }

                    //untuk contoh kalimat
                    var tcontoh = result.contoh;
                    for(i=1;i<=tcontoh.length;i++){
                        if(contoh == 'artanya,arjawab'){
                            $('#contoh').append('<h6>'+i+'. '+tcontoh[i-1].artanya+'</h6><h6>......'+tcontoh[i-1].arjawab+'</h6>');
                        }else{
                            $('#contoh').append('<h6>'+i+'. '+tcontoh[i-1].tanya+'</h6><h6>......'+tcontoh[i-1].jawab+'</h6>');
                        }
                    }

                    //untuk percakapan
                    var tcakap = result.cakap;
                    if (cakap == 'terjemah') {
                        $('#judul').html(tcakap[0].judul[1]);
                    }else{
                        $('#judul').html(tcakap[0].judul[0]);
                    }

                    for(i=1;i<=tcakap.length;i++){
                        $('#kaiwa').append('<div class="col s2"><h6>'+tcakap[i-1].cakap[0]+' </h6></div><div class="col s10"><h6>'+tcakap[i-1].cakap[1]+' </h6></div>');
                    }
                }
            });
        }

        $('input[type=checkbox]').change(function(){
            aktif++;
            if(aktif % 2 == 0){
                terjemah('terjemah', 'artanya,arjawab', 'terjemah');
            }else{
                terjemah('pola', 'tanya,jawab', 'percakapan');
            }
        });

        $('a, #page').click(function() {
            var id = $(this).data('id');
            $('.waves-effect').removeClass('active');
            $('.'+id).addClass('active');
            console.log(id);
            $.ajax({
                method: 'post',
                url: "{{ url('/pagination') }} ",
                data: {_token:csrf, hal:id, limit:5, bab:bab, set:set},
                success: function(hasil){
                    var no = 1;

                    $('#tbody').empty();
                    $.each(hasil, function(k,v){
                        if (v.kanji || v.kanji == '') {
                            var kanji = '<td>'+v.kanji+'</td>';
                        }else{ var kanji = '';}
                        if (v.romaji) {
                            var romaji = '<td>'+v.romaji+'</td>';
                        }else{var romaji = '';}
                        if(v.keterangan){
                            var arti = '<span class="tooltipped" data-position="top" data-tooltip="'+v.keterangan+'"> '+v.arti+' </span>';
                        }else{
                            var arti = v.arti;
                        }
                        $('#tbody').append('<tr><td>' + no + ' </td><td>'+v.huruf+' </td>'+kanji+romaji+'<td>'+arti+' </td></tr>');
                        no++;
                    });
                    $('.tooltipped').tooltip();
                }
            });
        });
        $('.tooltipped').tooltip();
    });
</script>
@endsection
