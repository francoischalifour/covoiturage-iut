<?php
require_once("include/autoload.inc.php");

$pdo = new MyPdo();
$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllPersonne();

if (empty($_GET['user'])) {
?>
<h1>Liste des personnes</h1>
<?php
if ($personneManager->isEmpty()) {
    ?>
    <p>Aucune personne n'est actuellement enregistrée.</p>
    <?php
} else {
?>
<table class="table sortable">
    <tr>
        <th class="pointer">#</th>
        <th class="pointer">Prénom</th>
        <th class="pointer">Nom</th>
    </tr>
    <?php
    foreach ($personnes as $personne) {
    ?>
    <tr>
        <td><a href="<?php echo $_SERVER['REQUEST_URI'] ?>&amp;user=<?php echo $personne->getPerNum() ?>"><?php echo $personne->getPerNum() ?></a></td>
        <td><?php echo $personne->getPerPrenom() ?></td>
        <td><?php echo $personne->getPerNom() ?></td>
    </tr>
    <?php
    }
}
    ?>
</table>

<div class="text-center">
    <a href="index.php?page=1" class="btn btn-primary btn-flat">Ajouter une nouvelle personne</a>
</div>
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

        if (isConnected()) {
            // On affiche les informations de modification s'il s'agit de l'utilisateur connecté
            if ($numero == $_SESSION['user_num']) {
        ?>
        <div class="text-center">
            <a href="index.php?page=3&amp;user=<?php echo $personne->getPerNum() ?>" class="btn btn-primary btn-primary">Modifier</a>
            <button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#supprimerPersonne">Supprimer</button>
        </div>
        <?php
            }
        }
    }
}
?>

<div class="modal fade" id="supprimerPersonne" tabindex="-1" role="dialog" aria-labelledby="supprimerPersonne" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
        <h4 class="modal-title">Êtes-vous sûr de vouloir supprimer cette personne ?</h4>
      </div>
      <div class="modal-body">
        <p>Cette action entrainera la suppression de toutes les données relatives à cette personne.</p>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Non</button>
            <a href="index.php?page=4&amp;user=<?php echo $personne->getPerNum() ?>" class="btn btn-primary btn-flat">Oui</a>
      </div>
    </div>
  </div>
</div>