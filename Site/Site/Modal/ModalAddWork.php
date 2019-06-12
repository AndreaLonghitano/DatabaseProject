<div class="modal fade" id="ModalAddWork">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" >Add Work Experience</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
<form method="post" id="formaddwork" name="formaddwork">
    <div class="container">
        
    <div class="form-group row">
    <label  class="col-sm-2 col-form-label"> Company <sup>*</sup></label>
    <div class="col-sm-6">
    <select class="custom-select" id="selectedcompany" name="company" > 
        <option selected value="default">Choose a Company</option>
    </select>
        </div>
    <div class="col-sm-2">
        <button type="button" class="btn btn-primary" value="1" id="AddCompanyButton">Add Company</button>
        </div>
    </div> 
        
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Role <sup>*</sup></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="RoleAddWork" placeholder="Role" name="role" value=""> <!--questo è un campo testo eprche non ho una tabella dei ruoli -->
    </div>
  </div>
        
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Place <sup>*</sup></label>
     <div class="col-sm-8">
    <select class="custom-select" id="selectedplace" name="place" placeholder="Choose a place" disabled>
        <option selected value="default">Choose a Place</option>    
    </select>
  </div>
</div>
        
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Year <sup>*</sup></label>
    <div class="col-sm-8">
      <input type="number" class="form-control" placeholder="year" name="year" value="" min="1950" id="AddWorkYear">  
    </div>
  </div>
        
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" value="1">Add</button></div>
    </div>
</form>
 </div>
    </div>
  </div>
</div>


<script>
    var formAddWork=$("#formaddwork");
$(document).ready(function(){
     
    
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
                // value è il nuovo valore
                // eleement è l'eleemtno sul quale è stato richaiamto,
                // arg è l'argomento che passo nella validation
                return arg !== value;
            }, "Value must not equal arg.");
    
    
    formAddWork.validate({
                     errorPlacement: function errorPlacement(error, element) { error.insertAfter(element); },
                rules: {
                    company: { valueNotEquals: "default",},
                    role:{ required:true,},
                    year:{required:true,},
                },
            messages: {
                company: { valueNotEquals: "Please select a company!" },
                role: "Insert a Valid Role",    
                year: "Insert a Valid Year",
                }  
            });
    
    $("#AddWorkExperience").on('click',function(){
                $("#ModalAddWork").modal("show");
                var selectedcompany=$("#selectedcompany");
                selectedcompany.empty();
                selectedcompany.append('<option selected value="default">Choose a Company</option>');
                $.ajax({
                    url:"json/GetCompany.php",
                    type:"POST",
                    data:{"mode":0},
                    success:function(data){
                        var companies=$.parseJSON(data);
                        $.each(companies,function(indice,elemento){
                            selectedcompany.append('<option value="'+elemento.nome+'">'+elemento.nome+'</option>');
                        });
                    }  
                });
            });
    
    $("#selectedcompany").on("change",function(){
            var x=$(this).val(); // cosi mi prendo il valore selezionato
            var selectedplace=$("#selectedplace");
            if(x=="default"){
                selectedplace.empty();
                selectedplace.append("<option selected value='default'>Choose a Place</option>");
                selectedplace.prop('disabled',true);
                }
            else{
                selectedplace.empty();
                selectedplace.prop('disabled',false);
                $.ajax({
                url:"json/GetPlace.php",
                type:"POST",
                data:{"company":x},
                success:function(data){
                    var opts=$.parseJSON(data);
                    $.each(opts,function(indice,elemento){
                        selectedplace.append("<option value='"+elemento.place+"'>"+elemento.place+"</option>");
                    })
                },
            }); 
            }
        });
    
     $("#formaddwork").submit(function(event){
                var workTable=$("#work-table");
                event.preventDefault();
                if(formAddWork.valid()){
                    var company=$("#selectedcompany").val();
                    var place=$("#selectedplace").val();
                    var role=$("#RoleAddWork").val();
                    var year=$("#AddWorkYear").val();
                    $.ajax({
                        url:"json/AddWorkExperience.php",
                        type:"POST",
                        data:{"company":company,"role":role,"place":place,"year":year},
                        success:function(data){
                            var opts=$.parseJSON(data);
                            var id_experience=opts[0].id;
                            $("#work-table").DataTable().ajax.reload();
                        },
                         error:function(){
                            alert("Si è verificato un errore durante l'aggiornamento");
                        } 
                    });
                   $("#ModalAddWork").modal("hide");
                }
                });
    
    
    
    
    
});


</script>