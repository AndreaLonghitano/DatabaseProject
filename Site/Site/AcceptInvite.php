

<?php
session_start();
include('../DB/database.php');
include("../DB/function.php");
if(!isset($_GET['meeting']) or !isset($_GET['id'])){
    if(!isset($_SESSION['meeting']) or !isset($_SESSION['invitato']))header("Location:../error.php");
}
else{
   $_SESSION['meeting']=$_GET['meeting']; // mi salvo queste due variabili come sessione
   $_SESSION['invitato']=$_GET['id']; 
}
if (!isset($_SESSION['username'])){
    header("Location:../Login.php");
}
else{
    $userid=getUserId($_SESSION['username']);
    if($userid==$_SESSION['invitato']){ // Devo Loggare come invitato
        $name=getName($userid);
        $surname=getSurname($userid);
        $photo=getUrlPhoto($userid);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>Accept Invite</title>

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
    <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script>
    
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> 
 
  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <script src="../dist/js/demo.js"></script>
    <script src="../js/notifications.js"></script>
    <script src="../js/closemodal.js"></script>
    <style>
        .wizard > .steps > ul > li
{
    width: 100%; /* lo sto sovrascrivendo */
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
        <div class="section">
          <h1 class="section-header">
            <div class="titlecenter">Accept Invite</div>
          </h1>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-info mb-0" style="text-align:center;">
                  In questa sezione potrai accettare l'invito al meeting.
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
                   
                  
                      
                          
      <?php
                    $result=mysqli_query($conn,"select title,place,date,lat,lng from meeting where meeting_id='".$_SESSION['meeting']."';");
                    if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $date=$row['date'];
                        $data=explode(" ",$date);
                        $dataattuale=date("Y-m-d");
                        $dataattuale=strtotime($dataattuale);
                        $data=strtotime($data[0]);
                        
                        
                        $result2=mysqli_query($conn,"select reply from invite where meeting_id='".$_SESSION['meeting']."' and user_id='".$_SESSION['invitato']."';");
                        $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
                        if($dataattuale>$data){
                            echo "<script> swal('Questo meeting si è gia svolto. Non puoi piu partecipare','','error');</script> </div></div></div></div></div></div>";
                            include('footer.php'); 
                            echo'</div></div></div>';
                            unset($_SESSION['meeting']);
                            unset($_SESSION['invitato']);
                            mysqli_close($conn);
                        }
                        elseif(!($row2['reply']==null)){
                            echo "<script> swal('Ha gia espresso la tua opinione per questo meeting.','','error');</script> </div></div></div></div></div></div>";
                            include('footer.php'); 
                            echo'</div></div></div>';
                            unset($_SESSION['meeting']);
                            unset($_SESSION['invitato']);
                            mysqli_close($conn);
                            
                        }
                        else {
                ?>
<div class="container">
<div id="wizard">
            <div>
                    
                <h2>Accept Invite</h2>
                <section>
                    
    
                     <div class="container col-sm-10 offset-sm-1 col-lg-10 offset-lg-1">
                         <br/>
                         <br/>
                         <div class="form-group row offset-sm-1">
                            <label  class="col-sm-2 col-form-label"> Title</label>
                                <div class="col-sm-8">
                                <input type="text"  value="" class="form-control" id="TitleMeeting" name="TitleMeeting" placeholder="<?php echo $row['title']; ?>" readonly> 
                            </div>
                        </div>
                           
                           <div class="form-group row offset-sm-1">
                            <label  class="col-sm-2 col-form-label"> Date</label>
                                <div class="col-sm-8">
                                <input type="text" value="" class="form-control" id="DateMeeting" name="DateMeeting" placeholder="<?php echo $row['date']; ?>" readonly>
                            </div>
                        </div>
                           
                           <div class="form-group row offset-sm-1">
                            <label class="col-sm-2 col-form-label"> Place </label>
                                <div class="col-sm-8">
                            <input type="text" class="form-control" id="PlaceMeeting" name="PlaceMeeting" placeholder="<?php echo $row['place']; ?>" readonly>
                            </div>
                           </div>
                        <br> 
                         
                        
    
                        
                         
                    
                         
                         
        <?php
        // seleziono tutte le card dello utente 
        $i=0;
        $result=mysqli_query($conn,"select card_id,title,name,surname,email,work_experience_id,photo from cards where user_id='".$_SESSION['invitato']."';");
        $num_rows=mysqli_num_rows($result);
        if(!$num_rows){
            echo '<div class="container">
                        <div class="col-md-12 col-lg-12  col-sm-12">
                            <div class="alert alert-danger" style="text-align:center" >Aggiungi qualche card prima di accettare l invito. Clicca <a href="NewBusinessCard.php">qui</a> e poi ritorna indietro</div></div></div></div></section></div></div></div> </div></div></div></div></div></div></div></div></div>';
        }
        else{ 
            echo '<div class="container col-sm-10 offset-sm-1 col-lg-10 offset-lg-1">
                                <div id="demo" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">';
            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $result2=mysqli_query($conn,"select C.name,W.role from work_experience W join company C on W.company_id=C.company_id where work_experience_id='".$row['work_experience_id']."';");
            if($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                if (!$i) echo '<div class="carousel-item active personalized">';
                else echo '<div class="carousel-item personalized">';
                $i++;
                echo'<div class="container col-sm-10 col-md-10  col-lg-10"><div class="row col-12"><div class="centre"><strong>'.$row['title'].'</strong></div></div><br/><div class="row"><div class="col-sm-10 col-lg-5 col-md-10 offset-md-1 offset-sm-1 col-xs-12" style="text-align:center;"><img src="'.$row['photo'].'" alt="Not Available" class="img-fluid img-responsive"></div><div class="col-lg-6 col-md-10 col-xs-12" ><div class="col-12"><strong>'.$row['name'].' '.$row['surname'].'</strong></div><br/><div class="col-12">'.$row2['name'].': '.$row2['role'].'</div><br/><br/><div class="col-12" style="font-size:11px;"><span>'.$row['email'].' &nbsp;<span class="checkbox" data-selected="false" data-id="'.$row['card_id'].'"></span></span></div></div> </div></div><br/><br/></div>';
            }
        }
      ?>
  
  <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev"><span class="carousel-control-prev-icon"></span></a><a class="carousel-control-next" href="#demo" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                </div>
            </div>
            </div>
                
                </section>
    </div>
</div>
</div>
                              
                      
    
              
                    </div>
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
    <?php
                }
            ?>

  

      <script>
      
$(document).ready(function(){
    
    var form = $("#wizard");
    
    form.children('div').steps({
                        headerTag: "h2",
                        bodyTag: "section",
                        transitionEffect: "slideLeft",
                        enableCancelButton: true,
                        onFinishing: function (event, currentIndex)
                                {   
                                    var x;
                                    var card=checkCardSelected();
                                        if(card==-1){
                                            swal("Selezionare una card.",'','error');
                                            return false;
                                        }
                                        else {
                                            swal({
                                                title: "Sei sicuro di voler accettare?",
                                                icon: "warning",
                                                buttons: true,
                                                dangerMode: true,
                                            })
                                            .then((willDelete) => {
                                                if(willDelete)window.location.href="json/Accetta.php?card="+card;
                                            })
                                            } 
                                        return false;
                                        },
                        labels: {
                            finish: "Accept Invite",
                            next: "Next",
                            previous: "Previous",
                            cancel:"Rifiuta l'invito",
                        },
        
                        onCanceled:function (event) { 
                            swal({
                                                title: "Sei sicuro di voler rifiutare l'invito?",
                                                icon: "warning",
                                                buttons: true,
                                                dangerMode: true,
                                            })
                                            .then((willDelete) => {
                                                if(willDelete)window.location.href="json/RefuseInvite.php";;
                                            })
                                            return false;
                                            } 
                                });  
    
    function checkCardSelected(){
        var card_id=-1;
        var check=$(".checkbox[data-selected='true']");
        if(check.length==1){
            check.each(function(index){
                 card_id=$(this).attr("data-id"); 
            });
        }
        return card_id;
    }
    
    $(".checkbox").on('click',function(){    
                            var x=$(this).attr("data-selected");
    
                            $(".checkbox").each(function(index){
                                $(this).attr("data-selected",false); // li pulisco tutti perche ne posso selezionare solo una             
                            });
    
                            if(x=="true")$(this).attr("data-selected",false);
                            else $(this).attr("data-selected",true);   
                        });     
      
});
    
      
      
</script>
    
      
</body>
</html>

<?php
                               }
                    }
}
else {
        unset($_SESSION['username']);
        header("Location:../Login.php");
}
}
?>