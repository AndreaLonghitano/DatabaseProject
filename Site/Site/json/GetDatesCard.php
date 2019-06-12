<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");


if( !isset($_SESSION['username']) or !isset($_GET['id'])){
    mysqli_close($conn);
  header("Location: ../../error.html");
  exit();
}       
$id=mysqli_real_escape_string($conn,$_GET['id']);
$result=mysqli_query($conn,"select title,phone,email,photo from cards where card_id=$id;") or die("ERRORE");
$res=array();
if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res[]=array("title" =>$row['title'],
                 "tel"=>$row['phone'],
                 "email" =>$row['email'],
                 "photo"=>$row['photo'],
                );
    mysqli_close($conn);
    echo json_encode($res);
}