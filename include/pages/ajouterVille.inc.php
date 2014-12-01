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
                <input type="text" placeholder="Nom de la ville" class="form-control" name="vil_nom" pattern="[a-zA-Z]{3-100}" title="La distance doit être un entier positif." required="required">
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
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
    <p class="alert alert-success">La ville <strong><?php echo $_POST['vil_nom'] ?></strong> a bien été ajoutée.</p>
    <?php
}