<?php
    $items_pl_kolej = App\Item::where("category_id","1")->where(function ($q) {
        $q->where('subcategory','Kolej');
        $q->orWhere('subcategory','Komunikacja miejska');
    })->groupBy('name')->get();

    $items_other = App\Item::where("category_id","2")->where(function ($q) {
        $q->where('subcategory','Kolej');
        $q->orWhere('subcategory','Komunikacja miejska');
    })->groupBy('name')->get();

    $countries_kolej = App\Item::where("category_id","2")->where("subcategory","Kolej")->where("country","!=","")->groupBy('country')->get();
    $countries_komunikacja = App\Item::where("category_id","2")->where("subcategory","Komunikacja miejska")->where("country","!=","")->groupBy('country')->get();

    $names_kolej = App\Item::where("category_id","2")->where("subcategory","Kolej")->groupBy('slug')->get();
    $names_komunikacja = App\Item::where("category_id","2")->where("subcategory","Komunikacja miejska")->groupBy('slug')->get();

?>
    <div class="container-fluid mobile-m-0 mobile-p-10" style="margin-top: 10px; border-radius: 15px">
        <div class="row">
            <div class="container col-xs-12" style="padding: 0;">
                <nav class="navbar navbar-default" style="background-color: inherit; border-radius: 0; margin-bottom: 0px">
                    <div class="navbar-header">
                        <a class="navbar-brand visible-xs" href="{{ route('home') }}">Sławek Zaspa - kolekcje</a>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar" style="float: left">
                        <ul class="nav navbar-nav navbar mobile-navbar" style="display: flex; align-items: center;">
                            <a class="dropdown-toggle disabled mobile-nav-link mobile-nav-main" href="{{ route('home') }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer; padding: 10px;">
                                Strona główna
                            </a>
                            <div class="mobile-nav-link">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="{{ route('show_items', ['category_id' => 1]) }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer;">
                                        Kalendarzyki polskie
                                        <span class="caret caret-hide"></span>
                                    </a>

                                    <ul class="dropdown-menu multidropdown drop-desktop" aria-labelledby="dropdownMenu1">
                                        <li class="dropdown-submenu" hidden>
                                            <a href="#">Lata<i class="caret"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{url('/category/1?start_year=0&end_year=1989')}}">< 1989</a></li>
                                                <li><a href="{{url('/category/1?start_year=1990&end_year=2000')}}">1990-2000</a></li>
                                                <li><a href="{{url('/category/1?start_year=2001&end_year=2010')}}">2001-2010</a></li>
                                                <li><a href="{{url('/category/1?start_year=2011&end_year=9999')}}">> 2011</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <li><a href="{{url('/category/1?sort_subcategory=Kolej')}}">Kolej</a></li>
                                            <li><a href="{{url('/category/1?sort_subcategory=Miejska')}}">Komunikacja miejska</a></li>
                                        </li>
                                        @if(isset($items_pl_kolej) && !is_null($items_pl_kolej))
                                            <li class="dropdown-submenu" style="padding: 5px 0px;">
                                                <a href="#">Nazwa emitenta<i class="caret"></i></a>
                                                <ul class="dropdown-menu" style="min-width: 360px; max-height: 35vh; overflow-y: scroll;">
                                                    @foreach($items_pl_kolej as $ip)
                                                        <li><a href="{{route('show_items', ['category' => $ip->category_id, 'sort' => 'custom-slug', 'custom_slug' => $ip->name ])}}" style="font-size: 12px;">{{ $ip->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="mobile-nav-link">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="{{ route('show_items', ['category_id' => 2]) }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer;">
                                        Kalendarzyki zagraniczne
                                        <span class="caret caret-hide"></span>
                                    </a>
                                    <ul class="dropdown-menu multidropdown drop-desktop" aria-labelledby="dropdownMenu1">
                                        <li class="dropdown-submenu" hidden>
                                            <a href="#">Lata<i class="caret"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{url('/category/2?start_year=0&end_year=1989')}}">< 1989</a></li>
                                                <li><a href="{{url('/category/2?start_year=1990&end_year=2000')}}">1990-2000</a></li>
                                                <li><a href="{{url('/category/2?start_year=2001&end_year=2010')}}">2001-2010</a></li>
                                                <li><a href="{{url('/category/2?start_year=2011&end_year=9999')}}">> 2011</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu" style="padding: 5px 0px;">
                                            <a href="{{url('/category/2?sort_subcategory=Kolej')}}">Kolej<i class="caret"></i></a>
                                            @if(isset($countries_kolej) && !is_null($countries_kolej) && count($countries_kolej) > 0 )
                                                <ul class="dropdown-menu" style="max-height: 35vh;">
                                                    <li class="text-center"><a href="#">Państwo</a></li>
                                                    <hr style="margin: 0px;">
                                                    @foreach($countries_kolej as $ck)
                                                        <li class="dropdown-submenu" style="padding: 0px 0px;">
                                                            <a href="{{url('/category/2?sort=custom-country&sort_subcategory=Kolej&custom_country=' . $ck->country )}}" style="font-size: 12px; padding-left: 5px;">
                                                                {{ $ck->country }}
                                                            </a>
                                                            @if(isset($names_kolej) && !is_null($names_kolej) && count($names_kolej) > 0 )
                                                                <ul class="dropdown-menu" style="min-width: 300px; max-width: 500px; max-height: 35vh; overflow-y: scroll;">
                                                                    <li class="text-center"><a href="#">Nazwa emitenta</a></li>
                                                                    <hr style="margin: 0px;">
                                                                    @foreach($names_kolej as $nk)
                                                                        @if($nk->country == $ck->country)
                                                                        <li class="dropdown-submenu" style="padding: 5px 0px;">
                                                                            <a href="{{url('/category/2?sort=custom-slug&sort_subcategory=Kolej&custom_country=' . $ck->country . '&custom_slug=' . $nk->name )}}" style="font-size: 12px; padding-left: 5px;">
                                                                                {{ $nk->name }}
                                                                            </a>
                                                                        </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>

                                        <li class="dropdown-submenu" style="padding: 5px 0px;">
                                            <a href="{{url('/category/2?sort_subcategory=Miejska')}}">Komunikacja miejska<i class="caret"></i></a>
                                            @if(isset($countries_komunikacja) && !is_null($countries_komunikacja) && count($countries_komunikacja) > 0 )
                                                <ul class="dropdown-menu" style="max-height: 35vh;">
                                                    <li class="text-center"><a href="#">Państwo</a></li>
                                                    <hr style="margin: 0px;">
                                                    @foreach($countries_komunikacja as $ck)
                                                        <li class="dropdown-submenu" style="padding: 0px 0px;">
                                                            <a href="{{url('/category/2?sort=custom-country&sort_subcategory=Miejska&custom_country=' . $ck->country )}}" style="font-size: 12px;">
                                                                {{ $ck->country }}
                                                            </a>
                                                            @if(isset($names_komunikacja) && !is_null($names_komunikacja) && count($names_komunikacja) > 0 )
                                                                <ul class="dropdown-menu" style="min-width: 300px; max-width: 500px; max-height: 35vh; overflow-y: scroll;">
                                                                    <li class="text-center"><a href="#">Nazwa emitenta</a></li>
                                                                    <hr style="margin: 0px;">
                                                                    @foreach($names_komunikacja as $nk)
                                                                        @if($nk->country == $ck->country)
                                                                            <li class="dropdown-submenu" style="padding: 5px 0px;">
                                                                                <a href="{{url('/category/2?sort=custom-slug&sort_subcategory=Miejska&custom_country=' . $ck->country . '&custom_slug=' . $nk->name)}}" style="font-size: 12px; padding-left: 5px;">
                                                                                    {{ $nk->name }}
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                        @if(isset($items_other) && !is_null($items_other))
                                            <li class="dropdown-submenu" style="padding: 5px 0px;">
                                                <a href="#">Nazwa emitenta<i class="caret"></i></a>
                                                <ul class="dropdown-menu" style="min-width: 360px; max-height: 35vh; overflow-y: scroll;">
                                                    @foreach($items_other as $ip)
                                                        <li><a href="{{route('show_items', ['category' => $ip->category_id, 'sort' => 'custom-slug', 'custom_slug' => $ip->name ])}}" style="font-size: 12px;">{{ $ip->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <?php $categories = App\Category::where('is_home','1')->where('id','!=','1')->where('id','!=','2')->get(); ?>
                            @foreach ($categories as $cat)
                                <div class="mobile-nav-link">
                                    <div class="dropdown">
                                        <?php
                                        $countries_other = \App\Item::where("category_id",$cat->id)->where("country","!=","")->groupBy('country')->get();
                                        ?>
                                        @if(isset($countries_other) && !is_null($countries_other) && count($countries_other) > 0)
                                            <a class="dropdown-toggle disabled" href="{{ route('show_items', ['category_id' => $cat->id]) }}" id="dropdownMenu{{$cat->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer;">
                                                {{$cat->name}}
                                                <span class="caret caret-hide"></span>
                                            </a>
                                            <ul class="dropdown-menu multidropdown drop-desktop" aria-labelledby="dropdownMenu{{$cat->id}}">
                                                 <li class="dropdown-submenu">
                                                    <a href="#">Państwo<i class="caret"></i></a>
                                                    <ul class="dropdown-menu">
                                                        @foreach($countries_other as $co)
                                                            <li><a href="{{ url('/category/' . $co->category_id . '?sort=custom-country&custom_country=' . $co->country )}} ">{{ $co->country }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        @else
                                            <a class="dropdown-toggle disabled" href="{{ route('show_items', ['category_id' => $cat->id]) }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer; padding: 10px;">
                                                {{$cat->name}}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div class="mobile-nav-link visible-xs">
                                <a href="{{ route('exchange_items') }}" style="padding: 10px;">Do wymiany</a>
                            </div>
                            <div class="mobile-nav-link visible-xs">
                                <a href="{{ route('new_items') }}" style="padding: 10px;">Nowości</a>
                            </div>
                            <div class="mobile-nav-link text-center visible-xs" style="width: 100%;">
                                <span class="text-center" style="padding: 10px; color: white; font-weight: 600;">
                                    <span>Kontakt</span><br>
                                    <span>lukasz_111@gazeta.pl</span>
                                </span>
                            </div>
                        </ul>
                    </div>
                    <div class="hidden-xs" style="float: right;">
                        <ul class="nav navbar-nav navbar" style="display: flex; align-items: center;">
                            <div class="dropdown">
                                <a class="dropdown-toggle disabled" href="{{ route('exchange_items') }}" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer; padding: 10px;">
                                    Do wymiany<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu multidropdown" aria-labelledby="dropdownMenu2">
                                    <li class="dropdown-submenu">
                                        <a href="{{ route('exchange_items', ['category' => '1']) }}">Polskie</a>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a href="{{ route('exchange_items', ['category' => '2']) }}">Zagraniczne</a>
                                    </li>
                                </ul>
                            </div>
                            <li><a href="{{ route('new_items') }}" class="new_items">Nowości</a></li>
                            <li id="contact" style="position: relative;">
                                <a href="#">
                                    Kontakt
                                </a>
                                <div id="contact-info" class="text-center" style="position: absolute; width: 250px; line-height: 35px; padding: 10px; display: none; right: -15px; background: linear-gradient(#251b01,#3e2e06 90%); z-index: 11;">
                                    <a href="mailto:lukasz_111@gazeta.pl" style="font-weight: 600; color: white;">lukasz_111@gazeta.pl</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>



    <script>
        $(".dropdown").hover( function() {
            $(this).children('.dropdown-menu', this).stop( true, true ).delay(300).slideDown("fast");
            $(this).addClass('open');
        }, function() {
            $(this).children('.dropdown-menu', this).stop( true, true ).delay(300).slideUp("fast");
            $(this).removeClass('open');
        });

        $("#contact").click( function() {
            $("#contact-info").slideToggle(300);
        });
    </script>