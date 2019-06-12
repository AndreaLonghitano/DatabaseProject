<div class="modal fade" id="ModalUpdateWork">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" >Update Work experience</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form name="updateform" id="formwork">
            <div class="form-group row">
            <label class="col-2 form-label">Company</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="company" placeholder="Company" value="" disabled id="modcompany">
            </div>
            </div>
              
        <div class="form-group row">
            <label class="col-2 form-label">Role</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="Role" placeholder="Role" value="" id="modrole">
        </div>
        </div>
              
        <div class="form-group row">
            <label class="col-2 form-label">Place</label>
            <div class="col-sm-9">
            <select  class="form-control" name="place" id="modplace" placeholder="Place">
            </select>
            </div>
        </div>
              
        <div class="form-group row">
            <label class="col-2 form-label">Year</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="year" placeholder="Year" id="modyear" value="">
            </div>
        </div>  
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="modalupdatebutton">Save</button></div>
        </form>
      </div>
    </div>
  </div>
</div>

