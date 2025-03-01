<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "icstitde_mis";

 
 $conn_PDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
 
 error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


 ?>