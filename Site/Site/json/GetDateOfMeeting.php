<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");


if( !isset($_SESSION['username']) or !isset($_POST['id'])){
  header("Location: ../../error.html");
  exit();
}       

$idmeeting=$_POST['id'];
$result=mysqli_query($conn,"select date,lat,lng from meeting where meeting_id=$idmeeting;") or die("ERRORE");
$res=array();
if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array("date" =>$row['date'],
                 "lat"=>$row['lat'],
                 "lng" =>$row['lng'],
                );
    mysqli_close($conn);
    echo json_encode($res);
}