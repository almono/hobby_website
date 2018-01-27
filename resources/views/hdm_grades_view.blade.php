@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-2 col-md-8 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h3>Grade</h3></b>
    </div>
    <div class="col-xs-12 col-md-offset-2 col-md-8 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
      <div class="form-group row" style="margin-top:1%; background-color:#a5ea80;">
        <label class="col-xs-6 col-md-7 col-form-label" style="padding-top:2%">Student</label>
        <label class="col-xs-6 col-md-5 col-form-label" style="padding-top:2%">Grades</label>
      </div>
      @foreach($results as $key=>$result)
        <div class="form-group row" style="margin-top:4%">
          <label type="text" class="col-xs-6 col-md-7">{{$key . " " }}</label>
          <label class="col-xs-5">
          @foreach($result as $grade)
            <label class="align-center vcenter" style="border:1px solid #808080;">{{$grade . " " }}</label>
          @endforeach
          </label>
        </div>
      @endforeach
    </div>
</div>
