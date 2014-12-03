<h1>Ajouter une ville</h1>
<?php
require_once("include/autoload.inc.php");

if (empty($_POST['vil_nom'])) {
    ?>
    <form action="#" method="post">
        <div class="row form-group">
            <div class="col-lg-2">
                <label for="vil_nom">Nom de la ville</label>
            </div>
            <div class="col-lg-10">
                <input type="text" placeholder="Nom de la ville" class="form-control" name="vil_nom" pattern="[a-zA-Z-éêèàçïî\s]{2,20}" title="Le nom de la ville doit comporté au moins 3 caractères." required="required">
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>
    <?php
} else {
    $db = new Mypdo();
    $villeManager = new VilleManager($db);

    if ($villeManager->isVilleAlreadyRegistered($_POST['vil_nom'])) {
        ?>
    <p class="alert alert-warning">Cette ville est déjà référencée.</p>
    <div class="text-center">
        <a href="index.php?page=7" class="btn btn-primary btn-flat">Recommencer</a>
    </div>
        <?php
    } else {
        $ville = new Ville (
            array(
                'vil_nom' => $_POST['vil_nom'],
                )
            );
        $villeManager->add($ville);
        ?>
    <p class="alert alert-success">La ville <strong><?php echo $_POST['vil_nom'] ?></strong> a bien été ajoutée.</p>
    <div class="text-center">
        <a href="index.php?page=8" class="btn btn-default">Retour à la liste des villes</a>
    </div>
        <?php
    }
}