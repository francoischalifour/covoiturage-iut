<?php
require_once("include/autoload.inc.php");
//session_destroy();
var_dump($_SESSION);

if (!isset($_POST['per_nom'])) {
    ?>
    <h1>Ajouter une personne</h1>

    <form action="#" method="post">
        <div class="container">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="per_nom">Nom :</label>
                    <input type="text" placeholder="Nom de la personne" class="form-control" name="per_nom">
                </div>

                <div class="form-group">
                    <label for="per_prenom">Prénom :</label>
                    <input type="text" placeholder="Prénom de la personne" class="form-control" name="per_prenom">
                </div>

                <div class="form-group">
                    <label for="per_tel">Téléphone :</label>
                    <input type="text" placeholder="Téléphone de la personne" class="form-control" name="per_tel">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="per_mail">Mail :</label>
                    <input type="text" placeholder="Mail de la personne" class="form-control" name="per_mail">
                </div>

                <div class="form-group">
                    <label for="per_login">Login :</label>
                    <input type="text" placeholder="Login de la personne" class="form-control" name="per_login">
                </div>

                <div class="form-group">
                    <label for="per_pwd">Mot de passe :</label>
                    <input type="password" placeholder="Mot de passe de la personne" class="form-control" name="per_pwd">
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <div class="form-group">
                <label for="per_cat">Catégorie :</label>
            </div>
            <label for="1"><input type="radio" name="per_cat" id="1" value="1" checked="checked">Etudiant</label>
            <label for="2"><input type="radio" name="per_cat" id="2" value="2">Personnel</label>
        </div>

        <br>

        <div class="form-group">
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
    if ($_POST['per_cat'] == "1") {
        ?>
        <h1>Ajouter un étudiant</h1>
        <form action="#" method="post">
            <label for="per_div">Année :</label>
            <select name="per_div" id="per_div">
                <option value="1">Année 1</option>
                <option value="2">Année 2</option>
            </select>

            <br>

            <label for="per_dep">Département :</label>
            <select name="per_dep" id="per_dep">
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

            <br>

            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
        <?php
    }  else if ($_POST['per_cat'] == "2") {
        ?>
            <h1>Ajouter un salarié</h1>
            <form action="#" method="post">
            <label for="per_telpro">Téléphone professionnel :</label>
            <input type="text" placeholder="Téléphone professionnel de la personne" class="form-control" name="per_telpro">

            <br>

            <label for="per_fonction">Fonction :</label>
            <select name="per_fonction" id="per_fonction">
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

            <br>

            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
        <?php
    }

    // Pas au bon endroit

    if(isset($_POST['dep_num']) || isset($_POST['per_telpro'])) {
        switch ($_SESSION['per_cat']) {
            case "1":
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

            default:
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
                break;
        }
        ?>
        <p>La personne <?php echo $_SESSION['per_nom'] ?> a bien été ajoutée</p>
        <?php
        session_destroy();
    }
}