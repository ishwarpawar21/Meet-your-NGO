<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $pagetitle; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--base css styles-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
        <!--page specific css styles-->
        <!--flaty css styles-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/flaty.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/flaty-responsive.css">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.png">
    </head>
    <body class="login-page">
      <!-- BEGIN Main Content -->
        <div class="login-wrapper">
             <?php
			 //this is used of login
			if($this->router->fetch_method()=='login'){ ?>
            <!-- BEGIN Login Form -->
            <form  class="form-horizontal" novalidate='novalidate' id="validation-form" action="<?php echo base_url('superadmin/admin/login'); ?>"  method="post">
                <h3>Login to your account</h3>
                <hr/>
                <div class="form-group">
                <?php if(isset($error)){  ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                </div>
                <div class="form-group  has-error">
                    <div class="controls">
                      <input type="text" name="username" id="username" placeholder="Username" class="form-control"  data-rule-required="true" value="<?php echo set_value('username'); ?>"/>
                      <?php if(form_error('username')!=''){ ?><span class="help-block" for="password">This field is required.</span> <?php } ?>
                    </div>
                   
                </div>
                <div class="form-group has-error">
                   <div class="controls">
                        <input type="password"  id="password" name="password" placeholder="Password" class="form-control" data-rule-required="true" />
                   </div>
                   <?php if(form_error('password')!=''){ ?><span class="help-block" for="password">This field is required.</span> <?php } ?>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary form-control" id="btn_login" name="btn_login">Login</button>
                    </div>
                </div>
                <hr/>
                 <p class="clearfix">
                  <a href="<?php echo base_url().'superadmin/admin/forgotpassword/'; ?>" class="goto-forgot pull-left">Forgot Password?</a></p>
            </form>
            <!-- END Login Form -->
            <?php } ?>
            <!-- BEGIN Forgot Password Form -->
            <?php
			//this is used by forgot password
			if($this->router->fetch_method()=='forgotpassword'){ ?>
            <form id="validation-form" action="<?php echo base_url().'superadmin/admin/forgotpassword/'; ?>" method="post">
                <h3>Get back your password</h3>
                <hr/>
                <div class="form-group">
                <?php 
				if($this->session->flashdata('error')!=''){  ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                <?php } 
                if($this->session->flashdata('success')!=''){?>	
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
				<?php } ?>
				</div>
				<div class="form-group">
                   <div class="controls">
                    <input type="text" id="email" name="email" placeholder="Email" class="form-control"  data-rule-required="true"  data-rule-email="true"/>
                   </div>
                </div>
                <div class="form-group">
                   <div class="controls">
                    <button type="submit"  name="btn_recovery" class="btn btn-primary form-control" id="btn_recovery">Recover</button>
                   </div>
                </div>
                <hr/>
                <p class="clearfix">
                  <a href="<?php echo base_url().'superadmin/admin/login/';?>" class="goto-login pull-left">← Back to login form</a>
                </p>
            </form>
            <?php } ?>
            <!-- END Forgot Password Form-->
            <!-- BEGIN change password -->
            <?php
			//this is used by chnage password
			if($this->router->fetch_method()=='changepassword'){
			?>
             <form id="validation-form" action="<?php echo base_url().'superadmin/admin/changepassword/'.$this->uri->segment('3'); ?>" method="post">
               <?php if($error_alreay==''){ ?>
                <h3>Change your password</h3>
                <hr/>
                <div class="form-group">
                <?php 
				if($this->session->flashdata('error')!=''){  ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                <?php } 
                if($this->session->flashdata('success')!=''){?>	
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
				<?php } ?>
                <?php if(isset($success) && $success!=''){ ?>
                 <div class="alert alert-success"><?php echo $success; ?></div>
                <?php } ?>
				</div>
         		 <div class="form-group">
                   <div class="controls">
                    <input type="password" id="password" name="password" placeholder="password" class="form-control"  data-rule-required="true"/>
                   </div>
                </div>
                 <div class="form-group">
                  <div class="controls">
                    <input type="password" id="confirm password" name="confirm_password" placeholder="confirm Password" class="form-control"  data-rule-required="true"  data-rule-equalto="#password"/>
                  </div>
                </div>
                 <div class="form-group">
                   <div class="controls">
                    <button type="submit"  name="btn_password" class="btn btn-primary form-control" id="btn_password">change password</button>
                    </div>
                </div>
                <?php }else{ ?>
                 <div class="form-group">
                 <div class="alert alert-danger"><?php echo $error_alreay; ?></div>
                 </div>
                <?php }?>
             </form>
            <?php
			}
			?>
            <!-- END change password-->
        </div>
        <!-- END Main Content -->
        <!--basic scripts-->
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/jquery/jquery-2.0.3.min.js"><\/script>')</script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        
		<script src="<?php echo base_url(); ?>assets/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>
    	
		<script src="<?php echo base_url(); ?>assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/jquery-cookie/jquery.cookie.js"></script>
        
        <!--flaty scripts-->
        <script src="<?php echo base_url(); ?>js/flaty.js"></script>
        <!--<script src="js/flaty-demo-codes.js"></script>-->
    </body>
</html>
