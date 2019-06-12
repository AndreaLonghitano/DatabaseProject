<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

if (isset($_SESSION['username']) and isset($_POST['name'])){
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $place=mysqli_real_escape_string($conn,$_POST['place']);
        $website=mysqli_real_escape_string($conn,$_POST['site']);
        $note=mysqli_real_escape_string($conn,$_POST['note']);
        if(mysqli_query($conn,"Insert into company(name,place,web,email,note) values('".$name."','".$place."','".$website."','".$email."','".$note."');")){
            mysqli_close($conn); 
        }
        else {
            mysqli_close($conn);
            die("ERRRORE");
        }
    }

else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
?>