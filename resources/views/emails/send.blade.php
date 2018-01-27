<html>
<style>
  h1 {
    color: #636b6f;
    font-family: 'Raleway', sans-serif;
    font-weight: 100;
  }
  table.redTable {
  border: 2px solid #A40808;
  background-color: #EEE7DB;
  width: 35%;
  text-align: center;
  border-collapse: collapse;
  }
  table.redTable td, table.redTable th {
    border: 1px solid #AAAAAA;
    padding: 3px 2px;
    color: black;
  }
  table.redTable tbody td {
    font-size: 13px;
  }
  table.redTable thead {
    background: #A40808;
  }
  table.redTable thead th {
    font-size: 19px;
    font-weight: bold;
    color: #FFFFFF;
    text-align: center;
    border-left: 2px solid #A40808;
  }
</style>
<head></head>
<body style="background: black; color: white; ">
<h1>{{$title}}</h1>
<p>{{$content}}</p>
<table class="redTable">
  <tr>
    <th>Subject</th>
    <th>Grade</th>
  </tr>
  <tr>
    <td><b>{{$subject}}</b></td>
    <td><b>{{$grade}}</b></td>
  </tr>
</table>
</body>
</html>
