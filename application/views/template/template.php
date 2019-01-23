<?php
	$this->load->view('template/header');
?>
<body>
	<div id="wrapper" class="container wrap">
<?php
	$this->load->view('template/menu');
	$this->load->view($content);
?>
	
<?php	
	$this->load->view('template/footer');
?>
</div>
</body>
		<script src="<?php echo base_url ('assets/js/jquery.js'); ?>" type="text/javascript"></script>
	<script type="text/javascript">
		function navbar_active(navbar_id) {
			$(navbar_id).addClass('active');
			$(navbar_id).find('a').append('<span class="selected"></span>');	
		}
	</script>