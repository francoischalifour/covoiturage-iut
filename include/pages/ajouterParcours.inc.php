<h1>Ajouter un parcours</h1>
<?php
require_once("include/autoload.inc.php");

if (empty($_POST['vil_num1']) && empty($_POST['vil_num2'])) {
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->getAllVille();
?>
<form action ="#" method ="post">
    <label for="vil_num1">Ville de départ :</label>
    <select class="form-control" name="vil_num1" id="vil_num1">
        <option value="">Sélectionnez la ville</option>
        <?php
            foreach ($villes as $ville) {
            ?>
        <option value="<?php echo $ville->getVilNum() ?>"><?php echo $ville->getVilNom() ?></option>
            <?php
            }
        ?>
    </select>

    <label for="nom">Ville d'arrivée :</label>
    <select class="form-control" name="vil_num2" id="vil_num2">
            <option value="">Sélectionnez la ville</option>
            <?php
                foreach ($villes as $ville) {
                ?>
                <option value="<?php echo $ville->getVilNum() ?>"><?php echo $ville->getVilNom() ?></option>
                <?php
                }
            ?>
        </select>

    <label for="par_km">Nombre de kilomètres :</label>
    <input type="text" placeholder="Nombre de kilomètres" class="form-control" name="par_km">

    <br>

    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php
} else {
    $db = new Mypdo();
    $manager = new ParcoursManager($db);

    $parcours = new Parcours (
        array(
            'par_km' => $_POST['par_km'],
            'vil_num1' => $_POST['vil_num1'],
            'vil_num2' => $_POST['vil_num2']
            )
        );
    $manager->add($parcours);
    ?>
    <p>Le parcours entre <?php echo $_POST['vil_num1'] ?> et <?php echo $_POST['vil_num2'] ?> a été ajouté. Il fait <?php echo $_POST['par_km'] ?> km.</p>
    <?php
}
