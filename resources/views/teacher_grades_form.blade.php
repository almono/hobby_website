@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-2 col-md-8 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h3>Grade</h3></b>
    </div>
    <div class="col-xs-12 col-md-offset-2 col-md-8 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
      <div class="form-group row" style="margin-top:1%; background-color:#a5ea80;">
        <label class="col-xs-4 col-md-3 col-form-label" style="padding-top:2%">First name</label>
        <label class="col-xs-4 col-md-4 col-form-label" style="padding-top:2%">Last name</label>
        <label class="col-xs-4 col-md-2 col-form-label" style="padding-top:2%">Grade</label>
        <label class="col-xs-6 col-md-1 col-form-label" style="padding-top:2%">Add</label>
      </div>
      @foreach($results as $result)
      <form method="POST" action="{{route ('teacher_grades_form_grade') }}">
        <div class="form-group row" style="margin-top:4%">
          <label type="text" class="col-xs-3 col-md-3">{{$result->first}}</label>
          <label type="text" class="col-xs-4 col-md-4">{{$result->last}}</label>
          <input type="text" class="col-xs-3 col-md-2" name="new_grade">
          <label type="text" class="col-xs-6 col-md-1">
              <input type=submit value="O"></button>
              <input type="hidden" name="user_id" value="{{$result->user_id}}">
              <input type="hidden" name="subject_id" value="{{$subject_id}}">
              <input type="hidden" name="class_id" value="{{$class_id}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>
          </label>
        </div>
                  @endforeach
          <div class="form-group row" style="margin-top:4%">
            <div class="col-xs-12 col-md-offset-3 col-md-6">

            </div>
          </div>
          <div class="col-xs-12" style="padding-bottom:5%;">
            @if (session('wrong_info'))
              {{session('wrong_info')}}
            @endif
          </div>
    </div>
</div>
