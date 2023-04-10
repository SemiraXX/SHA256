<!-- View Report Modal -->
<div class="modal fade" id="uploadmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <div class="modal-body">

        <div class="modalhead">
            <p class="modaltitletext">Upload new File</p>
        </div>

        <div class="modalcontent">

          <form action="{{ route('file.upload') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <p class="inputlabel"><strong>F1</strong>:Select file to check</p>
          <input type="file" class="inputclass" placeholder="Type Here" name="mainfile"  id="fileselector" onchange="hashfile()"  required>
          <input type="hidden" class="inputclass" id="filehashcode" name="filehashcode">
          <br><br>
          <p class="inputlabel">File Name</p>
          <input type="text" class="inputclass" placeholder="Type Here" id="fileName" name="fileName" readonly>
          <br><br>
          <p class="inputlabel">File Category</p>
          <input type="text" class="inputclass" placeholder="Type Here" id="fileCateg" name="fileCateg" readonly>
          <br><br>
          <button type="submit" class="checkbtn">Upload</button>
          <br><br>
          </form>

        </div>

      </div>

    </div>
    
  </div>
</div>