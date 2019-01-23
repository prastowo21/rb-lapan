<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <?php $id_role = $this->session->userdata('id_role'); ?>
              <?php if (isset($id_role) && $id_role == 1): ?>
                <a href="<?= base_url('index.php/admin') ?>" class="site_title"><i class="fa fa-rocket"></i> <span>RB LAPAN</span></a>
              <?php elseif (isset($id_role) && $id_role == 2): ?>
                <a href="<?= base_url('index.php/editor') ?>" class="site_title"><i class="fa fa-rocket"></i> <span>RB LAPAN</span></a>
              <?php endif; ?>   
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <?php if($foto!='') : ?>
                  <img src="<?= base_url('/doc_file/pas_foto/'.$foto) ?>" alt="" class="img-circle profile_img"/>
                <?php elseif($foto == '') : ?>
                  <span class="fa fa-user"></span>
                <?php endif; ?>
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>
                    <?php 
                      $id_role = $this->session->userdata('id_role');
                      if (isset($id_role) && $id_role == 1): ?>
                      <?= $admin->nama ?>
                    <?php elseif (isset($id_role) && $id_role == 2): ?>
                      <?= $editor->nama ?>
                    <?php endif; ?>    
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                <?php if (isset($id_role)): ?>
                  <?php if ($id_role == 1): ?>
                    <?php if ($news == "on"): ?>
                      <li>
                        <a href="<?= base_url('index.php/admin/news-management') ?>"><i class="fa fa-edit"></i> News Management <span></span></a>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($user == "on"): ?>
                      <li>
                        <a><i class="fa fa-users"></i> User Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?= base_url('index.php/admin/admin-management') ?>">Admin Management</a></li>
                          <li><a href="<?= base_url('index.php/admin/editor-management') ?>">User Management</a></li>
                        </ul>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($banner == "on"): ?>
                      <li>
                        <a href="<?= base_url('index.php/admin/banner-management') ?>"><i class="fa fa-flag"></i> Banner Management <span></span></a>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($menu == "on"): ?>
                      <li>
                        <a><i class="fa fa-bars"></i> Profile Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?= base_url('index.php/admin/vimi-management') ?>">Visi dan Misi</a></li>
                          <li><a href="<?= base_url('index.php/admin/tujuan-management') ?>">Tujuan</a></li>
                          <li><a href="<?= base_url('index.php/admin/sasaran-management') ?>">Sasaran dan Indikator Keberhasilan</a></li>
                          <li><a href="<?= base_url('index.php/admin/peraturanrb-management') ?>">Peraturan RB</a></li>
                          <li><a href="<?= base_url('index.php/admin/quickwin-management') ?>">Quickwins</a></li>
                          <li><a href="<?= base_url('index.php/admin/kebijakan-management') ?>">Kebijakan</a></li>
                          <li><a href="<?= base_url('index.php/admin/buletin-management') ?>">Buletin</a></li>
                          <li><a href="<?= base_url('index.php/admin/roadmap-management') ?>">Roadmap</a></li>
                        </ul>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($diagram == "on"): ?>
                      <li>
                        <a href="<?= base_url('index.php/admin/diagram-management') ?>"><i class="fa fa-pie-chart"></i> Diagram Management <span></span></a>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($capaian == "on"): ?>
                      <li>
                        <a><i class="fa fa-line-chart"></i> Capaian Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?= base_url('index.php/admin/manajemen-perubahan-management') ?>">Manajemen Perubahan</a></li>
                          <li><a href="<?= base_url('index.php/admin/penataan-peraturan-uu-management') ?>">Penataan Peraturan Perundang-Undangan</a></li>
                          <li><a href="<?= base_url('index.php/admin/penataan-dan-penguatan-organisasi-management') ?>">Penataan dan Penguatan Organisasi</a></li>
                          <li><a href="<?= base_url('index.php/admin/penataan-tatalaksana-management') ?>">Penataan Tatalaksana</a></li>
                          <li><a href="<?= base_url('index.php/admin/penataan-sistem-manajemen-sdm-management') ?>">Penataan Sistem Manajemen SDM</a></li>
                          <li><a href="<?= base_url('index.php/admin/penguatan-pengawasan-management') ?>">Penguatan Pengawasan</a></li>
                          <li><a href="<?= base_url('index.php/admin/penguatan-akuntabilitas-kinerja-management') ?>">Penguatan Akuntabilitas Kinerja</a></li>
                          <li><a href="<?= base_url('index.php/admin/peningkatan-kualitas-pelayanan-publik-management') ?>">Peningkatan Kualitas Pelayanan Publik</a></li>
                        </ul>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($ikm == "on"): ?>
                      <li>
                        <a href="<?= base_url('index.php/admin/ikm-management') ?>"><i class="fa fa-thumbs-up"></i> IKM Management <span></span></a>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($ipk == "on"): ?>
                      <li>
                        <a href="<?= base_url('index.php/admin/ipk-management') ?>"><i class="fa fa-gavel"></i> IPK Management <span></span></a>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                  <?php elseif ($id_role == 2): ?> 
                    <?php if ($news == "on"): ?>
                      <li>
                        <a href="<?= base_url('index.php/editor/news-management') ?>"><i class="fa fa-edit"></i> News Management <span></span></a>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($user == "on"): ?>
                      <li>
                        <a><i class="fa fa-users"></i> User Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?= base_url('index.php/editor/admin-management') ?>">Admin Management</a></li>
                          <li><a href="<?= base_url('index.php/editor/editor-management') ?>">User Management</a></li>
                        </ul>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($banner == "on"): ?>
                      <li>
                        <a href="<?= base_url('index.php/editor/banner-management') ?>"><i class="fa fa-flag"></i> Banner Management <span></span></a>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($menu == "on"): ?>
                      <li>
                        <a><i class="fa fa-bars"></i> Profile Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?= base_url('index.php/editor/vimi-management') ?>">Visi dan Misi</a></li>
                          <li><a href="<?= base_url('index.php/editor/tujuan-management') ?>">Tujuan</a></li>
                          <li><a href="<?= base_url('index.php/editor/sasaran-management') ?>">Sasaran dan Indikator Keberhasilan</a></li>
                          <li><a href="<?= base_url('index.php/editor/peraturanrb-management') ?>">Peraturan RB</a></li>
                          <li><a href="<?= base_url('index.php/editor/quickwin-management') ?>">Quickwins</a></li>
                          <li><a href="<?= base_url('index.php/editor/kebijakan-management') ?>">Kebijakan</a></li>
                          <li><a href="<?= base_url('index.php/editor/buletin-management') ?>">Buletin</a></li>
                          <li><a href="<?= base_url('index.php/editor/roadmap-management') ?>">Roadmap</a></li>
                        </ul>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($diagram == "on"): ?>
                      <li>
                        <a href="<?= base_url('index.php/editor/diagram-management') ?>"><i class="fa fa-pie-chart"></i> Diagram Management <span></span></a>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($capaian == "on"): ?>
                      <li>
                        <a><i class="fa fa-line-chart"></i> Capaian Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?= base_url('index.php/editor/manajemen-perubahan-management') ?>">Manajemen Perubahan</a></li>
                          <li><a href="<?= base_url('index.php/editor/penataan-peraturan-uu-management') ?>">Penataan Peraturan Perundang-Undangan</a></li>
                          <li><a href="<?= base_url('index.php/editor/penataan-dan-penguatan-organisasi-management') ?>">Penataan dan Penguatan Organisasi</a></li>
                          <li><a href="<?= base_url('index.php/editor/penataan-tatalaksana-management') ?>">Penataan Tatalaksana</a></li>
                          <li><a href="<?= base_url('index.php/editor/penataan-sistem-manajemen-sdm-management') ?>">Penataan Sistem Manajemen SDM</a></li>
                          <li><a href="<?= base_url('index.php/editor/penguatan-pengawasan-management') ?>">Penguatan Pengawasan</a></li>
                          <li><a href="<?= base_url('index.php/editor/penguatan-akuntabilitas-kinerja-management') ?>">Penguatan Akuntabilitas Kinerja</a></li>
                          <li><a href="<?= base_url('index.php/editor/peningkatan-kualitas-pelayanan-publik-management') ?>">Peningkatan Kualitas Pelayanan Publik</a></li>
                        </ul>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($ikm == "on"): ?>
                      <li>
                        <a href="<?= base_url('index.php/editor/ikm-management') ?>"><i class="fa fa-thumbs-up"></i> IKM Management <span></span></a>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($ipk == "on"): ?>
                      <li>
                        <a href="<?= base_url('index.php/editor/ipk-management') ?>"><i class="fa fa-gavel"></i> IPK Management <span></span></a>
                      </li>
                    <?php else : ?>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            
          </div>
        </div>
        