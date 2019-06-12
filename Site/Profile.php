<?php
session_start();
include('DB/database.php');
include("DB/function.php");
if(isset($_SESSION['username'])){
    $user_id=getUserID($_SESSION['username']);
    if($user_id==-1) die("Errore user_id");
    $name=getName($user_id);
    if($name==-1)die("Errore name");
    $surname=getSurname($user_id);
    if($surname==-1)die ("Errore surname");
    $result=mysqli_query($conn,"select photo from users where user_id=$user_id;");
    if ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        if(is_null($row['photo']))$url="ImageProfile/ignota.jpg"; 
        else $url=$row['photo'];
    }
?>  

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Profile</title>
    <script type="text/javascript" src="javascript.js"></script>
    
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

<!-- Datatables -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
    
    <style>
        
        .icon:hover{
            cursor:pointer;
            color:orange;
        }
    
    
    </style>
    
    <script>
        
        /* Dovrei fare l'update con una finestra modale */
        
    
    </script>
</head>

    
    
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-1 offset-sm-11">
                <a href="Logout.php">Logout</a>
            </div>
        </div>
    </div>
    
    <br/><br>
    
    <div class="container">
        <div class="row">
        <fieldset class="col-sm-3" style="border:1px solid red">
            <legend class="h6">UserInfo</legend>
             <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        
                    <img src="<?php echo $url; ?>" alt="Not Available" class="img-thumbnail">
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <span style="font-size:10px"><?php echo $name. " ".$surname; ?></span>
                        </div>
                        <div class="row">
                            <span><a id="loadImage"><i class="fas fa-upload icon" title="Choose Foto"></i></a>
                            <a hidden id="saveImage"><i class="fas fa-save icon" title="Upload Photo"></i></a></span>
                        </div>
                    </div>
                 </div>
            </div>  
            
        </fieldset>  
         <form action="LoadImage.php" method="POST" id="formimage" enctype="multipart/form-data" hidden>
            <input type="file" name="file" id="file" accept="image/jpeg">
            <input type="submit" name="submitimage" value="1">
        </form>
            
    
   <fieldset class="col-sm-8 offset-sm-1" style="border:1px solid green;">
            <legend class="h6">UserInfo</legend>
            
            <div class="row">
                <fieldset class="col-sm-10 offset-sm-1" style="border:1px solid black">
                    <legend class="h6">Education and Training</legend>
                <div class="container">
                    <div class="col-sm-1 offset-sm-10">
                        <button type="button" class="btn btn-primary" id="AddExperience">Add</button>
                    </div>
                </div>
                    <!-- MODIFICARE QUII -->
                <table id="tableEdu" class="table table-striped">
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
            </fieldset> 
        </div>
       
       <br/><br/>
            <div class="row">
                <fieldset class="col-sm-10 offset-sm-1" style="border:1px solid black">
                    <legend class="h6">Work Experience</legend>
                    
                    <div class="container">
                    <div class="col-sm-1 offset-sm-10">
                        <button type="button" class="btn btn-primary" id="AddWorkExperience">Add</button>
                    </div>
                </div>
                    <div class="container">
                    <table class="table table-striped table-bordered" id="work-table">
                    <thead>
                        <tr>
                            <th class="col-sm-3">Company</th>
                            <th class="col-sm-3">Role</th>
                            <th class="col-sm-3">year</th>
                            <th class="col-sm-3">Place</th>
                            <th class="col-sm-3">Handle</th>
                        </tr>
                    </thead>
                    <tbody>  
                </tbody>
                    </table>
                  </div>  
                </fieldset>
            </div>
            </fieldset>
            
        </div>
    </div>
      
<?php
    
   include("Modal/ModalUpdateWork.php");
   include("Modal/ModalUpdateEducation.php");
    
?>
    

     
<?php
    
    include ("Modal/ModalAddEducation.php");
    include ("Modal/ModalAddWork.php");
    include ("Modal/ModalAddCompany.php");
    include ("Modal/ModalDelete.php");
    
