<?php 
$host="localhost";
$user="root";
$password="";
$dbname="todo_app";

$dsn= "mysql:host=$host;dbname=$dbname";

try{
$pdo= new PDO($dsn, $user, $password,);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo " Exception message: " . 
    $e->getMessage();
}
?>


