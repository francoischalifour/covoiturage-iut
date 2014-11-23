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
            $etudiant = $etudiantManager->getEtudiant($numero);

            $departementManager = new DepartementManager($pdo);
            $departement = $departementManager->getAllDepartement();

            //$villeManager = new VilleManager($pdo);
            //$ville = $villeManager->getAllVille();

            $divisionManager = new DivisionManager($pdo);
            $division = $divisionManager->getAllDivision();
        ?>
        <h1>Détail sur l'étudiant <?php echo $personne->getPerPrenom() ?> <?php echo $personne->getPerNom() ?></h1>
        <table class="table">
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Adresse e-mail</th>
                <th>Téléphone</th>
                <th>Département</th>
                <th>Division</th>
            </tr>
            <tr>
                <td><?php echo $personne->getPerPrenom() ?></td>
                <td><?php echo $personne->getPerNom() ?></td>
                <td><?php echo $personne->getPerMail() ?></td>
                <td><?php echo $personne->getPerTel() ?></td>
                <td><?php echo $departementManager->getDepNom($etudiant->getDepNum())->dep_nom ?></td>
                <td><?php echo $divisionManager->getDivNom($etudiant->getDivNum())->div_nom ?></td>
            </tr>
        </table>
        <?php
        } else {
            $salarie = $salarieManager->getSalarie($numero);

            $fonctionManager = new FonctionManager($pdo);
            $fonction = $fonctionManager->getAllFonction();
        ?>
        <h1>Détail sur le salarié <?php echo $personne->getPerPrenom() ?> <?php echo $personne->getPerNom() ?></h1>
            <table class="table">
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Adresse e-mail</th>
                    <th>Téléphone</th>
                    <th>Téléphone Pro</th>
                    <th>Fonction</th>
                </tr>
                <tr>
                    <td><?php echo $personne->getPerPrenom() ?></td>
                    <td><?php echo $personne->getPerNom() ?></td>
                    <td><?php echo $personne->getPerMail() ?></td>
                    <td><?php echo $personne->getPerTel() ?></td>
                    <td><?php echo $salarie->getSalTelProf() ?></td>
                    <td><?php echo $fonctionManager->getFonNom($salarie->getFonNum())->fon_libelle ?></td>
                </tr>
            </table>
        <?php
        }
    }
}
?>