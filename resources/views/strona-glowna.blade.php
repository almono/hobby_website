@extends('app')
@section('content')

<div class="col-xs-12 text-center" style="margin-top: 30px; border-right: 1px solid black; border-left: 1px solid black;">
    <div class="col-xs-12" style="margin-bottom: 25px; border-bottom: 1px solid black; padding-bottom: 10px;">
        <span style="font-weight: 600; font-size: 30px;">Strona tytułowa!</span>
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
        <div class="col-xs-12" style="margin-bottom: 20px; font-size: 24px;">
            Kalendarzyki polskie
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
                        <a href="{{route('show_items', ['category' => $ip->category_id, 'sort' => 'custom-slug', 'custom_slug' => $ip->name ])}}">{{ $ip->name }}<span style="font-weight: 600; margin-right: 3px;">({{ $ip->countItems($ip->name) }})</span></a>
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
                        <a href="{{route('show_items', ['category' => $ip->category_id, 'sort' => 'custom-slug', 'custom_slug' => $ip->name ])}}">{{ $ip->name }}<span style="font-weight: 600; margin-right: 3px;">({{ $ip->countItems($ip->name) }})</span></a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-xs-4" style="height: 100%;">
        <div class="col-xs-12" style="margin-bottom: 20px; font-size: 24px;">
            Kalendarzyki zagraniczne
        </div>
        <div class="col-xs-12 text-left" style="border-bottom: 1px solid black; padding-bottom: 10px;">
            <span class="show_groups" style="cursor: pointer; font-weight: 600;"><i class="fa fa-arrow-right"></i>Kalendarzyki zagraniczne według grup</span>
            <br>
            <span class="show_countries" style="cursor: pointer; font-weight: 600;"><i class="fa fa-arrow-right"></i>Kalendarzyki zagraniczne według państw</span>
        </div>
        <div class="col-xs-12" id="groups" style="padding-top: 10px; border-bottom: 1px solid black; padding-bottom: 10px;" hidden>
            @if(isset($items_other) && !is_null($items_other))
                @foreach($items_other as $io)
                    <div class="col-xs-12 text-left">
                        <a href="{{route('show_items', ['category' => $io->category_id, 'custom_slug' => $io->slug, 'sort' => 'custom-slug' ])}}">{{ $io->name }}<span style="font-weight: 600; margin-right: 3px;">({{ $io->countItems($io->name) }})</span></a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-xs-12" id="countries" style="padding-top: 10px; border-bottom: 1px solid black; padding-bottom: 10px;" hidden>
            @if(isset($items_countries) && !is_null($items_countries) && $items_countries != ""  )
                @foreach($items_countries as $io)
                    <div class="col-xs-12 text-left">
                        <a href="{{route('show_items', ['category' => '2', 'custom_country' => $io->country, 'sort' => 'custom-country' ])}}"><span style="font-weight: 600; margin-right: 3px;">({{ $io->total }})</span>{{ $io->country }}</a>
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