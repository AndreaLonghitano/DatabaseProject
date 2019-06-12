<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
<body>

<?php


include("DB/database.php");
include('DB/function.php');


   

session_start(); // come prima istruzione. Per salvare la username 

if(isset($_POST['signup'])){
$username=mysqli_real_escape_string($conn,$_POST['username']);
$password=mysqli_real_escape_string($conn,$_POST['password']);
$password=md5($password);
$email=mysqli_real_escape_string($conn,$_POST["email"]);
$name=mysqli_real_escape_string($conn,$_POST['nome']);
$surname=mysqli_real_escape_string($conn,$_POST['surname']);
$date=mysqli_real_escape_string($conn,$_POST['date']);
 
    // dovrei controllare che lo username non esiste gia ma essendo impostato username come un campo unique allo
    // interno del databse non è necessario controllare. Eventualemtne fallisce tutta la transazione*/

    
/* Verifico a questo punto che quell'username non esiste gia all'interno del database.. Potrebbe bastarmi anche la query di inserimento.
Infatti,poiche il campo username, è un campo unique, la query fallirebbe nel caso in cui l'username esistesse */

if(checkUsername($username)) {
    mysqli_close($conn);
    echo "<script> swal('Username esiste gia', 'Inserisci un altro username', 'error')
                            .then((value) => {
                                    window.location.href='SignUp.php';
                            });</script>";
}
else if(checkEmail($email)){
    mysqli_close($conn);
    echo "<script> swal('Email gia esistente', 'Inserisci un altra email', 'error')
                            .then((value) => {
                                    window.location.href='SignUp.php';
                            });</script>";
    
}
else { 
mysqli_autocommit($conn,FALSE);
$error=0;  

$error+=query("insert into Account(activation_date,passw,username) values(current_date(),'".$password."','".$username."');");
$query=mysqli_query($conn,"select user_id from Account where username='".$username."';");
$error+=query("select user_id into @tmp from Account where username='".$username."';");
$error+=query("insert into users values(@tmp,'".$name."','".$surname."','".$date."','".$email."',NULL);");   

if($error==3){
    echo "<script>swal('registrazione effettuata con successo');</script>";
    mysqli_commit($conn);
    mysqli_close($conn);
    $_SESSION["username"]=$username; // Suppongo che la registrazione implica il login
    header("refresh:1;url=Site/dashboard.php");
}
else {
    mysqli_rollback($conn);/* Potrei anche ometterlo perhce l'autocommit è settato a FALSE */
    mysqli_close($conn);
     header("refresh:0;url=error.html");} 
}
}
else {
    mysqli_close($conn);
    header("Location:error.html");
}
?>
    
 </body>
</html>
    