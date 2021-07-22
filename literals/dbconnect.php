<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "icoder";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
    //echo "Connection was successful";
}

?>