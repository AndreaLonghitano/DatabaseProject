<?php

$db_host="localhost";
$db_user="root";
$db_password="";
$db_database="MyCard";

$conn=mysqli_connect($db_host,$db_user,$db_password) or die("Errore nel stabilire la connessione con il database");
mysqli_select_db($conn,$db_database);
?>