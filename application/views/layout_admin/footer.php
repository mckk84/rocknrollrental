<div class="modal fade" id="edit-booking" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="updatebooking" class="booking_form" action="<?=base_url('admin/Bookings/update')?>" method="POST">
            <input type="hidden" name="booking_id" value="">
            <div class="modal-header">
              <span class="modal-title h5">Booking Order</span>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-2 px-2">
                  <div id="order_dates" class="col-md-12 mb-1 px-1">

                  </div>
                  <div id="order_details" class="col-md-8 mb-1 px-1">

                  </div>
                  <div id="order_details1" class="col-md-4 mb-1 px-1">

                  </div>
                  <div id="bike_select" class="col-md-12 px-1">
                    
                  </div>
                  <div id="order_summary" class="col-md-12 px-1">
                    
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" id="submitbooking" type="button">Submit</button>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div><!-- End Disabled Backdrop Modal-->
<!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><a class="text-warning" href="https://rocknrollrental.com">ROCK N ROLL RENTALS</a></strong>. All Rights Reserved
         Designed by <a class="text-warning" href="https://jvmtech.in/"><strong>JVM TECH SOLUTIONS</strong></a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script type="text/javascript">
    let base_url = '<?=base_url()?>';
    let booking_url = '<?=base_url('admin/Bookings')?>';
  </script>
  <!-- Vendor JS Files -->
  <script src="<?=base_url()?>assets/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url()?>assets/admin/assets/vendor/quill/quill.js"></script>
  <script src="<?=base_url()?>assets/admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?=base_url()?>assets/admin/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?=base_url()?>assets/admin/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?=base_url()?>assets/admin/assets/js/main.js"></script>
  <!-- Ajax Calls -->
  <script src="<?=base_url()?>assets/admin/assets/js/ajax.js"></script>

</body>

</html>