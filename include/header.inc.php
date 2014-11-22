<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <?php $title = "Covoiturage de l'IUT, partagez plus que votre véhicule !"; ?>
        <title><?php echo $title ?></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/material.css" />
        <link rel="stylesheet" type="text/css" href="css/ripples.min.css" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
        <link rel="icon" href="image/logo.png" />
    </head>
    <body>
        <div class="navbar">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand" title="Aller à l'accueil">
                        <img src="image/logo.png" alt="Logo" height="50" class="pull-left">
                        <span>Covoiturage de l'IUT</span>
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php?page=11" class="btn btn-link">Connexion</a>
                    </li>
                </ul>
            </div>
        </div>