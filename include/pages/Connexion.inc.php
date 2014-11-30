<?php
if (isset($_SESSION['user_login'])) {
    header('Location: index.php');
}
?>
 <h1>Se connecter</h1>
<?php
require_once("include/autoload.inc.php");

if (!isset($_POST['per_login'])) {
?>
<form action="#" method="post">
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

    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </div>
</form>
<?php
} else {
    $pdo = new MyPdo();
    $personneManager = new PersonneManager($pdo);

    $connexion = $personneManager->verifPersonne($_POST['per_login'], $_POST['per_pwd']);

    if (!$connexion) {
        ?>
<p class="alert alert-danger">Vos identifiants sont incorrects.</p>
<div class="text-center">
    <a href="index.php?page=11" class="btn btn-default">Recommencer</a>
</div>
        <?php
    } else {
        $_SESSION['user_login'] = $_POST['per_login'];
        $personne = $personneManager->getPersonneByLogin($_POST['per_login']);
        $_SESSION['user_num'] = $personne->getPerNum();

        header('Location: index.php');
        exit();
?>
<p class="alert alert-success">Vous êtes maintenant connecté.</p>
<?php
    }
}
