<?php
session_start();
include('../../DB/database.php');
if(!isset($_SESSION['meeting']) or !isset($_SESSION['invitato'])){
    header("Location:../../error.html");
    exit();
}

mysqli_query($conn,"update invite set reply=0 where meeting_id='".$_SESSION['meeting']."' and user_id='".$_SESSION['invitato']."';") or die("Errore");

unset($_SESSION['meeting']);
unset($_SESSION['invitato']);
mysqli_close($conn);
header("Location:../dashboard.php");

?>