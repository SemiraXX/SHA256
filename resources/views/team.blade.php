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
    <div class="main-container">
    <br>
        <p class="pagetitle">Team</p>
        <p class="inputlabel">All user accounts</p>
        <br>
        <div class="input-group teamgroupdiv">
        <button type="submit" class="add-team-button"><i class="fa fa-user-plus" aria-hidden="true"></i> Create new account</button>
        <input type="text" class="searchinput" placeholder="Type Here" name="search">
        </div>

     
        <table class="table-main">
        <thead>
            <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Cat ID</th>
            <th>Cat Name</th>
            <th>Description</th>
            <th>Date Created</th>
            <th>Last Modified</th>
            <th style="width:80px;"></th>
            <th style="width:80px;"></th>
            </tr>
        </thead>
        <tbody>
        <?php $accounts = DB::table('tbl_useraccounts')->get(); ?>
          @if($accounts)
            @foreach($accounts as $account)
            <?php $categ = DB::table('tbl_category')->where('id', $account->cat_id)->first(); ?>
            <tr>
            <td>{{$account->id}}</td>
            <td>{{$account->usr_name}}</td>
            <td>{{$account->cat_id}}</td>
            <td>{{$categ->cat_name}}</td>
            <td>{{$categ->cat_desc}}</td>
            <td>{{$account->created_at}}</td>
            <td>{{$account->updated_at}}</td>
            <td><button type="button" id="{{$account->id}}" class="edit-account-button"> Edit </button></td>
            <td><button type="button" id="{{$account->id}}" class="delete-account-button"> Delete </button></td>
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