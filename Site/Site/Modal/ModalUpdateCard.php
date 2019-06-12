<div class="modal fade" id="ModalUpdateCard">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" >Update Card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form name="updatecard" id="formcard" action="javascript:">
            <div class="form-group row">
            <label class="col-2 form-label">Title</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="title" value="" id="TitleUpdate">
            </div>
            </div>
              
        <div class="form-group row">
            <label class="col-2 form-label">Email</label>
            <div class="col-sm-9">
            <input type="email" class="form-control" name="email" placeholder="Email" value="" id="EmailUpdate">
        </div>
        </div>
              
        <div class="form-group row">
            <label class="col-2 form-label">Tel</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="tel" placeholder="Tel" value="" id="TelUpdate">
            </div>
        </div>
              
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="modalupdatecard">Save</button></div>
        </form>
      </div>
    </div>
  </div>
</div>