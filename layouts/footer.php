     </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
  const burgerMenu = document.querySelector('.burger-menu');
  const nav = document.querySelector('.nav');

  burgerMenu.addEventListener('click', function () {
    nav.classList.toggle('show');
  });
});
</script>
  </body>
</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>
