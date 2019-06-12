<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

// MEETINGS 2

if( !isset($_SESSION['username']) or !isset($_POST['id'])){
  header("Location: ../../error.html");
  exit();
}  

$id=mysqli_real_escape_string($conn,$_POST['id']);
$userid=getUserId($_SESSION['username']);
$res=array();
$result=mysqli_query($conn,"select P.user_id,C.title,C.name,C.surname,C.email,C.photo,O.name as companyname,W.role from partecipate P join cards C on P.card_id=C.card_id join work_experience W on C.work_experience_id=W.work_experience_id join company O on W.company_id=O.company_id where meeting_id=$id and P.user_id<>$userid;");

while($row=mysqli_fetch_array($result)){
 $res[]=array(
        "user_id" =>$row['user_id'],
        "title" =>$row['title'],
        "name" =>$row['name'],
        "surname" =>$row['surname'],
        "email" =>$row['email'],
        "photo" =>$row['photo'],
        "companyname" =>$row['companyname'],
        "role" =>$row['role'],
        );  
}

mysqli_close($conn);
echo json_encode($res);
?>
