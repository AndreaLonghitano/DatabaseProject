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
  <title>Meeting Room</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    
  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- per alert personalizzati --> 
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
            <div class="titlecenter">Meeting Room</div>
          </h1>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-info mb-0" style="text-align:center;">
                  In questa sezione potrai esprimere la tua opinione in merito ai Meetings a cui hai partecipato.
                </div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4 style="text-align:center">Meeting</h4>
                  </div>
                  <div class="card-body">
                      
                        
                         <table id="meetingTable" class="table table-striped table-responsive-lg table-responsive-sm table-responsive-md table-responsive-xs">
				<thead>
			  	<tr>
						<th scope="col">Role</th>
						<th scope="col">Title</th>
						<th scope="col">Partecipate</th>
						<th scope="col">Place</th>
                        <th scope="col">ID</th>
					</tr>
			     </thead>
				<tbody> 
				</tbody>
                </table>   
                </div>
                </div>
              </div>
            </div>
              
              <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <div class="row">
                      <div class="card col-12">
                            <div class="card-header">
                        <h4 style="text-align:center">Partecipants</h4>
                    </div>
                    <div class="card-body">
                         
                            <div id="demo" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" id="carousel-inner"> 
                        <!-- vado ad appendere con Ajax -->
                                <br/>
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a> &nbsp;
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>   
                        </a>
                                </div>
                            </div>
                      
                    </div>
                    </div>
                </div>
                      
                      <!-- second row -->
                    <div class="row">
                        <div class="card col-12">
                            <div class="card-header">
                        <h4 style="text-align:center">Rate Meeting</h4>
                    </div>
                    <div class="card-body">
                        <form id="meetinginfo" style="display:none">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                     <div class="form-group">
                            <label for="notes">Your Notes</label>
                            <textarea class="form-control rounded-0" id="notestextarea" rows="3" placeholder="Please Insert your Notes About Meeting"></textarea>
                      </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xs-6">
                        <br/>
                        <div class="row">
                            <span>Useful:</span>
                            <span id="rateYo"></span>
                        </div>
                        
                        <div class="row">
                            <span>Importance:</span>
                            <span id="importance"></span>
                        </div>
                    </div>
                    <div class="row col-sm-1 offset-sm-9 col-md-1 offset-md-9 col-lg-1 offset-lg-9 col-xs-1 offset-xs-9">
                        <button type="button" class="btn btn-primary" id="savemeetingrate">Save</button>
                    </div>
                    </div>
                </form>
                    </div>
                    </div>
                      
                      </div>
                  
                  </div>
                  
                  <div class="col-lg-6 col-md-12 col-12 col-sm-12 col-xs-12">
                    <div class="card">
                            <div class="card-header">
                        <h4 style="text-align:center">Rate Partecipants</h4>
                    </div>
                        
                    <div class="card-body">
                        
                        
                        <div id="infopartecipant" style="display:none">
   <div class="row">
      <div class="col-sm-6 col-lg-6 col-xs-4 col-md-5">
         <img src="" alt="Non Disponibile" id="profileimage" class="img-thumbnail img-responsive profileimage"  />
      </div>
      <div class="col-sm-4 offset-sm-1 col-lg-5 offset-lg-1 col-md-5 offset-md-1" id="namesurname" style="text-align:center;">
         Nome e Cognome
      </div>
   </div>
   <br />
   <div class="row">
      <div class="col-sm-10 offset-sm-1 col-lg-10 offset-lg-1 col-md-10 offset-md-1">
         <div class="form-group">
            <label for="notes">Your Notes</label>
            <textarea class="form-control rounded-0" id="notepartecipant" rows="3" placeholder="Please Insert your Notes About Partecipants"></textarea>
         </div>
      </div>
   </div>
   <br />
   <div class="row">
      <div class="col-sm-10 offset-sm-1 col-lg-10 offset-lg-1">
         <div class="row">
            <span>Professionality:</span>
            <span id="professionality"></span>
         </div>
         <div class="row">
            <span>Impression:</span>
            <span id="impression"></span>
         </div>
         <div class="row">
            <span>Availability:</span>
            <span id="availability"></span>
         </div>
         <div class="row">
            <div class="col-sm-2 offset-sm-9">
               <button type="button" class="btn btn-primary" id="saveuserrating">Save</button>
            </div>
         </div>
      </div>
   </div>
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
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> 
 
  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <script src="../dist/js/demo.js"></script>
    <script src="../js/notifications.js"></script>
    <script src="../js/closemodal.js"></script>
    
  <script>
    $(document).ready(function(){
    
        $("#rateYo").rateYo({
        starWidth:'20px',
        numStars: 5,
        precision: 2,
        halfStar: true,
        });
    
        $("#importance").rateYo({
             starWidth:'20px',
        })
    
        $("#professionality").rateYo({
            starWidth:'20px',
        });
    
        $("#impression").rateYo({
            starWidth:'20px',
        });
    
        $("#availability").rateYo({
            starWidth:'20px',
        });
    
        var id="";
        var meetingtable=$("#meetingTable").DataTable({
                "searching": false,
                "info": false,
                "bLengthChange": false,
                "processing": true,
                "responsive":true,
                "columnDefs": [
                    {
                "targets": [ 4],
                "visible": false,
                    },
                ],   
     
                "ajax": {
				url: "json/MeetingRoomDate.php",
				error: function (xhr, error, thrown) {
					alert( error ); 
                    alert("Errore nel caricaemtno della tabella");
				    },
			     },
     
                "aoColumns": [
				{ "mData": "role","bSortable": false},
				{ "mData": "title","bSortable":true},
				{ "mData": "partecipanti","bSortable": true,},
				{ "mData": "place", "bSortable": true},
                { "mData": "meeting_id", "bSortable": true},
                ],
     
                "oLanguage":{
                    "sZeroRecords":"Nessun elemento trovato",
                    "oPaginate": {
				        "sPrevious": "Previous",
				        "sNext": "Next",
			     },				
                },
        });
    
        // Impongo che il carosello gira
        $("#demo").carousel({
            interval: false,
        });
    
        $('#demo').on('slide.bs.carousel', function () {
            setTimeout(showPartecipant, 700); // devo farlo Aspettare questi 700 secondi altrimenti leggi un valore della card sbagliato
        });
    
        var rating;
        function showPartecipant(){
            var x=$(".active");
            if(x.length){
            cleanDivPartecipant();
            $("#infopartecipant").css("display",'block');
            var card=$(".active");
            var utente;
            card.each(function(){
                utente=$(this).attr('data-id'); // il ciclo tanto si ripete una volta sola.. Prendo id dell'utente
            });
            $("#saveuserrating").attr('data-id',utente); // mi salvo l'id dell'utente nel bottone
            var SelectMeeting=$("#meetingTable").find('.selected');
            meeting=(meetingtable.row(SelectMeeting).data())['meeting_id'];
            $.ajax({
                url:"json/GetUserRating.php",
                type:"POST",
                data:{id:utente,meeting:meeting},
                success:function(data){
                    var json=$.parseJSON(data);
                        if(json.length){
                            $("#namesurname").append('<br/><strong>'+json[0].name + " " + json[0].surname+'</strong>');
                            if((json[0].photo))$("#profileimage").attr('src',json[0].photo);
                            if((json[0].note))$("#notepartecipant").attr('placeholder',json[0].note);
                            if((json[0].professionality))$("#professionality").rateYo("option", "rating",(json[0].professionality));
                            if((json[0].impression))$("#impression").rateYo("option", "rating",(json[0].impression));
                            if((json[0].availability))$("#availability").rateYo("option", "rating",(json[0].availability));
                            if(json[0].note || json[0].professionality || json[0].impression || json[0].availability)rating=true;
                            else rating=false;
                         }
                        else rating=false;
                    
                   // Altrimenti non fa niente tanto i Div sono gia Puliti. Pertanto posso inserire le nuove impressioni
                },
                    
                });
            }
        }
    
        function cleanDivPartecipant(){
            $("#namesurname").empty();
            $("#notepartecipant").attr('placeholder','Please Insert your Notes About Partecipants');
            $("#profileimage").attr('src','');
            $("#professionality").rateYo("option", "rating",5); // li setto al massimo di default
            $("#impression").rateYo("option", "rating",5);
            $("#availability").rateYo("option", "rating",5);
        }
    
    
        $('#meetingTable').on( 'click', 'tr', function () {
            $("#carousel-inner").empty();
        if ($(this).hasClass('selected') ) {
            $(this).removeClass('selected'); // svuota il carosello se nessuno è selezionato
            $("#meetinginfo").css("display","none");
            $("#infopartecipant").css("display",'none');
        }
        else {
            meetingtable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var SelectMeeting= $("#meetingTable").find('.selected');
            id=(meetingtable.row(SelectMeeting).data())['meeting_id'];
            var partecipate=(meetingtable.row(SelectMeeting).data())['partecipanti'];
            loadMeeting(id);
            if(partecipate==0){
                $("#carousel-inner").append('<div class="alert alert-danger">Non Partecipa nessuno al meeting selezionato</div>');
                $("#infopartecipant").css("display",'none');
            }
            else {
                loadCards(id);
                $('#demo').carousel('next'); // in maniera tale che subito mostro il primo partecipante
                }
               
        }
        });
    
    
    
    function loadCards(id){
        $.ajax({
                    url:"json/CardsOfMeeting.php",
                    type:"POST",
                    data:{"id":id},
                        success:function(data){
                            var opts=$.parseJSON(data);
                            if(opts.length){
                            for(var i=0;i<opts.length;i++){
                                if(i==0) var active="active";
                                else var active="";
                                 $("#carousel-inner").append('<div class="carousel-item '+active+' personalized" data-id="'+opts[i].user_id+'">'+'<div class="container col-sm-8 offset-sm-2 col-lg-8 offset-lg-2"><div class="row col-12"><div class="centre"><strong>'+opts[i].title+'</strong></div></div><br/><div class="row"><div class="col-sm-10 col-lg-5 col-md-10 offset-md-1 offset-sm-1 col-xs-12"><img src="'+opts[i].photo+'" alt="Not Available" class="img-fluid img-responsive"></div><div class="col-lg-5 offset-lg-1 col-md-10 offset-md-1 col-xs-12"><div class="row"><div><strong>'+opts[i].name+' '+opts[i].surname+'</strong></div><br/><div>'+opts[i].companyname+': '+opts[i].role+'</div></div><div class="row"><span>'+opts[i].email+' &nbsp;</span></div></div></div></div></div>');
                            }
                        $("#carousel-inner").append('<a class="carousel-control-prev" href="#demo" data-slide="prev"><span class="carousel-control-prev-icon"></span></a> &nbsp;<a class="carousel-control-next" href="#demo" data-slide="next"><span class="carousel-control-next-icon"></span></a>');
                            }
                            else $("#carousel-inner").append('<div class="alert alert-danger">Non partecipa nessuno al meeting oltre te stesso</div>');
                        },
                        error:function(){
                            alert("Si è verificato un errore durante l'aggiornamento");
                        } 
                    });
    }
    
     var votato;
    function loadMeeting(id){
        $("#notestextarea").attr('placeholder','Please Insert your Notes About Meeting');
        $("#notestextarea").attr('value','');
        $("#rateYo").rateYo("option", "rating", 5); //returns a jQuery Element
        $("#importance").rateYo("option", "rating", 5); // li setto al massimo
        $("#meetinginfo").css("display","block");
        $("#savemeetingrate").attr("data-id",id); // mi salvo l'id nel bottone
        $.ajax({
            url:"json/GetWalletRating.php",
            type:"POST",
            data:{idmeeting:id},
            success:function(data){
                var json=$.parseJSON(data);
                if(json.length){
                  $("#notestextarea").attr('placeholder',json[0].note); 
                  $("#rateYo").rateYo("option", "rating",json[0].useful);
                  $("#importance").rateYo("option", "rating",(json[0].importance));
                    votato=true;
                }
                else votato=false; // significa che non ho ancora votato per quel meeting
            },    
            });
        }
    
    $("#savemeetingrate").on('click',function(){
        var useful=($("#rateYo").rateYo("option", "rating"));
        var importance=($("#importance").rateYo("option", "rating"));
        var text=$("#notestextarea").val();
        if(!text){
            text=$("#notestextarea").attr('placeholder');
            if (text=="Please Insert your Notes About Meeting")text=null;
        }
        var idmeeting=$("#savemeetingrate").attr('data-id');
        if(votato)var mode=1; // modalita 1 aggiorna
        else mode=0; // modalita 0 inserisce
        $.ajax({
            url:"json/RateMeeting.php",
            type:"POST",
            data:{idmeeting:idmeeting,
                  mode:mode,
                  useful:useful,
                  importance:importance,
                  note:text,
                 },
            success:function(data){
                swal('Info meeting aggiornati correttamente','', 'success');
            },
            error:function(){
                 swal('Si è verificato un errore durante aggiornamento','Riprova', 'error');
            },
        });
        
        
    });
    
    $("#saveuserrating").on('click',function(){
        var professionality=($("#professionality").rateYo("option", "rating"));
        var availability=($("#availability").rateYo("option", "rating"));
        var impression=($("#impression").rateYo("option", "rating"));
        var text=$("#notepartecipant").val();
        if(!text){
            text=$("#notestextarea").attr('placeholder');
            if (text=="Please Insert your Notes About Meeting")text=null;
        }
        //id del meeting lo conosciamo perche salvato nella variabile globale id
        var utente=$("#saveuserrating").attr('data-id');
        if(rating)var mode=1; // modalita 1 aggiorna
        else mode=0; // modalita 0 inserisce
        
        $.ajax({
            url:"json/RateUser.php",
            type:"POST",
            data:{idmeeting:id,
                  mode:mode,
                  professionality:professionality,
                  availability:availability,
                  impression:impression,
                  note:text,
                  raited_user:utente
                 },
            success:function(data){
                swal('Dati aggiornati correttamente','', 'success');
            }
        });
        
        
        
    });
    
});
    
    </script>
</body>
</html>

<?php
}
else header("Location:../error.html");
?>