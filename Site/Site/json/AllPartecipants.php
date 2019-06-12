<?php

session_start();
include('../../DB/database.php');
include("../../DB/function.php");

if(!isset($_SESSION['username'])){
  header("Location: ../../error.html");
  exit();
}

/* Seleziono l'ultima esperienza */

$userid=getUserId($_SESSION['username']);

$query="select W.work_experience_id,user_id,year from work_experience W where year >=all(select max(WW.year) from work_experience WW where W.user_id=WW.user_id) and user_id<>$userid;";
$result=mysqli_query($conn,$query);

$res=array();
$num_rows=mysqli_num_rows($result);

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $userid=$row['user_id'];
    $work_experience=$row['work_experience_id'];
    $name=getName($userid);
    $surname=getSurname($userid);
    $utente=$name." ".$surname;
    $query2="select role,company_id from work_experience where work_experience_id=$work_experience;";
    $result2=mysqli_query($conn,$query2);
    if($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
        $role=$row2['role'];
        $companyid=$row2['company_id'];
        $query3="select name from company where company_id=$companyid";
        $result3=mysqli_query($conn,$query3);
        if($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
            $companyname=$row3['name'];
            $res[]=array(
                "utente" =>$utente,
                "company" =>$companyname,
                "role" =>$role,
                "id" =>$userid,
                );
        }
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