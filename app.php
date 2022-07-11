<?php
session_start();
require_once("./pdo.php");
$success = $_SESSION["success"] ?? false;
$error = $_SESSION["error"] ?? false;

if(!isset($_SESSION["user"])){
  die("ACCÈS REFUSÉ");
}

if(isset($_POST['add'])) {
  if(isset($_POST['name']) && !empty($_POST['name'])) {
    $name = htmlentities($_POST['name']);
    $namedb = $pdo->prepare('INSERT INTO tasks(title, user_id) VALUES(:title, :id)');
    $namedb->execute(array(
      ":title" => $name,
      ":id" => $_SESSION["user_id"]
    ));
    header("Location: app.php");
    return;
}
}

$namedb = $pdo->prepare('SELECT * FROM tasks WHERE user_id = :id');
$namedb->execute(array(
  "id" => $_SESSION["user_id"]
));
$result = $namedb->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST["ajouter"])){
  if(!empty($_POST["task"])){
    $sql = (('INSERT INTO tasks (title, user_id, task_id) VALUES (:title, :user_id, :task_id)'));
    $insert = $pdo->prepare($sql);
    $insert->execute([
        ":title" => $_POST['task'],
        ":user_id" => $_SESSION['user_id'],
        ":task_id"=> $_SESSION['task_id']
        ]);
      $_SESSION["success"] = "tâche ajouté";
      header("Location: app.php");
      return;
  } else {
    $_SESSION["error"] = "champs sont requis";
    header("Location: app.php");
    return;
    }
  }

  if (isset($_POST["edit"])) {
    header("Location: edit.php");
    return;
  }

$stmt = $pdo->query("SELECT * FROM tasks");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <title>App</title>
</head>
<body>
  <div>
    <h1>Tâche à faire de<?= $_SESSION["user"]?> </h1>
    <form method="POST">
      <input type="text" name="name" id="name">
      <input type="submit" name="add" id="add" value="ajouter">
      <br>
      <br>
      <a href="./logout.php">se déconnecter</a>
<br>
<br>
    </form>
      <?php
  echo "<table border='1'>";
  foreach ($rows as $row) {
    $tasks = <<<EOL
      <tr>
        <td>{$row["title"]}</td>
        <td>
          <form method="POST">
          <input type="hidden" name="title" value="{$row["task_id"]}">
            <input type="submit" name="edit" value="Editer">
          </form>
        </td>
        <td>
          <form method="POST">
          <input type="hidden" name="title" value="{$row["task_id"]}">
            <input type="submit" name="delete" value="supprimer">
          </form>
        </td>
      </tr>
    EOL;
    echo $tasks;
  }
  echo "</table>";

  ?>
    </div>
</body>
</html>