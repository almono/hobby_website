<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}"/>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">

    <script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/select2.min.js')}}"></script>

    <title>Hobby</title>
</head>
<body style="background: black; height: 100%; min-height: 100%;">
<div class="container-fluid" style="height: 100%;">

        <div class="col-xs-3" style="margin-top: 0px; border: gray 1px solid; min-height: 50px; padding-left: 0px; padding-right: 0px; border-left: none; border-top: none">
            <?php $ilosc = App\Item::count();?>
            <b style="color: white;">Ilość wszystkich kalendarzyków: {{$ilosc}}</b>
        </div>
        <div class="col-xs-9 text-left" style="position: relative; margin-top: 0px; border: gray 1px solid; min-height: 50px; padding-left: 20px; padding-right: 0px; border-top:none; border-right:none; padding-top: 5px;">
            <div class="btn btn-primary show-cats" style="margin-top: auto; margin-bottom: auto; position: relative;">
                Ilości w każdej kategorii
                <?php $per_kat = App\Category::withCount('items')->get();?>
                <div id="ilosci_per_kat" class="text-left" style="display: none; position: absolute; top: 100%; left: 0; background-color: black; z-index: 10; border: 1px solid gray; width: 250px; padding: 10px;">
                    @foreach($per_kat as $pk)
                        <p style="color: white;">{{ ucfirst($pk->name) }}: <b>{{ $pk->items_count }}</b></p>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="col-xs-3" style="margin-top: 0px; border: gray 1px solid; min-height: 800px; padding-left: 0px; padding-right: 0px; border-left: none; position: relative;">
            <div class="col-xs-10 col-xs-offset-1" style="margin-top: 15px">
                <a href="{{route('admin_new_item')}}" class="btn btn-lg" style="width: 100%; border: gray 1px solid"><span class="glyphicon glyphicon-plus-sign"></span>Dodaj przedmiot</a>
            </div>
            <div class="col-xs-10 col-xs-offset-1" style="margin-top: 15px">
                <a href="{{route('admin_new_category')}}" class="btn btn-lg" style="width: 100%; border: gray 1px solid"><span class="glyphicon glyphicon-plus-sign"></span>Dodaj kategorie</a>
            </div>
            <div class="col-xs-10 col-xs-offset-1" style="margin-top: 15px">
                <a href="{{route('admin_show_items')}}" class="btn btn-lg" style="width: 100%; border: gray 1px solid"><span class="glyphicon glyphicon-align-justify"></span>Wyświetl przedmioty</a>
            </div>
            <div class="col-xs-10 col-xs-offset-1" style="margin-top: 15px">
                <a href="{{route('admin_show_categories')}}" class="btn btn-lg" style="width: 100%; border: gray 1px solid"><span class="glyphicon glyphicon-align-justify"></span>Wyświetl kategorie</a>
            </div>
            <div class="col-xs-10 col-xs-offset-1" style="bottom: 10px; position: absolute;">
                <a href="{{route('logout')}}" class="btn btn-lg" style="width: 100%; border: gray 1px solid"><span class="glyphicon glyphicon-align-justify"></span>Wyloguj</a>
            </div>
        </div>
        <div class="col-xs-9" style="margin-top: 0px; border: gray 1px solid; min-height: 800px; padding-left: 0px; padding-right: 0px; border-right: none">
            @yield('admin_content')
        </div>
        <div id="alert" class="col-xs-offset-3 col-xs-6" style="padding-top: 10px; height: 15%; padding-left: 0px; padding-right: 0px; margin-top: 20px;">
            @include('flash::message')
        </div>
</div>
</body>
</html>

@yield('admin-scripts')

<script>
    $('div.alert').not('.alert-important').delay(1500).fadeOut(350);

    $('.show-cats').on('click', function() {
        $('#ilosci_per_kat').slideToggle(200);
    })
</script>
