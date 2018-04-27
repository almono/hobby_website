@extends('front.admin')
@section('admin_content')

    <div class="col-xs-12"  style="margin-top: 0px; height: 100%; padding-left: 0px; padding-right: 0px;">
        {{ Form::open([ 'method' => 'POST', 'route' => ['update_item', $item->id]]) }}
        {{ Form::hidden('id',$item->id) }}
        <div class="col-xs-12 text-center" style="margin-top: 20px">
            <b style="font-size: 30px; color: antiquewhite">{{$item->name}}</b>
        </div>
            <div class="col-xs-offset-2 col-xs-4 text-center" style="margin-top: 20px;">
                <b style="color:white; font-size: 24px;">Aktualne dane</b>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Nazwa</span>
                    <span class="form-control admin_input">{{$item->name}}</span>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Miasto</span>
                    <span class="form-control admin_input">{{$item->city}}</span>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Rocznik</span>
                    <span class="form-control admin_input">{{$item->year}}</span>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Kategoria</span>
                    <span class="form-control admin_input">{{$item->category->name}}</span>
                </div>
                <div class="col-xs-6 input-group form_margin" style="width: 100%; color: white;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Zdjęcie przód</span>
                    <img class="col-xs-9" src="{{ asset("img/$item->img_front")}}" alt="front" style="max-height: 100px; max-width: 100px;">
                    <b>Orientacja: </b><br>
                    @if ($item->img_orient_front == 1)
                        <b>Pozioma</b>
                    @else
                        <b>Pionowa</b>
                    @endif
                </div>
                <div class="col-xs-6 input-group form_margin" style="width: 100%; color: white;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Zdjęcie tył</span>
                    <img class="col-xs-9" src="{{ asset("img/$item->img_back")}}" alt="front" style="max-height: 100px; max-width: 100px;">
                    <b>Orientacja: </b><br>
                    @if ($item->img_orient_back == 1)
                        <b>Pozioma</b>
                    @else
                        <b>Pionowa</b>
                    @endif
                </div>
            </div>
            <div class="col-xs-4 text-center" style="margin-top: 20px;">
                <b style="color:white; font-size: 24px;">Nowe dane</b>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Nazwa</span>
                    {{ Form::text('new_name','',['class' => 'form-control admin_input']) }}
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Miasto</span>
                    {{ Form::text('new_city','',['class' => 'form-control admin_input']) }}
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Rocznik</span>
                    {{ Form::number('new_year','',['class' => 'form-control admin_input']) }}
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Kategoria</span>
                    <select name="kategoria" style="float:left; margin-top: 3px; margin-left: 10px;">
                        @foreach ($categories as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Podkategoria</span>
                    <select name="new_subcat" style="float:left; margin-top: 3px; margin-left: 10px;">
                        <option value="Kolej">Kolej</option>
                        <option value="Komunikacja miejska">Komunikacja miejska</option>
                    </select>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2" style="width: 150px !important;">Orientacja przodu</span>
                    <select name="new_orient_front" style="float:left; margin-top: 3px; margin-left: 10px;">
                        <option value="1" @if($item->img_orient_front == 1) selected @endif>Pozioma</option>
                        <option value="0" @if($item->img_orient_front == 0) selected @endif>Pionowa</option>
                    </select>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2" style="width: 150px !important;">Orientacja tyłu</span>
                    <select name="new_orient_back" style="float:left; margin-top: 3px; margin-left: 10px;">
                        <option value="1" @if($item->img_orient_back == 1) selected @endif>Pozioma</option>
                        <option value="0" @if($item->img_orient_back == 0) selected @endif>Pionowa</option>
                    </select>
                </div>
                {{ Form::checkbox('active','1',true) }} <b style="color:white;">Czy aktywny?</b>
                <br><br>
                {{ Form::submit('Zapisz',['class' => 'btn btn-info', 'style' => 'width: 150px;']) }}
            </div>
            <div class="col-xs-12 text-center" style="margin: auto; margin-top: 30px">
            </div>
    </div>

@stop