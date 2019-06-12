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
$res=array();

$result=mysqli_query($conn,"select note,useful,importance from wallet where meeting_id=$meeting and user_id=$userid");
if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array("note" =>$row['note'],
                 "useful" =>$row['useful'],
                 "importance" =>$row['importance'],
                );
}
mysqli_close($conn);
echo json_encode($res);

?>