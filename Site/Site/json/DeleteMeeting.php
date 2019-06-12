<?php

include('../../DB/database.php');
include("../../DB/function.php");
session_start();
if(isset($_SESSION['username']) and isset($_POST['id'])){
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $invitati=mysqli_query($conn,"select user_id from invite where reply is null and meeting_id=$id;");
    $partecipanti=mysqli_query($conn,"select user_id from partecipate where meeting_id=$id;");
    $result1=mysqli_query($conn,"select title,place,date from meeting where meeting_id=$id");
    if($row=mysqli_fetch_array($result1)){
        $title=$row['title'];
        $place=$row['place'];
        $date=$row['date'];
    }
    $result = mysqli_query($conn, "delete from meeting where meeting_id=$id;") or die(mysqli_error($conn));
    if($result) sendDeleteEmail($invitati,$partecipanti,$title,$place,$date);
    mysqli_close($conn);
}
else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
?>
