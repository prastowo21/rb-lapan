<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
	        <div class="col-md-12">
	        <h1><i class="fa fa-check-square-o"></i><strong> Penguatan Akuntabilitas Kinerja</strong></h1>
	        <hr style="border-style: dashed; border-width: 1px; border-color: #B7B5B5;">
		        <div class="col-md-12">
		        <?php if(empty($Penguatan_akuntabilitas_kinerja)): ?>
			  		<div class="container">
			  			<div class="jumbotron">
                			<h4 class="text-center">Data tidak tersedia</h4>
                		</div>
                	</div>
                <?php else: ?>
				  <table class="table table-hover">
				  	<thead>
				  		<tr>
				  			<th>No</th>
				  			<th width="700px">Keterangan</th>
				  			<th class="text-center">Unduh</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  	<?php $No = 1; ?>
		        	<?php foreach ($Penguatan_akuntabilitas_kinerja as $penguatan_akuntabilitas_kinerja): ?>
				  		<tr>
				  			<td><?= $No++; ?></td>
				  			<td><?= $penguatan_akuntabilitas_kinerja->title ?></td>
				  			<td class="text-center"><a href="<?= base_url() ?>doc_file/capaian/Penguatan Akuntabilitas Kinerja/<?= $penguatan_akuntabilitas_kinerja->isi ?>" target="_blank" class="btn btn-default"><i class="fa fa-download"></i></a></td>
				  		</tr>
				  	<?php endforeach; ?>
				  	</tbody>
				  </table>
				<?php endif; ?>
				</div>
	        </div>
        </div>
    </div>
</section>
<script type="text/javascript">
	$(document).ready(function($) {
		navbar_active('#nb_capaianrb');
	});
</script>