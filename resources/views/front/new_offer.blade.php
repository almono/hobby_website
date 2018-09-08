<div class="container">
    <div class="col-xs-12">
        <div class="row" style="margin-top: 3px;">
            <div class="hidden-xs hidden-sm col-xs-2 col-sm-2">
                <a href="{{route('home')}}" >
                    <img src="{{asset('img/utarg_logo.png')}}" height="44px;">
                </a>
            </div>
            <div class="col-xs-9 col-sm-7">
                <div class="input-group" style="margin: 5px;">
                    <input type="text" class="form-control" style="border: #8559CC solid 2px; font-weight: bold"/>
                    <span class="input-group-addon" style="background-color: #8559CC; border: #8559CC solid 1px;">
                        <i class="fa fa-search" style="color: white"></i>
                    </span>
                </div>
            </div>
            <div class="hidden-xs hidden-sm col-xs-3">

                <div class="text-center dropdown" style="margin: auto; padding: 5px 0px 5px 0px; border-radius: 10px; border: #8559CC solid 1px; width: 75%;">
                    <a id="dLabel" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style=" color: #CEBCED">
                        <i class="fa fa-user fa-2x" aria-hidden="true"></i>
                        <b style="font-size: 15px;">My u-account</b>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        @if (!Auth::check())
                        <li class="text-center" style="margin-top: 5px;">
                            <a id="login_button" href="{{route('login_form')}}">Login</a>
                        </li>
                        <li class="text-center" style="margin-top: 4px;">
                            <div style="font-size: 10px; color: #CEBCED;">
                                New to u-targ? <a href="{{route('register_form')}}" style="font-size: 10px; color: yellow;">Register</a>
                            </div>
                        </li>
                        @else
                            <li class="text-center" style="margin-top: 4px;">
                                Witaj, <b> {{ Auth::user()->username }} ! </b>
                            </li>
                        @endif
                        <hr style="width: 80%; border-color: #CEBCED; margin-top: 5px; margin-bottom: 5px;">
                        <li><a href="#">My account</a></li>
                        <li><a href="#">My orders</a></li>
                        <li><a href="#">My offers</a></li>
                        <li><a href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </div>



            </div>
        </div>
        <div class="row hidden-xs">
            <div class="col-xs-2">

            </div>
            <div class="container col-xs-7">
                <nav class="navbar navbar-default" style="background-color:#21064C; border-radius: 0; margin-bottom: 0px">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar">
                            <ul class="nav navbar-nav navbar" style="display: flex; align-items: center;">
                                <li><a href="a">Messages</a></li>
                                <li><a href="b">My profile</a></li>
                                <li><a href="c">Log out</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"><span class="caret"></span> Register</a>
                                    <div class="dropdown-menu custom-form" style="padding: 15px; padding-bottom: 10px; text-align:center;">
                                        <h4 style="font-weight: bold; margin-top: 0; border: 2px solid black; border-radius: 25px; border-color: #85bc6a; padding: 10px;">Registration form</h4>
                                        <form class="form-horizontal"  method="post" accept-charset="UTF-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                <input type="text" class="form-control" name="username" maxlength="9" placeholder="Username">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                                <input type="text" class="form-control" name="email" maxlength="9" placeholder="Email">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                                <input type="text" class="form-control" name="password" maxlength="9" placeholder="Password">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                                <input type="text" class="form-control" name="newid" maxlength="9" placeholder="Confirm password">
                                            </div>
                                            <input class="btn btn-primary" type="submit" name="submit" value="Register" style="margin-top:10px; width:100%;"/>
                                        </form>
                                    </div>
                                </li>
                                <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"><span class="caret"></span> Login</a>
                                    <div class="dropdown-menu custom-form" style="padding: 15px; padding-bottom: 10px; text-align:center;">
                                        <h4 style="font-weight: bold; margin-top: 0; border: 2px solid black; border-radius: 25px; border-color: #85bc6a; padding: 10px;">Login form</h4>
                                        <form class="form-horizontal"  method="post" accept-charset="UTF-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                <input type="text" class="form-control" name="username" maxlength="9" placeholder="Username">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                                <input type="text" class="form-control" name="password" maxlength="9" placeholder="Password">
                                            </div>
                                            <input class="btn btn-primary" type="submit" name="submit" value="Register" style="margin-top:10px; width:100%;"/>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>

                </nav>
            </div>
        </div>
    </div>
</div>