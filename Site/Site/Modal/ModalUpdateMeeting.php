<div class="modal fade" id="ModalUpdateMeeting">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" >Meeting info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
    <div class="container">
<form id="updateMeetingForm">
  <div class="form-group row">
    <label class="col-2 form-label">Title</label>
    <div class="col-sm-8">
      <input type="text"  value="" class="form-control" id="updateTitleMeeting" > <!-- DOVREBBE ESSERE UNICO MA NELLO SHCEMA NON RISULTA-->
    </div>
  </div>
     
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label"> Date</label>
    <div class="col-sm-8">
      <input type="text" value="" class="form-control" id="updateDateMeeting" name="updateDateMeeting">
    </div>
  </div>
        
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"> Place </label>
    <div class="col-sm-8">
      <input type="text"  value=""  class="form-control" id="PlaceMeeting">
    </div>
  </div> 
    
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"> Location </label>
    <div class="col-sm-8">
      <div id="map" class="row" style="width:100%;height:200px;"></div>
    </div>
  </div> 
    
  <div id="infowindow-content">
            <img src="" width="16" height="16" id="place-icon">
            <span id="place-name"  class="title"></span><br>
            <span id="place-address"></span>
    </div>
    
<div class="modal-footer">
        <button type="submit" class="btn btn-primary" value="1">Update</button>
</div>

</form>
</div>
    </div>
  </div>
</div>
</div>
