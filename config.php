<?php

$HOSTNAME = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE = "Library";

$conn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if($conn){
    // echo "Connection Successful";
}else{
    die("Connection Error". mysqli_connect_error());
}

?>