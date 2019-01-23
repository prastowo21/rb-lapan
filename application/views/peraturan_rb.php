<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
        <?php foreach ($Peraturan_rb as $peraturan_rb): ?>
			<div class="bs-callout bs-callout-primary">
			  <h4><?= $peraturan_rb->title ?></h4>
				  <div class="col-md-12 col-md-offset-0">
				  	<?= $peraturan_rb->isi ?>
				  </div>
			</div>
		<?php endforeach; ?>
        </div>
    </div>
</section>

<script type="text/javascript">
	$(document).ready(function($) {
		navbar_active('#nb_peraturan_rb');
	});
</script>