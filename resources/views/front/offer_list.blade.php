@extends('app')
@section('content')

<div class="col-xs-12 col-md-12">
<div class="col-xs-12" style="border: 1px black solid; border-radius: 10px; margin-top: 15px; margin-bottom: 15px; color: #CEBCED; padding-top: 10px; padding-bottom: 10px;">
<form action="{{url("category/$category")}}">
    <b>Sortowanie:</b>
    <select name="sort" id="sort" class="form-control" style="width: 150px; display: inline-block; margin-left: 5px; margin-right: 5px;">
        <option selected>Wybierz opcje</option>
        <option value="nazwa-asc">Nazwa A-Z</option>
        <option value="nazwa-desc">Nazwa Z-A</option>
        <option value="rocznik-asc">Rocznik rosnąco</option>
        <option value="rocznik-desc">Rocznik malejąco</option>
        <option value="custom-year">Rok</option>
        <option value="custom-town">Miasto</option>
    </select>
    <input type="text" class="form-control" name="custom_year" id="custom_year" style="display:none; width: 150px;">
    <input type="text" class="form-control" name="custom_town" id="custom_town" style="display:none; width: 150px;">
    <input type="hidden" name="category_id" value="{{$category}}">
    <input type="submit" class="btn btn-info" value="Sortuj">
</form>
</div>
    @foreach($items as $i)
        <div class="col-md-4 item-div item{{$i->id}}">
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
            <div class="col-md-12 text-center item-name" id="with-hover" style="color: #CEBCED; font-size: 18px;">{{$i->name}}, {{$i->city}} {{$i->year}}r</div>
        </div>
    @endforeach

</div>
<div class="col-xs-12 text-center">
    <?php echo $items->render(); ?>
</div>

<script type="text/javascript">

    $( document ).ready(function() {

        var value = $('#sort').children(":selected").val(); console.log(value);

        if ( value == 'custom-year') {
            $("#custom_town").hide();
            $("#custom_year").show();
            $("#custom_year").css("display","inline-block");
        }
        else if ( value == 'custom-town'){
            $("#custom_year").hide();
            $("#custom_town").show();
            $("#custom_town").css("display","inline-block");
        }
        else {
            $("#custom_year").hide();
            $("#custom_town").hide();
        }

        $('#sort').change(function(){

            var value = $(this).children(":selected").val();
            console.log(value);

            if ( value == 'custom-year') {
                $("#custom_town").hide();
                $("#custom_year").show();
                $("#custom_year").css("display","inline-block");
            }
            else if ( value == 'custom-town'){
                $("#custom_year").hide();
                $("#custom_town").show();
                $("#custom_town").css("display","inline-block");
            }
            else {
                $("#custom_year").hide();
                $("#custom_town").hide();
            }

        });

        $('.item').hover(
            function(){
                $('.item').css('background', '#F00')
            },
            function() {
                $('.item').css('background', '#F00')
            });

    });

</script>

@stop