@extends('front.admin')
@section('admin_content')

    <div class="col-xs-12"  style="margin-top: 0px; height: 100%; padding-left: 0px; padding-right: 0px;">
        {{ Form::open(array('route' => 'admin_add_new_item', 'method' => 'POST', 'files' => true)) }}
            <div class="col-xs-offset-3 col-xs-6 text-center" style="margin-top: 20px;">
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Nazwa</span>
                    <input class="form-control admin_input" id="nazwa" placeholder="nazwa przedmiotu" aria-describedby="basic-addon2" name="nazwa" type="text" required>
                </div>
                <div class="col-xs-12 input-group form_margin">
                    <span class="input-group-addon admin_span" id="basic-addon2">Rocznik</span>
                    <input class="form-control admin_input" id="rok" placeholder="rocznik" aria-describedby="basic-addon2" name="rok" type="text" required>
                </div>
                <div class="col-xs-12 input-group form_margin">
                    <span class="input-group-addon admin_span" id="basic-addon2">Miasto</span>
                    <input class="form-control admin_input" id="miasto" placeholder="miasto" aria-describedby="basic-addon2" name="miasto" type="text">
                </div>
                <div class="col-xs-12 input-group form_margin">
                    <span class="input-group-addon admin_span" id="basic-addon2">Kategoria</span>
                    <!--<input class="form-control admin_input" id="kategoria" placeholder="kategoria" aria-describedby="basic-addon2" name="kategoria" type="text" required>-->
                    <select name="kategoria" style="float:left; margin-top: 3px; margin-left: 10px;">
                        @foreach ($categories as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 input-group form_margin">
                    <span class="input-group-addon admin_span" id="basic-addon2">Podkategoria</span>
                    <select name="podkategoria" style="float:left; margin-top: 3px; margin-left: 10px;">
                        <option value="Kolej">Kolej</option>
                        <option value="Komunikacja miejska">Komunikacja miejska</option>
                    </select>
                </div>
                <div class="col-xs-12 input-group form_margin" style="margin-top: 20px">
                    <span class="input-group-addon admin_span" id="basic-addon2">Zdjęcie przód</span>
                    <input class="admin_input" id="zdjecie_przod" placeholder="kategoria" aria-describedby="basic-addon2" name="zdjecie_przod" type="file" style="margin-left: 10px; margin-top: 2px; " required>
                </div>
                <div class="col-xs-12 input-group form_margin">
                    <label style="border: 1px white solid; border-radius: 5px; padding: 10px;"><input type="radio" name="zdjecie_orientacja_front" checked value="1">Zdjęcie poziome</label>
                    <label style="border: 1px white solid; border-radius: 5px; padding: 10px;"><input type="radio" name="zdjecie_orientacja_front" value="0">Zdjęcie pionowe</label>
                </div>
                <div class="col-xs-12 input-group form_margin">
                    <span class="input-group-addon admin_span" id="basic-addon2">Zdjęcie tył</span>
                    <input class="admin_input" id="zdjecie_tyl" placeholder="kategoria" aria-describedby="basic-addon2" name="zdjecie_tyl" type="file" style="margin-left: 10px; margin-top: 2px" required>
                </div>
                <div class="col-xs-12 input-group form_margin">
                    <label style="border: 1px white solid; border-radius: 5px; padding: 10px;"><input type="radio" name="zdjecie_orientacja_back" checked value="1">Zdjęcie poziome</label>
                    <label style="border: 1px white solid; border-radius: 5px; padding: 10px;"><input type="radio" name="zdjecie_orientacja_back" value="0">Zdjęcie pionowe</label>
                </div>
            </div>

            <div class="col-xs-12 text-center" style="margin: auto; margin-top: 30px">
                {{Form::submit('STWÓRZ NOWY',['class' => 'btn btn-info', 'style' => 'width: 200px; height: 50px;'])}}
            </div>
        {{Form::close()}}
    </div>

@stop