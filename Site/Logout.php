<?php
session_start();
if(isset($_SESSION['username'])){
    unset($_SESSION['session_var']);
    session_destroy();
    header("Location:login.php");
}

else header("Location:error.html");

?>