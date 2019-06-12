<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

// MEETINGS 2

if( !isset($_SESSION['username']) or !isset($_POST['id'])){
  header("Location: ../../error.html");
  exit();
}  

$idmeeting=$_POST['id'];
$result=mysqli_query($conn,"select U.name,U.surname,I.reply from invite I join users U on I.user_id=U.user_id where I.meeting_id=$idmeeting;");
$num_rows=mysqli_num_rows($result);
$res=array();
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $user=$row['name']. " ".$row['surname'];
    if(is_null($row['reply']))$risposta="DA ACCETTARE";
    else if($row['reply']==1)$risposta="YES";
    else if($row['reply']==0)$risposta="NO";    
    $res[]=array(
        "utente" =>$user,
        "invito" =>$risposta,
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
