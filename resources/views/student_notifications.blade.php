@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-4 col-md-4 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h2>Notifications</h2></b>
        <br><b>{{session('data')}}</b>
    </div>
    <div class="col-xs-12 col-md-offset-4 col-md-4 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
      <div class="form-group row" style="margin-top:1%; background-color:#a5ea80;">
        <label class="col-xs-7 col-xs-offset-1 col-md-7 col-form-label" style="padding-top:2%">Email</label>
        <label class="col-xs-3 col-form-label" style="padding-top:2%">Action</label>
      </div>
      <div class="form-group row" style="margin-top:4%">
        <form method="POST" action="{{route('student_enable_notifications')}}">
          <div class="col-xs-7 col-xs-offset-1">
            <input type="email" class="form-control" name="email"></input>
          </div>
            <input type=submit name="enable_notif" value="Enable" class="col-xs-3 btn btn-info"></button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>
      </div>

      <div class="col-xs-12" style="padding-bottom:5%;">
        @if (!empty(Session('message')))
          {{Session('message')}}
        @endif
            <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
      </div>
    </div>
</div>
