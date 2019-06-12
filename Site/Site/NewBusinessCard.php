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
  <title>Business Card</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
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
            <div class="titlecenter">Aggiungi Business Card</div>
          </h1>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-info mb-0" style="text-align:center;">
                  In questa sezione potrai aggiungere una Card.
                </div>
              </div>
            </div>
             <form method="post" id="formbusiness" action="json/AddCard.php" enctype="multipart/form-data" onsubmit="return checkCard();"> 
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-5 col-xs-12">
                    <div class="row">
                      <div class="card col-12">
                            <div class="card-header">
                        <h4 style="text-align:center">Card Info</h4>
                    </div>
                    <div class="card-body">
                         

                  <div class="form-group">
                    <label for="username">Title</label>
                    <input type="text" class="form-control" id="TitleCard" name="title" value="" placeholder="Title">
                  </div>

                  <div class="form-group">
                    <label for="email" class="d-block">Name
                    </label>
                    <input type="email" class="form-control" value="<?php echo $name; ?>" disabled>
                  </div>
                    
                  <div class="form-group">
                    <label for="email" class="d-block">Surname
                    </label>
                    <input type="text"  readonly class="form-control" value="<?php echo $surname;?>">
                  </div>
                    
                   <div class="form-group">
                    <label for="email" class="d-block">Email
                    </label>
                    <input type="text"  class="form-control" name="email"  placeholder="Email">
                  </div>
                    
                    <div class="form-group">
                    <label for="date" class="d-block">Telefono
                    </label>
                    <input type="tel"  class="form-control"  name="tel" value="" placeholder="Number Phone"> <!-- devo controlalre numbero di telefono il numero di cifre-->
                  </div>


                  <div class="form-group">
                    <label for="company" class="d-block">Compagnia
                    </label>
                    <select class="form-control" id="thiscompany" name="company" > 
                                    <option selected value="default">All Companies</option>
                            </select>
                  </div>
                
                <div class="form-group">
                    <label for="photo" class="d-block">Photo Card
                    </label>
                    <br/>
                    <div class="row">
                        <input type='file' name="imgcard" id="imgcard" onchange="readURL(this);" accept="image/jpeg" hidden/>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <img id="cardimg" src="ignota.jpg" alt="your image" class="img-responsive" style="position:relative;max-width:100%;max-height:100%;" />
                        </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <br/>
                        <br/>
                        <br />
                        <br/>
                         <a id="loadImage"><i class="fas fa-upload fa-3x icon" title="Choose Foto"></i></a>
                        </div>
                        
                    <div class="row col-10 offset-1">
                        <br/>
                            <div class="alert alert-danger" hidden style="text-align:center" id="fileAlert">Seleziona una Foto</div>
                        </div>
                    </div>
                </div>
                      
                    </div>
                    </div>
                </div>
                </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 offset-lg-1">
                    <div class="row">
                        <div class="card col-12">
                            <div class="card-header">
                        <h4 style="text-align:center">Education Experience</h4>
                    </div>
                        
                    <div class="card-body">
                        
                       <div class="col-2 offset-10 col-xl-2 offset-xl-10">
                        <button type="button" class="btn btn-danger btn-shadow btn-round has-icon has-icon-nofloat btn-block" id="AddExperience" title="Add Educational Experience">
                         <i class="fas fa-plus-circle icon"></i>
                        </button>
                        </div>
                      <br/>
                       <table id="tableEdu" class="table table-striped">
				<thead>
			  	<tr>
						<th scope="col">Title</th>
						<th scope="col">Year</th>
                        <th scope="col">Place</th>
                        <th>ID</th>
					</tr>
			     </thead>
				<tbody>
                    
				</tbody>
                    </table>
                    <div class="alert alert-danger" hidden style="text-align:center" id="EduAlert">Seleziona una Education Experience</div>
                    </div>
                    </div>
                </div>  
                    <div class="row">
                        <div class="card col-12">
                            <div class="card-header">
                        <h4 style="text-align:center">Work Experience</h4>
                    </div>
                        
                    <div class="card-body">
                        
                        <div class="col-2 offset-10 col-xl-2 offset-xl-10">
                        <button type="button" class="btn btn-danger btn-shadow btn-round has-icon has-icon-nofloat btn-block" id="AddWorkExperience" title="Add Work Experience">
                         <i class="fas fa-plus-circle icon"></i>
                        </button>
                        </div>
                      <br/>
                       <table id="work-table" class="table table-striped">
				<thead>
			  	<tr>
						<th scope="col">Role</th>
						<th scope="col">Year</th>
						<th scope="col">Place</th>
                        <th>ID</th>
					</tr>
			     </thead>
				<tbody>
                    
				</tbody>
                    </table>
                   <div class="alert alert-danger" hidden style="text-align:center" id="WorkAlert">Seleziona una Work Experience</div>
                  </div>
                        
                        
            
                </div>
                </div>
            </div>
              
          </div>
            <div class="row">
                <div class="col-lg-1 offset-lg-11">
                <button type="submit" name="edit" class="btn btn-primary" tabindex="4" id="Save">
                      Save
                    </button>
              </div>
             </div>
              </form>
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
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
    
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> 
  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <script src="../dist/js/demo.js"></script>
  <script src="../js/notifications.js"></script>
    <script src="../js/closemodal.js"></script>
    
  <?php
    
   include("Modal/ModalUpdateWork.php");
   include("Modal/ModalUpdateEducation.php");
   include ("Modal/ModalAddEducation.php");
   include ("Modal/ModalAddWork.php");
   include ("Modal/ModalAddCompany.php");
    
