@include('home')

<div class="container" style="margin-bottom:2%;">
    <div class="col-xs-12 col-md-offset-1 col-md-10 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h2>Grades list</h2></b><br>
        <b>{{session('invalid_data')}}</b>
    </div>
    <div class="col-xs-12 col-md-offset-1 col-md-10 border" style="border:1px solid black; background-color:#d3e1c1;">
      <div class="table">
        <table class="table-responsive" style="width:100%;">
          <tr style="background-color:#a5ea80; text-align:center;">
            <th style="text-align:left;">Class</th>
            <th style="text-align:left;">Subject</th>
          </tr>
        @foreach ($mygrades as $key=>$class)
            @foreach ($class as $key2=>$subject)
          <tr style="background-color:#55e580; ">
            <td style="text-align:left;"><b><u>{{$key}}</u></b></td>
            <td style="text-align:left;"><b>{{$key2}}</b></td>
          </tr>
            @foreach ($subject as $key3=>$student)
            <tr>
              <td style="padding-top:1%; padding-bottom:1%;">{{$key3}}</td>
              <td>
                @foreach($student as $key4=>$grade)
              <form method="POST" action="{{route('view_grade')}}" style="display:inline;">
                <button title="{{$grade[1]}}" type="submit" style="cursos:pointer;background:none!important;border:1px solid black; ">{{$grade[0]}}</button>
                <input type="hidden" name="grade_id" value="{{$key4}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
              @endforeach
            </td>
            </tr>
            @endforeach
          @endforeach
        @endforeach <!--
        @foreach ($results as $result)
          <tr style="text-align:center;">
            <td><u>{{$result->class}}</u></td>
            <td>{{$result->subject_name}}</td>
            <td>{{$result->first . " " . $result->last}}</td>
            <td>{{$result->grade}}</td>
            <td>
              <form method="get" action="{{route('view_grade')}}">
                <input type=submit value="O"></button>
                <input type="hidden" name="grade_id" value="{{$result->grade_id}}">
              </form>
            </td>
            <td>
              <form method="post" action="{{route('delete_grade')}}">
                <input type=submit value="X"></button>
                <input type="hidden" name="grade_id" value="{{$result->grade_id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
            </td>
          </tr>
        @endforeach -->
      </table>
      </div>
      <div style="text-align:center">

      </div>
    </div>
</div>
