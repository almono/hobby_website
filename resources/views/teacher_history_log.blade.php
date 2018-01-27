@include('home')

<div class="container" style="margin-bottom:2%;">
    <div class="col-xs-12 col-md-offset-1 col-md-10 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h2>History log</h2></b><br>
        <b>{{session('invalid_data')}}</b>
    </div>
    <div class="col-xs-12 col-md-offset-1 col-md-10 border" style="border:1px solid black;  background-color:#d3e1c1;">
      <div class="table-responsive">
      <table class="table">
        <tr style="background-color:#a5ea80;">
          <th>Class</th>
          <th>Subject</th>
          <th>Student</th>
          <th>Grade</th>
          <th>Status</th>
        </tr>
      @foreach ($results as $result)
        <tr>
            <td >{{$result->class}}</td>
            <td >{{$result->subject}}</td>
            <td >{{$result->first . " " . $result->last}}</td>
            <td >{{$result->grade}}</td>
            @if ($result->action == 'Changed')
            <td >{{$result->action . " to " . $result->changedTo}}</td>
            @else
            <td >{{$result->action}}</td>
            @endif
        </tr>
      @endforeach
      </table>
    </div>
          <div class="col-xs-12" style="padding-bottom:5%; text-align:center;">
            @if (session('invalid_data'))
              {{session('invalid_data')}}
            @endif
            <?php echo $results->render(); ?>
            <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
          </div>
    </div>
</div>
