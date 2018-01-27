@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-2 col-md-8 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h2>Subjects</h2></b>
        <br><b>{{session('data')}}</b>
    </div>
    <div class="col-xs-12 col-md-offset-2 col-md-8 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
      <div class="table-responsive">
        <table class="table" style="width:100%;">
      <tr style="margin-top:1%; background-color:#a5ea80;">
        <th style="text-align:center">Subject</th>
        <th style="text-align:center">Leading teacher</th>
        <th style="text-align:center">Edit</th>
        <th style="text-align:center">Delete</th>
      </tr>
      @foreach ($results as $result)
          <tr style="margin-top:4%">
              <td ><u>{{$result->subject}}</u></td>
              <td >{{$result->first_name . " " . $result->last_name}}</td>
              <td >
                <form method="get" action="{{route('edit_subject')}}">
                  <input type=submit value="O"></button>
                  <input type="hidden" name="subject_id" value="{{$result->id}}">
                </form>
              </td>
              <td >
                <form method="get" action="{{route('delete_subject')}}">
                  <input type=submit value="X"></button>
                  <input type="hidden" name="subject_id" value="{{$result->id}}">
                </form>
              </td>
          </tr>
      @endforeach
    </table>
  </div>
          <div class="col-xs-12" style="padding-bottom:5%;">
            {{session('wrong_data')}}
            @if (session('wrong_new'))
              {{session('wrong_new')}}
            @endif
            <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
          </div>
    </div>
</div>
