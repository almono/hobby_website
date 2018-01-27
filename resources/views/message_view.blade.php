@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-4 col-md-4 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h3>{{$results->topic}}</h3></b>
    </div>
    <div class="col-xs-12 col-md-offset-4 col-md-4 border" style="border:1px solid black; background-color:#d3e1c1;">
        <div class="form-group row" style="margin-top:4%; text-align:left">
            <label class="col-xs-12 col-md-12 col-form-label">Message:</label>
            <div class="col-xs-12 col-md-12">
              <textarea style="width: 100%; resize: none; font-size: 14px" name="content" disabled>{{$results->content}}</textarea>
            </div>
        </div>
        <div class="form-group row" style="margin-top:4%; text-align:left">
            <label class="col-xs-12 col-md-12 col-form-label">From:</label>
            <div class="col-xs-12 col-md-12">
              <textarea style="width: 100%; resize: none; font-size: 14px" name="content" disabled>{{ucfirst($results->role) . " " . $results->first_name . " " . $results->last_name}}</textarea>
            </div>
        </div>
        <div class="col-xs-12" style="padding-bottom:5%; text-align:center">
          <form class="col-xs-6" method="POST" action="{{route('new_message')}}">
            <input type="submit" value="Reply" class="btn btn-info">
            <input type="hidden" name="replying" value="1">
            <input type="hidden" name="user" value="{{$results->first_name . " " . $results->last_name}}">
            <input type="hidden" name="user_id" value="{{$user}}">
            <input type="hidden" name="topic" value="{{$topic}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>
          <form class="col-xs-6" method="POST" action="{{route('delete_message')}}">
            <input type="submit" value="Delete" class="btn btn-info">
            <input type="hidden" name="message" value="{{$results->message}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>
        </div>
    </div>
</div>
