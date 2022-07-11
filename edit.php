<?php
session_start();

require_once("./pdo.php");

if (!isset($_SESSION["user_id"])) {
    die("utilisateur non authentifié");
}


$sql = "SELECT * FROM tasks WHERE task_id = :task_id";
$query = $pdo->prepare($sql);
$query->execute([
    ":task_id" => $_SESSION["task_id"]
]);
$result = $query->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["save"])) {
    echo "save ";

    
    $task_id = $_SESSION["task_id"];
    $title = $_POST["title"];

    $updateQuery = "UPDATE tasks SET title = :title WHERE task_id = :task_id";
    
    $query = $pdo->prepare($updateQuery);

    
    $query->execute([
        ":task_id" => $task_id,
        ":title" => $title
    ]);
    $_SESSION["success"] = "Tache modifiée avec succes";
    header("Location: app.php");
    return;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./style.css">
  <title>Editer</title>
</head>
<body>
    <div class="container">
        <h3>Editer une Tâche</h3>
        <?php
        if (isset($_SESSION["error"])) {
            echo "<small style='color: red'>{$_SESSION["error"]}</small>";
            unset($_SESSION["error"]);
        }
        ?>
        <form method="POST">
            <input type="text" name="title" value="<?= $result["title"] ?>">
            <button class="btn btn-outline-secondary btn-sm" type="submit" name="save">Enregistrer</button>

            <a href="./app.php">Annuler</a>
        </form>

    </div>

