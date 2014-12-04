<h1>Rechercher un trajet</h1>
<?php
$javascripts = '<script src="js/moment.js"></script>
    <script src="js/datetimepicker.js"></script>
    <script src="js/sorttable.js"></script>
    <script src="js/datepicker.opt.js"></script>
    <script src="js/timepicker.opt.js"></script>
';

if (!isConnected()) {
    ?>
    <p>Vous devez être connecté pour accéder à cette page.</p>
    <div class="text-center">
        <a href="index.php?page=11" class="btn btn-primary">Accéder à la page de connexion</a>
    </div>
    <?php
} else {
require_once("include/autoload.inc.php");

$pdo = new MyPdo();
$proposeManager = new ProposeManager($pdo);

if (empty($_POST['vil_num']) && empty($_POST['vil_num2'])) {
    $proposeManager = new ProposeManager($pdo);
    $villes = $proposeManager->getAllVilleDepart();
    ?>
    <form action ="#" method ="post" id="formVille">
        <div class="row form-group">
            <div class="col-lg-2">
                <label for="vil_num">Ville de départ</label>
            </div>
            <div class="col-lg-10">
                <select class="form-control" name="vil_num" id="vil_num" onChange="document.getElementById('formVille').submit()" required="required">
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
                        <?php echo $villeManager->getVilNom($_SESSION['vil_num']) ?>
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
                        <div class="input-group date" id="timepicker">
                            <input type="text" name="pro_time" id="pro_time" class="form-control" placeholder="HH:MM" pattern="[0-9]{2}:[0-9]{2}" title="L'heure doit être de la forme HH:MM." required="required">
                            <span class="input-group-addon"><i class="mdi-action-schedule"></i></span>
                        </div>
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
    <table class="table sortable">
        <tr>
            <th class="pointer">Ville de départ</th>
            <th class="pointer">Ville d'arrivée</th>
            <th class="pointer">Date de départ</th>
            <th class="pointer">Heure de départ</th>
            <th class="pointer">Nombre de places</th>
            <th class="pointer">Nom du covoitureur</th>
        </tr>
        <?php
        foreach ($resultats as $resultat) {
            $parcours = $parcoursManager->getParcours($resultat->getParNum())[0];
            $ville1 = $villeManager->getVilNom($parcours->getVilNum1());
            $ville2 = $villeManager->getVilNom($parcours->getVilNum2());
            $personne = $personneManager->getPersonne($resultat->getPerNum());
            ?>
            <tr>
                <td><?php echo $ville1 ?></td>
                <td><?php echo $ville2 ?></td>
                <td><?php echo $resultat->getProDate() ?></td>
                <td><?php echo $resultat->getProTime() ?></td>
                <td><?php echo $resultat->getProPlace() ?></td>
                <td><?php echo $personne->getPerPrenom() . " " . $personne->getPerNom() ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
        <?php
    }
    ?>

    <div class="text-center">
        <a href="index.php?page=10" class="btn btn-primary btn-flat">Faire une nouvelle recherche</a>
    </div>
    <?php
}
}