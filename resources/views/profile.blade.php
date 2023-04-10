<!DOCTYPE html>
<html lang="en">
<head>
  <title>SHA256-Hashing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="/css/css1.css" rel="stylesheet">
  <link href="/css/loader.css" rel="stylesheet">
  @include('bootstrap.main')
</head>
<body>

<div class="row">

  <div class="col-sm-2 sidebarcol" style="background-color:#54389E">
      @include('sidebar')
  </div>

  <div class="col-sm-10">
    @include('popups')
    <?php
    if(session()->has('systemsession'))
    {
        $profile = DB::table('tbl_useraccounts')->where('id', '=', session('systemsession'))->first();
        $profilecateg = DB::table('tbl_category')->where('id', $profile->cat_id)->first();
        $mylogs = DB::table('tbl_logs')->where('username', $profile->usr_name)->limit(15)->get();
    }
    else
    {
      
    }
    ?>
    <div class="main-container">
    <br>
        <p class="pagetitle">Welcome</p>
        <p class="inputlabel">Username : {{$profile->usr_name}}</p>
        <p class="inputlabel">Access Role : {{$profilecateg->cat_name}}</p>
        <p class="inputlabel">Role Description: {{$profilecateg->cat_desc}}</p>

        <table class="table-main">
        <thead>
            <tr>
            <th>ID</th>
            <th style="width:200px">Date Logged</th>
            <th>Remarks</th>
            <th>IP Add</th>
            <th>Browser</th>
            </tr>
        </thead>
        <tbody>
          @if($mylogs)
            @foreach($mylogs as $log)
            <tr>
            <td>{{$log->id}}</td>
            <td>{{$log->created_at}}</td>
            <td>{{$log->remarks}}</td>
            <td>{{$log->ip_add}}</td>
            <td>{{$log->http_browser}}</td>
            </tr>
            @endforeach
          @else
          @endif
        </tbody>
        </table>
        <br><br>
    </div>

  </div>

</div>





</body>
</html>