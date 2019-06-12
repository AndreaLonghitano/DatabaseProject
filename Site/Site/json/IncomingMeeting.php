<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

if( !isset($_SESSION['username'])){
  header("Location: ../../error.html");
  exit();
}       

$user_id=getUserId($_SESSION['username']);

$res=array();
$result=mysqli_query($conn,"select title,date,P.meeting_id from partecipate P join meeting M on P.meeting_id=M.meeting_id where P.user_id=$user_id and date(date)>current_date();");
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array(
    "title"=>$row['title'],
    "date" =>$row['date'],
    "meeting"=>$row['meeting_id'],
    "partecipante"=>1
    ); 
}

$result=mysqli_query($conn,"select title,date,P.meeting_id from invite P join meeting M on P.meeting_id=M.meeting_id where P.user_id=$user_id and P.reply is null and date(date)>current_date();");
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array(
    "title"=>$row['title'],
    "date" =>$row['date'],
    "meeting"=>$row['meeting_id'],
    "partecipante"=>0
    ); 
}

mysqli_close($conn);
echo json_encode($res);


?>