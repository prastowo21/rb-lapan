<!-- Bootstrap -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url('assets/css') ?>/datatables.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- bootstrap-wysiwyg -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
<!-- Select2 -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<!-- Switchery -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<!-- starrr -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/starrr/dist/starrr.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url('assets/gentelella-master') ?>/build/css/custom.min.css" rel="stylesheet">
<!-- bootstrap-datetimepicker -->
<link href="<?= base_url('assets/css') ?>/bootstrap-datetimepicker.min.css" rel="stylesheet">
<!-- Button Print -->
<!-- <link href="<?= base_url('assets/css') ?>/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="<?= base_url('assets/css') ?>/Bootstrap/buttons.dataTables.min.css" rel="stylesheet">

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <?= $this->session->flashdata('msg') ?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">All</a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Published</a>
                      </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        <div class="x_content">
                          <p class="text-muted font-13 m-b-30">
                            <h3>Indeks Persepsi Korupsi LAPAN saat ini : <span id="ipk"><?php echo number_format($ipk_total,2); ?></span><small> dari skala (0-4)</small></h3>
                          </p>
                          <table id="datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Instansi</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Kota</th>
                                <th>Registrasi</th>
                                <th>IPK</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                          </table>
                          
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <div class="x_content">
                          <p class="text-muted font-13 m-b-30">
                            <h3>Indeks Persepsi Korupsi LAPAN saat ini : <span id="ipk1"><?php echo number_format($ipk_total,2); ?></span><small> dari skala (0-4)</small></h3>
                          </p>
                          <table id="datapublished" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Instansi</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Kota</th>
                                <th>Registrasi</th>
                                <th>IPK</th>
                                <th>Aksi</th>
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
              </div>

              <div id="delete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                <?= form_open('editor/ipk-management/') ?>
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Hapus Data</h4>
                      </div>
                      <div class="modal-body">
                        <h4>Apakah Anda yakin ingin menghapus data ini ?</h4>

                      </div>
                      <div class="modal-footer">
                        <input type="hidden" id="id_responden_del" name="id_responden_del">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <input type="submit" name="delete" class="btn btn-primary" value="Ya">
                      </div>
                    </div>
                  </div>
                <?= form_close() ?>
              </div>

              <div id="publish" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Hapus Data</h4>
                      </div>
                      <div class="modal-body">
                        <h4>Apakah Anda yakin ingin publish data ini ?</h4>

                      </div>
                      <div class="modal-footer">
                        <input type="hidden" id="id_responden_pub" name="id_responden_pub">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <button type="button" class="btn btn-primary" id="btn-simpan">Simpan</button>
                      </div>
                    </div>
                  </div>
                
              </div>

              <div id="unpublish" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                <?= form_open('editor/ipk-management/') ?>
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Hapus Data</h4>
                      </div>
                      <div class="modal-body">
                        <h4>Apakah Anda yakin ingin menghapus data ini ?</h4>

                      </div>
                      <div class="modal-footer">
                        <input type="hidden" id="id_responden_unpub" name="id_responden_unpub">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <input type="submit" name="unpublish" class="btn btn-primary" value="Ya">
                      </div>
                    </div>
                  </div>
                <?= form_close() ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
    
    <!-- jQuery -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- ajax -->
    
    <script src="<?= base_url('assets/js') ?>/datatables.js" type="text/javascript"></script>
    <!-- <script src="<?= base_url('assets/js') ?>/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js') ?>/dataTables.tableTools.js" type="text/javascript"></script> -->
    <script src="<?= base_url('assets/js') ?>/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js') ?>/buttons.print.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js') ?>/buttons.colVis.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js') ?>/buttons.flash.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js') ?>/jszip.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js') ?>/pdfmake.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js') ?>/vfs_fonts.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js') ?>/buttons.html5.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-moment -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/moment/min/moment.min.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="<?= base_url('assets/js') ?>/bootstrap-datetimepicker.min.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/starrr/dist/starrr.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url('assets/dist') ?>/summernote.js"></script>
    
    <!-- tinymce -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/tinymce/js/tinymce.min.js"></script>
    <!-- File Input -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap-imageupload/js/fileinput.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?= base_url('assets/gentelella-master') ?>/build/js/custom.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {

        var table_responden =  $('#datatables').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ],
            ordering:  true,
            "processing": true,
            "scrollY": 750*50/100,
            "paging": true,
            deferRender: true,
            "sAjaxSource":'<?= base_url('index.php/editor/getDataResponden') ?>',
            "columns": [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
            ],    
            "order": [[ 7, "desc" ]], 
            "language": {
                  "lengthMenu": "Tampil dalam _MENU_ halaman",
                  "zeroRecords": "Tidak ada data yang ditampilkan",
                  "info": "<br>Lihat  _START_ sampai _END_ dari _TOTAL_ semua entri",
                  "infoEmpty": "Data yang dicari tidak ada ",
                  "infoFiltered": "(pencarian dari _MAX_ total data)",
                  "search":"Cari ",
                  "paginate": {
                    "next": "lanjut",
                    "previous": "sebelum"
                }
              }

        });

        var table_published =  $('#datapublished').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ],
            ordering:  true,
            "processing": true,
            "scrollY": 750*50/100,
            "paging": true,
            deferRender: true,
            "sAjaxSource":'<?= base_url('index.php/editor/getDataPublished') ?>',
            "columns": [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
            ],    
            "order": [[ 7, "desc" ]], 
            "language": {
                  "lengthMenu": "Tampil dalam _MENU_ halaman",
                  "zeroRecords": "Tidak ada data yang ditampilkan",
                  "info": "<br>Lihat  _START_ sampai _END_ dari _TOTAL_ semua entri",
                  "infoEmpty": "Data yang dicari tidak ada ",
                  "infoFiltered": "(pencarian dari _MAX_ total data)",
                  "search":"Cari ",
                  "paginate": {
                    "next": "lanjut",
                    "previous": "sebelum"
                }
              }

        });
          
       
          // $('#btn-simpan').on( 'click', function () {
          //     t.row.add( [
          //         counter +'.1',
          //         counter +'.2',
          //         counter +'.3',
          //         counter +'.4',
          //         counter +'.5',
          //         counter +'.4',
          //         counter +'.4',
          //         counter +'.4',
          //         counter +'.4',
          //         counter +'.4'
          //     ] ).draw();
       
          //     counter++;
          // } );
       
      

      function ipk(){
        $.getJSON("<?= base_url('index.php/editor/data_ipk') ?>", function(data) {
          // $('#ipk').remove();
          $('#ipk').html(data.ipk);
          $('#ipk1').html(data.ipk);
          // $('#jlmunpublish').html(data.junpublish);
          // $('#jmlpublished').html(data.jpublished);
          // $('#jmlresponden').html(data.jresponden);
        });
      }

      function publish_button(id){
        // var getidresponden = id;
        var data = {
            "publish": true,
            "id_responden": id
          };
        $.ajax({
           type: "POST",
           url: '<?= base_url('index.php/editor/publishDataResponden') ?>',
           data: data,
           success: function(){
             table_responden.ajax.reload(null, false);
             table_published.ajax.reload(null, false);
             ipk();
           }
        });
      }

      function unpublish_button(id){
        // var getidresponden = id;
        var data = {
            "unpublish": true,
            "id_responden": id
          };
        $.ajax({
           type: "POST",
           url: '<?= base_url('index.php/editor/publishDataResponden') ?>',
           data: data,
           success: function(){
             table_responden.ajax.reload(null, false);
             table_published.ajax.reload(null, false);
             ipk();
           }
        });
      }

      $('body').on('click','.publish',function(){       
          publish_button($(this).data('id'));
      });

      $('body').on('click','.unpublish',function(){       
          unpublish_button($(this).data('id'));
      });
      
    });

      $('#btn-simpan').click(function(){
        var data = {
          "publish": true,
          "id_responden_pub": $('#id_responden_pub').val()
        };

        $.ajax({
          url: '<?= base_url('index.php/editor/publishData') ?>',
          type: 'POST',
          data: data,
          
          success: function(){
            $('#publish').modal('hide');
            
            $('#view').load('<?= base_url('index.php/editor/publishData') ?>');
          }
        });
      });

      function deleteData(id_responden){
          $('#id_responden_del').val(id_responden); 
      }
      
  </script>
        
    