

<!-- Add new team Modal -->
<div class="modal fade" id="addteam" >
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <div class="modal-body">

        <div class="modalhead">
            <p class="modaltitletext">Create new account</p>
        </div>

        <?php 
        $categories = DB::table('tbl_category')->get(); 
        $getlatestuserid = DB::table('tbl_useraccounts')->orderby('id','desc')->first(); 
        if($getlatestuserid)
        {$SetUserName = sprintf("%09s",$getlatestuserid->id + 1);}
        else{$SetUserName = sprintf("%09s",1);}
        ?>

        <div class="modalcontent">
            <form action="{{ route('team.new') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <p class="inputlabel">Username (AutGen)</p>
            <input type="text" class="inputclass" value="<?php echo $SetUserName; ?>" name="UserName" readonly>
            <br><br>
            <p class="inputlabel">Set Password</p>
            <input type="text" class="inputclass" placeholder="Type Here" name="Password">
            <br><br>
            <p class="inputlabel">Set Cetegory</p>
            <select class="inputclass" id="originalfile" name="Category">
            @if($categories)
              @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->cat_name}}</option>
              @endforeach
            @else
                <option value="0">None</option>
            @endif
            </select>
            <br><br>
            <button type="submit" class="loginbutton">Login</button>
            <br><br>
            </form>
        </div>


      </div>

    </div>

  </div>
</div>


<!-- View Report Modal -->
<div class="modal fade" id="editaccount">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <div class="modal-body">

        <div class="modalhead">
            <p class="modaltitletext">Edit Account Category</p>
        </div>

        <div class="modalcontent" id="reportareponsedata">
            <form action="{{ route('process.edit') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="vi" id="accountareponsedata"></div>
            </form>
        </div>

      </div>

    </div>

  </div>
</div>



<!-- View Report Modal -->
<div class="modal fade" id="deleteaccount">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <div class="modal-body">

        <div class="redmodalhead">
            <p class="modaltitletext">Remove Account</p>
        </div>

        <div class="modalcontent" id="accountdeleteareponsedata">
            <div class="vi" id="accountareponsedata"></div>
        </div>

      </div>

    </div>

  </div>
</div>




