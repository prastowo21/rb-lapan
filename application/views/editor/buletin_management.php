<!-- Bootstrap -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
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
<!-- Summernote -->
<link href="<?= base_url('assets/dist') ?>/summernote.css" rel="stylesheet">
<!-- Datatables -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<!-- File Input -->
<link href="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap-imageupload/css/fileinput.min.css" rel="stylesheet">
<!-- Image Zoom -->
<link href="<?= base_url('assets/css') ?>/image_zoom.css" rel="stylesheet">
<!-- ekko-lightbox -->
<link href="<?= base_url('assets/css') ?>/ekko-lightbox.css" rel="stylesheet">

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  
                  <?= $this->session->flashdata('msg') ?>
                  <div class="x_content">
                      
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Profile Management <small>Buletin</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                              </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <!-- <p class="text-muted font-13 m-b-30">
                            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                          </p> -->
                          
                          <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>NO</th>
                                <th>Title</th>
                                <th>Tahun</th>
                                <th>Deskripsi</th>
                                <th>Cover</th>
                                <th>Dokumen</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php $No=1; ?>
                            <?php foreach ($Buletin as $buletin): ?>
                              
                              <tr>
                                <td><?= $No++; ?></td>
                                <td><?= $buletin->title ?></td>
                                <td><?= $buletin->tahun ?></td>
                                <td><?= $buletin->deskripsi ?></td>
                                <td>
                                  <div class="col-md-3">
                                    <a href="<?= base_url() ?>doc_file/buletin/cover/<?= $buletin->cover ?>" data-toggle="lightbox">
                                      <img class="thumbnail" src="<?= base_url() ?>doc_file/buletin/cover/<?= $buletin->cover ?>" alt="<?= $buletin->title ?>">
                                    </a>
                                  </div>
                                </td>
                                <td>
                                  <a href="<?= base_url() ?>doc_file/buletin/dokumen/<?= $buletin->dokumen ?>" target="_blank"><?= $buletin->dokumen ?></a>
                                </td>
                                <td>
                                  <a href="#edit" onclick="retrieveData('<?= $buletin->id_buletin ?>');" data-toggle="modal" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                  <a href="#delete" onclick="deleteData('<?= $buletin->id_buletin ?>');" data-toggle="modal" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" ></i> Delete </a>
                                </td>
                              </tr>
                              
                            <?php endforeach; ?>
                            </tbody>
                          </table>
                          
                          <a href="#tambah" data-toggle="modal" class="btn btn-info"><i class="fa fa-plus"></i> Tambah </a>
                        </div>
                      </div>
                    </div>

                    <div id="delete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <?= form_open('editor/buletin-management') ?>
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
                            <input type="hidden" name="id_buletin_del" id="id_buletin_del" value="">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <input type="submit" name="delete" class="btn btn-primary" value="Ya">
                          </div>
                        </div>
                      </div>
                      <?= form_close() ?>
                    </div>
                    
                    <div id="tambah" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <?= form_open_multipart('editor/buletin-management',array('class' => 'form-horizontal')) ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Tambah </h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Title <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tahun <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="tahun" name="tahun" required="required" class="form-control col-md-7 col-xs-12" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Deskripsi <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="deskripsi" name="deskripsi"></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Cover <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" id="cover" name="cover" accept="image/*" multiple class="file-loading">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Dokumen <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" id="dokumen" name="dokumen" multiple class="file-loading">
                              </div>
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="tambah" class="btn btn-primary" value="Submit">
                          </div>
                        </div>
                      </div>
                    </div>
                    <?= form_close() ?>
                    </div>

                    <div id="edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <?= form_open_multipart('editor/buletin-management',array('class' => 'form-horizontal')) ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Edit </h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Title <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="title_baru" name="title_baru" required="required" class="form-control col-md-7 col-xs-12" value="">
                                <input type="hidden" id="id_buletin_baru" name="id_buletin_baru" required="required" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tahun <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="tahun_baru" name="tahun_baru" required="required" class="form-control col-md-7 col-xs-12" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Deskripsi <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="deskripsi_baru" name="deskripsi_baru"></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Cover <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" id="cover_baru" name="cover_baru" accept="image/*" multiple class="file-loading">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Dokumen <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" id="dokumen_baru" name="dokumen_baru" multiple class="file-loading">
                              </div>
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="edit" class="btn btn-primary" value="Submit">
                          </div>
                        </div>
                      </div>
                    </div>
                    <?= form_close() ?>
                    </div>

                  </div>
                
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
    <script src="<?= base_url('assets/js') ?>/ajax.js" type="text/javascript"></script>
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
    <!-- Datatables -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- tinymce -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/tinymce/js/tinymce.min.js"></script>
    <!-- File Input -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap-imageupload/js/fileinput.min.js"></script>
    <!-- Image Box -->
    <script src="<?= base_url('assets/js') ?>/jquery.imagebox.js"></script>
    <!-- ekko-lightbox -->
    <script src="<?= base_url('assets/js') ?>/ekko-lightbox.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?= base_url('assets/gentelella-master') ?>/build/js/custom.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        tinymce.init({
          selector: 'textarea',
          branding: false,
          theme: 'modern',
          plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
          ],
          toolbar1: 'undo redo | insert | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          toolbar2: 'print preview media | forecolor backcolor emoticons | codesample fullscreen help',
          image_advtab: true,
          templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
          ],
          content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
          ]
         });

        $("#cover").fileinput({
          uploadUrl: '<?= base_url('index.php/editor/coverUploader') ?>',
          overwriteInitial: true,
          autoReplace: true,
          showUploadedThumbs: false,
          maxFileSize: 500,
          maxFileCount: 1,
          uploadAsync: false
        });

        $("#cover_baru").fileinput({
          uploadUrl: '<?= base_url('index.php/editor/coverEditUploader') ?>',
          overwriteInitial: true,
          autoReplace: true,
          showUploadedThumbs: false,
          maxFileSize: 500,
          maxFileCount: 1,
          uploadAsync: false
        });

        $("#dokumen").fileinput({
          uploadUrl: '<?= base_url('index.php/editor/dokumenUploader') ?>',
          overwriteInitial: true,
          autoReplace: true,
          showUploadedThumbs: false,
          maxFileSize: 99999,
          maxFileCount: 1,
          uploadAsync: false,
          allowedFileExtensions: ["pdf"]
        });

        $("#dokumen_baru").fileinput({
          uploadUrl: '<?= base_url('index.php/editor/dokumenEditUploader') ?>',
          overwriteInitial: true,
          autoReplace: true,
          showUploadedThumbs: false,
          maxFileSize: 99999,
          maxFileCount: 1,
          uploadAsync: false,
          allowedFileExtensions: ["pdf"]
        });
    });

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    function retrieveData(id_buletin) {
        $.get('<?= base_url('index.php/editor/buletin-management') ?>' + '/' + id_buletin, function(data) {
          data = JSON.parse(data);
          $('#id_buletin_baru').val(data.id_buletin);
          $('#title_baru').val(data.title);
          $('#tahun_baru').val(data.tahun);
          tinymce.EditorManager.get('deskripsi_baru').setContent(data.deskripsi);
        });
      }

      function deleteData(id_buletin){
          $('#id_buletin_del').val(id_buletin); 
      }
      
  </script>
        
    