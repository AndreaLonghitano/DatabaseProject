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
  <title>Meeting</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>

  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    
  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    
<link rel="stylesheet" href="css/personalized.css">
    
<style>
.pac-container {
    z-index: 1051 !important; /* Importante per mettere l'autocompletamento davanti
}
    </style>
    
    
    
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
            <div class="titlecenter">Meetings</div>
          </h1>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-info mb-0" style="text-align:center;">
                  In questa sezione potrai visualizzare le info in merito ai meetings ove prenderai parte e di cui sei il creatore.
                </div>
              </div>
            </div>
              
              <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4 style="text-align:center">Meeting Table</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                        <div class="col-2 offset-10 col-xl-2 offset-xl-10">
                        <button class="btn btn-danger btn-shadow btn-round has-icon has-icon-nofloat btn-block" onclick="window.location.href='CreateMeeting.php'">
                         <div>Create</div>
                        </button>
                        </div>
                    </div>
                      <br/>
                     <table id="meetingTable" class="table table-striped table-bordered table-responsive-lg table-responsive-sm table-responsive-md table-responsive-xs">
				<thead>
			  	<tr>
						<th>Role</th>
						<th>Title</th>
						<th>Invitati</th>
						<th>Place</th>
                        <th>Handle</th>
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
        </section>
      </div>
        
        
        
    </div>
  </div>
    
<?php
    include("footer.php");
    
?>
    
<?php
    
    include ("Modal/ModalUpdateMeeting.php");
    include("Modal/ModalInfoMeeting.php");
    include ("Modal/ModalDelete.php");
    
?>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- per alert personalizzati --> 
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
  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <script src="../dist/js/demo.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcCHXiu03QBsnXE5hyBtBKqS5qJ5tQGQQ&libraries=places&callback=initMap" async defer></script>
  <script type="text/javascript" src="Maps/maps.js"></script> <!-- SONO UTILI ENTRAMBI PER LA MAPPA -->
   <script src="../js/notifications.js"></script> 
    <script src="../js/closemodal.js"></script>
  
    
    <script>

        $(document).ready(function(){
            
            var currentdate = new Date(); 
            var month,day;
            if((parseInt(currentdate.getMonth())+ 1)<10)month="0"+(parseInt(currentdate.getMonth())+ 1);
            else month=(parseInt(currentdate.getMonth())+ 1);
            var datetime = currentdate.getFullYear()+"-"+month
            + "-"+currentdate.getDate();
            
            var formupdate=$("#updateMeetingForm");
            
            formupdate.validate({
			errorPlacement: function errorPlacement(error, element) { error.insertBefore(element); },
            rules:{
            updateDateMeeting:{min:datetime},
            },
			 messages: {
                updateDateMeeting: {
                    min:"La Data deve essere Maggiore di quella attuale",
                },
             }
            });
            
           var meetingtable=$("#meetingTable").DataTable({
                "searching": false,
                "info": false,
                "bLengthChange": false,
                "processing": true,
                "pageLength": 2, 
                "responsive":true,
     
                "ajax": {
				url: "json/MeetingDates2.php",
				error: function (xhr, error, thrown) {
					alert( error ); 
                    alert("Errore nel caricamennto della tabella");
				    },
			     },
     
                "aoColumns": [
				{ "mData": "role","bSortable": false},
				{ "mData": "title","bSortable":true},
				{ "mData": "invitati","bSortable": true,},
				{ "mData": "place", "bSortable": true},
                {"mData": "id","bSortable":"false", // L'id del meeting qualora dovessi cancellarlo o modificarlo
                "mRender":function(data,type,row){
                    if(row['role']=='C'){
                        return "<a title='show' onclick='showMeetingInfo("+row['id']+");'><i class='far fa-eye icon'></i></i></a>&nbsp;"+"<a title='edit' onclick='updateMeeting("+row['id']+",this)'><i class='fas fa-edit icon'></i></a>&nbsp;<a title='delete' onclick='showModalDelete("+row['id']+");'><i class='fas fa-eraser icon'></i></a>";}
                    
                    else  return "<a title='show' onclick='showMeetingInfo("+row['id']+");'><i class='far fa-eye icon'></i></i></a>&nbsp;";
                    // se sono qui vuol dire che il ruolo è il aprtecipante
                }
                }
                ],
     
                "oLanguage":{
                    "sZeroRecords":"Nessun elemento trovato",
                    "oPaginate": {
				    "sPrevious": "Previous",
				    "sNext": "Next",
			     },				
                },
        });            
            
            
            $("#updateMeetingForm").submit(function(event){
                event.preventDefault();
                var title;
                var id=$("#ModalUpdateMeeting").attr("data-id");
                title=$("#updateTitleMeeting").val();
                var date=$("#updateDateMeeting").val();
                if(date!=""){
                    if(!(formupdate.valid()))return;
                }
                var place=$("#PlaceMeeting").val();
                console.log(latitude);
                console.log(longitude);
                console.log(place);
                
                if (title=="" && date=="" && place==""){
                    swal("Aggiornare i dati");
                }
                else if(place!="" && latitude==""){
                    swal("Inserire una via corretta");
                }
                else{
                    if(title=="") title=$("#updateTitleMeeting").attr("placeholder");
                    if(date=="") date=$("#updateDateMeeting").attr('placeholder');
                    if(place=="")place=$("#PlaceMeeting").attr('placeholder');
                    $.ajax({
                        "url":"json/UpdateMeetingInfo.php",
                        "type":"POST",
                        "data":{"id":id,"title":title,"date":date,"place":place,"lat":latitude,"lng":longitude},
                        success:function(){
                             $("#meetingTable").DataTable().ajax.reload();
                    }
                        
                    });
                    $("#ModalUpdateMeeting").modal("hide");
                }
            
            });
            
        });
        
        function showModalDelete(id){
            $("#deleteModal").modal("show");
            $("#deleteButtonModal").attr("data-id",id);
        }
        
        $("#deleteButtonModal").on('click',function(e){
            var id=$(this).attr('data-id');
            $.ajax({
					url: "json/DeleteMeeting.php",
                    type: "POST",
					data:{"id":id},
					success: function(){
                        $("#meetingTable").DataTable().ajax.reload(); 
                    },
                    error: function(d){
                        alert("Si è verificato un errore");
                    },  
				});
            $("#deleteModal").modal("hide"); // lo metto qui in maniera tale che non sia bloccante
        });
    
          function updateMeeting(id,elemento){ // devo passare l'id perche la data non la conosco
            var timestamp;
           var x=$(elemento).closest('tr').children("td");
            var title=$(x[0]).text();
              // cosi pulisco i div
            $("#updateTitleMeeting").val("");
            $("#updateDateMeeting").val("");
            $("#PlaceMeeting").val("");
              
            $("#updateTitleMeeting").attr("placeholder",$(x[1]).text());
            $("#PlaceMeeting").attr("placeholder",$(x[3]).text());
            initMap();
            $.ajax({
                url: "json/GetDateOfMeeting.php",
                type: "POST",
				data:{"id":id},
                success:function(data){
                    var data=$.parseJSON(data);
                    date=getDate(data[0].date); // mi faccio tornare la data nel formato giusto da questa funzione
                    var giorno=checkFormat(date.getDay()); // richiamo questa funzione per farmi tornare la data nel froamto corretto
                    var mese=checkFormat(date.getMonth());
                    var secondi=checkFormat(date.getSeconds());
                    var minuti=checkFormat(date.getMinutes());
                    var ore=checkFormat(date.getHours());
                    timestamp=date.getFullYear()+"-"+mese+"-"+giorno+"T"+ore+":"+minuti+":"+secondi;
                    $("#updateDateMeeting").attr("placeholder",timestamp);
                    var myLatLng = {lat: Number(data[0].lat), lng: Number(data[0].lng)};
                    latitude=Number(data[0].lat);
                    longitude=Number(data[0].lng); //setto latitudine e longitudine
                    var marker = new google.maps.Marker({
                        map: map, // map è una variabile globale nel file maps.js
                        position: myLatLng,
                    });
                    map.setCenter(myLatLng); // cosi setto il centro della mappa 
                    }
                });
            $("#ModalUpdateMeeting").attr("data-id",id);
              
            $("#ModalUpdateMeeting").modal("show");
          };
            
            // qui ancora dovrei migliorare il fatto della mappa
            
    
    
        $("#updateDateMeeting").focus( function() {
            $(this).attr({type: 'datetime-local'}); // prima era di tipo testo. Quando clicco lo trasformo in un input di tipo datetime local
        });
    
    
    
    function getDate(data){
        var anno_mese =data.split('-'); // anno e mese
        var anno =Number(anno_mese[0]);
        var mese=Number(anno_mese[1]);
        var giorno_time=anno_mese[2].split(" "); // questo è il giorno
        var giorno=Number(giorno_time[0]);
        
        var time=giorno_time[1].split(":");
        var ore=Number(time[0]);
        var minuti=Number(time[1]);
        var secondi=Number(time[2]);
        var date=new Date(anno, mese, giorno, ore, minuti, secondi);        
        return date;
    }
    
    function checkFormat(date){
        if(date<10)return "0"+date;
        else return date;
    }
    
    
     /*function deleteMeeting(id,elemento){
            var x=confirm("Sei sicuro di voler eliminare il Meeting?");
            if(x){
             $.ajax({
					url: "json/DeleteMeeting.php",
                    type: "POST",
					data:{"id":id},
					success: function(){
                        $(elemento).closest('tr').css("display","none");
                    },
                    error: function(d){
                        alert("Si è verificato un errore");
                    },  
				});
                 } 
        } */
    
    function showMeetingInfo(id){
        $.ajax({
            "url":"json/MeetingDatesModal.php",
            "type":"POST",
            data:{"id":id},
            success:function(data){
                var x=$.parseJSON(data);
                console.log(data);
                $("#MeetingName").text(x[0].title);
                $("#DateMeeting").text(x[0].date);
                $("#Indirizzomeeting").text(x[0].place);
                
            }
            
        });
       $("#ModalInfoMeeting").modal("show");
        $("#invitati").DataTable({
            "searching": false,
            "info": false,
            "bLengthChange": false,
            "processing": true,
            "pageLength": 2, 
            "responsive":true,
            "destroy":true,
            
            "ajax": {
				url: "json/GetInvitati.php",
                "type":"POST",
                data:{'id':id}, 
				error: function (xhr, error, thrown) {
					alert( error ); 
                    alert("Errore nel caricamennto della tabella");
				    },
			     },
            
            "aoColumns": [
				{ "mData": "utente","bSortable":true},
				{ "mData": "invito","bSortable":false,
                 "mRender":function(data,type,row){
                     return row['invito'];
                }
                }
                ],
            
             "oLanguage":{
                    "sZeroRecords":"Nessun elemento trovato",
                    "oPaginate": {
				    "sPrevious": "Previous",
				    "sNext": "Next",
			     },
             }  
        });
    }
    
    
    
    </script>
    
    
</body>
</html>

<?php
}
else header("Location:../error.html");
?>