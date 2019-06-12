<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");



if( !isset($_SESSION['username'])){
  header("Location: ../../error.html");
  exit();
}

$user_id=getUserID($_SESSION['username']);
$query="select * from education_experience where user_id=$user_id";
$result=mysqli_query($conn,$query);

$res=array();
$num_rows=mysqli_num_rows($result);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array(
        'title'=> $row['title'],
        'place' => $row['place'],
	     'year'=>$row['year'],
        'id'=>$row['education_experience_id']
    ); 
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







