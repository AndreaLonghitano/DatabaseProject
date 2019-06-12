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
  <title>Businness Cards</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


    
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
            <div class="titlecenter">Business Cards</div>
          </h1>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-info mb-0" style="text-align:center;">
                  In questa sezione potrai visualizzarele le tue card.Potrai rimuoverle ed eventualemnte aggiungerne altre.
                </div>
              </div>
            </div>
              
             <!-- <div class="container col-sm-10 offset-sm-1 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                  <div class="row col-12"><div class="centre" id="titlee">
                      <strong>'.$row['title'].'</strong>
                      </div></div><br/><div class="row">
                  <div class="col-sm-10 col-lg-5 col-md-10 offset-md-1 offset-sm-1 col-xs-12" style="text-align:center">
                      <img src="'.$row['photo'].'" alt="Not Available" class="img-fluid img-responsive"></div>
                  <div class="col-lg-5 offset-lg-1 col-md-10 offset-md-1 col-xs-12"  style="text-align:Center">
                      <div class="col-12"><strong>'.$row['name'].' '.$row['surname'].'</strong></div><br/><div class="col-12">'.$row2['name'].': '.$row2['role'].'</div><br/>
                      <div class="col-12" id="eee">
                          <span>'.$row['email'].' &nbsp;</span>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                  <br/><br/>
              </div> -->
              
              
              
              
            <div class="row">
                <div class="card col-10 offset-1">
                  <div class="card-header">
                    <h4 style="text-align:center">Cards</h4>
                  </div>
                  <div class="card-body">
                      <?php
    
                        $i=0;
                        $result=mysqli_query($conn,"select card_id,title,name,surname,email,work_experience_id,photo from cards where user_id=$userid;");
                        $rows=mysqli_num_rows($result);
                        if(!$rows){
                            echo '<div class="alert alert-danger mb-0" style="text-align:center">Non esiste nessuna card per questo utente. Prova ad aggiungerne qualcuna cliccando 
                            <a href="NewBusinessCard.php">qui</a></div>';
                        }
                        else{
                            echo '<div id="demo" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
                             while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                $result2=mysqli_query($conn,"select C.name,W.role from work_experience W join company C on W.company_id=C.company_id where work_experience_id='".$row['work_experience_id']."';");
                                 
                                if($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                                    if (!$i) echo '<div class="carousel-item active personalized" data-id="'.$row['card_id'].'">';
                                    else echo '<div class="carousel-item personalized" data-id="'.$row['card_id'].'">';
                                    $i++;
                                
                                    echo'<div class="container col-sm-10 offset-sm-1 col-md-10 offset-md-1 col-lg-8 offset-lg-2"><div class="row col-12"><div class="centre" id="titlee"><strong>'.$row['title'].'</strong></div></div><br/><div class="row"><div class="col-sm-10 col-lg-5 col-md-10 offset-md-1 offset-sm-1 col-xs-12" style="text-align:center"><img src="'.$row['photo'].'" alt="Not Available" class="img-fluid img-responsive"></div><div class="col-lg-5 offset-lg-1 col-md-10 offset-md-1 col-xs-12" id="eemail" style="text-align:Center"><div class="col-12"><strong>'.$row['name'].' '.$row['surname'].'</strong></div><br/><div class="col-12" >'.$row2['name'].': '.$row2['role'].'</div><br/><div class="col-12" id="eee"><span>'.$row['email'].' &nbsp;</span>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                  <br/><br/>
              </div>';
              
                            }
                            }
                            
                            echo'<a class="carousel-control-prev" href="#demo" data-slide="prev"><span class="carousel-control-prev-icon"></span></a><a class="carousel-control-next" href="#demo" data-slide="next"><span class="carousel-control-next-icon"></span></a>';   
                            echo "</div></div>";
                            
                            echo '<br/><br><div class="row"><div class="col-lg-1 offset-lg-3 col-md-1 offset-md-2 col-sm-1 offset-sm-2 col-xs-1 offset-xs-2"><button class="btn btn-danger btn-shadow btn-round has-icon btn-block" title="Add" id="AddCard">
                         <i class="fas fa-plus-circle icon"></i>
                        </button></div>
                         <div class="col-lg-1 offset-lg-1 col-xs-1 offset-xs-1 col-md-1 offset-md-1 col-sm-1 offset-sm-2">
                        <button class="btn btn-danger btn-shadow btn-round has-icon btn-block" title="Update" id="UpdateCard">
                        <i class="fas fa-edit icon"></i>
                        </button>
                        </div>
                        <div class="col-lg-1 offset-lg-1 col-xs-1 offset-xs-1 col-md-1 offset-md-1 col-sm-1 offset-sm-2">
                        <button class="btn btn-danger btn-shadow btn-round has-icon btn-block" title="Delete" id="DeleteCard">
                        <i class="fas fa-minus-circle icon"></i>
                        </button>
                        </div>
                        </div>';
                        }
                        ?>
                      
                </div>
              </div>
              </div>
              
            </div>
        </section>
     
