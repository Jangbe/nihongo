<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/materialize.css') }}">
    <script type="text/javascript" src="{{ url('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/materialize.js') }}"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col s12 push-m3 m6">
            <h2 class="header center-align">@yield('name')</h2>
            <div class="card horizontal">
                <div class="card-stacked">
                    <div class="card-content">
                        @yield('body')
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
