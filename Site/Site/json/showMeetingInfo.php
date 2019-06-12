<?php
include('../../DB/database.php');
include("../../DB/function.php");
session_start();
if(isset($_SESSION['username']) and isset($_POST['id_meeting'])){
        $idmeeting=mysqli_real_escape_string($conn,$_POST['id_meeting']);
    // da modificare perche devo mostrare anche la mappa
        $result=mysqli_query($conn,"select title,place,date from meeting where meeting_id=$idmeeting;");
            $res=array();
        if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $res[]=array(
                'title'=> $row['title'],
                'date'=>$row['date'],
                'place'=>$row['place']);
                mysqli_close($conn);
                echo json_encode($res);
          }
            
        }
        else {
             mysqli_close($conn);
            die("ERRORE");
        }
?>