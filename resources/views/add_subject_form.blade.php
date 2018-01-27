@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-3 col-md-6 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h3>Add new subject</h3></b>
    </div>
    <div class="col-xs-12 col-md-offset-3 col-md-6 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
      <form method="POST" action="{{route ('new_subject') }}">
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-5 col-form-label" style="padding-top:2%">Subject name</label>
              <div class="col-xs-8 col-md-7">
                  <input type="text" class="form-control" name="subject_name">
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-5 col-form-label" style="padding-top:2%">Leading teacher</label>
              <div class="col-xs-8 col-md-7">
                <select name="teacher_id" class="col-xs-12 form-control">
                    @foreach($teachers as $teacher)
                      <option value="{{$teacher->id}}">{{$teacher->first_name ." ". $teacher->last_name}}</option>
                    @endforeach
                </select>
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
            <div class="col-xs-12 col-md-offset-3 col-md-6">
              <input type="submit" value="Add subject" class="form-control btn btn-info">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
          </div>
          <div class="col-xs-12" style="padding-bottom:5%;">
            @if (session('wrong_info'))
              {{session('wrong_info')}}
            @endif
          </div>
        </form>
    </div>
</div>
