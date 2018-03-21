<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="vn">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php if(isset($title)) echo $title; else echo "Đăng nhập hệ thống"; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>css/giasu.css" rel="stylesheet">
      
    <!--google map-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="all" />  
    <link href="<?php echo base_url(); ?>css/StyleAdminLogin.css" rel="stylesheet">
</head>
<body>
	

 <div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="<?php echo base_url(); ?>img/admin1.jpg" />
        <p id="profile-name" class="profile-name-card">
        	<?php
		    if($this->session->flashdata('a_message')){ ?>
		        <div class="alert alert-danger fade in alertStyle">
		            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		            <img src="<?php ?>"><?php echo $this->session->flashdata('a_message'); ?>
		        </div>
		        <?php
		    } ?>
        </p>
        <form class="form-signin" method="post" action="<?php echo base_url(); ?>admin/login">
            <span id="reauth-email" class="reauth-email"></span>
            <label>Username:</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address"  autofocus required name="txtEmail">
            <i class="text-danger"><?php echo form_error("txtEmail"); ?></i>
             <label class="Pass">Password:</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="txtMatKhau" required>
            <i class="text-danger"><?php echo form_error("txtMatKhau"); ?></i>
          
           
            <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block btn-signin" value="Sign in"/>
        </form><!-- /form -->
        
    </div><!-- /card-container -->
</div><!-- /container -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<!-- ckeditor -->
<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>

<!-- captcha google -->
<script src='https://www.google.com/recaptcha/api.js'></script>

</body>
</html>