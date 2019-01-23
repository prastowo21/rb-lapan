<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</head>
<body>
	<div>
		<a href='<?= base_url()?>'>Home</a> |
		<a href='<?php echo site_url('editor/news_management')?>'>News</a> |
	<?php 
		$id_role = $this->session->userdata('id_role');
		if (isset($id_role)): 
	?>
		<a href='<?= base_url('pengguna/logout')?>'>Logout</a>
	<?php endif; ?>
		
		
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
