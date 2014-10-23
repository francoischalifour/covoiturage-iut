<?php
require_once("include/autoload.inc.php");

$pdo = new MyPdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->getAllVille();
?>

<h1>Liste des villes</h1>