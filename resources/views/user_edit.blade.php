@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-3 col-md-6 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h3>~~User profile~~</h3></b>
    </div>
    <form method="POST">
    <div class="col-xs-12 col-md-offset-3 col-md-6 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-4 col-form-label" style="padding-top:2%">First name</label>
              <div class="col-xs-4 col-md-4">
                  <label type="text" class="form-control" name="first_name">{{$user->first_name}}</label>
              </div>
              <div class="col-xs-4 col-md-4">
                  <input type="text" class="form-control" name="new_first_name"></input>
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-4 col-form-label" style="padding-top:2%">Last name</label>
              <div class="col-xs-4 col-md-4">
                  <label type="text" class="form-control" name="last_name">{{$user->last_name}}</label>
              </div>
              <div class="col-xs-4 col-md-4">
                  <input type="text" class="form-control" name="new_last_name"></input>
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-4 col-form-label" style="padding-top:2%">Username</label>
              <div class="col-xs-4 col-md-4">
                  <label type="text" class="form-control" name="username">{{$user->username}}</label>
              </div>
              <div class="col-xs-4 col-md-4">
                  <input type="text" class="form-control" name="new_username"></input>
              </div>
          </div>
          @if ($user->role_id==2)
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-4 col-form-label" style="padding-top:2%">Subject</label>
              <div class="col-xs-8 col-md-8">
                <select name="subject_id" class="col-xs-12 form-control">
                    @foreach($subjects as $subject)
                      <option value="{{$subject->id}}">{{$subject->id . ": " . $subject->name}}</option>
                    @endforeach
                </select>
              </div>
          </div>
          @endif
          @if ($user->role_id==3)
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-4 col-form-label" style="padding-top:2%">Class</label>
              <div class="col-xs-8 col-md-8">
                <select name="class_id" class="col-xs-12 form-control">
                    @foreach($classes as $class)
                      <option value="{{$class->id}}">{{$class->id . ": " . $class->name}}</option>
                    @endforeach
                </select>
              </div>
          </div>
          @endif
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-4 col-form-label" style="padding-top:2%">New Password</label>
              <form method="POST">
              <div class="col-xs-8 col-md-8">
                  <input type="password" class="form-control" name="new_password"></input>
              </div>
          </div>
          <div class="form-group row">
              <div class="col-xs-4 col-md-offset-4 col-md-8" style="margin-top:0%;">
                  <input type=submit value='Update user' class="col-md-12 btn btn-info">
                  <input type=hidden value={{$user->id}} name="user_id">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
              </form>
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
