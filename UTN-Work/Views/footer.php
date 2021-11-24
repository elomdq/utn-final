</div>

<?php

if (isset($_SESSION['loggedUser'])) { ?>

  <footer class="py-4 my-auto">
    <p class="text-center txt-white m-0">Copyright &copy; <?php echo date('Y'); ?> - All Rights Reserved - UTN Laboratorio IV</p>
  </footer>

<?php } ?>

</div>


<!-- JAVASCRIPTS -->
<!-- Bootstrap core JavaScript-->
<!-- <script src="<?php echo JS_PATH . "/bootstrap.bundle.min.js"; ?>"></script>
<script src="<?php echo JS_PATH . "/bootstrap.min.js"; ?>"></script> -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script>
  $(function() {
    $(document.getElementsByClassName('offer-description')).each(function(i) {
      len = $(this).text().length;
      if (len > 100) {
        $(this).text($(this).text().substr(0, 100) + '...');
      }
    });
  });
</script>


</body>

</html>