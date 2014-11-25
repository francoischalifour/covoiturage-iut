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
    ?>
        <form action="#" method="post">
        <?php
        $personne = $personneManager->getPersonne($numero);

        $etudiantManager = new EtudiantManager($pdo);

        $salarieManager = new SalarieManager($pdo);

        if (!$_POST) {

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
                    <td><input type="text" placeholder="Téléphone de la personne" value="<?php echo $personne->getPerTel() ?>" class="form-control" name="per_tel" pattern="[0-9]{10}" title="Le numéro doit être de la forme 0123456789" required="required">
                    <td>
                        <select name="dep_num" id="dep_num" class="form-control" required="required">
                            <?php
                                $pdo = new Mypdo();
                                $departementManager = new DepartementManager($pdo);
                                $departements = $departementManager->getAllDepartement();

                                foreach ($departements as $departement) {
                                    ?>
                                    <option value="<?php echo $departement->getDepNum() ?>" <?php if ($departement->getDepNum() == $etudiant->getDivNum()) echo 'required="required"' ?>><?php echo $departement->getDepNom() ?></option>
                                    <?php
                                }
                             ?>
                        </select>
                    </td>
                    <td>
                        <select name="div_num" id="div_num" class="form-control" required="required">
                            <option value="1" <?php if ($etudiant->getDivNum() == 1) echo 'selected=selected"' ?>>Année 1</option>
                            <option value="2" <?php if ($etudiant->getDivNum() == 2) echo 'selected=selected"' ?>>Année 2</option>
                        </select>
                    </td>
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
                    <td><input type="text" placeholder="Prénom de la personne" value="<?php echo $personne->getPerPrenom() ?>" class="form-control" name="per_prenom" required="required"></td>
                    <td><input type="text" placeholder="Nom de la personne" value="<?php echo $personne->getPerNom() ?>" class="form-control" name="per_nom" required="required"></td>
                    <td><input type="email" placeholder="Mail de la personne" value="<?php echo $personne->getPerMail() ?>" class="form-control" name="per_mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="required"></td>
                    <td><input type="text" placeholder="Téléphone de la personne" value="<?php echo $personne->getPerTel() ?>" class="form-control" name="per_tel" pattern="[0-9]{10}" title="Le numéro doit être de la forme 0123456789" required="required">
                    <td><input type="text" placeholder="Téléphone professionnel de la personne" value="<?php echo $salarie->getSalTelProf() ?>" class="form-control" name="sal_telprof" pattern="[0-9]{10}" title="Le numéro doit être de la forme 0123456789" required="required"></td>
                    <td>
                        <select name="fon_num" id="fon_num" class="form-control" required="required">
                            <?php
                                $fonctionManager = new FonctionManager($pdo);
                                $fonctions = $fonctionManager->getAllFonction();

                                foreach ($fonctions as $fonction) {
                                    ?>
                                    <option value="<?php echo $fonction->getFonNum() ?>" <?php if ($fonction->getFonNum() == $salarie->getFonNum()) echo 'selected="selected"' ?>><?php echo $fonction->getFonLibelle() ?></option>
                                    <?php
                                }
                             ?>
                        </select>
                    </td>
                </tr>
            </table>
            <?php
            }
            ?>
            <div class="text-center">
                <button type="submit" href="index.php?page=3&user=<?php echo $personne->getPerNum() ?>" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
        <?php
        } else {
            ?>
            <h1>Modification d'une personne</h1>
            <?php
            if ($etudiantManager->isEtudiant($numero)) {

            } else {

            }
            ?>
            <p class="alert alert-success">La personne a bien été modifiée.</p>
            <?php
        }
    }
}
