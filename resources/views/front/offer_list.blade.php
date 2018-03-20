@extends('app')
@section('content')

<div class="col-xs-12 col-md-12">

    @foreach($items as $i)
        <div class="col-md-4 item-div">
            <img class="col-md-12" src="{{ asset("img/$i->img_front")}}" alt="front" style="margin-bottom: 5px;">
            <div class="col-md-12 text-center item-name" style="color: #CEBCED; font-size: 18px;">{{$i->name}}</div>
        </div>
    @endforeach

</div>
<?php echo $items->render(); ?>


@stop