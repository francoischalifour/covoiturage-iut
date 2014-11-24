    <div class="footer">
        <div class="container">
            Covoiturage de l'IUT &agrave; votre service, depuis novembre 2011
            <br />
            &copy; IUT du Limousin -  DUT Informatique 2<sup>ème</sup> année
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/material.js"></script>
    <script src="js/ripples.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/datetimepicker.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datepicker').datetimepicker({
                pickTime: false,
                language: 'fr',
                showToday: true
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
      $(document).ready(function() {
          $.material.init();
      });
    </script>
</body>
</html>