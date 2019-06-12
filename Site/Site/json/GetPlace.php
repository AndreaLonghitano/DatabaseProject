<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

if(isset($_SESSION['username']) and isset($_POST['company'])){
    $company= mysqli_real_escape_string($conn, $_POST["company"]);
    $array=array();
    $result = mysqli_query($conn, "select place from company where name='".$company."';") or die(mysqli_error($conn));
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $array[]=array(
            'place'=> $row['place'],
        );
    }
    echo json_encode($array);
}
else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
?>