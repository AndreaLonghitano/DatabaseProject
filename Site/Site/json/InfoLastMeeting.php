<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

if( !isset($_SESSION['username'])){
  header("Location: ../../error.html");
  exit();
}       

$user_id=getUserId($_SESSION['username']);

$res=array();
$result=mysqli_query($conn,"select title,date(date),meeting_id from meeting where user_id=$user_id and (date(date)) >= all (select max(date(date)) from meeting where user_id=$user_id)");
if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $meeting=$row['meeting_id'];
    $result2=mysqli_query($conn,"select count(*) as partecipanti from partecipate where meeting_id=$meeting") or die("Errore");
    $num_rows=mysqli_num_rows($result2);
    
    // partecipanti
    if (!$num_rows) $partecipanti=0;
    else if($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
        $partecipanti=$row2['partecipanti'];
    }
    
    // in attesa
    $result3=mysqli_query($conn,"select count(*) as attesa from invite where meeting_id=$meeting and reply is null;");
    $num_rows=mysqli_num_rows($result3);
    if (!$num_rows) $attesa=0;
    else if($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
        $attesa=$row3['attesa'];
    }
    
    // rifiutati
    $result4=mysqli_query($conn,"select count(*) as rifiuti from invite where meeting_id=$meeting and reply=0;");
    $num_rows=mysqli_num_rows($result4);
    if (!$num_rows) $rifiuti=0;
    else if($row4=mysqli_fetch_array($result4,MYSQLI_ASSOC)){
        $rifiuti=$row4['rifiuti'];
    }
    
    $res[]=array(
    "title" =>$row['title'],
    "partecipanti" =>$partecipanti,
    "attesa" =>$attesa,
    "rifiuti" =>$rifiuti
    );
    
}

mysqli_close($conn);
echo json_encode($res);


?>