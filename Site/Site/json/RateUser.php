<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

// MEETINGS 2

if( !isset($_SESSION['username']) or !isset($_POST['idmeeting'])){
  header("Location: ../../error.html");
  exit();
}  

$userid=getUserId($_SESSION['username']);
$meeting=mysqli_real_escape_string($conn,$_POST['idmeeting']);
$mode=mysqli_real_escape_string($conn,$_POST['mode']);
$note=mysqli_real_escape_string($conn,$_POST['note']);
$professionality=mysqli_real_escape_string($conn,$_POST['professionality']);
$availability=mysqli_real_escape_string($conn,$_POST['availability']);
$impression=mysqli_real_escape_string($conn,$_POST['impression']);
$rateduser=mysqli_real_escape_string($conn,$_POST['raited_user']);
if($mode==1) mysqli_query($conn,'update user_rating set note="'.$note.'", professionality="'.$professionality.'", impression="'.$impression.'",availability="'.$availability.'" where rated_user="'.$rateduser.'" and meeting_id="'.$meeting.'";') or die("Errore nell'aggiornaemtno");
else if($mode==0) mysqli_query($conn,"insert into user_rating values($userid,$meeting,$rateduser,'".$note."',$professionality,$availability,$impression);") or die ("Errore nell'inserimento");
    
mysqli_close($conn);


?>