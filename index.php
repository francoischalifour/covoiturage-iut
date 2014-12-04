<?php require_once("include/header.inc.php"); ?>
<div class="row row-main">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once("include/menu.inc.php"); ?>
                </div>
                <div class="col-md-9">
                <?php var_dump($_SESSION); ?>
                    <?php require_once("include/texte.inc.php");  ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("include/footer.inc.php"); ?>
