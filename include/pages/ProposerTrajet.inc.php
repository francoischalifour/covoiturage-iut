<h1>Proposer un trajet</h1>
<?php
require_once("include/autoload.inc.php");

$pdo = new MyPdo();
$parcoursManager = new ParcoursManager($pdo);
$villeManager = new VilleManager($pdo);

if (empty($_POST['vil_num'])) {
$villes = $villeManager->getAllVille();
?>
<form action ="#" method ="post">
    <label for="vil_num">Ville de départ :</label>
    <select class="form-control" name="vil_num" id="vil_num">
        <option value="">Sélectionnez la ville</option>
        <?php
            foreach ($villes as $ville) {
            ?>
            <option value="<?php echo $ville->getVilNum() ?>"><?php echo $ville->getVilNom() ?></option>
            <?php
            }
        ?>
    </select>

    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php }