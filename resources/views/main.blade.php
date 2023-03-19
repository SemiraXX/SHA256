

<div class="main-container">

  <p class="pagetitle">Check file integrity</p>


  <p class="inputlabel"><strong>F1</strong>: Select file to check</p>

  <!--<div class="uploadwrapperdesign">
    <p class="uploadicondesign filenamevalhesdasdasre"><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
  </div>

  <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
  </div>
  </div>-->

  <input type="file" class="inputclass filetype" placeholder="Enter" id="fileselector" onchange="hashfile()">
  <input type="TEXT" class="inputclass" id="filehashcode">
  <br><br>
  <p class="inputlabel"><strong>F2</strong>: Select file from DB</p>
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

