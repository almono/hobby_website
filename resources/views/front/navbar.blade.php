
    <div class="col-xs-12"  style="margin-top: 10px; border-radius: 15px">

        <div class="row hidden-xs">
            <div class="container col-xs-12">
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

                                <div class="dropdown">

                                    <div class="dropdown">
                                        <a class="dropdown-toggle disabled" href="{{ route('show_items', ['category_id' => 1]) }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer; padding: 10px;">
                                            Kalendarzyki polskie
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu multidropdown" aria-labelledby="dropdownMenu1">
                                            <li class="dropdown-submenu">
                                                <a href="#">Lata<i class="caret"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{url('/category/1?start_year=0&end_year=1989')}}">< 1989</a></li>
                                                    <li><a href="{{url('/category/1?start_year=1990&end_year=2000')}}">1990-2000</a></li>
                                                    <li><a href="{{url('/category/1?start_year=2001&end_year=2010')}}">2001-2010</a></li>
                                                    <li><a href="{{url('/category/1?start_year=2011&end_year=9999')}}">> 2011</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="#">Podkategoria<i class="caret"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{url('/category/1?sort_subcategory=Kolej')}}">Kolej</a></li>
                                                    <li><a href="{{url('/category/1?sort_subcategory=Miejska')}}">Komunikacja miejska</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="dropdown">

                                    <div class="dropdown">
                                        <a class="dropdown-toggle disabled" href="{{ route('show_items', ['category_id' => 2]) }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer; padding: 10px;">
                                            Kalendarzyki zagraniczne
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu multidropdown" aria-labelledby="dropdownMenu1">
                                            <li class="dropdown-submenu">
                                                <a href="#">Lata<i class="caret"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{url('/category/2?start_year=0&end_year=1989')}}">< 1989</a></li>
                                                    <li><a href="{{url('/category/2?start_year=1990&end_year=2000')}}">1990-2000</a></li>
                                                    <li><a href="{{url('/category/2?start_year=2001&end_year=2010')}}">2001-2010</a></li>
                                                    <li><a href="{{url('/category/2?start_year=2011&end_year=9999')}}">> 2011</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="#">Podkategoria<i class="caret"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{url('/category/2?sort_subcategory=Kolej')}}">Kolej</a></li>
                                                    <li><a href="{{url('/category/2?sort_subcategory=Miejska')}}">Komunikacja miejska</a></li>
                                                </ul>
                                            </li>
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
                                <li><a href="a">Kontakt</a></li>
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
    </script>