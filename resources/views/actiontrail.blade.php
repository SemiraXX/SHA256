<!DOCTYPE html>
<html lang="en">
<head>
  <title>SHA256-Hashing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="/css/css1.css" rel="stylesheet">
  @include('bootstrap.main')
</head>
<body>

<div class="row">

  <div class="col-sm-2 sidebarcol" style="background-color:#54389E">
      @include('sidebar')
  </div>

  <div class="col-sm-10">
    @include('popups')
    <div class="main-container" >
    <br>
        <p class="pagetitle">Action Trail</p>
        <p class="inputlabel">List of all movements accross the whole system.</p>
        <br>
        <div class="input-group teamgroupdiv">
        <input type="text" class="searchinput" placeholder="Search Username" name="search">
        </div>

        <table class="table-main">
        <thead>
            <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Username</th>
            <th>Action Taken</th>
            <th style="width:100px;">IP Add</th>
            </tr>
        </thead>
        <tbody>
        <?php $actions = DB::table('tbl_action_trail')->orderBy('id','desc')->get(); ?>
          @if($actions)
            @foreach($actions as $action)
            <tr>
            <td>{{$action->id}}</td>
            <td>{{$action->updated_at}}</td>
            <td>{{$action->user_id}}</td>
            <td>{{$action->action_taken}}</td>
            <td>{{$action->ip_add}}</td>
            </tr>
            @endforeach
          @else
          @endif
        </tbody>
        </table>
        </div>


  </div>

</div>

@include('modals.team')
<script src="/js/modal.js"></script>

</body>
</html>