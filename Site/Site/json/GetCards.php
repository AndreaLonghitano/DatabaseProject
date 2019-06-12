<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

// MEETINGS 2

if( !isset($_SESSION['username'])){
  header("Location: ../../error.html");
  exit();
}  

$user_id=getUserId($_SESSION['username']);
$result=mysqli_query($conn,"select card_id,title,work_experience_id from cards where user_id='".$user_id."';");
$num_rows=mysqli_num_rows($result);

// Per il momento visualizzo solo il titolo.. Poi aggiungero eventualemente altro lato client  quando aggiungero il carousel */
$res=array();
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){  
    $workexperience=$row['work_experience_id'];
    $result2=mysqli_query($conn,"select C.name,W.role from work_experience W join company C on W.company_id=C.company_id where W.work_experience_id=$workexperience;");
    if($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
    $res[]=array(
        "title" =>$row['title'],
        "company" =>$row2['name'],
        "role" =>$row2['role'],
        "card_id" =>$row['card_id'],
    );
    }
}

mysqli_close($conn);
$json_data=array(
        "draw"            => 1,
        "recordsTotal"    => $num_rows,
        "recordsFiltered" => $num_rows,
        "data"            => $res,
            );
$json = json_encode($json_data);
echo $json;

?>