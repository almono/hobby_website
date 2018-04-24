@extends('front.admin')

<script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.js') }}"></script>
<script type="text/javascript" src="{{URL::asset('js/jquery-ui.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/fontawesome-all.css') }}">
@section('admin_content')
    <div class="col-xs-12 col-sm-6 col-sm-offset-3"  style="margin-top: 0px; padding-left: 0px; padding-right: 0px;">
        <div class="col-sm-12 text-center">
            <h5 style="color: white">Checkboxy służą do ustawienia kategorii na stronie głównej</h5>
        </div>
        <div id="item_container" class="col-xs-12 text-center" style="margin-top: 20px; overflow-y: scroll; height: 500px;">
            @foreach ($categories as $c)
                <div class="col-xs-6 input-group form_margin" style="width: 100%; border: whitesmoke 1px solid; height: 50px;">
                    <div style="margin-top: 0px;">
                        <span class="col-xs-6 admin-text" style="padding-top: 18px;">{{$c->name}}</span>
                        <div class="col-xs-6" style="padding-top: 10px">

                            {{ Form::open([ 'method' => 'POST', 'route' => ['edit_category', $c->id], 'style' => 'float: left']) }}
                            <button type="submit" class="far fa-edit" style="color: white; background-color: inherit; border: 1px solid white; padding: 5px;"></button>
                            {{ Form::checkbox('is_home',null, ($c->is_home == 1) ? true : null, ['style' => 'margin-left: 25px;', 'id' => "$c->id", 'class' => 'checbox_item']) }}
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

    $('document').ready( function() {
        $('.checbox_item').click(function () {
            var id = $(this).attr('id');
            console.log(id);
            var value = 0;
            if ($(this).prop('checked') === true) {
                value = 1;
            }
            var data = {};
            data['id'] = id;
            data['value'] = value;
            $.ajax({
                url: 'update_home_category',
                type: "POST",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    //$('div.alert').html("Kategoria została zmieniona!");
                    $('div.alert').css('display','block');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.responseText);
                }
            });

        });
    });


</script>