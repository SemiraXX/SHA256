
<div class="container">
<div class="checkfile-main-container">

  <div class="input-group mainpagecontent">
  <p class="welcomtitle">Check file integrity</p>
  <p class="mainpage-logintext"><a href="http://127.0.0.1:8000/Login" class="mainpagelink">Has an account? Login</a></p>
  </div>

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
</div>

<script src="/js/sha256.js"></script>

