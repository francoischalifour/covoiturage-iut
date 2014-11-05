<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <?php
        $title = "Bienvenue sur le site de covoiturage de l'IUT.";?>
        <title>
        <?php echo $title ?>
        </title>
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
    </head>
    <body>
        <div id="header">
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
            <div id="connect">
                <a href="index.php?page=11">Connexion</a>
            </div>
        </div>