@extends('layout.quiz')
@section('title', 'Test Huruf Jepang')
@section('4', 'active')
@section('body')
<div class="container">
    <br>
    <h4 class="center bold-text">Test Jenis Huruf {{$huruf}}</h4>
    <br>
    <div class="row">
        <form action="{{ url('/quiz-next') }}" method="POST" id="form">
            @csrf
            <input type="hidden" name="id" value="{{ $soal->id }} ">
            <input type="hidden" name="no" value="{{ $active }} ">
            <div class="col m2 push-m10 s2 offset-s10">
                <div class="green center-align">
                    <span class="white-text" id="time"></span>
                </div>
            </div>
            <div class="col m8 s12 pull-m2">
                <div class="progress green lighten-4">
                    <div class="determinate green lighten-1" style="width: {{$progress}}%"></div>
                </div>
            </div>
            <div class="col s12 m8">
                <div class="card darken-1">
                    <div class="card-content red-text">
                        <span class="card-title center-align" id="soal">{{ $soal->soal }} </span>
                        <input type="text" name="jawab" class="red-text" data-id="{{ $soal->id }}" data-max="{{ $jml}} " value="{{ $soal->jawab }}" autofocus autocomplete="off">
                    </div>
                    <div class="card-action">
                        <a href="{{ url('quiz-huruf')."/$prev" }} "><button type="button" class="btn red lighten-2 waves-effect" id="prev">Sebelumnya</button></a>
                        <button type="submit" class="btn red lighten-2 waves-effect right" id="next">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </form>
        <form action="{{ url('/quiz-huruf/check') }} " method="post">
            @csrf
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center-align">Nomer</span>
                        <ul class="pagination row">
                            @for($i = 1; $i <= $jml; $i++)
                            @if ($i == $active)
                                <li class="waves-effect col active s3"><a href="{{ url('/quiz-huruf').'/'.$i }}">{{ $i}} </a></li>
                            @elseif($soals[$i-1]->jawab == '')
                                <li class="waves-effect col s3"><a href="{{ url('/quiz-huruf').'/'.$i }}" class="red-text">{{ $i}} </a></li>
                            @else
                                <li class="waves-effect col s3"><a href="{{ url('/quiz-huruf').'/'.$i }}" class="green-text">{{ $i}} </a></li>
                            @endif
                            @endfor
                        </ul>
                    </div>
                    <div class="card-action">
                        <button class="btn red lighten-2" id="check">Check</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
</div>
<script>
    $(document).ready(function(){
        var csrf = $('input[name=_token]').val();
        var no = {{ $active }};
        var max = $('input[name=jawab]').data('max');
        var soalan = [];
        if(no<=1){
            $('#prev').addClass('disabled');
        }else if(no>=max){
            $('#next').removeAttr('type').attr('type', 'submit').html('Selesai');
            $('#form').attr('action', "{{ url('/quiz-huruf/check') }}");
        }

        $('input[name=jawab]').keyup(function(){
            var jawab = $(this).val();
            var id = $(this).data('id');
            $.ajax({
                method: 'post',
                url: "{{ url('/quiz-huruf/jawab') }}",
                data: {_token:csrf, jawab:jawab,id:id, no:no},
            });
        });

        var time = {{$time}};
        setInterval(function(){
            time = time - 1;
            var minute = Math.floor((time % 3600)/60);
            var second = Math.floor((time % 60));
            $('#time').text(minute+':'+second);
            $.ajax({
                method: "post",
                url: "{{ url('/time-huruf') }}",
                data: {_token:csrf, time:time}
            });
            if(time == 0){
                $.ajax({
                    method: "post",
                    url: "{{ url('/quiz-huruf/check') }} ",
                    data: {_token:csrf},
                    success: function(){
                        window.location.href = "{{ url('/result-huruf') }}"
                    }
                });
            }
        }, 1000);
    });
</script>
@endsection
