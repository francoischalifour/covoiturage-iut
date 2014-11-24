<?php
require_once("include/autoload.inc.php");

if (empty($_POST['per_nom']) && empty($_POST['dep_num']) && empty($_POST['fon_num'])) {
?>
    <h1>Ajouter une personne</h1>

    <form action="#" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-lg-2">
                        <label for="per_prenom">Prénom</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Prénom de la personne" class="form-control" name="per_prenom" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-2">
                        <label for="per_nom">Nom</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Nom de la personne" class="form-control" name="per_nom" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-2">
                        <label for="per_tel">Téléphone</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Téléphone de la personne" class="form-control" name="per_tel" pattern="^(\+[0-9]{1,3})?[0-9]{4,15}$" title="Le numéro doit être de la forme +330123456789 ou 0123456789" required="required">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="per_mail">Adresse e-mail</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="email" placeholder="Mail de la personne" class="form-control" name="per_mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="per_login">Login</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" placeholder="Login de la personne" class="form-control" name="per_login" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="per_pwd">Mot de passe</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="password" placeholder="Mot de passe de la personne" class="form-control" name="per_pwd" required="required">
                    </div>
                </div>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-1">
                <label for="per_cat">Catégorie</label>
            </div>
            <div class="col-lg-11">
                <ul class="list-unstyled">
                    <li>
                        <label for="1"><input type="radio" name="per_cat" id="1" value="1" checked="checked"> Etudiant</label>
                    </li>
                    <li>
                        <label for="2"><input type="radio" name="per_cat" id="2" value="2"> Personnel</label>
                    </li>
                </ul>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>
    <?php
} else if(!empty($_POST["per_nom"])) {
    $_SESSION['per_nom'] = $_POST['per_nom'];
    $_SESSION['per_prenom'] = $_POST['per_prenom'];
    $_SESSION['per_tel'] = $_POST['per_tel'];
    $_SESSION['per_mail'] = $_POST['per_mail'];
    $_SESSION['per_login'] = $_POST['per_login'];
    $_SESSION['per_pwd'] = $_POST['per_pwd'];
    $_SESSION['per_cat'] = $_POST['per_cat'];

    if ($_SESSION['per_cat'] == "1") {
    ?>
        <h1>Ajouter un étudiant</h1>
        <div class="row col-md-8 col-md-offset-2">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="div_num">Année :</label>
                    <select name="div_num" id="div_num" class="form-control" required="required">
                        <option value="1">Année 1</option>
                        <option value="2">Année 2</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dep_num">Département :</label>
                    <select name="dep_num" id="dep_num" class="form-control" required="required">
                        <?php
                            $pdo = new Mypdo();
                            $departementManager = new DepartementManager($pdo);
                            $departements = $departementManager->getAllDepartement();

                            foreach ($departements as $departement) {
                                ?>
                                <option value="<?php echo $departement->getDepNum() ?>"><?php echo $departement->getDepNom() ?></option>
                                <?php
                            }
                         ?>
                    </select>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    <?php
    }  else if ($_SESSION['per_cat'] == "2") {
    ?>
    <h1>Ajouter un salarié</h1>
    <div class="row col-md-8 col-md-offset-2">
        <form action="#" method="post">
            <div class="form-group">
                <label for="sal_telprof">Téléphone professionnel :</label>
                <input type="text" placeholder="Téléphone professionnel de la personne" class="form-control" name="sal_telprof" pattern="^(\+[0-9]{1,3})?[0-9]{4,15}$" title="Le numéro doit être de la forme +330123456789 ou 0123456789" required="required">
            </div>

            <div class="form-group">
                <label for="fon_num">Fonction :</label>
                <select name="fon_num" id="fon_num" class="form-control" required="required">
                    <?php
                        $pdo = new Mypdo();
                        $fonctionManager = new FonctionManager($pdo);
                        $fonctions = $fonctionManager->getAllFonction();

                        foreach ($fonctions as $fonction) {
                            ?>
                            <option value="<?php echo $fonction->getFonNum() ?>"><?php echo $fonction->getFonLibelle() ?></option>
                            <?php
                        }
                     ?>
                </select>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
    <?php
    }
} else {
    $db = new Mypdo();

    // Ajout de la personne
    $personneManager = new PersonneManager($db);
    $personne = new Personne (
        array(
            'per_nom' => $_SESSION['per_nom'],
            'per_prenom' => $_SESSION['per_prenom'],
            'per_tel' => $_SESSION['per_tel'],
            'per_mail' => $_SESSION['per_mail'],
            'per_login' => $_SESSION['per_login'],
            'per_pwd' => $_SESSION['per_pwd'],
            )
        );
    $numPersonne = $personneManager->add($personne);

    if (!empty($_POST['sal_telprof'])) {
        // Ajout du salarié
        $salarieManager = new SalarieManager($db);

        $salarie = new Salarie (
            array(
                'per_num' => $db->lastInsertId(),
                'sal_telprof' => $_POST['sal_telprof'],
                'fon_num' => $_POST['fon_num'],
                )
            );
        $salarieManager->add($salarie);
    } else if (!empty($_POST['dep_num'])) {
        // Ajout de l'étudiant
        $etudiantManager = new EtudiantManager($db);

        $etudiant = new Etudiant (
            array(
                'per_num' => $db->lastInsertId(),
                'dep_num' => $_POST['dep_num'],
                'div_num' => $_POST['div_num'],
                )
            );
        $etudiantManager->add($etudiant);
    }
    ?>
    <div class="row col-md-8 col-md-offset-2">
        <p class="alert alert-success">La personne <strong><?php echo $_SESSION['per_prenom'] ?> <?php echo $_SESSION['per_nom'] ?></strong> a bien été ajoutée</p>
        <p class="text-center">
            <a href="index.php?page=2" class="btn btn-primary">Revenir à la liste des personnes</a>
            <a href="index.php?page=2&user=<?php echo $numPersonne ?>" class="btn btn-default">Voir le profil de la nouvelle personne</a>
        </p>
    </div>
    <?php
    session_destroy();
}