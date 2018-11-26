<?php
    $items_pl_kolej = App\Item::where("category_id","1")->where(function ($q) {
        $q->where('subcategory','Kolej');
        $q->orWhere('subcategory','Komunikacja miejska');
    })->groupBy('name')->get();

    $items_other = App\Item::where("category_id","2")->where(function ($q) {
        $q->where('subcategory','Kolej');
        $q->orWhere('subcategory','Komunikacja miejska');
    })->groupBy('name')->get();
?>
    <div class="container" style="margin-top: 10px; border-radius: 15px">
        <div class="row hidden-xs">
            <div class="container col-xs-12" style="padding: 0;">
                <nav class="navbar navbar-default" style="background-color: inherit; border-radius: 0; margin-bottom: 0px">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar" style="float: left">
                            <ul class="nav navbar-nav navbar" style="display: flex; align-items: center;">
                                <a class="dropdown-toggle disabled" href="{{ route('home') }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer; padding: 10px;">
                                    Strona główna
                                </a>
                                <div class="">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle disabled" href="{{ route('show_items', ['category_id' => 1]) }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer; padding: 10px;">
                                            Kalendarzyki polskie
                                            <span class="caret"></span>
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
                                                    <ul class="dropdown-menu" style="min-width: 360px; max-height: 70vh; overflow-y: scroll;">
                                                        @foreach($items_pl_kolej as $ip)
                                                            <li><a href="{{route('show_items', ['category' => $ip->category_id, 'sort' => 'custom-slug', 'custom_slug' => $ip->name ])}}" style="font-size: 12px;">{{ $ip->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle disabled" href="{{ route('show_items', ['category_id' => 2]) }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer; padding: 10px;">
                                            Kalendarzyki zagraniczne
                                            <span class="caret"></span>
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
                                            <li class="dropdown-submenu">
                                                <li><a href="{{url('/category/2?sort_subcategory=Kolej')}}">Kolej</a></li>
                                                <li><a href="{{url('/category/2?sort_subcategory=Miejska')}}">Komunikacja miejska</a></li>
                                            </li>
                                            @if(isset($items_other) && !is_null($items_other))
                                                <li class="dropdown-submenu" style="padding: 5px 0px;">
                                                    <a href="#">Nazwa emitenta<i class="caret"></i></a>
                                                    <ul class="dropdown-menu" style="min-width: 360px; max-height: 70vh; overflow-y: scroll;">
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
                                <li>
                                    <a class="dropdown-toggle disabled" href="{{ route('show_items', ['category_id' => $cat->id]) }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer; padding: 10px;">
                                        {{$cat->name}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div style="float: right;">
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
                                    <div id="contact-info" class="text-center" style="position: absolute; width: 250px; line-height: 35px; padding: 10px; display: none; left: -50px; background: linear-gradient(#251b01,#3e2e06 90%); z-index: 11;">
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