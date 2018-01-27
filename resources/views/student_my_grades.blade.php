@include('home')

<div class="container" style="margin-bottom:2%;">
    <div class="col-xs-12 col-md-offset-3 col-md-6 border col-form" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h2>Grades list</h2></b><br>
        <b>{{session('invalid_data')}}</b>
    </div>
    <div class="col-xs-12 col-md-offset-3 col-md-6 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
      <div class="form-group row" style="margin-top:1%; background-color:#a5ea80;">
        <label class="col-xs-offset-1 col-xs-5 text-left" style="padding-top:2%">Subject</label>
        <label class="col-xs-6" style="padding-top:2%">Grades</label>
      </div>
      @foreach ($results as $result=>$subject)
      <div class="form-group-row">
        <label class="col-xs-offset-1 col-xs-5 text-left" style="border:1px solid #808080;">
          {{$result}}
        </label>
        <label class="col-xs-6 text-left">
        @foreach($subject as $sub=>$grade)
          <label class="align-center vcenter" style="border:1px solid #808080;">
            {{$grade}}
          </label>
        @endforeach
      </label>
      </div>
      @endforeach
    </div>
</div>
