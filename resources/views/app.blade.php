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

    <title>Hobby</title>
</head>
<body style="background: linear-gradient(to right, #251b01,#3e2e06,#251b01); height: 100%; min-height: 100%;">

<div class="container" style="background: linear-gradient(#3e2e06, #251b01 90%); border-radius: 0px 0px 15px 15px; margin-bottom: 15px; border: 4px  solid #1c1313; border-top: 0px;">
    @include('front.navbar')
</div>

<div class="container" style="position: relative; padding-bottom: 30px; border: 4px  solid #1c1313; border-radius: 15px; min-height: 75%;">
    <div class="col-xs-12" style="">
        @yield('content')
    </div>
</div>

</body>
</html>


