<?php

function databaseConnect()
{
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'hillel_db';

    $conn = mysqli_connect($host, $user, $password, $dbname);
    if ($conn === false) {
        die("FAIL TO CONNECT");
    }
    return $conn;
}

function databaseConnectPDO()
{
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'hillel_db';

    try {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $conn = new PDO($dsn, $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("FAIL TO CONNECT: " . $e->getMessage());
    }
}