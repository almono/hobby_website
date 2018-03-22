@extends('app')
@section('content')

<div class="col-xs-12 col-md-12">

    @foreach($items as $i)
        <div class="col-md-4 item-div">
            <div class="col-md-12 text-center item-name item-img" style="color: #CEBCED; font-size: 18px; height: 210px;">
                <div class="flip-container" ontouchstart="this.classList.toggle('hover');" style="height: 100%;">
                    <div class="flipper" style="height: 100%;">
                        <div class="front" style="height: 100%; width: 100%;">
                            <img class="col-md-12" src="{{ asset("img/$i->img_front")}}" alt="front" style="margin-bottom: 5px;">
                        </div>
                        <div class="back" style="height: 100%; width: 100%;">
                            <img class="col-md-12" src="{{ asset("img/$i->img_back")}}" alt="front" style="margin-bottom: 5px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center item-name" style="color: #CEBCED; font-size: 18px;">{{$i->name}}</div>
        </div>
    @endforeach

</div>
<div class="col-xs-12 text-center">
    <?php echo $items->render(); ?>
</div>



@stop