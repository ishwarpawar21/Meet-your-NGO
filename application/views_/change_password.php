<?php require_once APPPATH.'libraries/facebook/facebook.php'; ?>
  <!--contain-start-->
  <div class="contain"> 
    <!--inner-->
    <div class="innar-page">
      <!--login-inner-->
      <div class="login-inner">
      	<div class="login-top">
        	<div class="login-icon"><img src="<?php echo base_url();?>images/login-cons.png" width="42" height="47" alt="icon" style=" margin-top:18px;" /></div>
            <div class="login-title-in">Change Password to your <div class="clr"></div> <span>account</span> </div>
            <div class="login-corner"><img src="<?php echo base_url();?>images/login-corner.jpg" width="30" height="80" alt="img" /></div>
        </div>
       <?php if($this->session->flashdata('error')){?><div class="err-message"><?php echo $this->session->flashdata('error'); ?></div> <?php } ?>
       <?php if($this->session->flashdata('success')){?><div class="right-message" ><?php echo $this->session->flashdata('success'); ?></div> <?php } ?>
       <?php if($already=='')
	   {?>
        <form method="post"> 
        <div class="login-btm">
        	<div class="login-container">
            	<div class="login-1">
                <input type="password" class="select-login-pass" placeholder="Enter new password" value="<?php echo set_value('password'); ?>" name="password" id="password" >
                <div class="errr" style= " <?php if(form_error('password')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_password"><?php echo form_error('password'); ?></div>
                </div>
                <div class="login-2">
                <input type="password" class="select-login-pass" placeholder="Enter conform password" value="<?php echo set_value('conpassword'); ?>" name="conpassword" id="conpassword" >
                <div class="errr" style= " <?php if(form_error('conpassword')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_conpassword"><?php echo form_error('conpassword'); ?></div>
                </div>
                <div class="login-2">
                 <input type="submit" name="btn_change_password" id="btn_change_password" class="btn-select-login" value="Submit">
                </div>
                <div class="login-member">Back to Login ? <a href="<?php echo base_url('login');?>" style=" padding-left:6px;">Login</a></div>
           	  <div class="clr"></div>
            </div>
            <div class="clr"></div>
        </div>
         </form>
        <div class="clr"></div>
       <?php } else{?>
       <div class="login-btm">
        	<div class="login-container">
            	<div class="login-1">
               <div class="err-message"><?php echo $already; ?></div> 
               <div class="login-member"><a href="<?php echo base_url('login');?>" style=" padding-left:6px;">Login</a></div>
              <div class="clr"></div>
            </div>
            <div class="clr"></div>
        </div>
       <?php } ?>
      </div>
      <!--login-inner-->
    <div class="clr"></div>
    </div>
    <!--inner--> 
  </div>
  <!--contain-end--> 