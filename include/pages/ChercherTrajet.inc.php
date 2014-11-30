<?php
if (!isConnected()) {
    header('Location: index.php?page=11');
}
?>
<h1>Rechercher un trajet</h1>
<?php
require_once("include/autoload.inc.php");

$pdo = new MyPdo();

if (empty($_POST['vil_num']) && empty($_POST['vil_num2'])) {
    $proposeManager = new ProposeManager($pdo);
    $villes = $proposeManager->getAllVilleDepart();
    ?>
    <form action ="#" method ="post">
        <div class="row form-group">
            <div class="col-lg-2">
                <label for="vil_num">Ville de départ</label>
            </div>
            <div class="col-lg-10">
                <select class="form-control" name="vil_num" id="vil_num" required="required">
                    <option value="">Sélectionnez la ville</option>
                    <?php
                        foreach ($villes as $ville) {
                        ?>
                        <option value="<?php echo $ville->getVilNum() ?>"><?php echo $ville->getVilNom() ?></option>
                        <?php
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>
    <?php
} else if (empty($_POST['vil_num2']) && !empty($_POST['vil_num'])) {
    $villeManager = new VilleManager($pdo);
    $proposeManager = new ProposeManager($pdo);
    $ville = $villeManager->getVilNom($_POST['vil_num']);
    $_SESSION['vil_num'] = $_POST['vil_num'];
    ?>
    <form action ="#" method ="post">
        <div class="row">
            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="vil_num">Ville de départ</label>
                    </div>
                    <div class="col-lg-6">
                        <?php echo $ville->getVilNom() ?>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="pro_date">Date de départ</label>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group date" id="datepicker">
                            <input type="text" name="pro_date" id="pro_date" class="form-control" placeholder="JJ/MM/AAAA" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" title="La date doit être sous la forme JJ/MM/AAAA." required="required">
                            <span class="input-group-addon"><i class="mdi-action-event"></i></span>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="pro_time">A partir de</label>
                    </div>
                    <div class="col-lg-6">
                        <select name="pro_time" id="pro_time" class="form-control">
                            <?php
                            for ($i = 0; $i <= 23; $i++) {
                            ?>
                                <option value="<?php echo $i ?>"><?php echo ($i<10) ? "0".$i : $i; ?>h</option>
                            <?php
                            } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="vil_num">Ville d'arrivée</label>
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control" name="vil_num2" id="vil_num2" required="required">
                            <option value="">Sélectionnez la ville</option>
                            <?php
                                $villes = $proposeManager->getAllVilleArrivee($_POST['vil_num']);

                                foreach ($villes as $ville) {
                                ?>
                                <option value="<?php echo $ville->getVilNum() ?>"><?php echo $ville->getVilNom() ?></option>
                                <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="pro_date_prec">Précision</label>
                    </div>
                    <div class="col-lg-6">
                        <select name="pro_date_prec" id="pro_date_prec" class="form-control">
                            <option value="0">Ce jour</option>
                            <option value="1">+/- 1 jour</option>
                            <option value="2">+/- 2 jours</option>
                            <option value="3">+/- 3 jours</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>
    <?php
} else {
    $villeManager = new VilleManager($pdo);
    $parcoursManager = new ParcoursManager($pdo);
    $personneManager = new PersonneManager($pdo);

    $resultats = $proposeManager->getResultParcours($_SESSION['vil_num'], $_POST['vil_num2'], $_POST['pro_date'], intval($_POST['pro_date_prec']), $_POST['pro_time']);

    if (COUNT($resultats) == 0) {
        ?>
        <p>Aucun trajet ne correspond à votre recherche.</p>
        <?php
    } else {
        ?>
    <table class="table">
        <tr>
            <th>Ville de départ</th>
            <th>Ville d'arrivée</th>
            <th>Date de départ</th>
            <th>Heure de départ</th>
            <th>Nombre de places</th>
            <th>Nom du covoitureur</th>
        </tr>
        <?php
        foreach ($resultats as $resultat) {
            $parcours = $parcoursManager->getParcours($resultat->getParNum());
            $ville1 = $villeManager->getVilNom($parcours->getVilNum1());
            $ville2 = $villeManager->getVilNom($parcours->getVilNum2());
            $personne = $personneManager->getPerPrenom($resultat->getPerNum());
            ?>
            <tr>
                <td><?php echo $ville1->getVilNom(); ?></td>
                <td><?php echo $ville2->getVilNom(); ?></td>
                <td><?php echo $resultat->getProDate(); ?></td>
                <td><?php echo $resultat->getProTime(); ?></td>
                <td><?php echo $resultat->getProPlace(); ?></td>
                <td><?php echo $personne->getPerPrenom() . " " . $personne->getPerNom(); ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
        <?php
    }
}