<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
        <?php foreach ($Monev as $monev): ?>
			<div class="bs-callout bs-callout-primary">
			  <h4><?= $monev->title ?></h4>
				  <div class="col-md-12 col-md-offset-0">
				  	<?= $monev->isi ?>
				  </div>
			</div>
		<?php endforeach; ?>
        </div>
    </div>
</section>
<script type="text/javascript">
	$(document).ready(function($) {
		navbar_active('#nb_capaianrb');
	});
</script>