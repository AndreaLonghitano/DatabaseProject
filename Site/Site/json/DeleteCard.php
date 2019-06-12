<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

if(isset($_SESSION['username']) and isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    $result = mysqli_query($conn, "delete from cards where card_id='".$id."'") or die(mysqli_error($conn));
    mysqli_close($conn);
    header("Location:../BusinessCard.php");
}
else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
?>