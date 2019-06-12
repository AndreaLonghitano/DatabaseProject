<?php
include('../../DB/database.php');
include("../../DB/function.php");
session_start();
if(isset($_SESSION['username']) and isset($_POST['company'])){
        $company=mysqli_real_escape_string($conn,$_POST['company']);
        $company_id=getCompanyId($company,$_POST['place']);
        if($company_id==-1)die("Errore nella company_id");
        $role=mysqli_real_escape_string($conn,$_POST['role']);
        $place=mysqli_real_escape_string($conn,$_POST['place']);
        $year=mysqli_real_escape_string($conn,$_POST['year']);
        $user_id=getUserID($_SESSION['username']);
        if($user_id==-1) die("Errore user_id");
        if(query("insert into work_experience(company_id,user_id,role,year) values($company_id,$user_id,'".$role."',$year);")){
            $result1=mysqli_query($conn,"select work_experience_id from work_experience order by work_experience_id desc limit 1;") or die ("Errore");
            $res=array();
        if($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
            $res[]=array(
                'id'=> $row['work_experience_id']);
                mysqli_close($conn);
                echo json_encode($res);
          }
            
        }
        else {
             mysqli_close($conn);
                die("ERRORE");
        }
    }  

else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
?>