<?php
include('../../DB/database.php');
include("../../DB/function.php");
session_start();
if(isset($_SESSION['username']) and isset($_POST['title'])){
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $place=mysqli_real_escape_string($conn,$_POST['place']);
        $year=mysqli_real_escape_string($conn,$_POST['year']);
        $user_id=getUserID($_SESSION['username']);
        if($user_id==-1) die("Errore user_id");
        $result=mysqli_query($conn,"insert into education_experience(title,year,place,user_id) values('".$title."',$year,'".$place."',$user_id);") or die ("Errore");
        $result1=mysqli_query($conn,"select education_experience_id from education_experience order by education_experience_id desc limit 1;") or die ("Errore");
        $res=array();
        if($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
            $res[]=array(
                'id'=> $row['education_experience_id']);
            mysqli_close($conn);
            echo json_encode($res);
        }
        else {
            mysqli_close($conn);
            die ("Errore");
        }
    }
else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
?>