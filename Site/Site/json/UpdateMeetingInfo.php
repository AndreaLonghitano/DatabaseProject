<?php
include('../../DB/database.php');
include("../../DB/function.php");
session_start();
if(isset($_SESSION['username']) and isset($_POST['id'])){
    $id=mysqli_real_escape_string($conn,$_POST['id']);
        
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $date=mysqli_real_escape_string($conn,$_POST['date']);
    $place=mysqli_real_escape_string($conn,$_POST['place']);
    $lat=mysqli_real_escape_string($conn,$_POST['lat']);
    $lng=mysqli_real_escape_string($conn,$_POST['lng']);
    
    echo $lat;
    echo $lng;
    
    $prova1=explode("T",$date);
    $timestamp=$prova1[0]." ".$prova1[1];
    $error=0;
    mysqli_autocommit($conn,FALSE);
        $query="update meeting set title='".$title."' where meeting_id=$id;";
        if(!query($query)) $error++;
                 //Controllo che non sono vuote.. Se sono vuote rimango quelle di prima
        $query="update meeting set date='".$timestamp."' where meeting_id=$id;";
        if(!query($query)) $error++;

        $query="update meeting set place='".$place."' where meeting_id=$id;";
        if(!query($query)) $error++;
    
        $query="update meeting set lat='".$lat."' where meeting_id=$id;";
        if(!query($query)) $error++;
    
        $query="update meeting set lng='".$lng."' where meeting_id=$id;";
        if(!query($query)) $error++;
                
        if($error){
                mysqli_rollback($conn);
                mysqli_close($conn);
                die("ERRORE");
            }
            else{
                mysqli_commit($conn);
                sendEmailUpdate($id,$title,$date,$place,$id);
                mysqli_close($conn);
            }
        }

 else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
       


?>