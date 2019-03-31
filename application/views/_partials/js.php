      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Unipanel 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin akan logout</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="<?php echo base_url() ?>auth/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <div id="modal-konfirmasi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"></h4></center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-flat" data-dismiss="modal">Tidak</button>
          <button type="button" id="btnHapus"  class="btn btn-danger btn-flat">Ya</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/lte/notify/bootstrap-notify.js"></script>
<script src="<?php echo base_url()?>assets/vendor/lte/ajaxupload/jquery.ajaxfileupload.js"></script>
<script src="<?php echo base_url()?>assets/vendor/lte/select2/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/lte/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/lte/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/lte/pace/pace.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/lte/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	$('.datepicker').datepicker({
		autoclose: true,
		format: 'd M yyyy',
	});

	$(function() {
		if ($('#artikelx').length) {
	    	CKEDITOR.replace('artikelx')
		}
	})

	function select2() {
		$('.select2').select2({
		  placeholder: 'Select an option'
		});
	}
	
	function showNotif(title, msg, jenis) {
	    $.notify({
	        title: '<strong>' + title + '</strong>',
	        message: msg
	    }, {
	        type: jenis,
	        z_index: 2000,
	        allow_dismiss: true,
	        delay: 10,
	        animate: {
	            enter: 'animated fadeInDown',
	            exit: 'animated fadeOutUp'
	        },
	    }, );
	};
	$(".<?php echo $aktifgrup ?>").addClass("active");
	$(".<?php echo $aktifmenu ?>").addClass("active");


</script>

</body>

</html>