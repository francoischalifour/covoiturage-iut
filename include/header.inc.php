<?php
session_start();
require_once("include/functions.inc.php");
$title = "Covoit'IUT";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/material.css">
        <link rel="stylesheet" type="text/css" href="css/ripples.min.css">
        <link rel="stylesheet" type="text/css" href="css/datetimepicker.css">
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
        <link rel="icon" href="image/logo.png" />
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand" title="Aller à l'accueil">
                        <img src="image/logo.png" alt="Logo" height="50" class="pull-left">
                        <span><?php echo $title ?></span>
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (!isConnected()) {
                    ?>
                    <li><a href="index.php?page=11" class="btn btn-link">Connexion</a></li>
                    <?php
                    } else {
                    ?>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle btn btn-link" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['user_login'] ?> <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?page=2&amp;user=<?php echo $_SESSION['user_num'] ?>">Voir mon profil</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?page=5">Ajouter un parcours</a></li>
                        <li><a href="index.php?page=7">Ajouter une ville</a></li>
                        <li><a href="index.php?page=9">Proposer un trajet</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?page=12">Déconnexion</a></li>
                      </ul>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
