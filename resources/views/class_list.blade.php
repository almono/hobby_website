@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-4 col-md-4 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h2>Class list</h2></b>
        <br><b>{{session('data')}}</b>
    </div>
    <div class="col-xs-12 col-md-offset-4 col-md-4 border" style="border:1px solid black; background-color:#d3e1c1;">
      <div class="table-responsive">
        <table class="table" style="width:100%;">
      <tr style="margin-top:1%; background-color:#a5ea80; text-align:center;">
        <th style="text-align:center;">Class</th>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Edit</th>
        <th style="text-align:center;">Delete</th>
      </tr>
      @foreach ($results as $result)
          <tr style="margin-top:4%">
              <td style="text-align:center;"><b>{{$result->name}}</b></td>
              <td style="text-align:center;">{{$result->subjects_name}}</td>
                <td style="text-align:center;">
                  <form method="get" action="{{route('edit_class')}}">
                    <input type=submit value="O"></button>
                    <input type="hidden" name="class_id" value="{{$result->id}}">
                  </form>
                </td>
                <td style="text-align:center;">
                  <form method="get" action="{{route('delete_class')}}">
                    <input type=submit value="X"></button>
                    <input type="hidden" name="class_id" value="{{$result->id}}">
                  </form>
                </td>
          </tr>
      @endforeach
    </table>
  </div>
          <div class="col-xs-12" style="padding-bottom:5%; text-align:center;">
            @if (session('wrong_info'))
              {{session('wrong_info')}}
            @endif
            <?php echo $results->render(); ?>
            <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
          </div>
    </div>
</div>
