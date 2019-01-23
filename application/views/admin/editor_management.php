
    <!-- Bootstrap -->
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- File Input -->
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap-imageupload/css/fileinput.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets/gentelella-master') ?>/build/css/custom.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="clearfix"></div>

              
                  <?= $this->session->flashdata('msg') ?>
                  

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>User Management <small>User</small></h2>
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
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php $No=1; ?>
                            <?php foreach ($pengguna as $user): ?>
                              

                              <tr>
                                <td><?= $No++; ?></td>
                                <td><?= $user->id_user ?></td>
                                <td><?= $this->editor_m->get_row(array('id_user' => $user->id_user))->nama ?></td>
                                <td><?= $this->editor_m->get_row(array('id_user' => $user->id_user))->email ?></td>
                                <td><?= $this->editor_m->get_row(array('id_user' => $user->id_user))->telepon ?></td>
                                <td>
                                  <a href="#changePrivilege" onclick="retrievePrivilege('<?= $user->id_user ?>');" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> Change Privilage </a>
                                  <a href="#delete" onclick="deleteUser('<?= $user->id_user ?>');" data-toggle="modal" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" > Delete</i></a>
                                </td>
                              </tr>
                              
                            <?php endforeach; ?>
                            </tbody>
                          </table>
                          <a href="#tambah" data-toggle="modal" class="btn btn-info"><i class="fa fa-plus"></i> Tambah User</a>
                        </div>
                      </div>
                    </div>
                    
                    <div id="delete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <?= form_open('admin/editor-management/') ?>
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Hapus User</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Apakah Anda yakin ingin menghapus user ini ?</h4>
                            
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" id="id_user_del" name="id_user_del">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <input type="submit" name="delete" class="btn btn-primary" value="Ya">
                          </div>
                        </div>
                      </div>
                      <?= form_close() ?>
                    </div>

                    <div id="tambah" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">

                    <?= form_open_multipart('admin/editor-management',array('class' => 'form-horizontal')) ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
                          </div>
                          <div class="modal-body">

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="nama" name="nama" required="required" class="form-control col-md-7 col-xs-12" value="">
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Username <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="id_user" name="id_user" required="required" class="form-control col-md-7 col-xs-12" value="">
                                <input type="hidden" id="id_role" name="id_role" required="required" class="form-control col-md-7 col-xs-12" value="">
                              </div>
                            </div>
                                
                            <div class="form-group" data-parsley-validate>
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" data-parsley-trigger="change">
                              </div>
                            </div>
                            <div class="item form-group">
                              <label for="password" class="control-label col-md-3">Password <span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Privilege <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="add_news" id="add_news" />News Management
                                  </label>
                                </div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="add_banner" id="add_banner" />Banner Management
                                  </label>
                                </div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="add_menu" id="add_menu" />Profile Management
                                  </label>
                                </div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="add_diagram" id="add_diagram" />Diagram Management
                                  </label>
                                </div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="add_capaian" id="add_capaian" />Capaian Management
                                  </label>
                                </div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="add_ikm" id="add_ikm" />IKM Management
                                  </label>
                                </div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="add_ipk" id="add_ipk" />IPK Management
                                  </label>
                                </div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="add_pub_news" id="add_pub_news" />Publish News
                                  </label>
                                </div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="add_pub_banner" id="add_pub_banner" />Publish Banner
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Telepon <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="telepon" name="telepon" required="required" class="form-control col-md-7 col-xs-12" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Pas Foto <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" id="pasfoto" name="pasfoto" accept="image/*" multiple class="file-loading">
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

                    <div id="changePassword" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">

                    <?= form_open('admin/editor-management',array('class' => 'form-horizontal')) ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                          </div>
                          <div class="modal-body">
                            <div class="item form-group">
                              <label for="password" class="control-label col-md-3">Old Password <span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="old_password_input" type="password" name="old_password_input" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                              </div>
                            </div>
                          
                            <div class="item form-group">
                              <label for="password" class="control-label col-md-3">New Password <span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="new_password" type="password" name="new_password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                              </div>
                            </div>
                            <div class="item form-group">
                              <label for="password" class="control-label col-md-3">Repeat Password <span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="rpt_password" type="password" name="rpt_password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                              </div>
                            </div>
                          <div class="modal-footer">
                            <input type="hidden" id="id_user_psw" name="id_user_psw">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="change" class="btn btn-primary" value="Submit">
                          </div>
                        </div>
                      </div>
                    </div>
                    <?= form_close() ?>
                    </div>

                    <div id="changePrivilege" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">

                    <?= form_open('admin/editor-management',array('class' => 'form-horizontal')) ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Change Privilage</h4>
                          </div>
                          <div class="modal-body">
                            
                              <div class="x_panel">
                                <div class="x_title">
                                  <h2>Basic Tables <small>basic table subtitle</small></h2>
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

                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Nama</th>
                                        <th>Privilage</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td><p id="nama_user"></p></td>
                                        <td>
                                          <div class="checkbox">
                                            <label>
                                              <center><input type="checkbox" name="chg_news" id="chg_news">News Management</center>
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                            <label>
                                              <center><input type="checkbox" name="chg_user" id="chg_user">User Management</center>
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                            <label>
                                              <center><input type="checkbox" name="chg_banner" id="chg_banner">Banner Management</center>
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                            <label>
                                              <center><input type="checkbox" name="chg_menu" id="chg_menu">Profile Management</center>
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                            <label>
                                              <center><input type="checkbox" name="chg_diagram" id="chg_diagram">Diagram Management</center>
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                            <label>
                                              <center><input type="checkbox" name="chg_capaian" id="chg_capaian">Capaian Management</center>
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                            <label>
                                              <center><input type="checkbox" name="chg_ikm" id="chg_ikm">IKM Management</center>
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                            <label>
                                              <center><input type="checkbox" name="chg_ipk" id="chg_ipk">IPK Management</center>
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                            <label>
                                              <center><input type="checkbox" name="chg_pub_news" id="chg_pub_news">Publish News</center>
                                            </label>
                                          </div>
                                          <div class="checkbox">
                                            <label>
                                              <center><input type="checkbox" name="chg_pub_banner" id="chg_pub_banner">Publish Banner</center>
                                            </label>
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>

                                </div>
                              </div>
                           
                          <div class="modal-footer">
                            <input type="hidden" name="id_user_privilege" id="id_user_privilege">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="changePrivilege" class="btn btn-primary" value="Submit">
                          </div>
                        </div>
                      </div>
                    </div>
                    <?= form_close() ?>
                    </div>
                    
              
                  </div>
                </div>
              </div>
            
    <!-- jQuery -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ajax -->
    <script src="<?= base_url('assets/js') ?>/ajax.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/iCheck/icheck.min.js"></script>
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

    <!-- Custom Theme Scripts -->
    <script src="<?= base_url('assets/gentelella-master') ?>/build/js/custom.min.js"></script>

    <script type="text/javascript">

      $(document).ready(function() {
        $("#pasfoto").fileinput({
          overwriteInitial: false,
          maxFileSize: 200,
          showUpload: false
        });
      });

      function changePassword(id_user){
          $('#id_user_psw').val(id_user);
      }

      function deleteUser(id_user){
          $('#id_user_del').val(id_user);
      }

      function retrievePrivilege(id_user){
          $.get('<?= base_url('index.php/admin/editor-management') ?>' + '/' + id_user, function(data) {
            data = JSON.parse(data);
            $('#id_user_privilege').val(id_user);
            document.getElementById("nama_user").innerHTML = id_user;
            if(data.news == "on"){
              $('#chg_news').prop('checked', true);  
            }else{
              $('#chg_news').prop('checked', false);
            }
            if(data.banner == "on"){
              $('#chg_banner').prop('checked', true);  
            }else{
              $('#chg_banner').prop('checked', false);
            }
            if(data.menu == "on"){
              $('#chg_menu').prop('checked',true);  
            }else{
              $('#chg_menu').prop('checked', false);
            }
            if(data.diagram == "on"){
              $('#chg_diagram').prop('checked', true);  
            }else{
              $('#chg_diagram').prop('checked', false);
            }
            if(data.capaian == "on"){
              $('#chg_capaian').prop('checked', true);  
            }else{
              $('#chg_capaian').prop('checked', false);
            }
            if(data.ikm == "on"){
              $('#chg_ikm').prop('checked', true);  
            }else{
              $('#chg_ikm').prop('checked', false);
            }
            if(data.ipk == "on"){
              $('#chg_ipk').prop('checked', true);
            }else{
              $('#chg_ipk').prop('checked', false);
            }
            if(data.pub_news == "on"){
              $('#chg_pub_news').prop('checked', true);
            }else{
              $('#chg_pub_news').prop('checked', false);
            }
            if(data.pub_banner == "on"){
              $('#chg_pub_banner').prop('checked', true);
            }else{
              $('#chg_pub_banner').prop('checked', false);
            }
            
          });
      }
  </script>
        
    