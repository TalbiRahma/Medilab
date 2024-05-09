<?php

$host = 'localhost';
    $db = 'servicemedical';
    $user = 'root';
    $password = '';
    $port = '3306';
    //Chaine de connexion (connection String)
    $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

/*$host = 'localhost';
$db = 'servicemedical';
$user = 'root';
$password = '';
$port='3306';
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";*/





/*$servername = "localhost";
$DBuser ="root" ;
$DBpassword = "";

$DBname = "servicemedical";
$dsn = "mysql:host=$servername;dbname=$DBname;charset=UTF8";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$DBname", $DBuser, $DBpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }*/
?>