<?php
    include("footer.php");
    include("Modal/ModalDelete.php");
    include("Modal/ModalUpdateCard.php");
?>
    
        
        
    </div>
  </div>
</div>

  <script src="../dist/modules/jquery.min.js"></script>
  <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script> 
   <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <script src="../dist/js/demo.js"></script>
    <script src="../js/notifications.js"></script>
    <script src="../js/closemodal.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- per alert personalizzati -->
<script>
    $(document).ready(function(){
        $("#AddCard").click(function(){
            window.location.href="NewBusinessCard.php";
        })
        
        $("#DeleteCard").click(function(){
            $("#deleteModal").modal("show");
            var x=$(".active");
            $.each(x,function(){
               $("#deleteButtonModal").attr("data-id",$(this).attr('data-id'));
            });
        });
        
        $("#demo").carousel({
            interval: false,
        });
        
        
        
        $("#deleteButtonModal").click(function(){
            var x=$(this).attr("data-id");
            window.location.href="json/DeleteCard.php?id="+x;
        });
        
        $("#UpdateCard").click(function(){
            
            // pulisco i div
            $("#TitleUpdate").val('');
            $("#EmailUpdate").val('');
            $("#TelUpdate").val('');
            
            var x=$('.active');
            var id;
            $.each(x,function(index,elemento){
                   id=$(this).attr('data-id');
            });
            $("#ModalUpdateCard").attr('data-id',id);
            $.ajax({
                url:"json/GetDatesCard.php?id="+id,
                success:function(data){
                    var dati=$.parseJSON(data);
                    $("#TitleUpdate").attr('placeholder',dati[0].title);
                    $("#EmailUpdate").attr('placeholder',dati[0].email);
                    $("#TelUpdate").attr('placeholder',dati[0].tel);
                     $("#ModalUpdateCard").modal("show");
                }
            });
            
        });
        
        
        $("#modalupdatecard").click(function(event){
                var title=$("#TitleUpdate").val();
                var email=$("#EmailUpdate").val();
                var tel=$("#TelUpdate").val();
                if (title=="" && email=="" && tel=="") {
                    swal("Aggiornare i dati",'','error');
                    event.preventDefault();
                }
                else{
                    if(title=="") title=$("#TitleUpdate").attr('placeholder');
                    if(email=="") email=$("#EmailUpdate").attr('placeholder');
                    if(tel=="") tel=$("#TelUpdate").attr('placeholder');
                    var id=$("#ModalUpdateCard").attr('data-id');
                    $.ajax({
                        url:"json/UpdateCard.php",
                        type:"POST",
                        data:{id:id,title:title,email:email,tel:tel},
                        success:function(data){
                         $("#ModalUpdateCard").modal("hide"); 
                         var x=$(".active .container .row #titlee");
                         x.html('<strong>'+title+'</strong>');
                         var y=$(".active .container #eemail #eee");
                         y.html('<span>'+email+'</span>');
                    }
                        
                    });
                }
            });
        
        
        
        
    });
    
    
</script>
     
    
</body>
</html>

<?php
}
else header("Location:../error.html");
?>