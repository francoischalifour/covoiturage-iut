<?php
require_once("include/autoload.inc.php");

$pdo = new MyPdo();
$parcoursManager = new ParcoursManager($pdo);
$VilleManager = new VilleManager($pdo);
$parcours = $parcoursManager->getAllParcours();
?>

<h1>Liste des parcours proposés</h1>

<table class="table sortable">
    <tr>
        <th class="pointer">Numéro</th>
        <th class="pointer">Ville de départ</th>
        <th class="pointer">Ville d'arrivée</th>
        <th class="pointer">Nombre de kilomètres</th>
    </tr>
    <?php
    foreach ($parcours as $par) {
    ?>
    <tr>
        <td><?php echo $par->getParNum() ?></td>
        <td><?php echo $VilleManager->getVilNom($par->getVilNum1()) ?></td>
        <td><?php echo $VilleManager->getVilNom($par->getVilNum2()) ?></td>
        <td><?php echo $par->getParKm() ?></td>
    </tr>
    <?php
    }
    ?>
</table>