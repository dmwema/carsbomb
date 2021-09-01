<?php 
use Carbon\Carbon;
?>

</div>
<!-- content-wrapper ends -->
   <!-- partial:partials/_footer.html -->
    <footer class="footer">
    <div class="footer-inner-wraper">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Cars Bomb {{ Carbon::now()->format('Y') }}</span>
      </div>
    </div>
  </footer>
  <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<!-- plugins:js -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<!-- End custom js for this page -->
<!-- file upload -->
<script src="{{ asset('assets/js/file-upload.js') }}"></script>
<!-- End file upload --> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="{{ asset('assets/js/jquery.tablesort.min.js') }}"></script>
<script>
  $("table.users").tablesort()
</script>

<!-- drag and drop -->
<script src="{{ asset('assets/js/dragdrop.js') }}"></script>
<!-- End drag and drop --> 

</body>
</html>