?>
    

    
    
    

    

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> 
    

    
       
    <script>
      
        $(document).ready(function(){
            
            var formAddEdu=$("#formAddEdu");
            var formAddWork=$("#formaddwork");
            var formAddCompany=$("#addcompany");
            
            // qui mi sono definito un validator chiamato che controllo che la compagnia non sia settatata a Choose A Company
            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                // value è il nuovo valore
                // eleement è l'eleemtno sul quale è stato richaiamto,
                // arg è l'argomento che passo nella validation
                return arg !== value;
            }, "Value must not equal arg.");
            
            $.validator.addMethod("webCheck", function(value, element, arg){
                // value è il nuovo valore
                // eleement è l'eleemtno sul quale è stato richaiamto,
                // arg è l'argomento che passo nella validation
                if(value.includes("."))return true;
                else return false;
            }, "Ciao");

 // configure your validation
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
                        name:"Insert a Vald name",
                        place:"Insert a Valid Place",
                        email:"Insert a Valid Email",
                        website:{
                            required:"Insert a Valid website",
                            webCheck:"Inserisci alemno un punto",
                        }
             }
           });
            
            // CARICAMENTO IMMAGINE
            $("#loadImage").click(function(){
                $("#file").trigger('click');
            });
            
            $("#file").on('change',function(){
                $("#saveImage").attr("hidden",false);
            });
            
            $("#saveImage").click(function(){
                $("#formimage").trigger('submit');
            });
            
            
           var edutable=$("#tableEdu").DataTable({
                "searching": false,
                "info": false,
                "bLengthChange": false,
                "processing": true,
                "pageLength": 1,
               
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
            
           var worktable=$("#work-table").DataTable({
                "searching": false,
                "info": false,
                "bLengthChange": false,
                "processing": true,
                "pageLength": 1,
               
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
            
            $("#AddExperience").click(function(){
                $("#ModalAddEdu").modal("show");
            });
            
            $("#formAddEdu").submit(function(event){
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
                            var opts=$.parseJSON(data);
                            var id_experience=opts[0].id;
                            edutable.row.add( {
                            "title": title,
                            "year":  year,
                            "place": place,
                            "id": id_experience,
                            } ).draw();
                        },
                        error:function(){
                            alert("Si è verificato un errore durante l'aggiornamento");
                        } 
                    });
                   $("#ModalAddEdu").modal("hide"); 
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
                            worktable.row.add( {
                            "company": company,
                            "role":  role,
                            "year": year,
                            "place": place,
                            "id":id_experience,
                            } ).draw();
                        },
                         error:function(){
                            alert("Si è verificato un errore durante l'aggiornamento");
                        } 
                    });
                   $("#ModalAddWork").modal("hide");
                }
                });
            
            $("#AddCompanyButton").on("click",function(){
                   $("#ModalAddCompany").modal("show");                  
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
        /* LE FUNZIONI DEVO METTERLE QUI */
        
        
        function showModalDeleteWork(id){
            $("#deleteModal").modal("show");
            $("#deleteButtonModal").attr("data-id",id);
            $("#deleteButtonModal").attr("data-type","W"); //Work
        }
        
        function showDeleteModalEdu(id){
            $("#deleteModal").modal("show");
            $("#deleteButtonModal").attr("data-id",id);
            $("#deleteButtonModal").attr("data-type","E"); //Educational
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
                        $("#deleteModal").modal("hide");
                        $("#tableEdu").DataTable().ajax.reload();
                    },
                    error: function(d){
                        alert("Si è verificato un errore");
                    },  
				});
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
    
<script>
    
    var currentYear=(new Date()).getFullYear();
    document.getElementById('AddModYear').setAttribute("max",currentYear);
    document.getElementById('AddWorkYear').setAttribute("max",currentYear); // seleziona la massima data
    
    
</script>
    
    
</body>
</html>

<?php
}
else header("Location:error.html");
?>