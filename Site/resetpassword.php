<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- per alert personalizzati -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1,
            glare:true,
		}); 
	</script>
	<script src="js/main.js"></script>

</head>
<body>

<?php
    
include("DB/database.php");
    
if(isset($_POST['reset']) and isset($_POST['password']) and isset($_GET['id'])){
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $password=md5($password);
    $error=0;
    mysqli_autocommit($conn,FALSE);
    $result=mysqli_query($conn,"update Account set passw='".$password."' where user_id='".$id."';");
    if(!$result)$error++;
    $result=mysqli_query($conn,"update Account set token=NULL where user_id='".$id."';");
    if(!$result)$error++;
    if($error){
        mysqli_rollback($conn);
        mysqli_close($conn);
        die ("Errore");
    }
    else{
        mysqli_commit($conn);
        mysqli_close($conn);
        echo "<script> swal('Password aggiornata con successo', '', 'success')
                            .then((value) => {
                                    window.location.href='Login.php';
                            });</script>";
    }
    
}
    
elseif (isset($_GET['id']) and isset($_GET['token'])){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $token=mysqli_real_escape_string($conn,$_GET['token']);
    $result=mysqli_query($conn,"select token from Account where user_id=$id");
    if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    if($row['token']==$token){
        
        ?>
    
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/reset.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="resetpassword.php?id=<?php echo $_GET['id']; ?>" method="POST">
					<span class="login100-form-title">
						Reset Password
					</span>
                    

					<div class="wrap-input100 validate-input" data-validate = "Valid password is required">
						<input class="input100" type="password" name="password" placeholder="Password" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
                    
                    <div class="container-login100-form-btn">
						<input type="submit" name="reset" class="login100-form-btn" value="Reset">
					</div>
				</form>
			</div>
		</div>
	</div>    
 
<?php
    }
        else {
            echo "<script> swal('La sessione è scaduta', 'Richiedi nuovamente la password', 'error')
                            .then((value) => {
                                    window.location.href='ForgotPassword.html';
                            });</script>";
        }
    }
}
else {
        mysqli_close($conn);
        header("Location:error.html");
    }

?>
    
    
    
    </body>
</html>