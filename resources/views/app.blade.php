<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}"/>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">

    <script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>

    <title>Utargowo</title>
</head>
<body style="background-color: #e8daef; height: 100%; min-height: 100%;">

<div class="container-fluid navbar-contener" style="background-color: #21064C; ">
    @include('front.navbar')
</div>

<div class="container-fluid" style="padding-top: 120px; background-color: #d8c1e1; position: relative; min-height: 80%; padding-bottom: 30px;">
    <div class="col-xs-12">
        @yield('content')
    </div>
</div>
<div id="flash">
    @include('flash::message')
</div>
<footer class="container-fluid" style="min-height: 20%; bottom: 0px;">
    @include('front.footer')
</footer>

</body>
</html>


