<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'admin');
   define('DB_PASSWORD', '20277evs');
   define('DB_DATABASE', 'beal');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}	//echo $db
?>

