<h1>Se connecter</h1>
<form action="index.php" method="post">
    <div class="row form-group">
        <div class="col-lg-2">
            <label for="username">Nom d'utilisateur</label>
        </div>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="username" placeholder="Votre nom d'utilisateur">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label for="passwd">Mot de passe</label>
        </div>
        <div class="col-lg-10">
            <input type="password" class="form-control" name="passwd" placeholder="Votre mot de passe">
        </div>
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </div>
</form>