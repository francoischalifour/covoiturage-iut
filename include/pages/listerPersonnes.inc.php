<?php
require_once("include/autoload.inc.php");

$pdo = new MyPdo();
$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllPersonne();
?>

<h1>Liste des personnes enregistrées</h1>

<table class="table">
    <tr>
        <th>Numéro</th>
        <th>Nom</th>
        <th>Prénom</th>
    </tr>
    <?php
    foreach ($personnes as $personne) {
    ?>
    <tr>
        <td><?php echo $personne->getPerNum() ?></td>
        <td><?php echo $personne->getPerNom() ?></td>
        <td><?php echo $personne->getPerPrenom() ?></td>
    </tr>
    <?php
    }
    ?>
</table>