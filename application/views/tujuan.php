<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
        <?php foreach ($tujuans as $tujuan): ?>
			<div class="bs-callout bs-callout-primary">
			  <h4><?= $tujuan->title ?></h4>
				  
				  	<?= $tujuan->isi ?>
				  
			</div>
		<?php endforeach; ?>
        </div>
    </div>
</section>
<script type="text/javascript">
	$(document).ready(function($) {
		navbar_active('#nb_profile');
	});
</script>