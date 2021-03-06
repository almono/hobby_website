@extends('app', ['seo_title' => $seo])
@section('content')

<div class="col-xs-12 col-md-12" style="padding-top: 20px;">
    @if(isset($category) && !is_null($category))
        <div class="col-xs-12" style="border: 1px black solid; border-radius: 0px; margin-top: 15px; margin-bottom: 15px; color: #CEBCED; padding-top: 10px; padding-bottom: 10px;">
                <form action="{{url("category/$category")}}">
                    <b style="color: black;" class="col-xs-12 text-left">Sortowanie:</b>
                    <select name="sort" id="sort" class="col-xs-6 col-md-4 form-control" style="width: 150px; display: inline-block; margin-left: 5px; margin-right: 5px;">
                        <option selected>Wybierz opcje</option>
                        <option value="nazwa-asc">Nazwa A-Z</option>
                        <option value="nazwa-desc">Nazwa Z-A</option>
                        <!--
                        <option value="rocznik-asc">Rocznik rosnąco</option>
                        <option value="rocznik-desc">Rocznik malejąco</option>
                        -->
                        <option value="custom-year">Rok</option>

                        <option value="custom-name">Nazwa</option>
                        <!--
                        <option value="custom-town">Miasto</option>
                        -->
                        <option value="custom-country">Państwo</option>
                    </select>
                    <input type="text" class="col-xs-6 col-md-4 form-control" name="custom_year" id="custom_year" style="display:none; width: 150px;">
                    <input type="text" class="col-xs-6 col-md-4 form-control" name="custom_name" id="custom_name" style="display:none; width: 150px;">
                    <!--
                    <input type="text" class="form-control" name="custom_town" id="custom_town" style="display:none; width: 150px;">
                    -->
                    <input type="text" class="col-xs-6 col-md-4 form-control" name="custom_country" id="custom_country" style="display:none; width: 150px;">
                    <input type="hidden" name="category_id" value="{{$category}}">
                    <select name="sort_subcategory" id="sort_subcategory" class="col-xs-12 form-control" style="width: 200px; display: inline-block; margin-left: 5px; margin-right: 5px;">
                        <option value="Kolej">Kolej</option>
                        <option value="Miejska">Komunikacja miejska</option>
                    </select>
                    <input type="submit" class="btn btn-info col-xs-12 col-md-2" value="Sortuj">

                </form>

        </div>
    @endif
        @if(Request::has('custom_name'))
            <div class="col-xs-12 text-center">
                <span style="font-size: 28px;">{{ ucfirst(Request::get('custom_name')) }} @if(Request::has('custom_country')) ( {{Request::get('custom_country') }} ) @endif</span>
            </div>
        @elseif(Request::has('custom_slug'))
            <?php $catTitle = App\Item::where('slug', Request::get('custom_slug'))->first(); ?>
            @if(isset($catTitle) && !is_null($catTitle))
                <div class="col-xs-12 text-center">
                    <span style="font-size: 28px;">{{ $catTitle['name'] }} @if(Request::has('custom_country')) ( {{Request::get('custom_country') }} ) @endif</span>
                </div>
            @else
                <div class="col-xs-12 text-center">
                    <span style="font-size: 28px;">{{ ucfirst(Request::get('custom_slug')) }} @if(Request::has('custom_country')) ( {{Request::get('custom_country') }} ) @endif</span>
                </div>
            @endif
        @elseif(isset($title) && !is_null($title))
        <div class="col-xs-12 text-center">
            <h1 style="font-size: 28px;">{{ ucfirst($title) }} @if(Request::has('custom_country')) ( {{Request::get('custom_country') }} ) @endif</h1>
        </div>
        @endif
        @foreach($items as $i)
            @if(isset($i->img_front) && !is_null($i->img_front))
                @if(isset($i->img_back) && !is_null($i->img_back))
                    <div class="col-xs-12 col-md-4 item-div item{{$i->id}}" style="padding: 15px;">
                        <div class="col-xs-12 col-md-12 text-center item-name item-img" style="color: #CEBCED; font-size: 18px; height: 325px; width: 100%; padding: 0px;">
                                <div class="flip-container" ontouchstart="this.classList.toggle('hover');" style="height: 100%;">
                                    <div class="flipper" style="height: 100%;">
                                        <div class="front" style="height: 100%; width: 100%;">
                                            <img class="col-xs-12 col-md-12" src="{{ asset("img/$i->img_front")}}" alt="front" @if($i->img_orient_front == 1 && $i->is_square == 0) style="padding-top: 50px; padding-bottom: 50px;" @elseif( $i->is_square == 0) style="padding-left: 50px; padding-right: 50px;" @endif>
                                        </div>
                                        <div class="back" style="height: 100%; width: 100%;">
                                            <img class="col-xs-12 col-md-12" src="{{ asset("img/$i->img_back")}}" alt="front" @if($i->img_orient_back == 1  && $i->is_square == 0) style="padding-top: 50px; padding-bottom: 50px;" @elseif( $i->is_square == 0)  style="padding-left: 50px; padding-right: 50px;" @endif>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @if($title = 'Do wymiany' && Request::path() == 'exchange_items')
                            <div class="col-xs-12 col-md-12 text-center item-name" id="with-hover" style="color: #303030; font-size: 12px !important; font-weight: 600;">{{$i->id}}</div>
                        @endif
                    </div>
                @else
                    <div class="col-xs-12 col-md-4" style="padding: 15px;">
                        <div class="" style="height: 325px; width: 100%;">
                            <img class="col-xs-12 col-md-12" src="{{ asset("img/$i->img_front")}}" alt="front" @if($i->img_orient_front == 1) style="height: 100%; padding-top: 50px; padding-bottom: 50px;" @else style="height: 100%; padding-left: 50px; padding-right: 50px;" @endif>
                        </div>
                        @if($title = 'Do wymiany' && Request::path() == 'exchange_items')
                            <div class="col-xs-12 col-md-12 text-center item-name" id="with-hover" style="color: #303030; font-size: 12px !important; font-weight: 600;">{{$i->id}}</div>
                        @endif
                    </div>
                @endif
            @endif
        @endforeach

