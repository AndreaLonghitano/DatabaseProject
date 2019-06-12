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
$useful=mysqli_real_escape_string($conn,$_POST['useful']);
$importance=mysqli_real_escape_string($conn,$_POST['importance']);
if($mode==1) mysqli_query($conn,'update wallet set useful="'.$useful.'", importance="'.$importance.'", note="'.$note.'" where user_id="'.$userid.'" and meeting_id="'.$meeting.'";') or die("Errore nell'aggiornaemtno");
else if($mode==0) mysqli_query($conn,"insert into wallet values($userid,$meeting,'".$note."',$useful,$importance);") or die ("Errore nell'inserimento");
    
    
mysqli_close($conn);


?>