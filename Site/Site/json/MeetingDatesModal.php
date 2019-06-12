<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");



if( !isset($_SESSION['username']) and !isset($_POST['id'])){
  header("Location: ../../error.html");
  exit();
}       

$meetingid=$_POST['id'];
$res=array();

$result=mysqli_query($conn,"select title,date,place from meeting where meeting_id=$meetingid");
if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array(
        "title"=>$row['title'],
        "date"=>$row['date'],
        "place"=>$row['place'],
    );
}

echo json_encode($res);
?>