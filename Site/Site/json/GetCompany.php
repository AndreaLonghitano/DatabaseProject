<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");

 $res=array();


if(isset($_SESSION['username']) and isset($_POST['mode'])){
     $user_id=getUserId($_SESSION['username']);     
    if($_POST['mode']==0) $result=mysqli_query($conn,"select distinct name from company;") or die ("Errore");
    else $result=mysqli_query($conn,"select distinct C.name from work_experience W join company C  on W.company_id=C.company_id where W.user_id=$user_id;");
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $res[]=array(
            "nome"=>$row['name']);
    }
    mysqli_close($conn);
    echo json_encode($res);
}
else{
    mysqli_close($conn);
    header("Location:../../error.html");
}

?>