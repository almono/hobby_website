@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-2 col-md-8 border col-form" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h2>Inbox</h2></b>
        <br><b>{{session('message')}}</b>
    </div>
    <div class="col-xs-12 col-md-offset-2 col-md-8 border" style="border:1px solid black; background-color:#d3e1c1;">
      <div class="table-responsive">
        <table class="table" style="width:100%;">
      <tr style="margin-top:1%; background-color:#a5ea80; text-align:center;">
        <th style="text-align:center; width:50%;">From</th>
        <th style="text-align:center; width:50%;">Topic</th>
      </tr>
      @foreach ($results as $result)
          <tr style="margin-top:4%">
            <form method="POST" action="{{route('view_message')}}">
              @if ($result->status == 0)
                <td style="text-align:center; font-weight: bold">{{$result->first_name . " " . $result->last_name}}</td>
                  <td style="text-align:center; font-weight: bold">
                    <input type="submit" style="border: none; background: none; padding: 0;" name="topic" value="{{$result->topic}}"></input>
                    <input type="hidden" name="message" value="{{$result->message}}"></input>
                    <input type="hidden" name="user" value="{{$result->user_id}}"></input>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
              @elseif ($result->status == 1)
                <td style="text-align:center;">{{$result->first_name . " " . $result->last_name}}</td>
                  <td style="text-align:center;">
                    <input type="submit" style="border: none; background: none; padding: 0;" name="topic" value="{{$result->topic}}"></input>
                    <input type="hidden" name="message" value="{{$result->message}}"></input>
                    <input type="hidden" name="user" value="{{$result->user_id}}"></input>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
              @endif
              </td>
            </form>
          </tr>
      @endforeach
    </table>
  </div>
          <div class="col-xs-12" style="padding-bottom:5%; text-align:center;">
            <?php echo $results->render(); ?>
              <form method="POST" action="{{route('new_message')}}">
                <input type="submit" name="new" value="Write new" class="btn btn-info col-xs-12 col-md-offset-4 col-md-4">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
          </div>
    </div>
</div>
