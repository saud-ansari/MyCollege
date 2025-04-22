<?php
define('BASE_URL', 'http://localhost/MyCollege/');

$servername="localhost";
$username="root";
$password="";
$dbname="MyCollege";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
}

?>