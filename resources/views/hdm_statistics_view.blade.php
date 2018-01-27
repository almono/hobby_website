@include('home')

<div class="container">
    <div class="col-xs-12 col-md-offset-2 col-md-8 border col-form-" style="margin-top:5%; border:1px solid gray; text-align:center; padding-bottom:2%; padding-top:2%; border-radius:25px 25px 0px 0px; background-color:#9dcd5f">
      @if ($option == 1)
        <b><h3>Teachers statistics</h3></b>
      @elseif ($option == 2)
        <b><h3>Subjects statistics</h3></b>
      @elseif ($option == 3)
        <b><h3>Classes statistics</h3></b>
      @endif
    </div>
    <div class="col-xs-12 col-md-offset-2 col-md-8 border" style="border:1px solid black; text-align:center; background-color:#d3e1c1;">
      <div class="form-group row" style="margin-top:1%; text-align:center; background-color:#a5ea80;">
        <label class="col-xs-7 col-md-7" style="padding-top:2%">Name</label>
        @if ($option == 1)
          <label class="col-xs-5 col-md-5" style="padding-top:2%">Grades writen</label>
        @elseif ($option == 2)
          <label class="col-xs-5 col-md-5" style="padding-top:2%">Grades amount</label>
        @elseif ($option == 3)
          <label class="col-xs-5 col-md-5" style="padding-top:2%">Number of students</label>
        @endif
      </div>
      @foreach($results as $result)
        <div class="form-group row" style="margin-top:4%">
          @if ($option == 1)
            <label type="text" class="col-xs-7">{{$result->teacher_first . " " . $result->teacher_last }}</label>
          @elseif ($option == 2)
            <label type="text" class="col-xs-7">{{$result->subject }}</label>
          @elseif ($option == 3)
            <label type="text" class="col-xs-7">{{$result->class }}</label>
          @endif
          <label type="text" class="col-xs-5">{{$result->Total . " " }}</label>
        </div>
      @endforeach
      <div id="test-chart"></div>
      <?php echo Lava::render('PieChart', 'statistics', 'test-chart'); ?>
      <div class="form-group row" style="margin-top:4%">
        <div class="col-xs-12 col-md-offset-3 col-md-6">
        </div>
      </div>
    </div>
</div>
