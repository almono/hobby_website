@extends('app')
@section('content')

    <div class="container hidden-xs">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="https://www.w3schools.com/w3css/img_fjords.jpg" alt="U-Targ" style="height: 400px; width: 100%;">
                    <div class="carousel-caption">
                        <h3>U-Targ</h3>
                        <p>Strona dla wszystkich, od wszystkich</p>
                    </div>
                </div>

                <div class="item">
                    <img src="https://www.w3schools.com/w3css/img_fjords.jpg" alt="U-Targ" style="height: 400px; width: 100%;">
                    <div class="carousel-caption">
                        <h3>U-Targ</h3>
                        <p>Strona dla wszystkich, od wszystkich</p>
                    </div>
                </div>

                <div class="item">
                    <img src="https://www.w3schools.com/w3css/img_fjords.jpg" alt="U-Targ" style="height: 400px; width: 100%;">
                    <div class="carousel-caption">
                        <h3>U-Targ</h3>
                        <p>Strona dla wszystkich, od wszystkich</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="fa fa-arrow-left" style="top: 50%; position: absolute"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="fa fa-arrow-right" style="top: 50%; position: absolute"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


@stop
