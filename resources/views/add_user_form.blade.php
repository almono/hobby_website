@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-4 col-md-4 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h3>Add new user</h3></b>
    </div>
    <div class="col-xs-12 col-md-offset-4 col-md-4 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
      <form method="POST" action="{{route ('new_user') }}">
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">First name</label>
              <div class="col-xs-8 col-md-6">
                @if (!is_null($input['first']))
                  <input type="text" class="form-control" name="first_name" value="{{$input['first']}}">
                @else
                  <input type="text" class="form-control" name="first_name">
                @endif
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">Last name</label>
              <div class="col-xs-8 col-md-6">
                @if (!is_null($input['last']))
                  <input type="text" class="form-control" name="last_name" value="{{$input['last']}}">
                @else
                  <input type="text" class="form-control" name="last_name">
                @endif
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">Username</label>
              <div class="col-xs-8 col-md-6">
                @if (!is_null($input['username']))
                  <input type="text" class="form-control" name="username" value="{{$input['username']}}">
                @else
                  <input type="text" class="form-control" name="username">
                @endif
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">Password</label>
              <div class="col-xs-8 col-md-6">
                  <input type="password" class="form-control" name="password">
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">Confirm password</label>
              <div class="col-xs-8 col-md-6">
                  <input type="password" class="form-control" name="password_conf">
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">Role</label>
              <div class="col-xs-8 col-md-6">
                <select name="role_id" class="col-xs-12 form-control">
                    <option value=1>Headmaster</option>
                    <option value=2>Teacher</option>
                    <option value=3>Student</option>
                </select>
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
            <div class="col-xs-12 col-md-offset-3 col-md-6">
              <input type="submit" value="Add user" class="form-control btn btn-info">
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
