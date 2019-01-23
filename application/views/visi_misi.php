

<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
        	<?php foreach ($vimis as $vimi): ?>
	        	<div class="bs-callout bs-callout-primary">
				  <h4><?= $vimi->title ?></h4>
					  	<?= $vimi->isi ?>
				</div>
				<!-- <div class="bs-callout bs-callout-primary">
				  <h4>Visi</h4>
				  Pusat Ungulan Penerbangan dan Antariksa untuk Mewujudkan Indonesia yang Maju dan Mandiri.
				</div>
				<div class="bs-callout bs-callout-primary">
				  <h4>Misi</h4>
				  	1. Meningkatkan kualitas litbang penerbangan dan antariksa bertaraf internasional.<br>
					2. Meningkatkan kualitas produk teknologi dan informasi di bidang penerbangan dan antariksa dalam memecahkan permasalahan nasional.<br>
					3. Melaksanakan dan mengatur penyelenggaraan keantariksaan untuk kepentingan nasional.
				</div> -->
			<?php endforeach; ?>
        </div>
    </div>
</section>
<script type="text/javascript">
	$(document).ready(function($) {
		navbar_active('#nb_profile');
	});
</script>

<script src="<?php echo base_url('assets/js/jetmenu.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/ddlevelsmenu.js');?>" type="text/javascript"></script>