</div>

@if((isset($category) && !is_null($category)) || isset($title) && !is_null($title))
    <div class="col-xs-12 text-center">
            {{ $items->appends(['sort' => Input::get('sort'), 'custom_name' =>Input::get('custom_name'), 'custom_slug' =>Input::get('custom_slug'), 'custom_town' => Input::get('custom_town'), 'custom_country' => Input::get('custom_country'), 'sort_subcategory' =>Input::get('sort_subcategory')])->render() }}
    </div>
@endif

<script type="text/javascript">

    $( document ).ready(function() {

        var value = $('#sort').children(":selected").val(); console.log(value);

        if ( value == 'custom-year') {
            $("#custom_town").hide();
            $("#custom_name").hide();
            $("#custom_country").hide();
            $("#custom_year").show();
            $("#custom_year").css("display","inline-block");
        }
        else if ( value == 'custom-town'){
            $("#custom_year").hide();
            $("#custom_country").hide();
            $("#custom_name").hide();
            $("#custom_town").show();
            $("#custom_town").css("display","inline-block");
        }
        else if ( value == 'custom-name'){
            $("#custom_year").hide();
            $("#custom_town").hide();
            $("#custom_country").hide();
            $("#custom_name").show();
            $("#custom_name").css("display","inline-block");
        }
        else if ( value == 'custom-country'){
            $("#custom_year").hide();
            $("#custom_town").hide();
            $("#custom_name").hide();
            $("#custom_country").show();
            $("#custom_country").css("display","inline-block");
        }
        else {
            $("#custom_year").hide();
            $("#custom_town").hide();
            $("#custom_name").hide();
        }

        $('#sort').change(function(){

            var value = $(this).children(":selected").val();
            console.log(value);

            if ( value == 'custom-year') {
                $("#custom_town").hide();
                $("#custom_country").hide();
                $("#custom_name").hide();
                $("#custom_year").show();
                $("#custom_year").css("display","inline-block");
            }
            else if ( value == 'custom-town'){
                $("#custom_year").hide();
                $("#custom_country").hide();
                $("#custom_name").hide();
                $("#custom_town").show();
                $("#custom_town").css("display","inline-block");
            }
            else if ( value == 'custom-name'){
                $("#custom_year").hide();
                $("#custom_town").hide();
                $("#custom_country").hide();
                $("#custom_name").show();
                $("#custom_name").css("display","inline-block");
            }
            else if ( value == 'custom-country'){
                $("#custom_year").hide();
                $("#custom_town").hide();
                $("#custom_name").hide();
                $("#custom_country").show();
                $("#custom_country").css("display","inline-block");
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