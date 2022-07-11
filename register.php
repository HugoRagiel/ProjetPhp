<?php 
session_start();
require_once("./pdo.php");

$name= $_POST["name"] ?? '';
$confirmPassword= $_POST['confirmPassword'] ?? '';
$password= $_POST["password"] ?? '';

$message=false;
$salt='XyZzy12\*\_';



if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
  if(!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])){
    $name= htmlentities($_POST['name']);
    $password= htmlentities($_POST['password']);
    $confirmPassword= htmlentities($_POST['confirmPassword']);
    $password = sha1($_POST['password']);
    
    echo "tout les champs on été remplis";
    $namedb =$pdo->prepare("SELECT * FROM users WHERE name=?");
    $namedb->execute(array($name));
    $nameExist=$namedb->rowCount();
    
    if($nameExist == 0){

        $insert=$pdo->prepare("INSERT INTO users(name,password) VALUES(?,?)");
        $insert->execute(array($name, $password));

} else{
        $error="Le nom existe deja";
    }
}else{
    $error = "veuillez remplir tous les champs";
  }
      if(isset($_POST['submit'])){
      if($password == $_POST['confirmPassword']) {
      $_SESSION['password'] = $password;{
      if($password == $_POST['confirmPassword']){
          header("Location: index.php");
          }
        }
    } else {
        $error= "Vous n'avez pas entrer le mots de passe identique veuillez réessayer";
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
    <title>Enregistrez-vous</title>
</head>
<body>


    <div class="container">
        <form method="POST" class="form">
          <h4>Enregistrez-vous</h4>
  <p style="color:red"><?php if(isset($error)){ echo $error;}  ?>  </p>
          <div class="form-row">
            <label for="name" class="block">nom d'utilisateur : </label>
            <input type="text" name="name" id="name" >
          </div>

          <div class="form-row">
            <label for="password" class="block">mot de passe : </label>
            <input type="password" name="password" id="password" >
          </div>

          <div class="form-row">
            <label for="confirmPassword" class="block">confirmez le mot passe : </label>
            <input type="password" name="confirmPassword" id="confirmPassword" >
          </div>

          <input type="submit" class="btn" value="s'enregistrer" >
          <a href="./index.php" class="btn">annuler</a>
         
        </form>
      </div>
</body>
</html>