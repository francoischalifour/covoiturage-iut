<h1>Ajouter un parcours</h1>
<?php
require_once("include/autoload.inc.php");

if (empty($_POST['ville1']) && empty($_POST['ville2'])) {
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->getAllVille();
?>
<form action ="#" method ="post" name="formParcours">
    <label for="ville1">Ville de départ :</label>
    <select class="champ" name="ville1" id="ville1">
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
    <select class="champ" name="ville2" id="ville2">
            <option value="">Sélectionnez la ville</option>
            <?php
                foreach ($villes as $ville) {
                ?>
                <option value="<?php echo $ville->getVilNum() ?>"><?php echo $ville->getVilNom() ?></option>
                <?php
                }
            ?>
        </select>

    <label for="nbKm">Nombre de kilomètres :</label>
    <input type="text" placeholder="Nombre de kilomètres" class="champ" name="nbKm">

    <br>
    <button type="submit" class="bouton">Valider</button>
</form>
<?php
}
else {
    $db = new Mypdo();
    $manager = new ParcoursManager($db);

    $parcours = new Parcours (
        array(
            'ville1' => $_POST['ville1'],
            'ville2' => $_POST['ville2'],
            'nbKm' => $_POST['nbKm']

            )
        );
    $manager->add($parcours);
    ?>
?>
    <p>Le parcours entre <?php echo $_POST['ville1'] ?> et <?php echo $_POST['ville2'] ?> a été ajouté. Il fait <?php echo $_POST['nbKm'] ?>.</p>
<?php
}
