<?php
session_start(); 
include('../DB/database.php');
include("../DB/function.php");
if(isset($_SESSION['username'])){
    $userid=getUserId($_SESSION['username']);
    $name=getName($userid);
    $surname=getSurname($userid);
    $photo=getUrlPhoto($userid);
    $email=getEmail($userid);
    $date=getBirthDate($userid);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>Account Info</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">

  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    
 <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- per alert personalizzati -->
    
<link rel="stylesheet" href="css/personalized.css">
</head>
<?php
    
    if(isset($_POST['edit'])){
    $emailcorretta=0;
    $passcorretta=0; /* Questi due flag torneraano utili per stampare un messaggio */
    $updemail=$_POST['email']; /* La password aggiornata */
    $updpassword=$_POST['password']; /* Email aggiornata */
    
    /* Non è necessrio che i dati vengano aggiornati con successo */
    if(!empty($updemail)){
        $updemail=mysqli_real_escape_string($conn,$updemail);
        $query="update users set email='".$updemail."' where user_id=$userid";
        if(query($query)) $emailcorretta=1;
        $email=getEmail($user_id);
    }
    if(!empty($updpassword)){   
        $updpassword=mysqli_real_escape_string($conn,$updpassword);
        $updpassword=md5($updpassword);
        $query="update Account set passw='".$updpassword."'where user_id=$userid";
        if(query($query)) $passcorretta=1;
    }
    
    if($emailcorretta and $passcorretta)echo "<script>swal('Operazione eseguita con successo!', '', 'success');</script>";
    else if($emailcorretta)echo "<script>swal('Email aggiornata con successo!', '', 'success');</script>";
    else if($passcorretta)echo "<script>swal('Password aggiornata con successo!', '', 'success');</script>";
    else echo "<script>swal('Non è stato possibile aggiornare le info!', 'Riprova', 'error');</script>";
        
         $email=getEmail($userid);
    
    
    }
    
    
    ?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <?php include('navbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div class="main-content">
        <section class="section">
          <h1 class="section-header">
            <div class="titlecenter">Account Info</div>
          </h1>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-info mb-0" style="text-align:center;">
                  In questa sezione potrai aggionare le informazioni sul tuo profilo.
                </div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-11 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Image Profile</h4>
                  </div>
                  <div class="card-body container">
                      <div class="row">
                        <div class="col-5">
                            <?php
                                if ($photo==null)echo '<img class="img-thumbnail" id="photoimg" alt="image" src="ImageProfile/ignota.jpg">';
                                else echo '<img class="img-thumbnail" id="photoimg" alt="image" src="'.$photo.'">';
                            ?>  
                        </div>
                          <div class="col-3">
                              <div class="row">
                            <h4><?php echo $name. " " .$surname; ?> </h4>
                            </div>
                              <br/>
                            <div class="row">
                                <span><a id="loadImage"><i class="fas fa-upload fa-sm fa-3x icon" title="Choose Foto"></i></a>
                                <a hidden id="saveImage"><i class="fas fa-save fa-3x icon" title="Upload Photo"></i></a></span>
                              </div>
                          </div>
                          
                      </div>
                  </div>
                </div>
              </div>
              </div>
              
        <form action="LoadImage.php" method="POST" id="formimage" enctype="multipart/form-data" hidden>
            <input type="file" name="file" id="file" accept="image/jpeg" onchange="readURL(this);">
            <input type="submit" name="submitimage" value="1">  
        </form>
              
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

            <div class="card">
              <div class="card-header" style="text-align:center"><h4>Informations</h4></div>

              <div class="card-body">
                <form method="post" action="AccountInfo.php" id="updateInfo" onsubmit="return check();">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" readonly class="form-control" name="username" value="<?php echo $_SESSION['username']; ?>">
                  </div>

                  <div class="form-group">
                    <label for="email" class="d-block">Email
                    </label>
                    <input type="email" class="form-control" name="email" placeholder="<?php echo $email; ?>" value="" id="updateEmail">
                  </div>
                    
                  <div class="form-group">
                    <label for="email" class="d-block">Name
                    </label>
                    <input type="text"  readonly class="form-control" name="name" value="<?php echo $name;?>">
                  </div>
                    
                   <div class="form-group">
                    <label for="email" class="d-block">Surname
                    </label>
                    <input type="text"  readonly class="form-control"  name="surname" value="<?php echo $surname; ?>">
                  </div>
                    
                    <div class="form-group">
                    <label for="password" class="d-block">Password
                    </label>
                    <input type="password"  class="form-control" name="password" placeholder="********" value="" id="updatePassword" >
                  </div>
                    
                    
                    <div class="form-group">
                    <label for="date" class="d-block">Birth-Date
                    </label>
                    <input type="date" readonly class="form-control"  name="date" value="<?php echo $date ?>">
                  </div>


                  <div class="form-group">
                    <button type="submit" name="edit" class="btn btn-primary btn-block" tabindex="4" id="edit">
                      Edit
                    </button>
                  </div>
                </form>
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
  <script src='Calendar/moment.min.js'></script>
  
  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <script src="../dist/js/demo.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> 
  <script src="../js/notifications.js"></script>
    <script src="../js/closemodal.js"></script>
    
    <script>
        $(document).ready(function(){
            
            $("#loadImage").click(function(){
                $("#file").trigger('click');
            });
            
            $("#saveImage").click(function(){
                $("#formimage").trigger('submit');
            });
            
            var form=$("#updateInfo");
            
            $.validator.addMethod("CheckEmail", function(value, element, arg){
                // value è il nuovo valore
                // eleement è l'eleemtno sul quale è stato richaiamto,
                // arg è l'argomento che passo nella validation
                var email=$("#updateEmail").val();
                if (email=="")return true;
                if(value.includes(".") && value.includes("@"))return true;
                else return false;
            }, "Ciao");
            
            
            form.validate({
               errorPlacement: function errorPlacement(error, element) { error.insertBefore(element); }, // questa funzione inserisce dopo
               rules:{
                        email:{CheckMail:"1",},
                },
			 messages: {
                        email:"Insert a Valid Email",
             }
           });
            
            
            
        });
        
     function readURL(input) {
         $("#saveImage").attr("hidden",false);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photoimg')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        
    function check(){
        var email=$("#updateEmail").val();
        var password=$("#updatePassword").val();
        if (email=="" && password==""){
            swal("Aggiorna qualche informazione");
            return false;
        }
        if(form.valid())return true;
        else return false;
    }
    
    
    
    
    </script>
</body>
</html>

<?php
}
else header("Location:../error.html");
?>