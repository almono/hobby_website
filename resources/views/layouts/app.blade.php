<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

    <script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <title>Utargowo</title>
</head>
<body>

<div class="container-fluid" style="padding: 0px; background-color:#d3e1c1">
    @include('front.navbar')
</div>

<div class="container">

    <div class="col-xs-offset-4 col-xs-4">
        @yield('content')
    </div>

</div>

</body>
</html>





