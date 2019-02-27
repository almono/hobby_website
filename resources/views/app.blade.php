<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/all.css') }}">
    <script type="text/javascript" src="{{URL::asset('js/all.js')}}"></script>

    <title>Hobby</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133690594-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-133690594-1');
    </script>

</head>
<body style="background: #fff4d5;">

<div class="bg-image"></div>

<div class="container-fluid" id="sticky" style="background: linear-gradient(#3e2e06, #251b01 90%); border-radius: 0px; margin-bottom: 15px;border-top: 0px; z-index: 1000;">
    @include('front.navbar')
</div>

<div class="container" style="position: relative; padding-bottom: 30px; border-radius: 15px; margin-bottom: 30px;">
    <div class="col-xs-12 padding_fix_mobile">
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


