<h1>Ajouter un parcours</h1>
<?php
if (!isset($_POST['formParcours'])) {
	?>
	<form action ="#" method ="post" name="formParcours">
		<select class="champ" name="Ville1">
		
		</select>
	</form>
}







<?php
if (!isset($_POST['formVille'])) {
    ?>
    <form action="#" method="post" name="formVille">
        <label for="nom">Nom :</label>
        <input type="text" placeholder="Nom de la ville" class="champ" name="nom">
        <button type="submit" class="bouton">Valider</button>
    </form>
    <?php
}
else {
    // traitement
    ?>
    <p>La ville <?php echo $_POST['nom'] ?> a bien été ajoutée</p>
    <?php
}