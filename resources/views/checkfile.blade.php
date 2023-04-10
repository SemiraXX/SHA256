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
   
    <form action="{{ route('proceed.check') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="main-container">
        <p class="mainpagetitle">Check file integrity</p>
        <p class="inputlabel1"><strong>F1</strong>: Choose file</p>
        <input type="file" class="inputclass filetype" placeholder="Enter" name="mainfile" id="fileselector" onchange="hashfile()" required>
        <input type="hidden" class="inputclass" id="filehashcode" name="filehashcode">
        <br>
        <p class="inputlabel1"><strong>F2</strong>: Select file from DB</p>
        <select class="inputclass" id="originalfile" name="originalfile" required>
            @foreach($allfiles as $file)
            <option value="{{$file->FileID}}">{{$file->FileID}} - {{$file->FileName}}</option>
            @endforeach
        </select>
        <br><br>
        <button type="submit" class="checkbtn">Show Result</button>
    
        <br><br>
        <hr>
        @if(Session::get('dataresult'))
          <?php echo htmlentities(Session::get('dataresult'));?>
        @endif
        <div id="responsedata1"></div>
    </div>

  </div>
</form>
</div>

<script src="/js/sha256.js"></script>
</body>
</html>
