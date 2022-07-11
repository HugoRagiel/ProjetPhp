<?php
session_start();  
require_once("./pdo.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
    <div class="accueil">
    <h1>Bienvenue dans la base de donées des tâches</h1>
    <?php
     if(isset($_SESSION["success"])) {
        echo "<p><a href='./index.php'>utilisateur créer</a> </p>";
    }

  ?>
    <p><a href="./register.php">Enregistrer vous</a> / <a href="./login.php">connecter-vous</a></p>
    
    <p> Essayer d'<a href="./app.php">ajouter des données</a> sans vous connecter.
</p>

</div>
</body>
</html>