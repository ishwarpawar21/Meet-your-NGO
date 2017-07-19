  <!--contain-start-->
  <div class="contain"> 
    <!--inner-->
    <div class="innar-page">
      <!--login-inner-->
      <div class="login-inner">
      	<div class="login-top">
        	<div class="login-icon"><img src="<?php echo base_url();?>images/login-cons.png" width="42" height="47" alt="icon" style=" margin-top:18px;" /></div>
          <div class="login-title-in">Forgot Password <div class="clr"></div> <span>account</span> </div>
            <div class="login-corner"><img src="<?php echo base_url();?>images/login-corner.jpg" width="30" height="80" alt="img" /></div>
        </div>
        <?php if($this->session->flashdata('error')){?><div class="err-message"><?php echo $this->session->flashdata('error'); ?></div> <?php } ?>
       <?php if($this->session->flashdata('success')){?><div class="right-message" ><?php echo $this->session->flashdata('success'); ?></div> <?php } ?>
        <form method="post"> 
        <div class="login-btm">
        	<div class="login-container">
            	<div class="login-1">
               <input type="text" class="select-login-user" value="<?php echo set_value('email'); ?>" placeholder="Enter email" name="email" id="email">
               <div class="errr" style= " <?php if(form_error('email')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_email"><?php echo form_error('email'); ?>
               </div>
                </div>
                <div class="login-2">
                 <input type="submit" name="btn_forgot_password" id="btn_forgot_password" class="btn-select-login" value="Submit">
                </div>
                <div class="login-member"><a href="<?php echo base_url('login');?>" style=" padding-left:6px;">Back to Login</a></div>
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