<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");



if(!isset($_SESSION['username'])){
  header("Location: ../../error.html");
  exit();
}

$user_id=getUserID($_SESSION['username']);
if($_POST['mode']==2){
    $company=mysqli_real_escape_string($conn,$_POST['company']);
    $query="select * from work_experience where user_id=$user_id and company_id in (select company_id from company where name='".$company."');";
}
else $query="select * from work_experience where user_id=$user_id";

$result=mysqli_query($conn,$query);


$res=array();
$num_rows=mysqli_num_rows($result);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $result2=mysqli_query($conn,"select name,place from company where company_id='".$row['company_id']."';");
    if($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){  
    if($_POST['mode']==0){
    $res[]=array(
        'company'=> $row2['name'],
        'role' => $row['role'],
	    'year'=>$row['year'],
        'place'=>$row2['place'],
        'id'=>$row['work_experience_id']
    ); 
    }
    else{
        $res[]=array(
        'role' => $row['role'],
	    'year'=>$row['year'],
        'place'=>$row2['place'],
        'id'=>$row['work_experience_id']
    );     
    }
    }
}
        
$json_data=array(
        "draw"            => 1,
        "recordsTotal"    => $num_rows,
        "recordsFiltered" => $num_rows,
        "data"            => $res,
            );
mysqli_close($conn);
$json = json_encode($json_data);
echo $json;
?>