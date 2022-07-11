<?php
session_start();
require_once("./pdo.php");
$salt='XyZzy12\*\_';

if(isset($_POST['register'])) {
    if(!empty($_POST['name']) && !empty($_POST['password'])) { 
      $name= htmlentities($_POST['name']);
      $password= htmlentities($_POST['password']);
      $password = sha1($_POST['password']);
      
      $namedb = $pdo->query('SELECT * FROM users WHERE name="' . $name . '" AND password = "' . $password . '"');
      $namedb->execute(array($name));
      $result = $namedb->fetch();
      $userExist=$namedb->rowCount();

      if ($userExist == 1) {
        $_SESSION["user"] = $name;
        $_SESSION["user_id"] = $result["user_id"];
        header("Location: ./app.php");
      } else {
        echo "Identifiants incorrects";
        echo $name;
    } 
    } 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./normalize.css">
    <link rel="stylesheet" href="./style.css">
    <title>Se connecter</title>
</head>
<body>
    <div class="container">
        <form method="POST" class="form">
        <h4> connectez-vous</h4>

        <div class="form-row">
        <label for="name" class="block">nom d'utilisateur : </label>
        <input type="text" name="name" id="name" >
        </div>


         <div class="form-row">
        <label for="password" class="block">mot de passe : </label>
        <input type="password" name="password" id="password" >
        </div>

           

        <input type="submit" name="register" class="btn" value="Se connecter"> 
        <a href="./index.php"  class="btn"> annuler </a>