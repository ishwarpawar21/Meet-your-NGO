<div class="contain"> 
  <!--inner-->
  <div class="innar-page"> 
    <!--profile-inner-->
    <div class="profile-top">
      <?php include('profile-header.php'); ?>
    </div>
    <div class="co-pages">
      <div class="new-heading">
        <div class="new-heading-inner">
          <div class="new-heading-main-head-left">Account Preferences <span>(<a href="<?php echo base_url('seller/profile/');?>">View profile</a>)</span> </div>
          <div class="clr"></div>
        </div>
      </div>
      <div class="clr"></div>
    </div>
    <form method="post"  id="form_change_profile" name="form_change_profile">
    <div class="co-pages">
      <div class="">
        <div class="about-heading">
          <div class="about-inner-title">Change Password<span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
        </div>
        <?php if($this->session->flashdata('success')){?><div class="right-message" ><?php echo $this->session->flashdata('success'); ?></div> <?php }?>
 		<?php if($this->session->flashdata('error')){?><div class="err-message" ><?php echo $this->session->flashdata('error'); ?></div> <?php } ?>
        <div class="about-form"> 
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Old Password <span class="star">*</span> :</div>
            <div class="about-fild">
              <input type="password" class="select-about" placeholder="enter old password" name="current_pass" id="current_pass" data-rule-minlength="6">
              <div class="errr" style= " <?php if(form_error('current_pass')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_current_pass"><?php echo form_error('current_pass'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">New Password <span class="star">*</span> :</div>
            <div class="about-fild">
              <input type="password" class="select-about" placeholder="enter new password" name="new_pass" id="new_pass" data-rule-minlength="6">
              <div class="errr" style= " <?php if(form_error('new_pass')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_new_pass"><?php echo form_error('new_pass'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Confirm Password <span class="star">*</span> :</div>
            <div class="about-fild">
              <input type="password" class="select-about" placeholder="enter confirm password" name="confirm_pass" id="confirm_pass" data-rule-minlength="6">
              <div class="errr" style= " <?php if(form_error('confirm_pass')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_confirm_pass"><?php echo form_error('confirm_pass'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
       <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">&nbsp;</div>
            <div class="about-fild">
                 <div class="save-btn">
                  <input type="submit" value="Save Changes" class="btn-select-save" name="btn_change_password" id="btn_change_password">
                </div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>
    </form>
    <!--profile-inner-->
    <div class="clr"></div>
  </div>
  <!--inner--> 
</div>