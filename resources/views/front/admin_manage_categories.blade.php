@extends('front.admin')

<script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.js') }}"></script>
<script type="text/javascript" src="{{URL::asset('js/jquery-ui.js') }}"></script>

@section('admin_content')

    <div class="col-xs-12 col-sm-6 col-sm-offset-3"  style="margin-top: 0px; padding-left: 0px; padding-right: 0px;">
        <div id="item_container" class="col-xs-12 text-center" style="margin-top: 20px; overflow-y: scroll; height: 500px;">
            @foreach ($categories as $c)
                <div class="col-xs-6 input-group form_margin" style="width: 100%; border: whitesmoke 1px solid; height: 50px;">
                    <div style="margin-top: 0px;">
                        <span class="col-xs-6 admin-text" style="padding-top: 18px;">{{$c->name}}</span>
                        <div class="col-xs-6" style="padding-top: 10px">

                            {{ Form::open([ 'method' => 'POST', 'route' => ['edit_category', $c->id], 'style' => 'float: left']) }}
                            {{ Form::checkbox('Edytuj', ['style' => 'width: 100px;']) }}
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