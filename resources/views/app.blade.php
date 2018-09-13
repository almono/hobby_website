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
    <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">


    <script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.sticky.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/select2.min.js')}}"></script>

    <title>Hobby</title>
</head>
<body style="background: #fff4d5;">

<div class="container-fluid" id="sticky" style="background: linear-gradient(#3e2e06, #251b01 90%); border-radius: 0px; margin-bottom: 15px;border-top: 0px; z-index: 1000;">
    @include('front.navbar')
</div>

<div class="container" style="position: relative; padding-bottom: 30px; border-radius: 15px; margin-bottom: 30px;">
    <div class="col-xs-12" style="">
        @yield('content')
    </div>
</div>

</body>
</html>

@yield('scripts')

<script type="text/javascript">
    $(document).ready( function() {
        $("#sticky").sticky({topSpacing:0});
    });
</script>


