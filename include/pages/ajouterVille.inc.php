<h1>Ajouter une ville</h1>

<?php
require_once("include/autoload.inc.php");

if (empty($_POST['vil_nom'])) {
    ?>
    <form action="#" method="post">
        <label for="vil_nom">Nom :</label>
        <input type="text" placeholder="Nom de la ville" class="form-control" name="vil_nom">
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
    <?php
} else {
    $db = new Mypdo();
    $manager = new VilleManager($db);

    $ville = new Ville (
        array(
            'vil_nom' => $_POST['vil_nom'],
            )
        );
    $manager->add($ville);
    ?>
    <p>La ville <?php echo $_POST['vil_nom'] ?> a bien été ajoutée</p>
    <?php
}