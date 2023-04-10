
<div class="container">
<div class="checkfile-main-container">

  <div class="input-group mainpagecontent">
  <p class="welcomtitle">Check file integrity</p>
  <p class="mainpage-logintext"><a href="http://127.0.0.1:8000/Login" class="mainpagelink">Has an account? Login</a></p>
  </div>
  <form action="{{ route('proceed.check') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
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
    <?php echo html_entity_decode(Session::get('dataresult'));?>
  @endif
    

</div>
</div>

<script src="/js/sha256.js"></script>

