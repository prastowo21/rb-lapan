<?php
	$this->load->view('template_admin/header');
	$this->load->view('template_admin/sidebar', array('foto' => isset($foto) ? $foto : ''));
	$this->load->view('template_admin/top_navigation');
	$this->load->view($content);
	$this->load->view('template_admin/footer');
?>