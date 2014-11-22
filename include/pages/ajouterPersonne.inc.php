<?php
require_once("include/autoload.inc.php");
session_destroy();
var_dump($_SESSION);

if (empty($_POST['per_nom']) && empty($_POST['per_dep']) && empty($_POST['per_fonction'])) {
    ?>
    <h1>Ajouter une personne</h1>

    <form action="#" method="post">
        <div class="row">
            <div class="col-md-6">
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
                        <label for="per_prenom">Prénom</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Prénom de la personne" class="form-control" name="per_prenom" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-2">
                        <label for="per_tel">Téléphone</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Téléphone de la personne" class="form-control" name="per_tel" required="required">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-lg-2">
                        <label for="per_mail">Adresse e-mail</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="email" placeholder="Mail de la personne" class="form-control" name="per_mail" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-2">
                        <label for="per_login">Login</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Login de la personne" class="form-control" name="per_login" required="required">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-2">
                        <label for="per_pwd">Mot de passe</label>
                    </div>
                    <div class="col-lg-10">
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
} else {
    $_SESSION['per_nom'] = $_POST['per_nom'];
    $_SESSION['per_prenom'] = $_POST['per_prenom'];
    $_SESSION['per_tel'] = $_POST['per_tel'];
    $_SESSION['per_mail'] = $_POST['per_mail'];
    $_SESSION['per_login'] = $_POST['per_login'];
    $_SESSION['per_pwd'] = $_POST['per_pwd'];
    $_SESSION['per_cat'] = $_POST['per_cat'];

    var_dump($_SESSION);

    $db = new Mypdo();
    $manager = new PersonneManager($db);

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
    $manager->add($personne);

    /*
        1) Insérer Personne
        2) lastInsertId
        3) Insérer Etudiant
     */
    if ($_SESSION['per_cat'] == "1") {
        echo "ETUDIANT";
        if (empty($_POST['per_div'])) {
            echo "AJOUT ETUDIANT";
        ?>
        <h1>Ajouter un étudiant</h1>
        <div class="row col-md-8 col-md-offset-2">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="per_div">Année :</label>
                    <select name="per_div" id="per_div" class="form-control">
                        <option value="1">Année 1</option>
                        <option value="2">Année 2</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="per_dep">Département :</label>
                    <select name="per_dep" id="per_dep" class="form-control">
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
        } else {
            echo "AJOUT ETUDIANT FAIT OK";
            $_SESSION['dep_num'] = $_POST['dep_num'];
            $_SESSION['div_num'] = $_POST['div_num'];

            $db = new Mypdo();
            $manager = new EtudiantManager($db);

            $etudiant = new Etudiant (
                array(
                    'per_num' => $db->lastInsertId(),
                    'dep_num' => $_SESSION['dep_num'],
                    'div_num' => $_SESSION['div_num'],
                    )
                );
            $manager->add($etudiant);
                break;
        }
    }  else if ($_SESSION['per_cat'] == "2") {
            if (empty($_POST['per_telpro'])) {
        ?>
        <h1>Ajouter un salarié</h1>
        <div class="row col-md-8 col-md-offset-2">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="per_telpro">Téléphone professionnel :</label>
                    <input type="text" placeholder="Téléphone professionnel de la personne" class="form-control" name="per_telpro">
                </div>

                <div class="form-group">
                    <label for="per_fonction">Fonction :</label>
                    <select name="per_fonction" id="per_fonction" class="form-control">
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
        } else {
            $_SESSION['sal_telprof'] = $_POST['sal_telprof'];
            $_SESSION['fon_num'] = $_POST['fon_num'];

            $db = new Mypdo();
            $manager = new SalarieManager($db);

            $salarie = new Salarie (
                array(
                    'per_num' => $db->lastInsertId(),
                    'sal_telprof' => $_SESSION['sal_telprof'],
                    'fon_num' => $_SESSION['fon_num'],
                    )
                );
            $manager->add($salarie);
        }
    }
    ?>
    <div class="row col-md-8 col-md-offset-2">
        <p class="alert alert-success">La personne <strong><?php echo $_SESSION['per_nom'] ?></strong> a bien été ajoutée</p>
    </div>
    <?php
    //session_destroy();
}