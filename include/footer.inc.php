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
    <script src="js/moment.js"></script>
    <script src="js/datetimepicker.js"></script>
    <script src="js/sorttable.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datepicker').datetimepicker({
                pickTime: false,
                language: 'fr',
                showToday: true,
                minDate: new Date()
            });
        });

        $(function () {
            $('#timepicker').datetimepicker({
                pickDate: false,
                language: 'fr'
            });
        });
    </script>
    <script>
        $(function() {
            // Régler le conflit entre les deux scripts
            if (!$('#datepicker').length) {
                $.material.init();
            }
          });
    </script>
</body>
</html>