<?php


include_once "database/db.php";

$id = $_POST["id"] ?? null;

if (!$id){
    header("Location: index.php");
}

$statement = $pdo->prepare("DELETE FROM courses WHERE id = :id");
$statement->bindValue(":id", $id); 
$statement->execute();

header("Location: index.php");

?>