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

<div class="right_col" role="main">
  <div class="clearfix"></div>

                  <?= $this->session->flashdata('msg') ?>
                  <div class="x_content">

                    <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->
                    <!-- Trigger the modal with a button -->
                    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> --> 
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>News Management <small>News</small></h2>
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
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Creator</th>
                                <th>Gambar</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php $No=1; ?>
                            <?php foreach ($berita as $news): ?>
                              
                              <tr>
                                <td><?= $No++; ?></td>
                                <td><?= $news->tanggal_berita ?></td>
                                <td><?= $news->judul_berita ?></td>
                                <td>
                                  <?php $id_role = $this->user_m->get_row(array('id_user' => $news->id_user))->id_role ; ?>
                                  <?php if ($id_role == 1): ?>
                                    Ditulis oleh <?= $this->admin_m->get_row(array('id_user' => $news->id_user))->nama ?> (Admin)
                                  <?php elseif ($id_role == 2): ?>
                                    Ditulis oleh <?= $this->editor_m->get_row(array('id_user' => $news->id_user))->nama ?> (Editor)
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <a href="<?= base_url() ?>doc_file/berita/<?= $news->gambar_berita ?>" data-toggle="lightbox">
                                    <img class="thumbnail" src="<?= base_url() ?>doc_file/berita/<?= $news->gambar_berita ?>" alt="<?= $news->judul_berita ?>">
                                  </a>
                                </td>
                                <td>
                                <?php if($pub_news == "on"): ?>
                                  <?php if($news->status == 0): ?>
                                    <a href="#publish" onclick="publishBerita('<?= $news->id_berita ?>');" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Publish </a>
                                  <?php else: ?>
                                    <a href="#unpublish" onclick="unpublishBerita('<?= $news->id_berita ?>');" data-toggle="modal" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Unpublish </a>
                                  <?php endif; ?>
                                  <?php else: ?>
                                <?php endif; ?>
                                  <a href="#edit" onclick="dataBerita('<?= $news->id_berita ?>', '<?= $news->id_user ?>');" data-toggle="modal" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                  <a href="#delete" onclick="deleteBerita('<?= $news->id_berita ?>');" data-toggle="modal" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" > Delete</i></a>
                                </td>
                              </tr>
                              
                            <?php endforeach; ?>
                            </tbody>
                          </table>
                          <a href="#tambah" data-toggle="modal" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Berita</a>
                        </div>
                      </div>
                    </div>


                    <div id="delete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <?= form_open('editor/news-management') ?>
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Hapus Berita</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Apakah Anda yakin ingin menghapus berita ini ?</h4>
                            
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id_berita_del" id="id_berita_del" value="">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <input type="submit" name="delete" class="btn btn-primary" value="Ya">
                          </div>
                        </div>
                      </div>
                      <?= form_close() ?>
                    </div>

                    <div id="publish" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <?= form_open('editor/news-management') ?>
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Publish Berita</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Apakah Anda yakin ingin publish berita ini ?</h4>
                            
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id_berita_pub" id="id_berita_pub" value="">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <input type="submit" name="publish" class="btn btn-primary" value="Ya">
                          </div>
                        </div>
                      </div>
                      <?= form_close() ?>
                    </div>

                    <div id="unpublish" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <?= form_open('editor/news-management') ?>
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Unpublish Berita</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Apakah Anda yakin ingin unpublish berita ini ?</h4>
                            
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id_berita_unpub" id="id_berita_unpub" value="">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <input type="submit" name="unpublish" class="btn btn-primary" value="Ya">
                          </div>
                        </div>
                      </div>
                      <?= form_close() ?>
                    </div>

                    <div id="tambah" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <?= form_open_multipart('editor/news-management',array('class' => 'form-horizontal')) ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Tambah Berita</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal Berita <span class="required">*</span>
                              </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd hh:ii:ss" data-link-field="dtp_input1">
                                      <input class="form-control" id="tanggal_berita" name="tanggal_berita" size="16" type="text" required="required">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                  </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Judul <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="judul_berita" name="judul_berita" required="required" class="form-control col-md-7 col-xs-12" value="">
                                <input type="hidden" id="id_berita" name="id_berita" required="required" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>
                          
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Deskripsi <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="deskripsi_berita" name="deskripsi_berita"></textarea>
                              </div>
                            </div>
                            <!-- <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Creator <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="last-name" required="required" disabled="disabled" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div> -->
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Gambar <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="news_img" name="news_img"  type="file" accept="image/*" multiple class="file-loading">
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

                    <?= form_open_multipart('editor/news-management',array('class' => 'form-horizontal')) ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Edit Berita</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal Berita <span class="required">*</span>
                              </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd hh:ii:ss" data-link-field="dtp_input1">
                                      <input class="form-control" id="tanggal_berita_baru" name="tanggal_berita_baru" size="16" type="text" readonly>
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                  </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Judul <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="judul_berita_baru" name="judul_berita_baru" required="required" class="form-control col-md-7 col-xs-12" >
                                <input type="hidden" id="id_berita_baru" name="id_berita_baru" required="required" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div>
                          
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Deskripsi <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="deskripsi_berita_baru" name="deskripsi_berita_baru"></textarea>
                              </div>
                            </div>
                            <!-- <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Creator <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="creator_baru" name="creator_baru" required="required" disabled="disabled" class="form-control col-md-7 col-xs-12" value="">
                                <input type="hidden" name="id_user_baru" id="id_user_baru">
                              </div>
                            </div> -->
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Gambar <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="news_img_baru" name="news_img_baru"  type="file" accept="image/*" multiple class="file-loading">
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
    <!-- Piefix -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap-imageupload/js/plugins/piefix.min.js"></script>
    <!-- Sortable -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap-imageupload/js/plugins/sortable.min.js"></script>
    <!-- Purify -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap-imageupload/js/plugins/purify.min.js"></script>
    <!-- File Input -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap-imageupload/js/fileinput.min.js"></script>
    <!-- tinymce -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/tinymce/js/tinymce.min.js"></script>
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

      $("#news_img").fileinput({
        overwriteInitial: false,
        maxFileSize: 200,
        showUpload: false
      });
      $("#news_img_baru").fileinput({
        overwriteInitial: false,
        maxFileSize: 200,
        showUpload: false
      });
    });

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });

    function dataBerita(id_berita, id_user) {
        $.get('<?= base_url('index.php/editor/news-management') ?>' + '/' + id_berita + '/' + id_user, function(data) {
          data = JSON.parse(data);
          $('#id_berita_baru').val(data.id_berita);
          $('#tanggal_berita_baru').val(data.tanggal_berita);
          $('#judul_berita_baru').val(data.judul_berita);
          //$('#deskripsi_berita_baru').val(data.deskripsi_berita);
          tinymce.EditorManager.get('deskripsi_berita_baru').setContent(data.deskripsi_berita);
          $('#creator_baru').val(data.creator);
          $('#id_user_baru').val(data.id_user);
        });
      }

      function publishBerita(id_berita){
          $('#id_berita_pub').val(id_berita);
      }

      function unpublishBerita(id_berita){
          $('#id_berita_unpub').val(id_berita);
      }

      function deleteBerita(id_berita){
          $('#id_berita_del').val(id_berita);
      }
      
  </script>
        
    