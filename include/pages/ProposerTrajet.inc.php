<?php
if (!isConnected()) {
    header('Location: index.php?page=11');
}
?>
<h1>Proposer un trajet</h1>
<?php
require_once("include/autoload.inc.php");

$pdo = new MyPdo();
$parcoursManager = new ParcoursManager($pdo);
$villeManager = new VilleManager($pdo);

$villes = $villeManager->getAllVille();

if (empty($_POST['vil_num'])) {
    ?>
    <form action="#" method ="post">
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
            <button type="submit" class="btn btn-primary">Proposer</button>
        </div>
    </form>
    <?php
} else {
    $_SESSION['vil_num'] = $_POST['vil_num'];
    ?>
    <form action ="#" method ="post">
        <div class="row">
            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="vil_num1">Ville de départ</label>
                    </div>
                    <div class="col-lg-6">
                        <?php echo $villeManager->getVilNom($_POST['vil_num'])->vil_nom ?>
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
                        <label for="pro_place">Nombre de places</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="pro_place" id="pro_place" class="form-control" placeholder="Nombre de places" pattern="[1-9]" title="Le nombre de places doit être compris entre 1 et 9." required="required">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="vil_num2">Ville d'arrivée</label>
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control" name="vil_num2" id="vil_num2">
                            <option value="0">Sélectionnez la ville</option>
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

                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="pro_time">Heure de départ</label>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group date" id="timepicker">
                            <input type="text" name="pro_time" id="pro_time" class="form-control" placeholder="HH:MM" pattern="[0-9]{2}:[0-9]{2}" title="L'heure doit être de la forme HH:MM." required="required">
                            <span class="input-group-addon"><i class="mdi-action-schedule"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Proposer</button>
        </div>
    </form>
    <?php
}

if (!empty($_POST['vil_num2'])) {
    $proposeManager = new ProposeManager($pdo);

    $parcours = $parcoursManager->getParcoursByVilNums($_SESSION['vil_num'], $_POST['vil_num2']);

    $propose = new Propose($_POST);
    var_dump($_SESSION);
    $propose->setPerNum($_SESSION['per_num']);
    $propose->setParNum($parcours->getParNum());

    if ($parcours->getVilNum1() == $_SESSION['vil_num'])
        $sens = 0;
    else
        $sens = 1;

    $propose->setProSens($sens);
    var_dump($propose);

    $proposeManager->add($propose);
}