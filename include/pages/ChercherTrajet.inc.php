<h1>Rechercher un trajet</h1>
<?php
require_once("include/autoload.inc.php");

$pdo = new MyPdo();
$parcoursManager = new ParcoursManager($pdo);
$villeManager = new VilleManager($pdo);
$trajetManager = new TrajetManager($pdo);

$villes = $villeManager->getAllVille();

if (empty($_POST['vil_num'])) {
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
                                <option value="<?php echo $i ?>"><?php echo $i?>h</option>
                            <?php
                            } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row form-group">
                    <div class="col-lg-4">
                        <label for="vil_num">Ville d'arivée</label>
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control" name="vil2_num" id="vil2_num" required="required">
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
    
    $parcoursManager->searchTrajet($trajetManager);
}