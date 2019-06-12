<?php
session_start();
include('../../DB/database.php');
if(!isset($_SESSION['meeting']) or !isset($_SESSION['invitato']) or !isset($_GET['card'])){
    header("Location:../../error.html");
    exit();
}

echo
mysqli_query($conn,"insert into partecipate values('".$_SESSION['invitato']."','".$_SESSION['meeting']."','".$_GET['card']."');") or die("Errore");

unset($_SESSION['meeting']);
unset($_SESSION['invitato']);
mysqli_close($conn);
header("Location:../dashboard.php");

?>