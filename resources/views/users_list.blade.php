@include('home')

<div class="container" style="margin-bottom:2%;">
    <div class="col-xs-12 col-md-offset-1 col-md-10 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h2>Users</h2></b><br>
        <b>{{session('invalid_data')}}</b>
    </div>
    <div class="col-xs-12 col-md-offset-1 col-md-10 border" style="border:1px solid black; background-color:#d3e1c1;">
      <div class="table-responsive">
        <table class="table" style="width:100%;">
      <tr style="background-color:#a5ea80;">
        <th style="text-align:center;">User</th>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Edit</th>
        <th style="text-align:center;">Delete</th>
      </tr>
      @foreach ($results as $result)
          <tr style="margin-top:4%">
              <td style="text-align:center;"><b>{{$result->username}}</b></label>
              <td style="text-align:center;">{{$result->first_name . " " . $result->last_name}}</label>
              <td style="text-align:center;">{{$result->role}}</label>
              <td style="text-align:center;">
                <form method="get" action="{{route('edit_user')}}">
                  <input type=submit value="O"></button>
                  <input type="hidden" name="user_id" value="{{$result->id}}">
                </form>
              </td>
              <td style="text-align:center;">
                <form method="get" action="{{route('delete_user')}}">
                  <input type=submit value="X"></button>
                  <input type="hidden" name="user_id" value="{{$result->id}}">
                </form>
              </td>
          </tr>
      @endforeach
    </table>
    </div>
          <div class="col-xs-12" style="padding-bottom:5%; text-align:center">
            <?php echo $results->render(); ?>
            @if (session('wrong_new'))
              {{session('wrong_new')}}
            @endif
            <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
          </div>
    </div>
</div>
