@extends('app')
@section('content')

<div class="col-xs-12 text-center" style="margin-top: 30px; border-right: 1px solid black; border-left: 1px solid black;">
    <div class="col-xs-4" style="margin-bottom: 25px; border-bottom: 1px solid black; padding-bottom: 20px; padding-top: 10px; height: 240px;">
        <img src="{{ asset("img/obrazek_glowna") . ".jpg" }}" style="max-width: 100%;">
    </div>
    <div class="col-xs-8 text-justify" style="margin-bottom: 25px; border-bottom: 1px solid black; padding-bottom: 20px; padding-top: 10px; height: 240px;">
        <span style="font-weight: 600; font-size: 14px;">Nazywam się Sławek Zaspa i witam wszystkich na mojej stronie, na której będę chciał zaprezentować moją kolekcję kalendarzyków listkowych z tematów kolej i komunikacja zbiorowa miejska i międzymiastowa. Mam nadzieję, że dzięki tej stronie poznam innych kolekcjonerów o podobnych zainteresowaniach, co przyczyni się do powiększenia moich zbiorów. Będę też prezentował inne przedmioty z mojej kolekcji z tej tematyki. Serdecznie zapraszam do zapoznania się z moją kolekcja.
	        Jeżeli jesteś zainteresowany wymianą lub masz coś co może mnie zainteresować, odezwij się na adres podany w prawym górnym narożniku. Na pewno się porozumiemy.
        </span>
    </div>
    <div class="col-xs-4">
        <?php $i = App\Item::take(3)->orderBy('created_at','DESC')->get(); ?>
            <div class="col-xs-12" style="margin-bottom: 20px; font-size: 24px;">
                Nowości na stronie
            </div>
        @foreach($i as $item)
            <div class="col-xs-12 item-div item{{$item['id']}}" style="padding: 0px; border: none; padding-top: 0px; margin-top: 0px;">
                <div class="col-md-12 text-center item-name item-img" style="color: #CEBCED; font-size: 18px; height: 325px; width: 100%; padding: 0px; padding-top: 5px; padding-bottom: 5px;">
                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');" style="height: 100%;">
                        <div class="flipper" style="height: 100%;">
                            <div class="front" style="height: 100%; width: 100%;">
                                <img class="col-md-12" src="{{ asset("img/$item->img_front")}}" alt="front" @if($item->img_orient_front == 1) style="padding-top: 50px; padding-bottom: 50px;" @else style="padding-left: 50px; padding-right: 50px;" @endif>
                            </div>
                            <div class="back" style="height: 100%; width: 100%;">
                                <img class="col-md-12" src="{{ asset("img/$item->img_back")}}" alt="front" @if($item->img_orient_back == 1) style="padding-top: 50px; padding-bottom: 50px;" @else style="padding-left: 50px; padding-right: 50px;" @endif>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center item-name" id="with-hover" style="color: #303030; font-size: 12px !important;" hidden>{{$item->name}}</div>
            </div>
        @endforeach
    </div>
    <div class="col-xs-4" style="height: 100%; border-right: 1px solid black; border-left: 1px solid black; min-height: 1000px;">
        <div class="col-xs-12" style="margin-bottom: 20px; font-size: 22px;">
            Kalendarzyki polskie ({{$calendars_pl}})
        </div>
        <div class="col-xs-12" id="polish" style="padding: 0px 0px 10px 0px;">
            <span class="show_polish_kolej col-xs-12 text-left" style="cursor: pointer; font-weight: 600;"><i class="fa fa-arrow-right"></i>Kolej</span>
            <span class="show_polish_komunikacja col-xs-12 text-left" style="cursor: pointer; font-weight: 600;"><i class="fa fa-arrow-right"></i>Komunikacja miejska</span>
        </div>
        <div class="col-xs-12" id="polish_kolej" style="padding-top: 10px; border-bottom: 1px solid black; padding-bottom: 10px;" hidden>
            <span class="col-xs-12 text-center" style="font-weight: 600; padding-bottom: 10px;">
                Kolej
            </span>
            @if(isset($items_pl_kolej) && !is_null($items_pl_kolej))
                @foreach($items_pl_kolej as $ip)
                    <div class="col-xs-12 text-left">
                        <a href="{{route('show_items', ['category' => $ip->category_id, 'sort' => 'custom-slug', 'custom_slug' => $ip->name ])}}">{{ $ip->name }}</a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-xs-12" id="polish_komunikacja" style="padding-top: 10px; border-bottom: 1px solid black; padding-bottom: 10px;" hidden>
            <span class="col-xs-12 text-center" style="font-weight: 600; padding-bottom: 10px;">
                Komunikacja miejska
            </span>
            @if(isset($items_pl_komunikacja) && !is_null($items_pl_komunikacja))
                @foreach($items_pl_komunikacja as $ip)
                    <div class="col-xs-12 text-left">
                        <a href="{{route('show_items', ['category' => $ip->category_id, 'sort' => 'custom-slug', 'custom_slug' => $ip->name ])}}">{{ $ip->name }}</a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-xs-4" style="height: 100%;">
        <div class="col-xs-12" style="margin-bottom: 20px; font-size: 22px;">
            Kalendarzyki zagraniczne ({{$calendars_other}})
        </div>
        <div class="col-xs-12 text-left" style="border-bottom: 1px solid black; padding-bottom: 10px;">
            <span class="show_groups" style="cursor: pointer; font-weight: 600;"><i class="fa fa-arrow-right"></i>Kalendarzyki zagraniczne według grup</span>
            <br>
            <span class="show_countries" style="cursor: pointer; font-weight: 600;"><i class="fa fa-arrow-right"></i>Kalendarzyki zagraniczne według państw</span>
        </div>
        <div class="col-xs-12" id="groups" style="padding-top: 10px; border-bottom: 1px solid black; padding-bottom: 10px; padding-left: 0px;" hidden>
            @if(isset($items_other_groups_kolej) && !is_null($items_other_groups_kolej) && isset($items_other_groups_komunikacja) && !is_null($items_other_groups_komunikacja))
                <div class="col-xs-12 text-left" style="padding-left: 0px;">

                    <span class="col-xs-12 show_groups_kolej" style="cursor: pointer; font-weight: 600;"><i class="fa fa-arrow-right"></i>Kolej</span>
                    <div class="col-xs-12 text-left" id="other_kolej" style="padding-left: 20px;" hidden>
                        @foreach($items_other_groups_kolej as $iko)
                            <a class="col-xs-12" href="{{route('show_items', ['category' => $iko->category_id, 'custom_slug' => $iko->slug, 'sort' => 'custom-slug' ])}}">{{ $iko->name }}</a>
                        @endforeach
                    </div>

                    <span class="col-xs-12 show_groups_komunikacja" style="cursor: pointer; font-weight: 600;"><i class="fa fa-arrow-right"></i>Komunikacja miejska</span>
                    <div class="col-xs-12 text-left" id="other_komunikacja" style="padding-left: 20px;" hidden>
                        @foreach($items_other_groups_komunikacja as $iku)
                            <a class="col-xs-12" href="{{route('show_items', ['category' => $iku->category_id, 'custom_slug' => $iku->slug, 'sort' => 'custom-slug' ])}}">{{ $iku->name }}</a>
                        @endforeach
                    </div>

                </div>
            @endif
        </div>
        <div class="col-xs-12" id="countries" style="padding-top: 10px; border-bottom: 1px solid black; padding-bottom: 10px;" hidden>
            @if(isset($items_countries) && !is_null($items_countries) && $items_countries != ""  )
                @foreach($items_countries as $io)
                    <div class="col-xs-12 text-left">
                        <a href="{{route('show_items', ['category' => '2', 'custom_country' => $io->country, 'sort' => 'custom-country' ])}}">{{ $io->country }}</a>
                    </div>
                @endforeach
            @else
                <div class="col-xs-12 text-center asd">
                    <span style="font-weight: 600; font-size: 20px; color: brown">BRAK KALENDARZYKÓW DO WYŚWIETLENIA</span>
                </div>
            @endif
        </div>
    </div>
</div>
@stop
@section('scripts')
<script type="text/javascript">

    $(document).ready( function() {

        $(".show_groups").on('click', function() {
            if($("#groups").is(":visible")) {
                $("#groups").slideUp(500);
            }
            else {
                $("#groups").slideDown(500);
            }



        });

        $(".show_groups_kolej").on('click', function() {
            console.log(1);
                $("#other_kolej").slideToggle(500);
        });

        $(".show_groups_komunikacja").on('click', function() {
            $("#other_komunikacja").slideToggle(500);
        });

        $(".show_countries").on('click', function() {
            if($("#countries").is(":visible")) {
                $("#countries").slideUp(500);
            }
            else {
                $("#countries").slideDown(500);
            }

        });

        $(".show_polish_kolej").on('click', function() {
            if($("#polish_kolej").is(":visible")) {
                $("#polish_kolej").slideUp(400);
            }
            else {
                $("#polish_kolej").slideDown(400);
            }

        });

        $(".show_polish_komunikacja").on('click', function() {
            if($("#polish_komunikacja").is(":visible")) {
                $("#polish_komunikacja").slideUp(400);
            }
            else {
                $("#polish_komunikacja").slideDown(400);
            }

        });

    });

</script>
@stop