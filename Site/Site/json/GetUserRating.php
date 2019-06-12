<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

// MEETINGS 2

if( !isset($_SESSION['username']) or !isset($_POST['id'])){
  header("Location: ../../error.html");
  exit();
}  

$userid=getUserId($_SESSION['username']);
$rated_user=mysqli_real_escape_string($conn,$_POST['id']); // id dell'utente
$meeting=mysqli_real_escape_string($conn,$_POST['meeting']);
$res=array();

// il join lo faccio con users tanto sulla card id non mi importa alcun dato. E la foto devo necessariamente prenderla dalla tabella users
$result=mysqli_query($conn,"select U.note,U.professionality,U.availability,U.impression,S.photo,S.name,S.surname from user_rating U join users S on U.rated_user=S.user_id where U.meeting_id=$meeting and U.rated_user=$rated_user and U.user_id=$userid;") or die ("Errore nella query");
$num=mysqli_num_rows($result);
if($num==0){
    $result2=mysqli_query($conn,"select name,surname,photo from users where user_id=$rated_user");
    if($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
    $res[]=array(
        "photo"=>$row2['photo'],
        "name"=>$row2['name'],
        "surname"=>$row2['surname'],
        );
    }
}
else if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array(
        "note" =>$row['note'],
        "professionality" =>$row['professionality'],
        "availability" =>$row['availability'],
        "impression"=>$row['impression'],
        "photo"=>$row['photo'],
        "name"=>$row['name'],
        "surname"=>$row['surname']
        );
}

mysqli_close($conn);
echo json_encode($res);


?>