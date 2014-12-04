 <h1>Connexion</h1>
<?php
if (isConnected()) {
    ?>
    <p class="alert alert-warning">Vous êtes déjà connecté.</p>
    <div class="text-center">
        <a href="index.php" class="btn btn-primary">Revenir à l'accueil</a>
    </div>
    <?php
} else {
require_once("include/autoload.inc.php");

if (!isset($_POST['per_login'])) {
?>
<form action="#" method="post" id="loginForm">
    <div class="row form-group">
        <div class="col-lg-2">
            <label for="per_login">Nom d'utilisateur</label>
        </div>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="per_login" placeholder="Votre nom d'utilisateur" required="required">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label for="per_pwd">Mot de passe</label>
        </div>
        <div class="col-lg-10">
            <input type="password" class="form-control" name="per_pwd" placeholder="Votre mot de passe" required="required">
        </div>
    </div>

    <div class="row form-group" id="checkRobot">
        <div class="col-lg-2">
            <label for="per_pwd">Je ne suis pas un robot</label>
        </div>
        <div class="col-lg-10">
            <p><button type="button" class="btn btn-primary btn-fab mdi-action-accessibility" id="pressHuman"></button>
            &nbsp;Maintenir le bouton <strong>1 seconde</strong></p>
        </div>
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary" id="login" disabled="disabled">Se connecter</button>
    </div>
</form>
<?php
} else {
    $pdo = new MyPdo();
    $personneManager = new PersonneManager($pdo);

    $identifiantsOk = $personneManager->verifPersonne($_POST['per_login'], $_POST['per_pwd']);

    if (!$identifiantsOk) {
        ?>
<p class="alert alert-danger">Vos identifiants sont incorrects.</p>
<div class="text-center">
    <button onclick="history.back()" class="btn btn-default">Recommencer</button>
</div>
        <?php
    } else {
        $_SESSION['user_login'] = $_POST['per_login'];
        $personne = $personneManager->getPersonneByLogin($_POST['per_login']);
        $_SESSION['user_num'] = $personne->getPerNum();
?>
<p class="alert alert-success">Vous êtes maintenant connecté.</p>
<div class="text-center">
    <a href="index.php" class="btn btn-primary">Aller à l'accueil</a>
    <a href="javascript:history.go(-2)" class="btn btn-primary btn-flat">Revenir à la page précédente</a>
</div>
<?php
    }
}
}
