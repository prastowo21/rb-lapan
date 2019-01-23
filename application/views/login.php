<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RB LAPAN</title>
    <link href='<?= base_url('assets/img') ?>/LAPAN_logo.png' rel='shortcut icon'>
    <!-- Bootstrap -->
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
    <link href="<?= base_url('assets/gentelella-master') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     
</head>

<body>
    <div class="container">
    <h1 class="welcome text-center">Reformasi Birokrasi <br> LAPAN</h1>
        <div class="card card-container">
        <h2 class='login_title text-center'>Login</h2>
        <hr>
        <?= $this->session->flashdata('msg') ?>
            <?= form_open('login/index') ?>
            <div class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <p class="input_title">Username</p>
                <input type="text" id="inputEmail" class="login_box" placeholder="username" name="username" required autofocus>
                <p class="input_title">Password</p>
                <input type="password" id="inputPassword" class="login_box" placeholder="******" name="password" required>
                <!-- <a href="#forgot" data-toggle="modal"><p>Forgot Password ?</p></a><br> -->
                <input type="submit" name="login" value="Login" class="btn btn-lg btn-primary btn-block">
            </div>
            <?= form_close() ?>

            <div id="forgot" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            
              <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <div class="text-center">
                                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                                  <h2 class="text-center">Forgot Password?</h2>
                                  <p>You can reset your password here.</p>
                                  <div class="panel-body">
                    
                                    <?= form_open('login/resetPassword') ?>
                    
                                      <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                          <input type="text" id="username" name="username" placeholder="enter your username" class="form-control" >
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <input id="recover-submit" name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                      </div>
                                      
                                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                                    <?= form_close() ?>
                    
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                </div>
              
            </div>
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>

    <!-- jQuery -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>