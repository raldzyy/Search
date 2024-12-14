<?php  
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "job";
$dsn = "mysql:host={$host};dbname={$dbname}";

$conn = new PDO("mysql:host=localhost;dbname=job", "root", "");
$pdo->exec("SET time_zone = '+08:00';");

?>