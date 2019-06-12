<?php
session_start();
include('../DB/database.php');
include("../DB/function.php");
if(!isset($_SESSION['username'])){
    die ("ERRORE");
    exit();
}

if (isset($_FILES['file'])){
     $acceptedfiles=array("jpg","jpeg","png","gnf");
     $filetemp=$_FILES['file']['tmp_name'];
     $filename=$_FILES['file']['name'];
     $x=explode(".",$filename); // il nome glielo do io perche potrebbe andare a sovrascrivere il file di qualche altra persona
     $estensione=end($x);
    if(in_array($estensione,$acceptedfiles)){
        $userid=getUserId($_SESSION['username']);
        $url="ImageProfile/".$userid.".".$estensione;
        move_uploaded_file($filetemp,$url);
        $result=mysqli_query($conn,"update users set photo='".$url."' where user_id=$userid;");
        mysqli_close($conn);
        if($result)header("Refresh:0 url=AccountInfo.php");
        else header("Refresh:0 url=error.php");
    }
    else die ("Il file che hai caricato non è tra i formati accettati.. Riprova a caricare un file immagine");
     
    }
else die ("Qualcosa non è andata a buon fine");
?>