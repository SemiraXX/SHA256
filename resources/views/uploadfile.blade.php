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
    <div class="main-container">
    <br>
        <p class="pagetitle">Saved Files</p>
        <p class="inputlabel">List of original files in Argon2id format</p>
        <br>
        <div class="input-group teamgroupdiv">
        <button type="submit" class="upload-fille-button"><i class="fa fa-plus" aria-hidden="true"></i> Upload New</button>
        <input type="text" class="searchinput" placeholder="Type Here" name="search">
        </div>
        <table class="table-main">
        <thead>
            <tr>
            <th>ID</th>
            <th>File ID</th>
            <th>File Name</th>
            <th>Hash Code</th>
            <th>File Type</th>
            <th style="width:80px;"></th>
            <th style="width:80px;"></th>
            </tr>
        </thead>
        <tbody>
        <?php $files = DB::table('tbl_savedfiles')->orderby('id', 'desc')->get(); ?>
          @if($files)
            @foreach($files as $file)
            <?php $maskvalue = substr_replace($file->SHA256Argon2, str_repeat('*', strlen($file->SHA256Argon2)-7), 1, -6); ?>
            <tr>
            <td>{{$file->id}}</td>
            <td>{{$file->fileID}}</td>
            <td>{{$file->fileName}}</td>
            <td>{{$maskvalue}}</td>
            <td>{{$file->fileCateg}}</td>
            <td><button type="button" id="{{$file->id}}" class="edit-account-button"> Edit </button></td>
            <td><button type="button" id="{{$file->id}}" class="delete-account-button"> Delete </button></td>
            </tr>
            @endforeach
          @else
          @endif
        </tbody>
        </table>
        <br>

    </div>

  </div>

</div>



@include('modals.upload')
<script src="/js/modal.js"></script>
<script src="/js/sha256.js"></script>

</body>
</html>