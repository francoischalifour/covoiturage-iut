<?php
require_once("include/autoload.inc.php");

$pdo = new MyPdo();
$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllPersonne();
?>

<?php
if (empty($_GET['user'])) {
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
        <td><a href="<?php echo $_SERVER['REQUEST_URI'] ?>&user=<?php echo $personne->getPerNum() ?>"><?php echo $personne->getPerNum() ?></a></td>
        <td><?php echo $personne->getPerNom() ?></td>
        <td><?php echo $personne->getPerPrenom() ?></td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
} else {
    $numero = $_GET['user'];
    echo $numero;
?>
<h1>Détail sur le salarié</h1>
<table class="table">
    <tr>
        <th>Prénom</th>
        <th>Mail</th>
        <th>Tel</th>
        <th>Département</th>
        <th>Ville</th>
    </tr>
    <tr>

    </tr>
</table>
<?php
}
?>