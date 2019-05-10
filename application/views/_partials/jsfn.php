<script type="text/javascript">

  function refresh() {
      table.ajax.reload(null, false);
      idx = -1;
  }

  function add_data() {
      save_method = 'add';
      $('#form-data')[0].reset();
      if ($('#artikelx').length) {
          CKEDITOR.instances.artikelx.setData('');
      }

      $('#modal-data').modal('show');
      $('.modal-title').text('Tambahkan Data');
  }

  function save() {
      var url;
      if (($('#artikelx').length)) {
          artikel = CKEDITOR.instances['artikelx'].getData();
          $('#artikel').val(artikel);
      }
      if (save_method == 'add') {
          url = urlsave;
      } else {
          url = urlupdate;
      }
      $(".btn-fn").prop('disabled', true);
      $.ajax({
          url: url,
          type: "POST",
          data: $('#form-data').serialize(),
          dataType: "JSON",
          success: function(data) {
              if (data.sukses == 'success') {
                  $('#modal-data').modal('hide');
                  refresh();
                  save_method == 'add' ? showNotif('Sukses', 'Data Berhasil Ditambahkan', 'success') : showNotif('Sukses', 'Data Berhasil Diubah', 'success')
                  $(".btn-fn").prop('disabled', false);
              } else if (data.sukses == 'fail') {
                  $('#modal-data').modal('hide');
                  refresh();
                  showNotif('Sukses', 'Tidak Ada Perubahan', 'success');
                  $(".btn-fn").prop('disabled', false);
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert('Error on process');
              $(".btn-fn").prop('disabled', false);
          }
      });
  }

  function savefile() {
      var url;
      if ($('#artikelx').length) {
        artikel = CKEDITOR.instances['artikelx'].getData();
        $('#artikel').val(artikel);
      }
      if (save_method == 'add') {
          url = urlsavefile;
      } else {
          url = urlupdatefile;
      }
      $(".btn-fn").prop('disabled', true);
      var formData = new FormData($('#form-data')[0]);
      $.ajax({
          url: url,
          type: "POST",
          data: formData,
          dataType: "JSON",
          mimeType: "multipart/form-data",
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
              if (data.sukses == 'success') {
                  $('#modal-data').modal('hide');
                  refresh();
                  save_method == 'add' ? showNotif('Sukses', 'Data Berhasil Ditambahkan', 'success') : showNotif('Sukses', 'Data Berhasil Diubah', 'success');
                  $(".btn-fn").prop('disabled', false);
              } else if (data.sukses == 'fail') {
                  $('#modal-data').modal('hide');
                  refresh();
                  showNotif('Sukses', 'Tidak Ada Perubahan', 'success');
                  $(".btn-fn").prop('disabled', false);
              }

          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert('Error on process');
              $(".btn-fn").prop('disabled', false);
          }
      });
  }

  function unduh_data(id) {
      $.ajax({
          url: urlunduh,
          type: "POST",
          data: {
              id: id
          },
          dataType: "JSON",
          success: function(data) {
              var unduhdata = (data.unduh);
              if (data.sukses) {
                  showNotif('Sukses', 'File Di Unduh', 'success');
                  window.open("<?php echo site_url('')?>" + unduhdata);
              } else {
                  showNotif('Perhatian', 'File Tidak Ada', 'danger');
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert('Error on process');
          }
      });
  }

  function hapus_data(id) {
      $('.modal-title').text('Yakin Hapus Data ?');
      $('#modal-konfirmasi').modal('show');
      $('#btnHapus').attr('onclick', 'delete_data(' + id + ')');
  }

  function delete_data(id) {
      $.ajax({
          url: urlhapus,
          type: "POST",
          dataType: "JSON",
          data: {
              id: id,
          },
          success: function(data) {
              $('#modal-konfirmasi').modal('hide');
              if (data.sukses == 'success') {
                  refresh();
                  showNotif('Sukses', 'Data Berhasil Dihapus', 'success')
              } else if (data.sukses == 'fail') {
                  $('#modal-data').modal('hide');
                  refresh();
                  showNotif('Gagal', 'Data Gagal Dihapus', 'danger')
              }
              refresh();
          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert('Error on process');
          }
      });

  }

  function aktif_data(id) {
      $.ajax({
          url: urlaktif,
          type: "POST",
          dataType: "JSON",
          data: {
              id: id,
          },
          success: function(data) {
              if (data.sukses == 'success') {
                  refresh();
                  showNotif('Sukses', 'Data Berhasil Diubah', 'success')
              } else if (data.sukses == 'fail') {
                  refresh();
                  showNotif('Gagal', 'Data Gagal Diubah', 'danger')
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert('Error on process');
          }
      });
  }
</script>