?>        
    
<script>
    $(document).ready(function(){
         var formbusiness=$("#formbusiness");
         formbusiness.validate({
               errorPlacement: function errorPlacement(error, element) { error.insertAfter(element); }, // questa funzione inserisce dopo
               rules:{
                        title:{required:true,},
                        tel:{required:true,},
                        email:{required:true,}   
                },
			 messages: {
                        title:"Insert a Valid Title",
                        tel:"Insert a Mobile Phone Number",
                        email:"Insert a Valid mail",
                }
           });
        
         

        
        
        $("#loadImage").click(function(){
                $("#imgcard").trigger('click');
        });
        
         var selectedcompany=$("#thiscompany");
                $.ajax({
                    url:"json/GetCompany.php",
                    type:"POST",
                    data:{"mode":1},
                    success:function(data){
                        var companies=$.parseJSON(data);
                        if(companies.lenght==0){
                            selectedcompany.empty();
                            selectedcompany.append('<option selected disabled>No Work Experience</option>');
                        }
                          selectedcompany.empty();
                        selectedcompany.append('<option selected value="default">All Companies</option>');
                        $.each(companies,function(indice,elemento){
                            selectedcompany.append('<option value="'+elemento.nome+'">'+elemento.nome+'</option>')});;  
                    }  
                });
        
        $("#AddExperience").click(function(){
                $("#ModalAddEdu").modal("show");
            });
        
         
        
 var tableEducation=$("#tableEdu").DataTable({
         "searching": false,
        "info": false,
        "bLengthChange": false,
        "processing": true,
        "pageLength": 10,
        "order": [[ 0, "asc" ]],
        "columnDefs": [
            {
                "targets": [ 3 ],
                "visible": false,
            },
            ],   
        "ajax": {
            url: "json/EducationDates.php",
				error: function (xhr, error, thrown) {
					alert( error ); 
                    alert("Errore nel caricamento della tabella Education");
				},
			},
            
			"aoColumns": [
				{ "mData": "title"},
				{ "mData": "year"},
				{ "mData": "place","bSortable": false,},
                { "mData": "id",
                  "mRender": function(row) {return row;},
                },
                ],
               
               "oLanguage":{
                    "sZeroRecords":'<a href="YourProfile.php" style="color:red">Necessario avere un esperienza per creare una business card. Clicca per aggiungerne una</a>',
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
        "pageLength": 2,
        "order": [[ 0, "asc" ]],
        "bDestroy":true,
        "columnDefs": [
            {
                "targets": [ 3 ],
                "visible": false,
            },
            ],
               
        "ajax": {
            url: "json/WorkDates.php",
            type:"POST",
            data:{"mode":1},
				error: function (xhr, error, thrown) {
					alert( error ); 
                    alert("Errore nel caricamento della tabella Education");
				},
			},
            
			"aoColumns": [
				{ "mData": "role",},
				{ "mData": "year"},
                { "mData": "place","bSortable": false,},
                { "mData": "id",
                  "mRender": function(row) {return row;},
                },
               ],
               
               "oLanguage":{
                    "sZeroRecords":'<a href="YourProfile.php" style="color:red">Necessario avere un work_experience per creare una business card. Clicca per aggiungerne una</a>',
                    "oPaginate": {
					   "sPrevious": "Previous",
					   "sNext": "Next",
			     },	
               },
        
    });
        
        
        
        

            
         $("#AddCompanyButton").on("click",function(){
                   $("#ModalAddCompany").modal("show");                  
            });
        
        
    $("#thiscompany").on('change',function(){
        var company=$(this).val(); // cosi mi prendo il valore selezionato
            workTable.clear().draw();
            if(company=="default")reloadWorks(  );
            else loadWorksOfCompany(company);
    });
        
        
        function loadWorksOfCompany(company){
        $.ajax({
                    url:"json/WorkDates.php",
                    type:"POST",
                    data:{"mode":2,"company":company},
                    success:function(data){
                        var x=$.parseJSON(data).data;
                        $.each(x,function(indice,elemento){
                        workTable.row.add( {
                            "role":  elemento.role,
                            "year": elemento.year,
                            "place": elemento.place,
                            "id": elemento.id,
                            } ).draw(); 
                        });
                    }  
                }); 
    }
        
        
    function reloadWorks(){
        $.ajax({
                    url:"json/WorkDates.php",
                    type:"POST",
                    data:{"mode":1},
                    success:function(data){
                        var x=$.parseJSON(data).data;
                        $.each(x,function(indice,elemento){
                            console.log(elemento.role);
                        workTable.row.add( {
                            "role":  elemento.role,
                            "year": elemento.year,
                            "place": elemento.place,
                            "id": elemento.id,
                            } ).draw(); 
                        });
                    }  
                }); 
    }
        
        // funzioni per selezionare una riga //
     $('#tableEdu').on( 'click', 'tr', function () {
         console.log("JDAHDAHDAH");
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            
        }
        else {
            tableEducation.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $('#EduAlert').attr('hidden',true);
        }
    } );
    
    $('#work-table').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            workTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $('#WorkAlert').attr('hidden',true);
        }
    } );
        
       
       
        
  });
    
     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#cardimg')
                        .attr('src', e.target.result);
                };
                $('#fileAlert').attr('hidden',true);

                reader.readAsDataURL(input.files[0]);
            }
        }
    
    function checkCard(){
        var validate=0;
        var formbusiness=$("#formbusiness");
        if(formbusiness.valid()) validate++;
        var SelectWork = $("#work-table").find('.selected');
        var SelectEdu = $("#tableEdu").find('.selected');
        var file=$("#imgcard").val();
        if(SelectWork.length==0)$('#WorkAlert').removeAttr('hidden');
        else {
            validate++;
            $('#WorkAlert').attr('hidden',true);
        }
        if(SelectEdu.length==0) $('#EduAlert').removeAttr('hidden');
        else{
            validate++;
            $('#EduAlert').attr('hidden',true);
        }
        if(file=="")$('#fileAlert').removeAttr('hidden');
        else{
            validate++;
            $('#fileAlert').attr('hidden',true);
        }
        if(validate==4){
            var idWork=($("#work-table").DataTable().row(SelectWork).data())['id'];
            var idedu=($("#tableEdu").DataTable().row(SelectEdu).data())['id'];
            $("#formbusiness").append('<input type="text" hidden name="idWork" value="'+idWork+'">');
            $("#formbusiness").append('<input type="text" hidden name="idEdu" value="'+idedu+'">');
            return true;
        }
        else return false;
    };
        
    
    
    
    
    
    
    
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
else header("Location:../error.html");
?>