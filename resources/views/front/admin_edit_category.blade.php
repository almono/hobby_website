@extends('front.admin')
@section('admin_content')

    <div class="col-xs-12"  style="margin-top: 0px; height: 100%; padding-left: 0px; padding-right: 0px;">
        {{ Form::open([ 'method' => 'POST', 'route' => ['update_category', $category->id]]) }}
        {{ Form::hidden('id',$category->id) }}
        <div class="col-xs-12 text-center" style="margin-top: 20px">
            <b style="font-size: 30px; color: antiquewhite">{{$category->name}}</b>
        </div>
            <div class="col-xs-offset-2 col-xs-4 text-center" style="margin-top: 20px;">
                <b style="color:white; font-size: 24px;">Aktualne dane</b>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Nazwa</span>
                    <span class="form-control admin_input">{{$category->name}}</span>
                </div>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Kategoria</span>
                    <span class="form-control admin_input">{{$category->name}}</span>
                </div>
            </div>
            <div class="col-xs-4 text-center" style="margin-top: 20px;">
                <b style="color:white; font-size: 24px;">Nowe dane</b>
                <div class="col-xs-12 input-group form_margin" style="width: 100%;">
                    <span class="input-group-addon admin_span" id="basic-addon2">Nazwa</span>
                    {{ Form::text('new_name','',['class' => 'form-control admin_input']) }}
                </div>
                {{ Form::checkbox('active','1',true) }} <b style="color:white;">Czy aktywny?</b>
                <br><br>
                {{ Form::submit('Zapisz',['class' => 'btn btn-info', 'style' => 'width: 150px;']) }}
            </div>
            <div class="col-xs-12 text-center" style="margin: auto; margin-top: 30px">
            </div>
    </div>

@stop