<?php
session_start(); 
include('DB/database.php');
include("DB/function.php");


?>

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

</head>
<body>
    
    <?php
        if (isset($_SESSION['username']))header("Location:Site/dashboard.php" );/*Rimando subito alla Site/dashboard.php */
        if(isset($_POST['signin'])){
            $username=mysqli_real_escape_string($conn,$_POST['username']);
            $password=mysqli_real_escape_string($conn,$_POST['password']);
            $password=md5($password);
            if(checkUserPassword($username,$password)){
                $_SESSION['username']=$username;
                mysqli_close($conn);
                if(isset($_SESSION['meeting']) and isset($_SESSION['invitato'])) header("Refresh:0; url=http://127.0.0.1/Site/Site/AcceptInvite.php");
                else header("Refresh:0; url=http://127.0.0.1/Site/Site/dashboard.php");
            }
            else{/* Se sono qui la username e la password non sono corrette */
    
                echo "<script> swal('Username o Password incorrette', 'Riprova', 'error')
                            .then((value) => {
                                    window.location.href='Login.php';
                            });</script>";
                mysqli_close($conn);
            }
        }
    else{  ?>
        
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/login.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" name="signin" action="Login.php" method="POST">
					<span class="login100-form-title">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                    
                    
					
					<div class="container-login100-form-btn">
						<input type="submit" name="signin" class="login100-form-btn" value="LOGIN">
					</div>
                    
                    <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="ForgotPassword.html">
							 Password?
						</a>
					</div>


					<div class="text-center p-t-136">
						<a class="txt2" href="Signup.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
    
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1,
            glare:true,
		})
        
        
       
        
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
    
<?php
    }
?>
</html>