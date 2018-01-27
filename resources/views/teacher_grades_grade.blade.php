@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-4 col-md-4 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h3>{{"Class: " . $results->class . " Subject: " . $results->subject_name}}</h3></b>
    </div>
    <div class="col-xs-12 col-md-offset-4 col-md-4 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
      <form method="POST" action="{{route('teacher_grades_grade')}}">
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">{{$results->first . " " . $results->last}}</label>
              <div class="col-xs-8 col-md-6">
                  <input type="text" class="form-control" name="new_grade">
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <div class="col-xs-12 col-md-12">
                  <input type="submit" class="form-control btn btn-info" value="Add grade">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
          </div>
        </form>
          <div class="col-xs-12" style="padding-bottom:5%;">
            @if (session('wrong_new'))
              {{session('wrong_new')}}
            @endif
            <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
          </div>
    </div>
</div>
