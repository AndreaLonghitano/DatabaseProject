<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

$res=array();
if(!isset($_SESSION['username'])){
    die("Errore");
    exit();
}

$userid=getUserId($_SESSION['username']);

$result=mysqli_query($conn,"select I.meeting_id,M.title,U.name,U.surname,U.photo from invite I join meeting M on I.meeting_id=M.meeting_id join users U on M.user_id=U.user_id where I.user_id='".$userid."' and reply is null and date(M.date)>=current_date();");
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array(
        'id'=>$row['meeting_id'],
        'userid'=>$userid,
        'title' =>$row['title'],
        'utente' =>$row['name']." ".$row['surname'],
        'photo' =>$row['photo'],
    );
    
}

mysqli_close($conn);
echo json_encode($res);
?>