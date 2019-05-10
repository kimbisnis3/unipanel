<?php $this->load->view('_partials/head') ?>
<?php $this->load->view('_partials/sidebar') ?>
<?php $this->load->view('_partials/topbar') ?>
<div class="container-fluid">
  <h5 class="h3 mb-2 text-gray-800"><?php echo $title ?></h5>
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
              <th>Judul</th>
              <th>Artikel</th>
              <th>Image</th>
              <th>Keterangan</th>
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
</div>
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
              <label>Judul</label>
              <input type="hidden" name="id">
              <input type="text" class="form-control" name="judul">
            </div>
          <!--   <div class="form-group">
              <label>Tanggal</label>
              <input type="text" class="form-control datepicker" name="judul">
            </div> -->
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" class="form-control" name="image" id="image" >
            </div>
            <div class="form-group">
              <label>Artikel</label>
              <textarea class="form-control" rows="7" name="artikelx" id="artikelx"></textarea>
            </div>
            <div class="form-group" style="display : none;">
              <label>Artikel</label>
              <textarea class="form-control" rows="7" name="artikel" id="artikel"></textarea>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" class="form-control" name="ket" >
            </div>
            <div class="form-group">
              <input type="hidden" name="path" id="path">
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-warning btn-fn" data-dismiss="modal">Batal</button>
      <button type="button" class="btn btn-primary btn-fn" onclick="savefile()">Simpan</button>
    </div>
  </div>
</div>
</div>  <!-- END MODAL INPUT-->
<?php $this->load->view('_partials/js') ?>
<script type="text/javascript">
  var controller = 'berita';
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
        "columns": [
          {"data": "no"}, 
          {"data": "judul" }, 
          {"data": "artikel"}, 
          {"data": "image" }, 
          {"data": "ket"}, 
          {"data": "action"}
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
              $('[name="judul"]').val(data.judul);
              $('[name="ket"]').val(data.ket);
              $('[name="path"]').val('.' + data.image);
              CKEDITOR.instances.artikelx.setData(data.artikel);
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

