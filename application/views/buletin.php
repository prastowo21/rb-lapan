<!-- Image Zoom -->
<link href="<?= base_url('assets/css') ?>/image_zoom.css" rel="stylesheet">
<!-- ekko-lightbox -->
<link href="<?= base_url('assets/css') ?>/ekko-lightbox.css" rel="stylesheet">

<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">  
			<div class="col-md-12 col-md-offset-0">
			  	<ul class="nav nav-tabs">
			  	<?php if(empty($Buletin)): ?>
			  		<div class="container">
			  			<div class="jumbotron">
                			<h4 class="text-center">Belum ada data buletin yang diterbitkan</h4>
                		</div>
                	</div>
                <?php else: ?>
			  	<?php $i = 1; ?>
                <?php foreach ($Buletin as $buletin): ?>
                	<?php 
                        $id_buletin[$i] = $buletin->id_buletin;
                        $deskripsi[$i] = $buletin->deskripsi;
                        $title[$i] = $buletin->title; 
                        $tahun[$i] = $buletin->tahun;
                        $cover[$i] = $buletin->cover;
                        $dokumen[$i] = $buletin->dokumen;
                        $i++; 
                    ?>
                <?php endforeach; ?>
                
                <?php 
                    $thn = array_values(array_unique($tahun));
                ?>

                

                <?php for ($l = 0; $l < count($thn); $l++) { ?>
                    <?php if($l == 0): ?>
						<li class="active"><a data-toggle="tab" href="#<?php echo $l; ?>"><?php echo $thn[$l]; ?></a></li>
                    <?php else: ?>
					  	<li><a data-toggle="tab" href="#<?php echo $l; ?>"><?php echo $thn[$l]; ?></a></li>
					<?php endif; ?>
					 <!--<li><a data-toggle="tab" href="#menu2">2015</a></li> -->
				<?php } ?>
				</ul>

				<div class="tab-content">
					<?php for ($j = 0; $j < count($thn); $j++) { ?>
					  <?php $blt = $this->menu_buletin_m->get(array('tahun' => $thn[$j])); ?>
					  <?php if ($j == 0): ?>
						  <div id="<?php echo $j; ?>" class="tab-pane fade in active">
						  <?php foreach($blt as $bltn): ?>
						    <div class="well">
						      <div class="media">
						      	<a class="pull-left">
						    		<div class="col-md-3">
	                                <a href="<?= base_url() ?>doc_file/buletin/cover/<?= $bltn->cover ?>" data-toggle="lightbox">
	                                  <img class="thumbnail" src="<?= base_url() ?>doc_file/buletin/cover/<?= $bltn->cover ?>" alt="aaaa">
	                                </a>
	                              </div>
						  		</a>
						  		<div class="media-body">
						    		<h3 class="text-left"><strong><?= $bltn->title ?></strong></h3>
							        <!-- <div class="text-right">By Francisco</div> -->
							        <p><?= $bltn->deskripsi ?></p>
							        <p><a href="<?= base_url() ?>doc_file/buletin/dokumen/<?= $bltn->dokumen ?>" target="_blank">Selengkapnya . . .</a></p>
						          	<!-- <ul class="list-inline list-unstyled">
							  			<li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li>
							            <li>|</li>
							            <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>
							            <li>|</li>
							            <li>
							               <span class="glyphicon glyphicon-star"></span>
							                        <span class="glyphicon glyphicon-star"></span>
							                        <span class="glyphicon glyphicon-star"></span>
							                        <span class="glyphicon glyphicon-star"></span>
							                        <span class="glyphicon glyphicon-star-empty"></span>
							            </li>
							            <li>|</li>
							            <li>
							            Use Font Awesome http://fortawesome.github.io/Font-Awesome/
							              <span><i class="fa fa-facebook-square"></i></span>
							              <span><i class="fa fa-twitter-square"></i></span>
							              <span><i class="fa fa-google-plus-square"></i></span>
							            </li>
									</ul> -->
						        </div>
						      </div>
						    </div>
						  <?php endforeach; ?>
						  </div>
					  <?php else: ?>
						  <div id="<?php echo $j; ?>" class="tab-pane fade">
						  <?php foreach($blt as $bltn): ?>
						    <div class="well">
						      <div class="media">
						      	<a class="pull-left">
						    		<div class="col-md-3">
	                                <a href="<?= base_url() ?>doc_file/buletin/cover/<?= $bltn->cover ?>" data-toggle="lightbox">
	                                  <img class="thumbnail" src="<?= base_url() ?>doc_file/buletin/cover/<?= $bltn->cover ?>" alt="aaaa">
	                                </a>
	                              </div>
						  		</a>
						  		<div class="media-body">
						    		<h3 class="text-left"><strong><?= $bltn->title ?></strong></h3>
							        <!-- <div class="text-right">By Francicso</div> -->
							        <p><?= $bltn->deskripsi ?></p>
							        <p><a href="<?= base_url() ?>doc_file/buletin/dokumen/<?= $bltn->dokumen ?>" target="_blank">Selengkapnya . . .</a></p>
						          	<!-- <ul class="list-inline list-unstyled">
							  			<li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li>
							            <li>|</li>
							            <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>
							            <li>|</li>
							            <li>
							               <span class="glyphicon glyphicon-star"></span>
							                        <span class="glyphicon glyphicon-star"></span>
							                        <span class="glyphicon glyphicon-star"></span>
							                        <span class="glyphicon glyphicon-star"></span>
							                        <span class="glyphicon glyphicon-star-empty"></span>
							            </li>
							            <li>|</li>
							            <li>
							            
							              <span><i class="fa fa-facebook-square"></i></span>
							              <span><i class="fa fa-twitter-square"></i></span>
							              <span><i class="fa fa-google-plus-square"></i></span>
							            </li>
									</ul> -->
						        </div>
						      </div>
						    </div>
						    <?php endforeach; ?>
						  </div>
					  <?php endif ?>
					<?php } ?>
					<!-- <div id="menu1" class="tab-pane fade">
				    <h3>Menu 2</h3>
				    <p>Some content in menu 2.</p>
				  </div>
				  <div id="menu2" class="tab-pane fade">
				    <h3>Menu 2</h3>
				    <p>Some content in menu 2.</p>
				  </div> -->
				</div>
				<?php endif; ?>
			</div>
        </div>
    </div>
</section>

	

<script type="text/javascript">
	$(document).ready(function($) {
		navbar_active('#nb_profile');
	});

	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>