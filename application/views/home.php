
        <section class="section-whitebg dm-shadow">
        <div class="container">
            <div class="general_wrapper clearfix">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 first clearfix">
                    

                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                        <?php $i=0; ?>
                        <?php foreach ($banners as $banner): ?>
                            <?php if($i == 0): ?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?= $i; ?>" class="active"></li>
                                <?php $i++; ?>
                            <?php else: ?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?= $i; ?>" class=""></li>
                                <?php $i++; ?>
                            <?php endif; ?>
                            <!-- <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
                            <li data-target="#carousel-example-generic" data-slide-to="4" class=""></li> -->
                        <?php endforeach; ?>
                        </ol>
                        
                        <div class="carousel-inner">
                        <?php $j=0; ?>
                        <?php foreach ($banners as $banner): ?>
                            <?php if($j == 0): ?>
                                <div class="item active">
                                    <img alt="Slide <?= $banner->id_banner ?>" src="<?= base_url() ?>/doc_file/banner/<?= $banner->gambar ?>" style="width:100%; height: 412px;">
                                    <div class="carousel-caption">
                                        <h2 style="color: #ffffff;"><?= $banner->judul ?></h2>
                                        <p style="color: #ffffff;"><?= $banner->deskripsi ?></p>
                                    </div>
                                </div>
                                <?php $j++; ?>
                            <?php else: ?>
                                <div class="item">
                                    <img alt="Slide <?= $banner->id_banner ?>" src="<?= base_url() ?>/doc_file/banner/<?= $banner->gambar ?>" style="width:100%; height: 412px;">
                                    <div class="carousel-caption">
                                        <h2 style="color: #ffffff;"><?= $banner->judul ?></h2>
                                        <p style="color: #ffffff;"><?= $banner->deskripsi ?></p>
                                    </div>
                                </div>
                                <?php $j++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </div>

                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next" style="right: 0;"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        
                    </div>  
                </div><!-- end col-6 -->
    
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 last clearfix">
                    <div class="text-left effect-slide-right in" data-effect="slide-right" style="transition: all 0.7s ease-in-out;">
                        <div class="widget-title">
                            <h3>
                            <span>REFORMASI BIROKRASI</span>
                            </h3>
                            <hr>
                        </div><!-- end servicetitle -->
                            <p id="carousel-text" style="text-align: justify;"><b>Reformasi Birokrasi di Lembaga Penerbangan dan Antariksa Nasional (LAPAN) dilaksanakan dalam rangka perwujudan pelaksanaan Kebijakan Nasional yang merupakan komitmen dan kesadaran Lapan, untuk meningkatkan kinerja birokrasi yang dinyatakan dalam visi, misi, tujuan, sasaran dan target Reformasi Birokrasi Lembaga Penerbangan dan Antariksa Nasional.</b></p> 
                    </div><!-- end about widget -->
                </div><!-- end col-lg-6 -->
            </div><!-- general_wrapper -->
        </div><!-- end container -->
    </section>
    <section class="section-single blog-wrapper dm-shadow">
        <div class="container">
            <div class="clearfix">
                    <font size="3"><b>Kegiatan Reformasi Birokrasi</b></font><br><br>
                        <div id="Carousel" class="carousel slide" data-ride="carousel">
                            <!-- <ol class="carousel-indicators">
                                <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#Carousel" data-slide-to="1"></li>
                                <li data-target="#Carousel" data-slide-to="2"></li>
                            </ol> -->
                            <div class="carousel-inner">
                            <?php $i = 1; ?>
                            <?php foreach($Berita as $berita): ?>    
                                <?php 
                                    $id_berita[$i] = $berita->id_berita;
                                    $deskripsi[$i] = $berita->deskripsi_berita;
                                    $judul[$i] = $berita->judul_berita; 
                                    $slug[$i] = $berita->slug; 
                                    $gambar[$i] = $berita->gambar_berita;
                                    $status[$i] = $berita->status;
                                    $i++; 
                                ?>
                            <?php endforeach; ?>
                            <?php if(count($judul) == 0): ?>
                                <div class="item">
                                    <div class="row"></div>
                                </div>
                            <?php elseif(count($judul) <= 4): ?>
                                <div class="item active">
                                    <div class="row">
                                    <?php for($j = 1; $j <= 4; $j++){ ?>
                                        <?php if(!empty($judul[$j])): ?>
                                              <div class="col-md-3 col-sm-3">
                                                <a href="<?php echo base_url('index.php/berita/view'); ?>/<?php echo $slug[$j]; ?>" class="thumbnail" style="height: 338px">
                                                    <img src="<?php echo base_url(); ?>doc_file/berita/<?php echo $gambar[$j]; ?>" class="img-thumbnail" alt="Image" style="width:245px; height: 150px;">
                                                    <div class="caption">
                                                        <h4 style="text-transform: uppercase;"><?php echo $judul[$j]; ?></h4>
                                                        <p><?php echo strip_tags(substr($deskripsi[$j],0,100)); ?> ...</p>
                                                    </div>
                                                </a>
                                              </div>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    <?php } ?>  
                                    </div><!--.row-->
                                </div><!--.item-->
                            
                            <?php else: ?>
                                <div class="item active">
                                    <div class="row">
                                    <?php for($h = 1; $h <= 4; $h++){ ?>
                                        <?php if(!empty($judul[$h])): ?>
                                              <div class="col-md-3 col-sm-3">
                                                <a href="<?php echo base_url('index.php/berita/view'); ?>/<?php echo $slug[$h]; ?>" class="thumbnail" style="height: 338px">
                                                    <img src="<?php echo base_url(); ?>doc_file/berita/<?php echo $gambar[$h]; ?>" class="img-thumbnail" alt="Image" style="width:245px; height: 150px;">
                                                    <div class="caption">
                                                        <h4 style="text-transform: uppercase;"><?php echo $judul[$h]; ?></h4>
                                                        <p><?php echo strip_tags(substr($deskripsi[$h],0,100)); ?> ...</p>
                                                    </div>
                                                </a>
                                              </div>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    <?php } ?>  
                                    </div><!--.row-->
                                </div><!--.item-->
                                <div class="item">
                                    <div class="row">
                                    <?php for($k = 5; $k <= 8; $k++){ ?>
                                        <?php if(!empty($judul[$k])): ?>
                                              <div class="col-md-3 col-sm-3">
                                                <a href="<?php echo base_url('index.php/berita/view'); ?>/<?php echo $slug[$k]; ?>" class="thumbnail" style="height: 338px">
                                                    <img src="<?php echo base_url(); ?>doc_file/berita/<?php echo $gambar[$k]; ?>" class="img-thumbnail" alt="Image" style="width:245px; height: 150px;">
                                                    <div class="caption">
                                                        <h4 style="text-transform: uppercase;"><?php echo $judul[$k]; ?></h4>
                                                        <p><?php echo strip_tags(substr($deskripsi[$k],0,100)); ?> ...</p>
                                                    </div>
                                                </a>
                                              </div>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    <?php } ?>      
                                    </div><!--.row-->
                                </div><!--.item-->
                            <?php endif; ?>
                            </div>
                        </div>
            </div><!-- end general_wrapper -->
        </div><!-- end container -->
    </section>
    <section class="section-whitebg dm-shadow">
        <div class="container">
            <div class="general_wrapper clearfix">
                <div class="col-md-6">
                <div class="sidebar">
                    <h2>
                        <span class="line">
                            <center><i class="fa fa-bar-chart"> Parameter Pencapaian</i></center>
                        </span>
                    </h2>
                    <?php foreach($Pencapaian as $pencapaian): ?>
                                          
                        <span class="bar-label"><?= $pencapaian->nama ?></span>
                        
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="<?= $pencapaian->nilai ?>"
                              aria-valuemin="0" aria-valuemax="100" style="width:<?= $pencapaian->nilai ?>%">
                                <?= $pencapaian->nilai ?>%
                              </div>
                            </div>
                        
                    
                    <?php endforeach; ?>
                </div>
                </div>
                <div class="col-md-6">
                <div class="sidebar">
                    <h2>
                        <span class="line">
                            <center><i class="fa fa-pie-chart"> Diagram Pencapaian</i></center>
                        </span>
                    </h2>
                    <canvas id="chart1" width="100" height="100"></canvas>
                </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function($) {
          navbar_active('#nb_beranda');
        });
      </script>
    
