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
    <nav>
        <div class="nav-wrapper container">
            <a class="brand-logo"> 日本語</a>
            <a href="#" class="sidenav-trigger" data-target="sidenav"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">

            </ul>
        </div>
    </nav>
</div>
<ul class="sidenav" id="sidenav">

</ul>
@yield('body')
<footer class="page-footer">
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
