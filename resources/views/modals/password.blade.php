

<!-- EDIT PASSWORD Modal -->
<div class="modal fade" id="PASSWORDUPDATE">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <div class="modal-body">

        <div class="modalhead">
            <p class="modaltitletext">Change Password</p>
        </div>

        <div class="modalcontent" id="reportareponsedata">
            <form action="{{ route('pw.change') }}" method="post">
            {{ csrf_field() }}
            <p class="inputlabel">Current Password</p>
            <input type="password" class="inputclass" name="current" placeholder="Type here" required>
            <br><br>
            <p class="inputlabel">New Password</p>
            <input type="password" class="inputclass" name="newpas" placeholder="Type here" required>
            <br><br>
            <button type="submit" class="loginbutton">Continue</button>
            </form>
        </div>

      </div>

    </div>

  </div>
</div>