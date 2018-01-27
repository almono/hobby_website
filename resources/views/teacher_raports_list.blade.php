@include('home')

<div class="container" style="margin-bottom:2%;">
    <div class="col-xs-12 col-md-offset-2 col-md-8 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h2>Reports list</h2></b><br>
        <b>{{session('invalid_data')}}</b>
    </div>
    <div class="col-xs-12 col-md-offset-2 col-md-8 border" style="border:1px solid black; background-color:#d3e1c1;">
      <div class="table">
        <table class="table-responsive" style="width:100%; text-align:center;">
          <tr style="background-color:#a5ea80;">
            <th style="text-align:center">Report</th>
            <th style="text-align:center">Action</th>
          </tr>
        @foreach ($results as $result)
          <tr>
            <td><b>{{substr($result->name,0,19)}}</b></td>
            <form action="{{route('teacher_get_raport')}}">
              <td><input type="submit" value="Download" class="btn btn-warning"></td>
              <input type="hidden" name="raport_name" value="{{$result->name}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
          </tr>
        @endforeach
        </table>
      </div>
      <div style="text-align:center">
        <?php echo $results->render(); ?>
        <div class="col-xs-12" style="padding-bottom:5%;">
          <form method="POST" action="{{route('teacher_new_raport')}}">
            <input type="submit" name="new_raport" value="Generate new" class="btn btn-info">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>
        </div>
      </div>
    </div>
</div>
