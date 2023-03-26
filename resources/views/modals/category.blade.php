

<!-- CATEGORIES LIST Modal -->
<div class="modal fade" id="category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <div class="modal-body">

        <div class="modalhead">
            <p class="modaltitletext">Create new category</p>
        </div>

        <div class="modalcontent">
            <form action="{{ route('category.new') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <p class="inputlabel">Category Name</p>
            <input type="text" class="inputclass" placeholder="Type Here" name="CategoryName">
            <br><br>
            <p class="inputlabel">Description</p>
            <textarea class="inputclasstext" rows="4" name="Description"></textarea>
            <br><br>
            <p class="inputlabel">Roles</p>
            <div class="row">
              <div class="col-sm-6">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="ViewReport" value="1">
                    <label class="inputlabel">Manage Reports</label>
                  </div>
                  <div class="form-check" style="display:none">
                    <input type="checkbox" class="form-check-input" name="DeleteReport" value="1">
                    <label class="inputlabel">Delete Report</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="Checkfile" value="1">
                    <label class="inputlabel">Check File</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="UploadFile" value="1">
                    <label class="inputlabel">Manage Saved Files</label>
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="ViewActionTrail" value="1">
                    <label class="inputlabel">View Action Trail</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="ViewTeams" value="1">
                    <label class="inputlabel">Manage Teams</label>
                  </div>
                  <div class="form-check" style="display:none">
                    <input type="checkbox" class="form-check-input" name="AddnewTeam" value="1">
                    <label class="inputlabel">Add New Team</label>
                  </div>
                  <div class="form-check" style="display:none">
                    <input type="checkbox" class="form-check-input" name="RemoveTeam" value="1">
                    <label class="inputlabel">Remove Team</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="ViewCategories" value="1">
                    <label class="inputlabel">View Categories</label>
                  </div>
                  <div class="form-check" style="display:none">
                    <input type="checkbox" class="form-check-input" name="Addnewcategory" value="1">
                    <label class="inputlabel">Add new category</label>
                  </div>
                  <div class="form-check" style="display:none">
                    <input type="checkbox" class="form-check-input" name="Removecategory" value="1">
                    <label class="inputlabel">Modify category</label>
                  </div>
              </div>
            </div>
            <br>
            <button type="submit" class="loginbutton">Save</button>
            <br><br>
            </form>
        </div>

      </div>

  </div>
</div>
