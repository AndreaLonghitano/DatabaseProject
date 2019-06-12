<?php
session_start();
include('../../DB/database.php');
include("../../DB/function.php");
if(isset($_SESSION['username']) and isset($_POST['id'])){
            $title=mysqli_real_escape_string($conn,$_POST['title']);
            $tel=mysqli_real_escape_string($conn,$_POST['tel']);
            $email=mysqli_real_escape_string($conn,$_POST['email']);
            $card_id=$_POST['id'];
            $error=0;
            // AGGIORNO CON UNA TRANSAZIONE
               
                mysqli_autocommit($conn,FALSE);
                $query="update cards set title='".$title."' where card_id=$card_id;";
                if(!query($query)) $error++;
                
                
                $query="update cards set phone='".$tel."' where card_id=$card_id;";
                if(!query($query)) $error++;
                
                
                $query="update cards set email='".$email."' where card_id=$card_id;";
                if(!query($query))$error++;
            
            if($error){
                mysqli_rollback($conn);
                mysqli_close($conn);
                die("ERRORE");
            }
            else{
                mysqli_commit($conn);
                mysqli_close($conn);}
        }
else{
    mysqli_close($conn);
    header("Location:../../error.html");
}
?>