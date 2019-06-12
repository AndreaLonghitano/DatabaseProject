<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");
// vedi MEETING.php


if( !isset($_SESSION['username'])){
  header("Location: ../../error.html");
  exit();
}       

$user_id=getUserId($_SESSION['username']);
$query="select M.meeting_id,M.title,M.place,count(distinct P.user_id) as invitati from meeting M left join invite P on M.meeting_id=P.meeting_id where M.user_id=$user_id group by M.meeting_id,M.title,M.place;";
$result=mysqli_query($conn,$query) or die("ERRORE QUIII");

$res=array();
$num_rows=mysqli_num_rows($result);

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array(
        "role" => 'C',
        'title'=> $row['title'],
        'invitati' => $row['invitati'],
	    'place'=>$row['place'],
        'id'=>$row['meeting_id'],
    ); 
}

$query2="select P.meeting_id,M.title,M.place,count(distinct P.user_id) as invitati from partecipate P join Meeting M on P.meeting_id=M.meeting_id join invite I on M.meeting_id=I.meeting_id where P.user_id=$user_id group by M.meeting_id,M.title,M.place;";

$result2=mysqli_query($conn,$query2) or die("ERRORE QUIII");

$num_rows+=mysqli_num_rows($result2);

while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
    $res[]=array(
        "role" => 'P',
        'title'=> $row2['title'],
        'invitati' => $row2['invitati'],
	    'place'=>$row2['place'],
        'id'=>$row2['meeting_id'],
    ); 
}
 

$json_data=array(
        "draw"            => 1,
        "recordsTotal"    => $num_rows,
        "recordsFiltered" => $num_rows,
        "data"            => $res,
            );
$json = json_encode($json_data);
echo $json;
?>