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
        <p class="pagetitle">Categories</p>
        <p class="inputlabel">Custom categories and user roles</p>
        <br>
        <div class="input-group teamgroupdiv">
        <button type="submit" class="add-categ-button"><i class="fa fa-plus" aria-hidden="true"></i> Create Category</button>
        <input type="text" class="searchinput" placeholder="Type Here" name="search">
        </div>

     
        <table class="table-main">
        <thead>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Roles</th>
            <th>Date Created</th>
            <th>Last Modified</th>
            </tr>
        </thead>
        <tbody>
          <?php $categories = DB::table('tbl_category')->get(); ?>
          @if($categories)
            @foreach($categories as $category)
            <?php $roles = DB::table('tbl_userroles')->where('id',$category->id)->first(); ?>
            <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->cat_name}}</td>
            <td>{{$category->cat_desc}}</td>
            <td>
              @if(!empty($roles->ViewReport)) Manage Reports, @else  @endif
              @if(!empty($roles->DeleteReport)) Delete Report, @else  @endif
              @if(!empty($roles->Checkfile)) Check file, @else  @endif
              @if(!empty($roles->UploadFile)) Manage Saved Files, @else  @endif 
              @if(!empty($roles->ViewActionTrail)) View Action Trail, @else  @endif 
              @if(!empty($roles->ViewTeams)) Manage Teams, @else  @endif 
              @if(!empty($roles->AddnewTeam)) Add new Team, @else  @endif 
              @if(!empty($roles->RemoveTeam)) Remove Team, @else  @endif 
              @if(!empty($roles->ViewCategories)) Modify Categories, @else  @endif 
              @if(!empty($roles->Addnewcategory)) Add new Category, @else  @endif 
              @if(!empty($roles->Removecategory)) Remove Category @else  @endif
            </td>
            <td>{{$category->created_at}}</td>
            <td>{{$category->updated_at}}</td>
            </tr>
            @endforeach
          @else
          @endif
        </tbody>
        </table>

    </div>

  </div>

</div>

@include('modals.category')
<script src="/js/modal.js"></script>

</body>
</html>