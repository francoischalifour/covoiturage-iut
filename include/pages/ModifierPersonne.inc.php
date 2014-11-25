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
            <td><input type="text" placeholder="Prénom de la personne" value="<?php echo $personne->getPerPrenom() ?>" class="form-control" name="per_prenom" required="required"></td>
                <td><input type="text" placeholder="Nom de la personne" value="<?php echo $personne->getPerNom() ?>" class="form-control" name="per_nom" required="required"></td>
                <td><input type="email" placeholder="Mail de la personne" value="<?php echo $personne->getPerMail() ?>" class="form-control" name="per_mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="required"></td>
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
        ?>
        <p class="text-center">
            <a href="index.php?page=3&user=<?php echo $personne->getPerNum() ?>" class="btn btn-primary">Enregistrer</a>
        </p>
        <?php
    }
}
