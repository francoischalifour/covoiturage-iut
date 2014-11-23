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
                <select class="form-control" name="vil_num" id="vil_num">
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

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Proposer</button>
        </div>
    </form>
    <?php
} else {
    ?>
    <form action ="#" method ="post">
        <div class="row">
            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="vil_num">Ville de départ</label>
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
                            <input type="text" name="pro_date" id="pro_date" class="form-control" placeholder="JJ/MM/AAAA">
                            <span class="input-group-addon"><i class="mdi-action-event"></i></span>
                        </div>
                    </div>

                </div>

                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="pro_place">Nombre de places</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="pro_place" id="pro_place" class="form-control" placeholder="Nombre de places">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="vil_num">Ville d'arivée</label>
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control" name="vil2_num" id="vil2_num">
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
                            <input type="text" name="pro_time" id="pro_time" class="form-control" placeholder="HH:MM">
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