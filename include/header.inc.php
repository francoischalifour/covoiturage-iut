<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <?php $title = "Bienvenue sur le site de covoiturage de l'IUT."; ?>
        <title><?php echo $title ?></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
    </head>
    <body>
        <div class="header">
            <div id="entete">
                <div class="colonne">
                    <a href="index.php?page=0">
                        <img src="image/logo.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" />
                    </a>
                </div>
                <div class="colonne">
                    Covoiturage de l'IUT,<br />Partagez plus que votre véhicule !
                </div>
            </div>
            <div class="connect btn btn-default">
                <a href="index.php?page=11">Connexion</a>
            </div>
        </div>