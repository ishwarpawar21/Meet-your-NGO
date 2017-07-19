<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Job Recruitment -<?php echo $page_title; ?></title>
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
            <!-- BEGIN Login Form -->
            <form id="admin_login" name="admin_login" action="" class="validationclass" method="post">
                <h3>Forget Password</h3>
                <hr/>
                 <?php if($success!='')
			 	   {?>
                    <div class="form-group form-margin">
                        <div class="controls">
                            <span class="text-success"><?php echo $success;?></span>
                        </div>
                    </div>
             <?php } else if($error!='')
			 	   {?>
                    <div class="form-group form-margin">
                        <div class="controls">
                            <span class="text-danger"><?php echo $error;?></span>
                        </div>
                    </div>
               <?php }?>   
                <div class="form-group form-margin">
                    <div class="controls">
                        <input type="text" placeholder="Email" class="form-control"  id="user_name" name="user_name" value="<?php echo $this->input->post("username");?>" data-rule-required="true" />
                    </div>
                </div>
             
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary form-control" name="btn_forget" id="btn_forget" value="btn_admin_login">Submit</button>
                    </div>
                </div>
                
                
                <a href="<?php echo base_url();?>webmanager" style="font-weight:bold">Back</a>
                <hr/>
            </form>
            <!-- END Login Form -->

           
		   <!-- BEGIN Register Form -->
        </div>
        <!-- END Main Content -->

        <!--basic scripts-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url();?>js/jquery-2.0.3.min.js"><\/script>')</script>
        <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>js/parcel.js"></script>
		<script src="<?php echo base_url();?>js/parcel_login.js"></script>
        
    </body>
</html>
