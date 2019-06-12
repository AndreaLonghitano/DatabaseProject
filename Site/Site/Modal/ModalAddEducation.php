<div class="modal fade" id="ModalAddEdu">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" >Add Education Experience</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formAddEdu" name="formAddEdu">
            <div class="form-group row">
            <label class="col-2 form-label">Title</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="company" placeholder="Title" value="" id="AddModTitle">
            </div>
            </div>
              
        <div class="form-group row">
            <label class="col-2 form-label">Year</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="year" placeholder="Year" value="" id="AddModYear">
        </div>
        </div>
              
        <div class="form-group row">
            <label class="col-2 form-label">Place</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="place" placeholder="Place" value="" id="AddModPlace">
            </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary" value="1">Add</button></div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    
    $(document).ready(function(){
     var formAddEdu=$("#formAddEdu");
        
        formAddEdu.validate({
			         errorPlacement: function errorPlacement(error, element) { error.insertAfter(element); },
                     rules:{
                        company:{ required:true,},
                        place:{required:true,},
                        year:{required:true,
                              number:true},
                },
			 messages: {
                        company: "Insert a Valid Title",
                        year: {
                            required: "Insert a Valid Year",
                            number: "Specifica un anno",},
                        place:"Insert a Valid Place",
             }
            });
    
    $("#formAddEdu").submit(function(event){
                console.log("HDHAHADH");
                event.preventDefault();
                if(formAddEdu.valid()){
                    var title=$("#AddModTitle").val();
                    var year=$("#AddModYear").val();
                    var place=$("#AddModPlace").val();
                    $.ajax({
                        url:"json/AddEducationExperience.php",
                        type:"POST",
                        data:{
                            "title":title,
                            "year" :year,
                            "place":place
                        },
                        success:function(data){
                            $("#tableEdu").DataTable().ajax.reload();
                        },
                        error:function(){
                            alert("Si è verificato un errore durante l'aggiornamento");
                        } 
                    });
                   $("#ModalAddEdu").modal("hide"); 
                }
            });
        
         
    })




</script>