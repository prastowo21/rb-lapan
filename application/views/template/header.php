<!doctype html>
<html lang="en">
<head>
  <?php if(isset($berita->id_berita) == TRUE): ?>
    <meta charset="UTF-8">
    <meta property="og:url"           content="<?= base_url('index.php/berita/view') ?>/<?= $berita->slug ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?= $berita->judul_berita ?>" />
    <meta property="og:description"   content="<?= strip_tags($berita->deskripsi_berita) ?>"/>
    <meta property="og:image"         content="<?= base_url() ?>doc_file/berita/<?= $berita->gambar_berita ?>" />
  <?php else: ?>
    <meta charset="UTF-8">
    <meta property="og:url"           content="<?= base_url() ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?= $title ?>" />
    <meta property="og:description"   content="Selamat Datang di Website Reformasi Birokrasi LAPAN"/>
    <meta property="og:image"         content=" " />
  <?php endif; ?>
    <title>
      <?= $title ?>
    </title>
    <link href="<?= base_url('assets/img') ?>/LAPAN_logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style2.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/modal.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/colors.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/flexslider.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jetmenu.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/royalslider/royalslider.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/royalslider/rs-default-inverted.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/owl.carousel.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/hover_pack.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/prettyPhoto.css'); ?>" type="text/css"> 
    <link rel="stylesheet" href="<?php echo base_url('assets/css/prettify.css'); ?>" type="text/css"> 
    <link rel="stylesheet" href="<?php echo base_url('assets/css/stepwizard.css'); ?>" type="text/css">
</head>

      



        
                        
                    
                
           