<?php
require_once("include/autoload.inc.php");

if (empty($_POST['per_nom'])) {
    ?>
    <h1>Ajouter une personne</h1>

    <form action="#" method="post">
        <label for="per_nom">Nom :</label>
        <input type="text" placeholder="Nom de la personne" class="champ" name="per_nom">

        <label for="per_prenom">Prénom :</label>
        <input type="text" placeholder="Prénom de la personne" class="champ" name="per_prenom">

        <br>

        <label for="per_tel">Téléphone :</label>
        <input type="text" placeholder="Téléphone de la personne" class="champ" name="per_tel">

        <label for="per_mail">Mail :</label>
        <input type="text" placeholder="Mail de la personne" class="champ" name="per_mail">

        <br>

        <label for="per_login">Login :</label>
        <input type="text" placeholder="Login de la personne" class="champ" name="per_login">

        <label for="per_mdp">Mot de passe :</label>
        <input type="password" placeholder="Mot de passe de la personne" class="champ" name="per_mdp">

        <br>

        <p class="text-center">
            <label for="per_cat">Catégorie :</label>
            <label for="1"><input type="radio" name="per_cat" id="1" value="1" checked="checked">Etudiant</label>
            <label for="2"><input type="radio" name="per_cat" id="2" value="2">Personnel</label>
        </p>

        <br>

        <button type="submit" class="bouton">Valider</button>
    </form>
    <?php
} else {
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

            <button type="submit" class="bouton">Valider</button>
        </form>
    <?php
    }  else if ($_POST['per_cat'] == "2") {
        ?>
            <h1>Ajouter un salarié</h1>
            <form action="#" method="post">
            <label for="per_telpro">Téléphone professionnel :</label>
            <input type="text" placeholder="Téléphone professionnel de la personne" class="champ" name="per_telpro">

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

            <button type="submit" class="bouton">Valider</button>
        </form>
        <?php
    } else {
        $db = new Mypdo();
        $manager = new PersonneManager($db);

        $personne = new Personne (
            array(
                'per_nom' => $_POST['per_nom'],
                )
            );
        $manager->add($personne);
        ?>
        <p>La personne <?php echo $_POST['per_nom'] ?> a bien été ajoutée</p>
        <?php
    }
}