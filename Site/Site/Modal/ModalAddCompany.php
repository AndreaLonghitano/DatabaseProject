<div class="modal fade" id="ModalAddCompany">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" >Add Work Experience</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
<form method="post"  name="addcompany" id="addcompany" >
    <div class="container">
  <div class="form-group row">
    <label class="col-2 form-label">Name Company <sup>*</sup></label>
    <div class="col-sm-8">
      <input type="text" name="name" value="" placeholder="Name" class="form-control" id="NameNewCompany"> <!-- DOVREBBE ESSERE UNICO MA NELLO SHCEMA NON RISULTA-->
    </div>
  </div>
     
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label"> E-mail <sup>*</sup></label>
    <div class="col-sm-8">
      <input type="email" name="email" value="" placeholder="E-Mail" class="form-control" id="EmailNewCompany">
    </div>
  </div>
        
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"> Place <sup>*</sup></label>
    <div class="col-sm-8">
      <input type="text" name="place" value=""  placeholder="Place" class="form-control" id="PlaceNewCompany">
    </div>
  </div>
        
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"> WebSite <sup>*</sup></label>
    <div class="col-sm-8">
      <input type="text" name="website" value="" placeholder="WebSite" class="form-control" id="WebSiteNewCompany">
    </div>
  </div>
        
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"> Note </label>
    <div class="col-sm-8">
      <input type="text" name="note" value="" placeholder="Note" class="form-control" id="NoteNewCompany">
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
    $(document).ready(function(){
        
      var formAddCompany=$("#addcompany");
            
            // qui mi sono definito un validator chiamato che controllo che la compagnia non sia settatata a Choose A Company
            
            
            $.validator.addMethod("webCheck", function(value, element, arg){
                // value è il nuovo valore
                // eleement è l'eleemtno sul quale è stato richaiamto,
                // arg è l'argomento che passo nella validation
                if(value.includes("."))return true;
                else return false;
            }, "Ciao");

 // configure your validation
           
            
        
           formAddCompany.validate({
               errorPlacement: function errorPlacement(error, element) { error.insertAfter(element); }, // questa funzione inserisce dopo
               
               
               rules:{
                        name:{required:true,},
                        place:{required:true,},
                        email:{required:true,},
                        website:{required:true,
                                webCheck:"1",}
                },
			 messages: {
                        name:"Insert a Valid name",
                        place:"Insert a Valid Place",
                        email:"Insert a Valid Email",
                        website:{
                            required:"Insert a Valid website",
                            webCheck:"Inserisci alemno un punto",
                        }
             }
           });
        
        
             $("#addcompany").submit(function(event){
                event.preventDefault(); 
                if(formAddCompany.valid()){
                    var name=$("#NameNewCompany").val();
                    var email=$("#EmailNewCompany").val();
                    var place=$("#PlaceNewCompany").val();
                    var site=$("#WebSiteNewCompany").val();
                    var note=$("#NoteNewCompany").val();
                    $.ajax({
                        url:"json/AddCompany.php",
                        type:"POST",
                        data:{
                            "name":name,
                            "email" :email,
                            "place":place,
                            "site":site,
                            "note":note   
                        },
                        success:function(){
                            $("#ModalAddCompany").modal("hide");
                            $("#AddWorkExperience" ).modal( "hide" );
                            $("#AddWorkExperience" ).trigger( "click" );
                        },
                        event:function(){
                            alert("Si è verificato un errore");
                        },
                    
                });
                }
            });


  });



</script>