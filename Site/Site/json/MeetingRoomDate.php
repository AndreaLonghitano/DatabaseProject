<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");



if( !isset($_SESSION['username'])){
  header("Location: ../../error.html");
  exit();
}       

$user_id=getUserId($_SESSION['username']);
$query="select M.meeting_id,M.title,M.place,count(distinct P.user_id) as partecipanti from meeting M  left join partecipate P on M.meeting_id=P.meeting_id where M.user_id=$user_id and date(date)<current_date() group by M.meeting_id,M.title,M.place;";
$result=mysqli_query($conn,$query);

$res=array();
$num_rows=mysqli_num_rows($result);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array(
        "role" => 'C',
        'title'=> $row['title'],
        'partecipanti'=>$row['partecipanti'],
        'place' => $row['place'],
        'meeting_id'=>$row['meeting_id'],
    ); 
}
 
$query="select M.meeting_id,M.title,M.place,count(distinct P.user_id) as partecipanti 
from meeting M  left join partecipate P on M.meeting_id=P.meeting_id 
where M.meeting_id in(select P1.meeting_id from partecipate P1 where P1.user_id=$user_id) and date(date)<current_date() group by M.meeting_id,M.title,M.place;"; 

$result1=mysqli_query($conn,$query);
$num_rows=$num_rows+mysqli_num_rows($result);

while($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
    $res[]=array(
        "role" => 'P',
        'title'=> $row1['title'],
        'partecipanti'=>$row1['partecipanti'],
        'place' => $row1['place'],
        'meeting_id'=>$row1['meeting_id'],
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