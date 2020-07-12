<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nihongo - @yield('title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/materialize.css') }}">
    <script type="text/javascript" src="{{ url('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/materialize.js') }}"></script>
</head>
<body>
<div class="navbar-fixed">
    <nav class="blue">
        <div class="nav-wrapper container">
            <a href="{{ url('/admin')}} " class="brand-logo"> 日本語</a>
            <a href="#" class="sidenav-trigger" data-target="sidenav"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li class="@yield('1')"><a href="{{ url('/admin')}} ">Beranda</a></li>
                <li class="@yield('2')"><a href="{{ url('/addkotoba')}}">Tambah Kosakata</a></li>
                <li class="@yield('3')"><a href="{{ url('/addpola')}}">Tambah Pola Kalimat</a></li>
                <li><a href="{{ url('/logout')}}">Logout</a></li>
            </ul>
        </div>
    </nav>
</div>
<ul class="sidenav" id="sidenav">
    <li class="@yield('1')"><a href="{{ url('/admin ')}} ">Beranda</a></li>
    <li class="@yield('2')"><a href="{{ url('/addkotoba')}}">Tambah Kosakata</a></li>
    <li class="@yield('3')"><a href="{{ url('/addpola')}}">Tambah Pola Kalimat</a></li>
    <li><a href="{{ url('/logout')}}">Logout</a></li>
</ul>
@yield('body')
<footer class="page-footer blue">
    <div class="container">
        <div class="row">
            <div class="col s12 l6">
                <h5>Please Support me!</h5>
            </div>
            <div class="col s12 l6">
                <h5>Contact Us</h5>
            </div>
            <div class="col s6 l6 offset-l6">
                <p>Fb: <a href="https://web.facebook.com/devi.mulyana.796" class="white-text">Jangbe</a> <br>
                Wa: 08979394991</p>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            &copy; 2020 Nihongo, All right reserved
        </div>
    </div>
</footer>
<script>
    $(document).ready(function(){
        $('.sidenav').sidenav();
        $('.parallax').parallax();
        $('select').formSelect();
        $('.scrollspy').scrollSpy();
    });
</script>
</body>
</html>
