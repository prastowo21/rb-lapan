<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
        <?php foreach ($quickwins as $quickwin): ?>
			<div class="bs-callout bs-callout-primary">
			  <h4><?= $quickwin->title ?></h4>
				  
				<?= $quickwin->isi ?>
				<embed src="<?= base_url() ?>doc_file/quickwin/<?= $quickwin->dokumen ?>" type="application/pdf" width="100%" height="700px">  
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