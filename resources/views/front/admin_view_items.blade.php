@extends('front.admin')

<script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.js') }}"></script>
<script type="text/javascript" src="{{URL::asset('js/jquery-ui.js') }}"></script>

@section('admin_content')

    <div class="col-xs-12"  style="margin-top: 0px; padding-left: 0px; padding-right: 0px; ">
        <div class="col-xs-12 text-center" style="margin-top: 20px">
            {{ Form::open(array('route' => 'admin_show_items', 'method' => 'GET')) }}
                <b>Sortowanie:</b>
                <select name="sort" id="sort" class="form-control" style="width: 150px; display: inline-block; margin-left: 5px; margin-right: 5px;">
                    <option selected>Wybierz opcje</option>
                    <?php /*
                    <option value="nazwa-asc">Nazwa A-Z</option>
                    <option value="nazwa-desc">Nazwa Z-A</option>
                    <option value="rocznik-asc">Rocznik rosnąco</option>
                    <option value="rocznik-desc">Rocznik malejąco</option>
 */ ?>
                    <option value="custom-year">Rok</option>
                    <option value="custom-country">Państwo</option>
                    <option value="custom-name">Nazwa</option>
                </select>
                <input type="text" class="form-control" name="custom_year" id="custom_year" style="display:none; width: 150px;">
                <input type="text" class="form-control" name="custom_country" id="custom_country" style="display:none; width: 150px;">
                <input type="text" class="form-control" name="custom_name" id="custom_name" style="display:none; width: 150px;">
            <select name="sort_subcategory" id="sort_subcategory" class="form-control" style="width: 200px; display: inline-block; margin-left: 5px; margin-right: 5px;">
                <option value="Kolej">Kolej</option>
                <option value="Miejska">Komunikacja miejska</option>
            </select>
                <input type="submit" class="btn btn-info" value="Sortuj">
            {{ Form::close() }}
        </div>
        <div id="item_container" class="col-xs-12 text-center" style="margin-top: 20px; overflow-y: scroll; height: 500px;">
            @foreach ($items as $item)
                <div class="col-xs-12 input-group form_margin" style="width: 100%; border: whitesmoke 1px solid;">
                    <b class="col-xs-2 admin-text" style="max-width: 250px;">Zdjecie 1</b>
                    <b class="col-xs-2 admin-text" style="max-width: 250px;">Zdjecie 2</b>
                    <b class="col-xs-2 admin-text">Nazwa</b>
                    <b class="col-xs-1 admin-text">Państwo</b>
                    <b class="col-xs-1 admin-text">Rocznik</b>
                    <b class="col-xs-2 admin-text">Kategoria</b>
                    <div style="margin-top: 40px;">
                        <img class="col-xs-2 view_item_img" src="{{ asset("img/$item->img_front")}}" alt="front" style="margin-bottom: 5px;">
                        <img class="col-xs-2 view_item_img" src="{{ asset("img/$item->img_back")}}" alt="front" style="margin-bottom: 5px;">
                        <span class="col-xs-2 admin-text" style="margin-top: 50px;">{{$item->name}}</span>
                        <span class="col-xs-1 admin-text" style="margin-top: 50px;">{{$item->country}}</span>
                        <span class="col-xs-1 admin-text" style="margin-top: 50px;">{{$item->year}}</span>
                        <span class="col-xs-2 admin-text" style="margin-top: 50px;">{{$item->category->name}}</span>
                        <div class="col-xs-2" style="margin-top: 45px; padding: 0px;">

                            {{ Form::open([ 'method' => 'POST', 'route' => ['edit_item', $item->id], 'style' => 'float: left']) }}
                            {{ Form::submit('Edytuj', ['class' => 'btn btn-info', 'style' => 'width: 100px;']) }}
                            {{ Form::close() }}

                            {{ Form::open([ 'method' => 'POST', 'route' => ['delete_item', $item->id], 'onsubmit' => 'return ConfirmDelete()', 'style' => 'float: right']) }}
                            {{ Form::submit('Usuń', ['class' => 'btn btn-danger', 'style' => 'width: 100px;']) }}
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            @endforeach

    </div>
</div>
@stop




<script>
    function ConfirmDelete(){
        return confirm('Czy na pewno chcesz to usunąć?');
    }
</script>
<script type="text/javascript">

    $( document ).ready(function() {

        var value = $('#sort').children(":selected").val(); console.log(value);

        if ( value == 'custom-year') {
            $("#custom_name").hide()
            $("#custom_country").hide()
            $("#custom_year").show();
            $("#custom_year").css("display","inline-block");
        }
        else if ( value == 'custom-country'){
            $("#custom_year").hide();
            $("#custom_name").hide()
            $("#custom_country").show();
            $("#custom_country").css("display","inline-block");
        }
        else if ( value == 'custom-name'){
            $("#custom_year").hide();
            $("#custom_country").hide();
            $("#custom_name").show();
            $("#custom_name").css("display","inline-block");
        }
        else {
            $("#custom_name").hide()
            $("#custom_year").hide();
            $("#custom_country").hide();
        }

        $('#sort').change(function(){

            var value = $(this).children(":selected").val();
            console.log(value);

            if ( value == 'custom-year') {
                $("#custom_name").hide()
                $("#custom_country").hide()
                $("#custom_year").show();
                $("#custom_year").css("display","inline-block");
            }
            else if ( value == 'custom-country'){
                $("#custom_year").hide();
                $("#custom_name").hide()
                $("#custom_country").show();
                $("#custom_country").css("display","inline-block");
            }
            else if ( value == 'custom-name'){
                $("#custom_year").hide();
                $("#custom_country").hide();
                $("#custom_name").show();
                $("#custom_name").css("display","inline-block");
            }
            else {
                $("#custom_name").hide()
                $("#custom_year").hide();
                $("#custom_country").hide();
            }

        });


    });

</script>
