@extends('front.admin')
@section('admin_content')

    <div class="col-xs-12"  style="margin-top: 0px; height: 100%; padding-left: 0px; padding-right: 0px;">
        <div class="col-xs-12 text-center" style="margin-top: 20px">
            <b style="font-size: 30px; color: antiquewhite">Lista przedmiotów</b>
        </div>
        <div id="item_container" class="col-xs-12 text-center" style="margin-top: 20px; overflow-y: scroll; height: 80%">
            @foreach ($items as $item)
                <div class="col-xs-12 input-group form_margin" style="width: 100%; border: whitesmoke 1px solid;">
                    <b class="col-xs-2 admin-text">Zdjecie 1</b>
                    <b class="col-xs-2 admin-text">Zdjecie 2</b>
                    <b class="col-xs-2 admin-text">Nazwa</b>
                    <b class="col-xs-2 admin-text">Rocznik</b>
                    <b class="col-xs-2 admin-text">Kategoria</b>
                    <div style="margin-top: 40px;">
                        <img class="col-xs-2" src="{{ asset("img/$item->img_front")}}" alt="front" style="margin-bottom: 5px;">
                        <img class="col-xs-2" src="{{ asset("img/$item->img_back")}}" alt="front" style="margin-bottom: 5px;">
                        <span class="col-xs-2 admin-text" style="margin-top: 50px;">{{$item->name}}</span>
                        <span class="col-xs-2 admin-text" style="margin-top: 50px;">{{$item->year}}</span>
                        <span class="col-xs-2 admin-text" style="margin-top: 50px;">{{$item->category->name}}</span>
                        <div class="col-xs-2" style="margin-top: 45px;">

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

