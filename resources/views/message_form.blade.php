@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-4 col-md-4 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
        <b><h3>Send message</h3></b>
    </div>
    <div class="col-xs-12 col-md-offset-4 col-md-4 border" style="border:1px solid black; background-color:#d3e1c1;">
      <form method="POST" action="{{route('send_message') }}">
        <div class="form-group row" style="margin-top:4%;">
            <label class="col-xs-1 col-md-1" style="padding-top:2%">To:</label>
            <div class="col-xs-12 col-md-11">
            <select name="person" class="form-control" style="width: 100%">
              @if (!isset($replying))
                @foreach ($users as $user)
                  <option value = "{{$user->id}}" style="width:100%">{{ucfirst($user->role_name) . ": " . $user->first_name . " " . $user->last_name}}</option>
                @endforeach
              @else
                <option value="{{$user_id}}" style="width:100%;" selected>{{$user}}</option>
              @endif
            </select>
          </div>
        </div>
        <div class="form-group row" style="margin-top:4%; text-align:left">
            <label class="col-xs-12 col-md-12 col-form-label">Topic:</label>
            <div class="col-xs-12 col-md-12">
              @if (!isset($replying))
                <textarea maxlength="50" rows="1" wrap="hard" style="width: 100%; resize: none; font-size: 16px" name="topic" required></textarea>
              @else
                <textarea maxlength="50" rows="1" wrap="hard" style="width: 100%; resize: none; font-size: 16px" name="topic" required>{{"Re: " . $topic}}</textarea>
              @endif
            </div>
        </div>
        <div class="form-group row" style="margin-top:4%; text-align:left">
            <label class="col-xs-12 col-md-12 col-form-label">Message:</label>
            <div class="col-xs-12 col-md-12">
              <textarea maxlength="200" wrap="hard" spellcheck="true" style="width: 100%; resize: none; font-size: 16px" name="content" required></textarea>
            </div>
        </div>
        <div class="col-xs-12" style="padding-bottom:5%; text-align:center">
          <input type="submit" name="send" value="Send" class="btn btn-info col-xs-offset-3 col-xs-6">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>
      </form>
    </div>
</div>
