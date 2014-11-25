<h1>Supprimer des personnes enregistrées</h1>

<?php
require_once("include/autoload.inc.php");

if (empty($_GET['user'])) {
    ?>
    <h1>Une erreur est survenue</h1>
    <p>Vous n'avez sélectionné aucun utilisateur à modifier.</p>
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
    	$personne = $personneManager->getPersonne($numero);
    	$etudiantManager = new EtudiantManager($pdo);
		$salarieManager = new SalarieManager($pdo);

    	if ($etudiantManager->isEtudiant($numero)) {
    		$personneManager->deletePers($numero, 1);
    	} else {
    		$personneManager->deletePers($numero, 2);
    	}
    }
}
