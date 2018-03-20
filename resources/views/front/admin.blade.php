<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}"/>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">

    <script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>

    <title>Hobby</title>
</head>
<body style="background: black; height: 100%; min-height: 100%;">
<div class="container-fluid" style="height: 100%;">

        <div class="col-xs-2" style="margin-top: 0px; border: gray 1px solid; height: 20%; padding-left: 0px; padding-right: 0px; border-left: none; border-top: none">

        </div>
        <div class="col-xs-10" style="margin-top: 0px; border: gray 1px solid; height: 20%; padding-left: 0px; padding-right: 0px; border-top:none; border-right:none">

        </div>
        <div class="col-xs-2" style="margin-top: 0px; border: gray 1px solid; height: 65%; padding-left: 0px; padding-right: 0px; border-left: none;">
            <div class="col-xs-12" style="margin-top: 15px">
                <a href="{{route('admin_new_item')}}" class="btn btn-lg" style="width: 100%; border: gray 1px solid"><span class="glyphicon glyphicon-plus-sign"></span>Dodaj przedmiot</a>
            </div>
            <div class="col-xs-12" style="margin-top: 15px">
                <a href="{{route('admin_new_category')}}" class="btn btn-lg" style="width: 100%; border: gray 1px solid"><span class="glyphicon glyphicon-plus-sign"></span>Dodaj kategorie</a>
            </div>
            <div class="col-xs-12" style="margin-top: 15px">
                <a href="{{route('admin_show_items')}}" class="btn btn-lg" style="width: 100%; border: gray 1px solid"><span class="glyphicon glyphicon-align-justify"></span>Wyświetl przedmioty</a>
            </div>
        </div>
        <div class="col-xs-10" style="margin-top: 0px; border: gray 1px solid; height: 65%; padding-left: 0px; padding-right: 0px; border-right: none">
            @yield('admin_content')
        </div>
        <div id="alert" class="col-xs-offset-3 col-xs-6" style="padding-top: 10px; border: gray 1px solid; height: 15%; padding-left: 0px; padding-right: 0px; border-bottom: none; border-left: none; border-right: none">
            @include('flash::message')
        </div>
</div>
</body>
</html>

<script>
    $('div.alert').not('.alert-important').delay(1500).fadeOut(350);
</script>
