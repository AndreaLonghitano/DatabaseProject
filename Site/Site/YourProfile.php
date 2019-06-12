<?php
session_start(); 
include('../DB/database.php');
include("../DB/function.php");
if(isset($_SESSION['username'])){
    $userid=getUserId($_SESSION['username']);
    $name=getName($userid);
    $surname=getSurname($userid);
    $photo=getUrlPhoto($userid);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>Your Profile</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    
  <link href='Calendar/fullcalendar.min.css' rel='stylesheet' />
  <link href='Calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    
    <link rel="stylesheet" href="css/personalized.css">
    
    
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <?php include('navbar.php'); ?>
      <?php include('sidebar.php'); ?>
        
        
      <div class="main-content">
        <section class="section">
          <h1 class="section-header">
            <div class="titlecenter">Your Profile</div>
          </h1>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-info mb-0" style="text-align:center;">
                  In questa sezione potrai visualizzare le statistiche in merito alla tua carriera.
                </div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4 style="text-align:center">Education Experience</h4>
                  </div>
                  <div class="card-body">
                      
                      <div class="row">
                        <div class="col-2 offset-10 col-sm-2 offset-sm-10">
                        <button class="btn btn-danger btn-shadow btn-round has-icon has-icon-nofloat btn-block" id="AddExperience" style="text-align:center;">
                         <div>Add</div>
                        </button>
                        </div>
                    </div>
                      
                      <div class="row">
                            <table id="tableEdu" class="table table-striped table-responsive-lg table-responsive-sm table-responsive-md table-responsive-xs">
				        <thead>
			  	          <tr>
						      <th scope="col">Title</th>
						      <th scope="col">Year</th>
						      <th scope="col">Place</th>
						      <th scope="col">Handle</th>
					     </tr>
			         </thead>
				    <tbody>
                    
				    </tbody>
			                 </table>
                    </div>
                      
                      
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4 style="text-align:center">Work Experience</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                        <div class="col-2 offset-10 col-sm-2 offset-sm-10">
                        <button class="btn btn-danger btn-shadow btn-round has-icon has-icon-nofloat btn-block" id="AddWorkExperience">
                         <div style="position:relative;text-align:center;">Add</div>
                        </button>
                        </div>
                    </div>
                      
                      <div class="row">
                            <table class="table table-striped table-bordered table-responsive-lg table-responsive-sm table-responsive-md table-responsive-xs" id="work-table">
                    <thead>
                        <tr>
                            <th >Company</th>
                            <th >Role</th>
                            <th >year</th>
                            <th >Place</th>
                            <th >Handle</th>
                        </tr>
                    </thead>
                    <tbody>  
                </tbody>
                    </table>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
     
<?php
    include("footer.php");
?>

     
        
        
    </div>
  </div>

  <script src="../dist/modules/jquery.min.js"></script>
  <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script>
  <script src="../dist/modules/chart.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>
    
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> 
    
    <?php
    
   include("Modal/ModalUpdateWork.php");
   include("Modal/ModalUpdateEducation.php");
   include ("Modal/ModalDelete.php");
    
?>   
  <script>
      
    $(document).ready(function(){
        
       
        
        var edutable=$("#tableEdu").DataTable({
                "searching": false,
                "info": false,
                "bLengthChange": false,
                "processing": true,
               
               "ajax": {
				url: "json/EducationDates.php",
				error: function (xhr, error, thrown) {
					alert( error ); 
                    alert("Errore nel caricametno della tabella Education");
				},
			},
            
			"aoColumns": [
				{ "mData": "title"},
				{ "mData": "year"},
				{ "mData": "place","bSortable": false,},
				{ "mData": "id", "bSortable": false,
                  "mRender": function(id) {return "<a title='edit' onclick='updateEduExp("+id+",this)'><i class='fas fa-edit icon'></i></a>&nbsp;<a title='delete' onclick='showDeleteModalEdu("+id+");'><i class='fas fa-eraser icon'></i></a>";}}
                ],
               
               "oLanguage":{
                    "sZeroRecords":"Nessun elemento trovato",
                    "oPaginate": {
					   "sPrevious": "Previous",
					   "sNext": "Next",
			     },	
               },
                
        });
        
        var workTable=$("#work-table").DataTable({
                "searching": false,
                "info": false,
                "bLengthChange": false,
                "processing": true,
               
               "ajax": {
				url: "json/WorkDates.php",
                "type":"POST",
                data:{"mode":0},                   
                   error: function (xhr, error, thrown) {
					alert( error ); 
                    alert("Errore nel caricamento della tabella Work Experience");
				},
			},
            
			"aoColumns": [
				{ "mData": "company"},
				{ "mData": "role"},
				{ "mData": "year","bSortable": false,},
                { "mData": "place","bSortable": false,},
				{ "mData": "id", "bSortable": false,
                  "mRender": function(id) {return "<a title='edit' onclick='updateWorkExperience("+id+",this)'><i class='fas fa-edit icon'></i></a>&nbsp;<a title='delete' onclick='showModalDeleteWork("+id+");'><i class='fas fa-eraser icon'></i></a>";}}
               ],
                
                "oLanguage":{
                    "sZeroRecords":"Nessun elemento trovato",
                    "oPaginate": {
					   "sPrevious": "Previos",
					   "sNext": "Next",
			     },				
                },
        });
        
    });
        
    </script>
    
    <?php
     include ("Modal/ModalAddEducation.php");
     include ("Modal/ModalAddWork.php");
     include ("Modal/ModalAddCompany.php");
    
    
    ?>
    
    
    <script>
        $(document).ready(function(){
            
        $("#AddExperience").click(function(){
                $("#ModalAddEdu").modal("show");
            });
            
        
        
            
        $("#AddCompanyButton").on("click",function(){
                   $("#ModalAddCompany").modal("show");                  
        });
            
        
    });
      
             function showModalDeleteWork(id){
            $("#deleteModal").modal("show");
            $("#deleteButtonModal").attr("data-id",id);
            $("#deleteButtonModal").attr("data-type","W");
        }
        
        function showDeleteModalEdu(id){
            $("#deleteModal").modal("show");
            $("#deleteButtonModal").attr("data-id",id);
            $("#deleteButtonModal").attr("data-type","E");
        }
        
        function deleteWorkExperience(id){
              $.ajax({
					url: "json/DeleteWork.php",
                    type: "POST",
					data:{"id":id},
					success: function(data){
                        $("#deleteModal").modal("hide");
                        $("#work-table").DataTable().ajax.reload(); 
                    },
                    error: function(d){
                        alert("Si è verificato un errore");
                    },  
				}); 
        }
        
        function deleteEducationExperience(id){
            $.ajax({
					url: "json/DeleteEdu.php",
                    type: "POST",
					data:{"id":id},
					success: function(){
                        $("#tableEdu").DataTable().ajax.reload();
                    },
                    error: function(d){
                        alert("Si è verificato un errore");
                    },  
				});
            $("#deleteModal").modal("hide");
            }    
        
        $("#deleteButtonModal").on('click',function(e){
            var id=$(this).attr('data-id');
            var type=$("#deleteButtonModal").attr("data-type");
            if (type=="E") deleteEducationExperience(id);
            else deleteWorkExperience(id);
        });
         
        
        function updateWorkExperience(id,elemento){
            var x=$(elemento).closest('tr').children("td");
            var company=$(x[0]).text();
            $("#modcompany").attr("placeholder",$(x[0]).text());
            $("#modrole").attr("placeholder",$(x[1]).text());
            $("#modyear").attr("placeholder",$(x[2]).text());
            var place=$("#modplace");
            place.empty();
            $.ajax({
                url: "json/GetPlace.php",
                type: "POST",
				data:{"company":company},
                success:function(data){
                    var opts=$.parseJSON(data);
                    $.each(opts,function(indice,elemento){
                        if(elemento.place==($(x[3]).text())){
                        place.append("<option value='"+elemento.place+"' selected>"+elemento.place+"</option>");}
                        else  place.append("<option value='"+elemento.place+"'>"+elemento.place+"</option>");
                    });
                    }
                });
            $("#ModalUpdateWork").modal("show");
            
            $("#formwork").submit(function(event){
                var place=$("#modplace").val();
                var role=$("#modrole").val();
                var year=$("#modyear").val();
                if (place==($(x[3]).text()) && role=="" && year=="") {
                    alert("Aggiornare i dati");
                    event.preventDefault();}
                else{
                    if(role=="") role=$(x[1]).text();
                    if(year=="") year=$(x[2]).text();
                    
                    $.ajax({
                        url:"json/UpdateWorkExperience.php",
                        type:"POST",
                        data:{
                            "id":id,
                            "company":company,
                            "role":role,
                            "place" :place,
                            "year":year
                        },
                        success:function(data){
                            $(x[1]).text(role);
                            $(x[2]).text(year);
                            $(x[3]).text(place);
                        }
                        
                    });
                    event.preventDefault();
                    $("#ModalUpdateWork").modal("hide"); 
                    
                }
            });
            
            }
        
        function updateEduExp(id,elemento){
            var x=$(elemento).closest('tr').children("td");
            $("#modtitle").attr("placeholder",$(x[0]).text());
            $("#modeduyear").attr("placeholder",$(x[1]).text());
            $("#modeduplace").attr("placeholder",$(x[2]).text());
            $("#ModalUpdateEdu").modal("show");
            
            $("#formedu").submit(function(event){
                var place=$("#modeduplace").val();
                var year=$("#modeduyear").val();
                if (place=="" && year=="") {
                    alert("Aggiornare i dati.");
                    event.preventDefault();} // utile altriemnti ricarica la pagina! io Non voglio ricaricarla
                else{
                    if(place=="") place=$(x[2]).text();
                    if(year=="") year=$(x[1]).text();
                    $.ajax({
                        url:"json/UpdateEducationExperience.php",
                        type:"POST",
                        data:{
                            "id":id,
                            "place" :place,
                            "year":year
                        },
                        success:function(data){
                            $(x[1]).text(year);
                            $(x[2]).text(place);
                        },
                        error:function(){
                            alert("Si è verificato un errore durante l'aggiornamento");
                        } 
                    });
                    event.preventDefault(); // anche in questo caso evito di ricaricare la pagina
                    $("#ModalUpdateEdu").modal("hide"); 
                    
                }
            });
        }
      
  </script>
  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <script src="../dist/js/demo.js"></script>
  <script src="../js/notifications.js"></script>
  <script src="../js/closemodal.js"></script>
  <script>
    
    var currentYear=(new Date()).getFullYear();
    document.getElementById('AddModYear').setAttribute("max",currentYear);
    document.getElementById('AddWorkYear').setAttribute("max",currentYear); // seleziona la massima data
    
    
</script>
</body>
</html>

<?php
}
else header("Location:../error.html");
?>