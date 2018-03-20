@extends('front.admin')
@section('admin_content')

    <div class="col-xs-12"  style="margin-top: 0px; height: 100%; padding-left: 0px; padding-right: 0px;">
        <div class="col-xs-12 text-center" style="margin-top: 20px">
            <b style="font-size: 30px; color: antiquewhite">KREATOR</b>
        </div>
        {{ Form::open(array('route' => 'admin_add_new_category', 'method' => 'POST')) }}
        <div class="col-xs-offset-4 col-xs-4 text-center" style="margin-top: 20px;">
            <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                <span class="input-group-addon admin_span" id="basic-addon2">Nazwa</span>
                <input class="form-control admin_input" id="nazwa" placeholder="nazwa kategorii" aria-describedby="basic-addon2" name="nazwa" type="text" required>
            </div>
            <div class="col-xs-12 input-group form_margin">
                <span class="input-group-addon admin_span" id="basic-addon2">Opis</span>
                <input class="form-control admin_input" id="opis" placeholder="opis" aria-describedby="basic-addon2" name="opis" type="text">
            </div>
        </div>

        <div class="col-xs-12 text-center" style="margin: auto; margin-top: 30px">
            {{Form::submit('STWÓRZ NOWĄ')}}
        </div>
        {{Form::close()}}
    </div>

@stop