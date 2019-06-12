<?php
session_start(); 
include('../DB/database.php');
include("../DB/function.php");
if(isset($_SESSION['username'])){
    $user_id=getUserId($_SESSION['username']);
    $name=getName($user_id);
    $surname=getSurname($user_id);
    $photo=getUrlPhoto($user_id);

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
 <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">       

  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    
  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- per alert personalizzati --> 
    <link rel="stylesheet" href="css/personalized.css">
    <!--<link rel="stylesheet" href="Wizard/css/normalize.css">-->
    <link rel="stylesheet" href="Wizard/css/main.css">
    <link rel="stylesheet" href="Wizard/css/jquery.steps.css">
    <script src="Wizard/lib/modernizr-2.6.2.min.js"></script>
        
    <script src="Wizard/lib/jquery-1.9.1.min.js"></script>
    
    <script src="Wizard/lib/jquery.cookie-1.3.1.js"></script> 
    <script src="Wizard/build/jquery.steps.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- per alert personalizzati -->
    

    
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <?php include('navbar.php'); ?>
      <?php include('sidebar.php'); ?>
        
        
      <div class="main-content">
        <div class="section">
          <h1 class="section-header">
            <div class="titlecenter">Create Meeting</div>
          </h1>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-info mb-0" style="text-align:center">
                  In questa sezione potrai creare meeting.
                </div>
              </div>
            </div>
              
            
              
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <?php
                $result=mysqli_query($conn,"select card_id from cards where user_id='".$user_id."';");
                $num_rows=mysqli_num_rows($result);
                if(!$num_rows){
                    echo'<div class="alert alert-danger mb-0" style="text-align:center">Non puoi creare meeting in quanto non hai business card.Prova a creare qualcuna cliccando <a href="NewBusinessCard.php"><strong>qui</strong></a></div>';
                }
                else{
                ?>
                  <div class="card-header">
                    <h4 style="text-align:center">Meeting</h4>
                  </div>
                  <div class="card-body">
                              
                      <form id="myform" method="POST" action="json/InsertMeeting.php">
            <div>
                <h2>Insert New Meeting</h2>
                <section>
    
                     <div class="container col-sm-8 offset-sm-2">
                         <br/>
                         <br/>
                         <div class="form-group row offset-sm-1">
                            <label  class="col-sm-2 col-form-label"> Title</label>
                                <div class="col-sm-8">
                                <input type="text"  value="" class="form-control" id="TitleMeeting" name="TitleMeeting" placeholder="Title"> 
                            </div>
                        </div>
                           
                           <div class="form-group row offset-sm-1">
                            <label  class="col-sm-2 col-form-label"> Date</label>
                                <div class="col-sm-8">
                                <input type="datetime-local" value="" class="form-control" id="DateMeeting" name="DateMeeting">
                            </div>
                        </div>
                           
                           <div class="form-group row offset-sm-1">
                            <label class="col-sm-2 col-form-label"> Place </label>
                                <div class="col-sm-8">
                            <input type="text" class="form-control" id="PlaceMeeting" name="PlaceMeeting">
                            </div>
                           </div>
                        <br> 
                         
                            <div class="form-group row offset-sm-1">
                            <label class="col-sm-2 col-form-label"> Location </label>
                                <div class="col-sm-8">
                            <div id="map" class="row" style="width:100%;height:200px;">
                            </div>
                           </div>
                         </div>
                         <div id="infowindow-content">
                                <img src="" width="16" height="16" id="place-icon">
                                <span id="place-name"  class="title"></span><br>
                             <span id="place-address"></span>
                        </div>
                         
                        
                             
                    </div>
                    
            
                </section>  
                
                

                
                 <h2>Invite</h2>
                <section>
                    <div class="container col-sm-12 col-lg-12">
                        <br/>
                        <br/>
                        <table class="table table-bordered table-responsive-lg table-responsive-sm table-responsive-md table-responsive-xl" id="tablePartecipant">
                    <thead>
                        <tr>
                            <th>Utente</th>
                            <th>Company</th>
                            <th>Role</th>
                            <th>Invita</th>
                        </tr>
                    </thead>
                    <tbody>  
                </tbody>
                    </table>
                    </div>
                <br/>
                </section>
                
                
                <!-- £ SEZIONE -->
                
                <h2>Select Card</h2>
                <section>
                    <br/>
                    <br/>
                    <div class="container col-sm-10 offset-sm-1">
                    <div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators  LI HO ELIMINATI-->
  
  <!-- The slideshow -->
                    <div class="carousel-inner" id="carousel-inner">
      <?php
        // seleziono tutte le card dello utente 
        $i=0;
        $result=mysqli_query($conn,"select card_id,title,name,surname,email,work_experience_id,photo from cards where user_id=$user_id;");
        $num_rows=mysqli_num_rows($result);
        if(!$num_rows){
            echo '<div class="container"><div class="col-sm-4 offset-sm-4">
                  <p> Non ci sono ancora card associate al tuo account. Prima di inserire dei meeting dovresti inserire qualche card. <a href="BusinessCard.php">Clicca il seguente link per aggiungerne una</a></p></div></div>';
        }
        else{ while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $result2=mysqli_query($conn,"select C.name,W.role from work_experience W join company C on W.company_id=C.company_id where work_experience_id='".$row['work_experience_id']."';");
            if($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                if (!$i) echo '<div class="carousel-item active personalized">';
                else echo '<div class="carousel-item personalized">';
                $i++;
                echo '<div class="container col-sm-8 offset-sm-2 col-lg-8 offset-lg-2"><div class="row">';
                echo '<h6>'.$row['title'].'</h6></div>';
                echo '<div class="row"><div class="col-sm-5 col-lg-5"><img src="'.$row['photo'].'" alt="Not Available" class="img-fluid img-responsive"></div><div class="col-lg-5 offset-lg-1"><div class="row"><div><strong>'.$row['name'].' '.$row['surname'].'</strong></div><p>'.$row2['name'].': '.$row2['role'].'</p></div><br/><div class="row"><span>'.$row['email'].' &nbsp;<span class="checkbox" data-selected="false" data-id="'.$row['card_id'].'"></span></span></div></div></div></div><br/><br/></div>';
            }
        }
      ?>
  
  <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a> &nbsp;
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon" style="color:yellow"></span>   
                    </a>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                        
                        <script>
                        
                        $(".checkbox").on('click',function(){    
                            var x=$(this).attr("data-selected");
    
                            $(".checkbox").each(function(index){
                                $(this).attr("data-selected",false); // li pulisco tutti perche ne posso selezionare solo una             
                            });
    
                            if(x=="true")$(this).attr("data-selected",false);
                            else $(this).attr("data-selected",true);   
                        });     
                        
                        
                        
                    </script>
            </div>
                
                </section>
                      
               </div>
            </form>
            </div>
        <?php
                }
            ?>
        </div>
                  
    </div>           
</div>
    
              
              
        
        </div>
      </div>
     
<?php
    include("footer.php");
?>
  
        
        
    </div>
  </div>
</div>

  <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script>
    
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> 
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcCHXiu03QBsnXE5hyBtBKqS5qJ5tQGQQ&libraries=places&callback=initMap"
                        async defer></script>
    <script type="text/javascript" src="Maps/maps.js"></script>
 
  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <script src="../dist/js/demo.js"></script>
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
    console.log(datetime);
    
    
    var cardid="";
    var inviti= new Array();
    var form = $("#myform");
    
		form.validate({
			errorPlacement: function errorPlacement(error, element) { error.insertAfter(element); },
            rules:{
            TitleMeeting:{ required:true,},
            DateMeeting:{required:true,
                         min:datetime,
                        },
            PlaceMeeting:{required:true,
                         },
        },
			 messages: {
                TitleMeeting: "Insert a Valid Title",
                DateMeeting: {
                    required:"Insert a Valid Date",
                    min:"La Data deve essere Maggiore di quella attuale"},
                PlaceMeeting:{ required:"Insert a Place",
                    }
             }
    });
        
    form.children('div').steps({
                        headerTag: "h2",
                        bodyTag: "section",
                        transitionEffect: "slideLeft",
                        onStepChanging: function (event, currentIndex, newIndex)
                            {
                            if(newIndex<currentIndex)return false;
                                else {
                                    
                                    if(currentIndex==0) {
                                        // calcolo qui latitudine e longitudine
                                       console.log($("#PlaceMeeting").val()); 
                                        
                                        if(form.valid()){
                                            if(latitude=="" || longitude==""){
                                            swal ("Inserisci un posto corretto","","error");
                                            return false;
                                            }
                                        return true;
                                        } 
                                        else return false; 
                                         }
                                    if (currentIndex==1){
                                        if(saveInvite())return true;
                                        else return false;}
                                    else return true;
                                    
                                    }
                                },
                        
                            onFinishing: function (event, currentIndex)
                                {
                                    if(checkCardSelected()){
                                        completeForm();
                                        form.submit();
                                        return true;
                                    }
                                    else {
                                        swal("Seleziona una card","","error");
                                        return false;
                                    }
                                },
    
                            });
        
        
    function completeForm(){
        form.append('<input type="text" name="cardIdSelected" value="'+cardid+'" hidden>');
        form.append('<input type="text" name="lat" value="'+latitude+'" hidden>');
        form.append('<input type="text" name="lng" value="'+longitude+'" hidden>');
        for(var i=0;i<inviti.length;i++){
            form.append('<input type="text" name="invito[]" value="'+inviti[i]+'" hidden>');
        }
    }
    
    function saveInvite(){
        var invite=$("tr.selected");
        if(invite.length==0) {
            var risp=confirm("Sei sicuro di voler procedere senza invitare?");
            if (risp) return 1; else return 0;
        }
        $("tr.selected").each(function(){
            var x=$(this).find("td:last-child").find("input").val();
            inviti.push(x);
        });
        console.log(inviti);
        return 1;
    }   
    
    
    $("#tablePartecipant").dataTable({
        "searching": true,
        "info": false,
        "bLengthChange": false,
        "processing": true,
        "pageLength": 10,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   3
        } ],
        select: {
            style:'multi',
            selector: 'td:last-child',
        },
        
        "ajax": {
				url: "json/AllPartecipants.php",
				error: function (xhr, error, thrown) {
					alert( error ); 
                    alert("Errore nel caricametno della tabella Education");
				},
			},
            
			"aoColumns": [
				{ "mData": "utente"},
				{ "mData": "company"},
				{ "mData": "role","bSortable": false,},
				{ "mData": "id", "bSortable": false,
                  "mRender": function(id) {return "<input type='hidden' value='"+id+"'>";}}
                ],
    });
    
    
    
    /* fino a qui funziona sicuro */
    
    
    function checkCardSelected(){
        var check=$(".checkbox[data-selected='true']");
        if(check.length==1){
            check.each(function(index){
                cardid=$(this).attr("data-id"); 
            })
            return true;
        }
        else return false;
    }
    
    
    });
    
    </script>
    
      
</body>
</html>

<?php
}
else header("Location:../error.html");
?>