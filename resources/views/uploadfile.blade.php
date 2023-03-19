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
        <p class="pagetitle">Upload File</p>
        <br>
        <form action="{{ route('file.upload') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
        <p class="inputlabel">File Name</p>
        <input type="text" class="inputclass" placeholder="Type Here" name="fileName">
        <br><br>
        <p class="inputlabel">File Category</p>
        <input type="text" class="inputclass" placeholder="Type Here" name="fileCateg">
        <br><br>
        <p class="inputlabel">Posted By</p>
        <input type="text" class="inputclass" value="Maiky" name="postedBy" readonly>
        <br><br>
        <p class="inputlabel">Posted Date</p>
        <input type="text" class="inputclass" value="<?php echo date('m-d-y');?>" name="postedDate" readonly>
        <br><br>
        <p class="inputlabel"><strong>F1</strong>:Select file to check</p>
        <input type="file" class="inputclass" placeholder="Type Here" name="mainfile" required>

        
        <br><br>
        <button type="submit" class="checkbtn">Upload</button>
        <br><br>
        </form>

    </div>

  </div>

</div>


</body>
</html>