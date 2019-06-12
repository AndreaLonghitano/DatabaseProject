<!DOCTYPE html>
<html lang="en">
<head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- per alert personalizzati -->
</head>

<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");
if( !isset($_SESSION['username']) or !isset($_POST['title']) or !isset($_POST['idEdu']) or !isset($_POST['idWork']) or !isset($_FILES['imgcard']) or !isset($_POST['email']) or!isset($_POST['tel'])){
    mysqli_close($conn);
    header("Location: ../../error.php");
    exit();
}


$userid=getUserId($_SESSION['username']);
$name=getName($userid);
$surname=getSurname($userid);

$title=mysqli_real_escape_string($conn,$_POST['title']);
$idEdu=mysqli_real_escape_string($conn,$_POST['idEdu']);
$idWork=mysqli_real_escape_string($conn,$_POST['idWork']);
$tel=mysqli_real_escape_string($conn,$_POST['tel']);
$email=mysqli_real_escape_string($conn,$_POST['email']);

$acceptedfiles=array("jpg","jpeg","png","gnf");
$filetemp=$_FILES['imgcard']['tmp_name'];
$filename=$_FILES['imgcard']['name'];
$x=explode(".",$filename); // il nome glielo do io perche potrebbe andare a sovrascrivere il file di qualche altra persona
$estensione=end($x);

mysqli_autocommit($conn,FALSE);
$query="insert into cards(user_id,title,name,surname,email,education_experience_id,work_experience_id,phone) values($userid,'".$title."','".$name."','".$surname."','".$email."',$idEdu,$idWork,'".$tel."');";


mysqli_query($conn,$query) or die ("ERRORE QUIII");

$result=mysqli_query($conn,"select card_id from cards where user_id=$userid order by card_id desc limit 1;");
if ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $card=$row['card_id'];
    if(in_array($estensione,$acceptedfiles)){
        $url="../BusinessCardPhoto/".$card.".".$estensione;
        move_uploaded_file($filetemp,$url) or die ("ERRORE");
        $url="BusinessCardPhoto/".$card.".".$estensione;
        $result=mysqli_query($conn,"update cards set photo='".$url."' where card_id=$card;");
        if(!$result) {   
              mysqli_rollback($conn);
              mysqli_close($conn);
              header('Location:error.php');
            }
        }
    else {  mysqli_rollback($conn);
                    mysqli_close($conn);
                    die ("Il file che hai caricato non è tra i formati accettati.. Riprova a caricare un file immagine");
         }
     
    }
else die ("Errore nella query della card");

mysqli_commit($conn);
mysqli_close($conn);
echo "<script> swal('Card Inserita Correttamente');</script>";
header("Refresh:0; url=../BusinessCard.php");

?>