<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");
if(isset($_SESSION['username']) and isset($_POST['id'])){
            $newrole=mysqli_real_escape_string($conn,$_POST['role']);
            $newyear=mysqli_real_escape_string($conn,$_POST['year']);
            $newplace=mysqli_real_escape_string($conn,$_POST['place']);
            $result=mysqli_query($conn,"select company_id from company where name='".$_POST['company']."' and place='".$newplace."';");
            if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $work_id=$_POST['id'];
                $error=0;
            // AGGIORNO CON UNA TRANSAZIONE
               
                mysqli_autocommit($conn,FALSE);
                $query="update work_experience set company_id=".$row['company_id']." where work_experience_id=$work_id;";
                if(!query($query)) $error++;
                
                
                 //Controllo che non sono vuote.. Se sono vuote rimango quelle di prima
                if(!empty($newrole)){
                $query="update work_experience set role='".$newrole."' where work_experience_id=$work_id;";
                if(!query($query)) $error++;
                }
                
                if(!empty($newyear)){
                $query="update work_experience set year='".$newyear."' where work_experience_id=$work_id;";
                if(!query($query)) $error++;
                }
                
            
            if($error){
                mysqli_rollback($conn);
                mysqli_close($conn);
                die("ERRORE");
            }
            else{
                mysqli_commit($conn);
                mysqli_close($conn);}
        }
    }
else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
?>