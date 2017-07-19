<?php require_once APPPATH.'libraries/facebook/facebook.php'; ?>
 <!--contain-start-->
  <div class="contain"> 
    <!--inner-->
    <div class="innar-page">
      <!--login-inner-->
      <div class="co-pages">
      <?php 
	  if($this->uri->segment(1)=='facebook'){ 
	  ?>
      <div class="new-heading">
        <div class="new-heading-inner">
          <div class="new-heading-main-head-left">Your Facebook email address is private so we can't access your data properly please fill remaining data and register.</div>
          <div class="clr"></div>
        </div>
      </div>
       <?php } ?>
      <div class="clr"></div>
    </div>
      <div class="login-inner">
      	<div class="login-top">
        	<div class="login-icon"><img src="<?php echo base_url();?>images/login-cons.png" width="42" height="47" alt="icon" style=" margin-top:18px;" /></div>
          <div class="login-title-in">Sign up to your <div class="clr"></div> <span>account</span> </div>
            <div class="login-corner"><img src="<?php echo base_url();?>images/login-corner.jpg" width="30" height="80" alt="img" /></div>
        </div>
        <?php if($this->session->flashdata('error')){?><div class="err-message"><?php echo $this->session->flashdata('error'); ?></div> <?php } ?>
        <form method="post"> 
        <div class="login-btm">
         <div class="login-container">
             <?php if($this->uri->segment(1)!='facebook'){ ?>
               <div class="co-pages login-with" style="text-align:center; padding-bottom:15px; float:none; margin-right:0px;">
              <a href="javascript:void(0);" id="facebook"><img src="<?php echo base_url();?>images/login-with-facebook.png" width="214" height="39" alt="img" /></a></div>
               <div class="co-pages" style="text-align:center;"><img src="<?php echo base_url();?>images/or-icon.png" alt="img" /></div>
			  <?php } ?>
              <div class="login-1">
                 <input type="radio" class="chk_user_type css-checkbox" value="user" name="user_type" id="user_type" <?php if(set_value('user_type')=='user'){echo 'checked="checked"'; }else{ echo 'checked="checked"';}?>>
                  <label for="user_type" class="css-label" style="font-size:16px;font-family:Arial, Helvetica, sans-serif;">Regular User</label>
                  <input type="radio" class="chk_user_type css-checkbox" value="seller" name="user_type" id="user_typ1" <?php if(set_value('user_type')=='seller'){echo 'checked="checked"'; }?>> <label for="user_typ1" class="css-label" style="font-size:16px;font-family:Arial, Helvetica, sans-serif;">Seller</label>
                 </label>
               </div>
               <div class="login-1">
                 <input type="text" class="select-login-user" value="<?php echo set_value('email'); ?>" placeholder="Enter email" name="email" id="email">
               <div class="errr" style= " <?php if(form_error('email')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_email"><?php echo form_error('email'); ?></div>
                </div>
                <div class="login-1">
               <!--<input name="user" placeholder="Enter username" class="select-login-user" type="text" />-->
               <input type="text" class="select-login-user" value="<?php echo set_value('user_slug'); ?>" placeholder="Enter name" name="user_slug" id="user_slug">
               <div class="errr" style= " <?php if(form_error('user_slug')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_user_slug"><?php echo form_error('user_slug'); ?></div>
                </div>
                <div class="login-2">
               <!-- <input name="password" placeholder="Enter Password" class="select-login-pass" type="text" />-->
                <input type="password" class="select-login-pass" placeholder="Enter password" value="<?php echo set_value('password'); ?>" name="password" id="password" >
                <div class="errr" style= " <?php if(form_error('password')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_password"><?php echo form_error('password'); ?></div>
                </div>
                <div class="login-2">
                <!--<input name="submit" class="btn-select-login" value="Login" type="button" />-->
                 <input type="submit" name="btn_save" id="btn_save" class="btn-select-login" value="Register">
                </div>
                <div>
                <span class="login-forget">
                <a href="<?php echo base_url('forgot-password');?>">Forgot your Password ?</a>
                </span>
                
                <span class="login-member" style="padding-left:15px;">
                <a href="<?php echo base_url('login');?>" style=" padding-left:6px;">Back to Login</a>
                </span>
                </div>
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
  <script language="javascript">
  $(document).ready(function(){
  $('.chk_user_type').click(function(){
         var vallabel=$(this).attr('value');
		 document.cookie='user_type='+vallabel;
	  })
  });
  </script>
