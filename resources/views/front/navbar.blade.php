
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
                                <a href="{{ route('show_items', ['category_id' => 1]) }}" >Kalendarzyki polskie</a>

                                <a href="{{ route('show_items', ['category_id' => 2]) }}" style="margin-left: 20px;">Kalendarzyki zagraniczne</a>

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
