@extends('front.admin')
@section('admin_content')

    <div class="col-xs-12"  style="margin-top: 0px; height: 100%; padding-left: 0px; padding-right: 0px;">
        {{ Form::open([ 'method' => 'POST', 'route' => ['update_item', $item->id], 'files' => true]) }}
        {{ Form::hidden('id',$item->id) }}
        @if(isset($previous) && !is_null($previous))
            {{ Form::hidden('previous_url',$previous) }}
        @endif
        <div class="col-xs-12 text-center" style="margin-top: 20px">
            <b style="font-size: 30px; color: antiquewhite">{{$item->name}}</b>
        </div>
            <div class="col-xs-6 text-center" style="margin-top: 20px;">
                <b style="color:white; font-size: 24px;">Aktualne dane</b>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Nazwa</span>
                    <span class="form-control admin_input">{{$item->name}}</span>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Państwo</span>
                    <span class="form-control admin_input">{{$item->country}}</span>
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
                    <select class="form-control admin_input name-tags"  id="new_name" placeholder="nazwa przedmiotu" aria-describedby="basic-addon2" name="new_name" type="text">
                        <option selected="selected"></option>
                        @foreach($item_names as $i)
                            <option value="{{ $i->name }}">{{ $i->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Państwo</span>
                    {{ Form::text('new_country','',['class' => 'form-control admin_input']) }}
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Rocznik</span>
                    {{ Form::number('new_year','',['class' => 'form-control admin_input']) }}
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Kategoria</span>
                    <select name="kategoria" style="float:left; margin-top: 3px; margin-left: 10px;">
                        @foreach ($categories as $c)
                            <option value="{{$c->id}}" @if($item->category_id == $c->id) selected @endif >{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Podkategoria</span>
                    <select name="new_subcat" style="float:left; margin-top: 3px; margin-left: 10px;">
                        <option value="Kolej" @if($item->subcategory == "Kolej") selected @endif >Kolej</option>
                        <option value="Komunikacja miejska" @if($item->subcategory == "Komunikacja miejska") selected @endif >Komunikacja miejska</option>
                    </select>
                </div>
                <hr>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Zdjęcie przód</span>
                    <input class="admin_input" id="zdjecie_przod" placeholder="kategoria" aria-describedby="basic-addon2" name="zdjecie_przod" type="file" style="margin-left: 10px; margin-top: 2px; ">
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2" style="width: 150px !important;">Orientacja przodu</span>
                    <select name="new_orient_front" style="float:left; margin-top: 3px; margin-left: 10px;">
                        <option value="1" @if($item->img_orient_front == 1) selected @endif>Pozioma</option>
                        <option value="0" @if($item->img_orient_front == 0) selected @endif>Pionowa</option>
                    </select>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Zdjęcie tył</span>
                    <input class="admin_input" id="zdjecie_tyl" placeholder="kategoria" aria-describedby="basic-addon2" name="zdjecie_tyl" type="file" style="margin-left: 10px; margin-top: 2px">
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2" style="width: 150px !important;">Orientacja tyłu</span>
                    <select name="new_orient_back" style="float:left; margin-top: 3px; margin-left: 10px;">
                        <option value="1" @if($item->img_orient_back == 1) selected @endif>Pozioma</option>
                        <option value="0" @if($item->img_orient_back == 0) selected @endif>Pionowa</option>
                    </select>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <input type="checkbox" name="exchange" value="1" @if($item->exchange == '1') checked="checked" @endif>
                    <b style="color: white;">Do wymiany</b>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <input type="checkbox" name="is_square" value="1" @if($item->is_square == '1') checked="checked" @endif>
                    <b style="color: white;">Kwadratowe zdjęcie</b>
                </div>
                <br><br>
                {{ Form::submit('Zapisz',['class' => 'btn btn-info', 'style' => 'width: 150px;']) }}
            </div>
            <div class="col-xs-12 text-center" style="margin: auto; margin-top: 30px">
            </div>
    </div>

@stop
@section('admin-scripts')
    <script type="text/javascript">
        $(document).ready( function() {
            $(".name-tags").select2({
                tags: true
            });
        });
    </script>
@stop