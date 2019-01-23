<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
        <?php foreach ($sasarans as $sasaran): ?>
			<div class="bs-callout bs-callout-primary">
			  <h4><?= $sasaran->title ?></h4>
				  
				  	<?= $sasaran->isi ?>
				  
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