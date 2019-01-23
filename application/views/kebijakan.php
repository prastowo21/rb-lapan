<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
        <?php foreach ($Kebijakan as $kebijakan): ?>
			<div class="bs-callout bs-callout-primary">
			  <h4><?= $kebijakan->title ?></h4>
				  <div class="col-md-12 col-md-offset-0">
				  	<?= $kebijakan->isi ?>
				  </div>
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