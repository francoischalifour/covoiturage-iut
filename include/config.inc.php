<?php
// Paramètres de l'application Covoiturage
// A modifier en fonction de la configuration

define('DBHOST', "localhost");
define('DBNAME', "iut_3");
define('DBUSER', "root");
define('DBPASSWD', "");
define('ENV','dev');
// pour un environememnt de production remplacer 'dev' (développement) par 'prod' (production)
// les messages d'erreur du SGBD s'affichent dans l'environememnt dev mais pas en prod
?>