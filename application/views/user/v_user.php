<?php $this->load->view('_partials/head') ?>
<?php $this->load->view('_partials/sidebar') ?>
<?php $this->load->view('_partials/topbar') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h5 class="h3 mb-2 text-gray-800"><?php echo $title ?></h5>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="row">
        <!-- <div class="col-md-6">
          <h5 class="m-0 font-weight-bold text-primary"><?php echo $title ?></h5>
        </div> -->
        <div class="col-md-6">
          <button class="btn btn-success" onclick="add_data()"><i class="fa fa-plus"></i></button>
          <button class="btn btn-primary" onclick="refresh()"><i class="fa fa-sync"></i></button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Password</th>
              <th>Alamat</th>
              <th>Status</th>
              <th width="13%">Opsi</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<div class="modal fade" id="modal-data" role="dialog" data-backdrop="static">
<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title"></h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="form-data">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Username</label>
              <input type="hidden" name="id">
              <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="text" class="form-control" name="password" >
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" class="form-control" name="alamat" >
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-warning btn-flat" data-dismiss="modal">Batal</button>
      <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-flat">Simpan</button>
    </div>
  </div>
</div>
</div>  <!-- END MODAL INPUT-->
<?php $this->load->view('_partials/js') ?>
  <script type="text/javascript">
  var controller = 'user';
  var table;
  var idx = -1;
  var urlmaindata = "<?php echo site_url('') ?>" + controller + '/setView';
  var urledit = "<?php echo site_url('')?>" + controller + '/edit';
  var urlsave = "<?php echo site_url('')?>" + controller + '/tambah';
  var urlsavefile = "<?php echo site_url('')?>" + controller + '/tambahfile';
  var urlupdate = "<?php echo site_url('')?>" + controller + '/update';
  var urlupdatefile = "<?php echo site_url('')?>" + controller + '/updatefile';
  var urlhapus = "<?php echo site_url('')?>" + controller + '/hapus';
  var urlunduh = "<?php echo site_url('')?>" + controller + '/unduh';
  var urlaktif = "<?php echo site_url('')?>" + controller + '/aktif';

  $(document).ready(function() {
      table = $('#table').DataTable({
          "processing": true,
          "ajax": {
              "url": urlmaindata,
              "type": "POST",
              "data": {}
          },
          "columns": [{
                  "data": "no"
              }, 
              {
                  "data": "nama"
              },
              {
                  "data": "username"
              }, 
              {
                  "data": "password"
              }, 
              {
                  "data": "alamat"
              }, 
              {
                  "data": "aktif"
              }, 
              {
                  "data": "action"
              }
          ]
      });
  });

  function edit_data(id) {
      save_method = 'update';
      $('#form-data')[0].reset();
      $.ajax({
          url: urledit,
          type: "POST",
          data: {
              id: id,
          },
          dataType: "JSON",
          success: function(data) {
              $('[name="id"]').val(data.id);
              $('[name="nama"]').val(data.nama);
              $('[name="username"]').val(data.username);
              $('[name="password"]').val(data.password);
              $('[name="alamat"]').val(data.alamat);
              
              $('#modal-data').modal('show');
              $('.modal-title').text('Edit Data');

          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert('Error on process');
          }
      });
  }

  </script>

<?php $this->load->view('_partials/jsfn') ?>