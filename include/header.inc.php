<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <?php $title = "Bienvenue sur le site de covoiturage de l'IUT."; ?>
        <title><?php echo $title ?></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/material.css" />
        <link rel="stylesheet" type="text/css" href="css/ripples.min.css" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
    </head>
    <body>
        <div class="navbar">
            <div class="container">
                <!-- <div class="navbar-brand">
                    <a href="index.php?page=0">
                        <img src="image/logo.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" />
                    </a>
                </div> -->
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand">
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