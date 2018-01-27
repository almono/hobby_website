@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-3 col-md-6 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h2>My subjects</h2></b>
    </div>
    <div class="col-xs-12 col-md-offset-3 col-md-6 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
      <div class="form-group row" style="margin-top:1%; background-color:#a5ea80;">
        <label class="col-xs-6 col-md-6 col-form-label" style="padding-top:2%">Subject</label>
        <label class="col-xs-6 col-md-6 col-form-label" style="padding-top:2%">Class</label>
      </div>
      @foreach ($results as $result=>$subject)
          <div class="form-group row" style="margin-top:4%">
              <label type="text" class="col-xs-6 col-md-6"><u>{{$result}}</u></label>
              <label type="text" class="col-xs-6 col-md-6">
              @foreach ($subject as $subject=>$class)
              <label class="align-center vcenter" style="border:1px solid #808080;">
                {{$class}}
              </label>
              @endforeach
              </label>
          </div>
      @endforeach
          <div class="col-xs-12" style="padding-bottom:5%;">
            @if (session('wrong_new'))
              {{session('wrong_new')}}
            @endif

            <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
          </div>
    </div>
</div>
