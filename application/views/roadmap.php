<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
        <?php if(empty($Buletin)): ?>
	  		<div class="container">
	  			<div class="jumbotron">
        			<h4 class="text-center">Belum ada data roadmap yang diterbitkan</h4>
        		</div>
        	</div>
        <?php else: ?>
	        <?php foreach ($Roadmap as $roadmap): ?>
				<div class="bs-callout bs-callout-primary">
				  <h4><?= $roadmap->title ?></h4>
					  
					<?= $roadmap->isi ?>
					<embed src="<?= base_url() ?>doc_file/roadmap/<?= $roadmap->dokumen ?>" type="application/pdf" width="100%" height="700px">
						<div id="tableau">
							
						</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		
        </div>
    </div>
</section>
<!-- jQuery -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function($) {
		navbar_active('#nb_profile');

		// variables to feed trusted ticket retrieval
	    var phpScript = '<?= base_url('index.php/menu/getTicketTableau') ?>',
	        userName = "pustispan",
	        serverURL = "http://10.14.1.49/#/views/RBLapan/Dashboard1?:iid=1";

	   // variable to hold trusted ticket
	        var incomingTicket;

	   $.post(phpScript, {
	    toDo: 'generateTicket',
	        user: userName,
	        server: serverURL,
	        targetsite: ''
	    }, function(response) {
	        // do something with response (the ticket) right here
	        incomingTicket = response;
	        $("#tableau").append('<iframe src="http://10.14.1.49/views/RBLapan/Dashboard1?:embed=y&:showShareOptions=true&:display_count=no&:showVizHome=no" width="100%" height="700px"></iframe>');
	    });
	});


</script>