<?php

include('../../DB/database.php');
include("../../DB/function.php");
session_start();
if(isset($_SESSION['username']) and isset($_POST['id'])){
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $result = mysqli_query($conn, "delete from work_experience where work_experience_id='".$id."'") or die(mysqli_error($conn));
    mysqli_close($conn);
}
else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
?>

