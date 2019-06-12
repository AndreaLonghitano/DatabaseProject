<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
<body>

<?php
$stringa="asfdhadskiqrepcmbkdyqnboa2376954cnmoweqhft";
include ('DB/database.php');
    include('DB/function.php');
if(isset($_POST['email']) and isset($_POST['recover'])){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $stringa=str_shuffle($stringa);
    $token=substr($stringa,0,10);
    if(checkEmail($email)){
        $result=mysqli_query($conn,"select user_id,name,surname from users where email='".$email."';");
        if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))$userid=$row['user_id'];
        
        mysqli_query($conn,"update Account set token ='".$token."' where user_id=$userid;");
        
        $subject = 'Recupera Password';
        $headers = "From: " . "andrealonglg96@gmail.com". "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        $message="";
        $message = '<html><body>';
        $message .= '<p>Ciao '.$row['name'].' '.$row['surname'].'</p>';
        $url="http://127.0.0.1/Site/ResetPassword.php?id=$userid&token=$token";
        $message .='<p>Per Resettare la password visita il seguente <a href="'.$url.'">link</a></p>';
        
    
    // modificare qusto messaggio
        $message.='<p>Cordiali Saluti</p>';
        $message .='</body></html>';
        
        mail($email,$subject,$message,$headers);
        header("Location:SignUp.php");
    }
    else{
        mysqli_close($conn);
        echo "<script> swal('Nessuno utente registrato con questa email', 'Riprova', 'error')
                            .then((value) => {
                                    window.location.href='ForgotPassword.html';
                            });</script>";
    }
}





?>
    
    </body>
</html>