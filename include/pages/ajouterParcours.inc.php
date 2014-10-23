<h1>Ajouter un parcours</h1>
<?php
if (!isset($_POST['formParcours'])) {
?>
<form action ="#" method ="post" name="formParcours">
    <label for="ville1">Ville de départ :</label>
    <select class="champ" name="ville1" id="ville1">
        <option value="">Sélectionnez la ville</option>
        <!-- villes ... -->
    </select>

    <label for="nom">Ville d'arrivée :</label>
    <select class="champ" name="ville2" id="ville2">
            <option value="">Sélectionnez la ville</option>
            <!-- villes ... -->
        </select>

    <label for="nbKm">Nombre de kilomètres :</label>
    <input type="text" placeholder="Nombre de kilomètres" class="champ" name="nbKm">

    <br>
    <button type="submit" class="bouton">Valider</button>
</form>
<?php
}
else {
?>
    <p>Le parcours a été ajouté</p>
<?php
}
