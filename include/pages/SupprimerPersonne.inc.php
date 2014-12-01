<?php
require_once("include/autoload.inc.php");

if (empty($_GET['user'])) {
    ?>
    <h1>Une erreur est survenue</h1>
    <p>Vous n'avez sélectionné aucun utilisateur à supprimer.</p>
    <?php
} else {
    $pdo = new MyPdo();
    $personneManager = new PersonneManager($pdo);
    $personnes = $personneManager->getAllPersonne();

    $numero = $_GET['user'];

    if (!$personneManager->isPersonne($numero)) {
    ?>
        <h1>Utilisateur inexistant</h1>
        <p>L'utilisateur que vous recherchez n'existe pas.</p>
    <?php
    } else {
        if (isConnected()) {
            // On affiche les informations de modification s'il s'agit de l'utilisateur connecté
            if ($numero == $_SESSION['user_num']) {
                $personne = $personneManager->getPersonne($numero);
                $etudiantManager = new EtudiantManager($pdo);
                ?>
                <h1>Suppression d'une personne</h1>
                <p class="alert alert-success">La personne <strong><?php echo $personne->getPerPrenom() . ' ' . $personne->getPerNom() ?></strong> a bien été supprimée.</p>
                <?php
                if ($etudiantManager->isEtudiant($numero)) {
                	$personneManager->deletePers($numero, 1);
                } else {
                	$personneManager->deletePers($numero, 2);
                }

                header('Location: index.php?page=12');
            } else {
                ?>
            <h1>Autorisation nécessaire</h1>
            <p>Vous ne pouvez pas supprimer cette personne.</p>
                <?php
            }
        }
    }
}
