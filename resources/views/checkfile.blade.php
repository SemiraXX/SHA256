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
  
    <div class="main-container">
        <p class="mainpagetitle">Check file integrity</p>
        <p class="inputlabel1"><strong>F1</strong>: Choose file</p>
        <input type="file" class="inputclass filetype" placeholder="Enter" id="fileselector" onchange="hashfile()">
        <input type="hidden" class="inputclass" id="filehashcode">
        <br>
        <p class="inputlabel1"><strong>F2</strong>: Select file from DB</p>
        <select class="inputclass" id="originalfile" name="originalfile">
            @foreach($allfiles as $file)
            <option value="{{$file->SHA256Argon2}}">{{$file->fileID}} - {{$file->fileName}}</option>
            @endforeach
        </select>
        <br><br>
        <button type="button" class="checkbtn result">Show Result</button>
        <br><br>
        <hr>
        <div id="responsedata1"></div>
    </div>

    <script src="/js/sha256.js"></script>

  </div>

</div>


</body>
</html>
