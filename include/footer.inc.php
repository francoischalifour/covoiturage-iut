    <div class="footer">
        <div class="container">
            Covoiturage de l'IUT &agrave; votre service, depuis novembre 2011
            <br />
            &copy; IUT du Limousin -  DUT Informatique 2<sup>ème</sup> année
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/material.js"></script>
    <script src="js/ripples.js"></script>
    <?php if (!empty($javascripts)) echo $javascripts ?>
    <?php if (!empty($_GET['page']) && $_GET['page'] == 2 && !empty($_GET['user'])) { ?>
    <script>
    if ($('#showPhoneNumber').length) {
        $('#showPhoneNumber').on('click', function() {
            $(this).html("<img src=\"include/telephone.php?num=<?php echo $personne->getPerTel()?>\" alt=\"Numéro\">");
        });
    }
    </script>
    <?php } ?>
    <script>
    $(function() {
        $.material.init();
      });
    </script>
</body>
</html>