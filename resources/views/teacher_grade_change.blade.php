@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-3 col-md-6 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h3>~~Grade change~~</h3></b>
    </div>

        <div class="col-xs-12 col-md-offset-3 col-md-6 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
              <div class="form-group row" style="margin-top:4%">
                  <label class="col-xs-4 col-md-4 col-form-label" style="padding-top:2%">New grade</label>
                  <div class="col-xs-4 col-md-4">
                      <label type="text" class="form-control">{{$grade->grade}}</label>
                  </div>
                  <div class="col-xs-4 col-md-4">
                      <input type="text" class="form-control" name="new_grade" form="change"></input>
                  </div>
              </div>
              <div class="form-group row" style="margin-top:4%">
                  <label class="col-xs-4 col-md-4 col-form-label" style="padding-top:2%">Comment</label>
                  <div class="col-xs-8 col-md-8">
                      <input type="text" class="form-control" name="new_comment" value="{{$grade->comment}}" form="change"></input>
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-xs-12" style="margin-top:0%;">
                      <form method="POST" action="{{route('delete_grade')}}" id="delete">
                          <input type=submit value='Delete' class="col-xs-4 btn btn-danger" form="delete">
                          <input type=hidden name="grade_id" value="{{$grade->id}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      </form>
                      <form method="POST" action="{{route('change_grade')}}" id="change">
                          <input type=submit value='Change grade' class="col-xs-6 col-xs-offset-1 btn btn-info" form="change">
                          <input type=hidden name="subject_id" value="{{$grade->subject_id}}">
                          <input type=hidden name="grade_id" value="{{$grade->id}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      </form>
                  </div>
              </div>
        </div>
</div>
