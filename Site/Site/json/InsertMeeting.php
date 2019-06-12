<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");



if(!isset($_SESSION['username']) or !isset($_POST['cardIdSelected'])){ 
  header("Location: ../../error.html");
  exit();
}




$title=mysqli_real_escape_string($conn,$_POST['TitleMeeting']);
$date=mysqli_real_escape_string($conn,$_POST['DateMeeting']);
$place=mysqli_real_escape_string($conn,$_POST['PlaceMeeting']);
$card_id=mysqli_real_escape_string($conn,$_POST['cardIdSelected']);
$lat=mysqli_real_escape_string($conn,$_POST['lat']);
$lng=mysqli_real_escape_string($conn,$_POST['lng']);
$user_id=getUserId($_SESSION['username']);

//EMAIL
$namecreatore=getName($user_id);
echo $namecreatore;
$surnamecreatore=getSurname($user_id);
echo $surnamecreatore;
$subject = 'Invite to Meeting';
$headers = "From: " . "andrealonglg96@gmail.com". "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


mysqli_autocommit($conn,FALSE);
$error=0;

$query="insert into meeting(user_id,title,date,place,card_id,lat,lng) values('".$user_id."','".$title."','".$date."','".$place."','".$card_id."','".$lat."','".$lng."');";
$result=mysqli_query($conn,$query) or die ("ERRORE QUIII");
if(!$result)$error++;
$query="select meeting_id from meeting where user_id=$user_id order by meeting_id desc limit 1;";
$result2=mysqli_query($conn,$query) or die ("DQAHHAHAHHA");
if(!$result2)$error++;

elseif($row=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
    $meeting=$row['meeting_id'];
    for($i=0;$i<count($_POST['invito']);$i++){
    //$invitato=   ; // prendere da $_POST['valore];
    $invitato=$_POST['invito'][$i];
    // non mettere qui perche ancora devo invitare
        
        
    $query="insert into invite(user_id,meeting_id) values('".$invitato."','".$meeting."');";
    $result=mysqli_query($conn,$query);
    if(!$result)$error++;
    // fine for
    }
}

if($error){
    mysqli_rollback($conn);
    mysqli_close($conn);
    echo "Si è verificato un errore durante l'inserimento in tabella";
}
else{
    mysqli_commit($conn);
    SendInvite($meeting,$title,$place,$date,$_POST['invito'],$user_id);
    mysqli_close($conn);
    header("Location:../Meetings.php");
}


?>