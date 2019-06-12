<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");
if(isset($_SESSION['username']) and isset($_POST['id'])){
            $newyear=mysqli_real_escape_string($conn,$_POST['year']);
            $newplace=mysqli_real_escape_string($conn,$_POST['place']);
            $edu_id=$_POST['id'];
            
    
            mysqli_autocommit($conn,FALSE);
            if(!empty($newyear)){
                $query="update education_experience set year='".$newyear."' where education_experience_id=$edu_id;";
                if(!query($query)) $error++;
            }
            if(!empty($newplace)){
                $query="update education_experience set place='".$newplace."' where education_experience_id=$edu_id;";
                if(!query($query))  $error++; 
                echo $error;
            }
            
            
            if($error){
                mysqli_rollback($conn);
                mysqli_close($conn);
                die("Errore");
            }
            else{
                mysqli_commit($conn);
                mysqli_close($conn);
            }
        }
else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
?>