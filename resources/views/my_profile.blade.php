@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-4 col-md-4 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h3>~~MY PROFILE~~</h3></b>
    </div>
    <div class="col-xs-12 col-md-offset-4 col-md-4 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">First name</label>
              <div class="col-xs-8 col-md-6">
                  <label type="text" class="form-control" name="first_name" id="first_name">{{session('user.first_name')}}</label>
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">Last name</label>
              <div class="col-xs-8 col-md-6">
                  <label type="text" class="form-control" name="last_name">{{session('user.last_name')}}</label>
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">Username</label>
              <div class="col-xs-8 col-md-6">
                  <label type="text" class="form-control" name="username">{{session('user.username')}}</label>
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">Role</label>
              <div class="col-xs-8 col-md-6">
                  <label type="text" class="form-control" name="role">
                    @if (session('user.role_id')==1)
                      Headmaster
                    @elseif (session('user.role_id')==2)
                      Teacher
                    @else
                      Student
                    @endif
                  </label>
              </div>
          </div>
          <div class="form-group row" style="margin-top:4%">
              <label class="col-xs-4 col-md-6 col-form-label" style="padding-top:2%">New password</label>
              <form method="POST">
              <div class="col-xs-8 col-md-6">
                  <input type="password" class="form-control" name="new_password"></input>
              </div>
          </div>
          <div class="form-group row">
              <div class="col-xs-offset-3 col-xs-9 col-sm-offset-4 col-sm-8 col-md-offset-6 col-md-6" style="margin-top:0%;">
                  <input type=submit value='Change password' name="change_password" class="col-xs-12 btn btn-info">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
              </form>
          </div>
          <div class="col-xs-12" style="padding-bottom:5%;">
            @if (session('wrong_new'))
              {{session('wrong_new')}}
            @endif
            <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
          </div>
    </div>
</div>
