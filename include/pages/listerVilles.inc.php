<?php
require_once("include/autoload.inc.php");

$pdo = new MyPdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->getAllVille();
?>

<h1>Liste des villes</h1>

<table>
    <tr>
        <th>Numéro</th>
        <th>Nom</th>
    </tr>
    <?php
    foreach ($villes as $ville) {
    ?>
    <tr>
        <td><?php echo $ville->getVilNum() ?></td>
        <td><?php echo $ville->getVilNom() ?></td>
    </tr>
    <?php
    }
    ?>
</table>