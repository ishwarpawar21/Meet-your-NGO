<?php require_once APPPATH.'libraries/facebook/facebook.php'; ?>
  <!--contain-start-->
  <div class="contain"> 
    <!--inner-->
    <div class="innar-page">
      <!--login-inner-->
      <div class="login-inner">
      	<div class="login-top">
        	<div class="login-icon"><img src="<?php echo base_url();?>images/login-cons.png" width="42" height="47" alt="icon" style=" margin-top:18px;" /></div>
            <div class="login-title-in">login to your <div class="clr"></div> <span>account</span> </div>
            <div class="login-corner"><img src="<?php echo base_url();?>images/login-corner.jpg" width="30" height="80" alt="img" /></div>
        </div>
        <?php 
		  if($this->session->flashdata('error')){?>
          <div class="err-message"><?php echo $this->session->flashdata('error'); ?></div> 
	 <?php } ?>
         <?php if($this->session->flashdata('success')){?><div class="right-message" >
		   <?php echo $this->session->flashdata('success'); ?></div> 
		 <?php } ?>
        <form method="post"> 
        <div class="login-btm">
        	<div class="login-container">
            <div class="co-pages login-with" style="text-align:center; padding-bottom:15px; float:none; margin-right:0px;">
              <a href="javascript:void(0);" id="facebook"><img src="<?php echo base_url();?>images/login-with-facebook.png" width="214" height="39" alt="img" /></a></div>
            <div class="co-pages" style="text-align:center;"><img src="<?php echo base_url();?>images/or-icon.png" alt="img" /></div>
               <div class="login-1">
               <!--<input name="user" placeholder="Enter username" class="select-login-user" type="text" />-->
               <input type="text" class="select-login-user" value="<?php echo set_value('email'); ?>" placeholder="Enter email" name="email" id="email">
               <div class="errr" style= " <?php if(form_error('email')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_email"><?php echo form_error('email'); ?>
               </div>
                </div>
                <div class="login-2">
                <!--<input name="password" placeholder="Enter Password" class="select-login-pass" type="text" />-->
                <input type="password" class="select-login-pass" placeholder="Enter password" value="<?php echo set_value('password'); ?>" name="password" id="password" >
                <div class="errr" style= " <?php if(form_error('password')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_password"><?php echo form_error('password'); ?></div>
                </div>
                <div class="login-2">
                <!--<input name="submit" class="btn-select-login" value="Login" type="button" />-->
                 <input type="submit" name="btn_login" id="btn_login" class="btn-select-login" value="Login">
                </div>
                <div class="login-forget">
                  <a href="<?php echo base_url('forgot-password');?>">Forgot your Password ?</a>
                </div>
                <!--<div class="login-member">Not a member ? <a href="<?php echo base_url('signup');?>" style=" padding-left:6px;">Sign up now</a></div>-->
           	    <!--<div class="login-3">
                	<div class="login-with">
                     <a id="facebook" href="javascript:void(0);">
                       <img src="<?php echo base_url();?>images/facebook-login.jpg" width="92" height="52" alt="facebook" />
                     </a>
                    </div>
                    <div class="clr"></div>
              </div>-->
              <div class="clr"></div>
            </div>
            <div class="clr"></div>
        </div>
         </form>
        <div class="clr"></div>
      </div>
      <!--login-inner-->
    <div class="clr"></div>
    </div>
    <!--inner--> 
  </div>
  <!--contain-end--> 