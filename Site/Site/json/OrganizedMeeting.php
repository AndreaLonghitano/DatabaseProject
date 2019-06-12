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
$result=mysqli_query($conn,"select month(date) as mese,count(*) as meeting from meeting where user_id=$user_id group by month(date);");
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array(
        $row['mese']=>$row['meeting'],
    );
}

mysqli_close($conn);
echo json_encode($res);


?>