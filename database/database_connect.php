<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'hillel_db';

$conn = mysqli_connect($host, $user, $password, $dbname);
if($conn === false){
    die("FAIL TO CONNECT");
}