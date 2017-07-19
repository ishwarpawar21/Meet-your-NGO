<!--<link rel="stylesheet" href="<?php //echo base_url();?>css/front/coupon.css" />-->
<div class="contain"> 
  <!--inner-->
  <div class="innar-page"> 
    <!--profile-inner-->
    <div class="profile-top">
      <?php include('profile-header.php'); ?>
    </div>
     <?php if($this->session->flashdata('success')){?>
       <div class="right-message"><?php echo $this->session->flashdata('success'); ?></div> 
	 <?php } ?>
     <?php if($this->session->flashdata('error')){?>
       <div class="err-message" ><?php echo $this->session->flashdata('error'); ?></div>
     <?php } ?>
    <form method="post"  id="form_edit_profile_user" name="form_edit_profile_user" enctype="multipart/form-data">
    <div class="co-pages">
       <div class="about-heading">
         <div class="about-inner-title">Upgrade to seller <span class="title-arow">
             <img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span>
         </div>
        </div>
        <?php if(count($checkInsert)=='0'){ ?>
        <div class="clr"></div>
        <div class="new-heading" style="margin-top:10px;">
            <div class="new-heading-inner">
                 Upgrade profile to submit coupon send request to admin.
                <!--<div class="new-heading-main-head-right">There are currently <span></span> active brand</div>-->
              <div class="clr"></div>
            </div>
          </div>
        <div class="about-form"> 
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Business Name <span class="star">*</span> :</div>
            <div class="about-fild">
              <input type="text" class="select-about" placeholder="Enter Business Name" name="business_name" id="business_name" value="">
               <div class="errr" style= " <?php if(form_error('business_name')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_business_name"><?php echo form_error('business_name');?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Business Type <span class="star">*</span>:</div>
            <div class="about-fild">
              <input type="text" class="select-about" placeholder="Enter Business Type" name="business_type" id="business_type" value="">
                <div class="errr" style= " <?php if(form_error('business_type')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_business_type"><?php echo form_error('business_type'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Business Description <span class="star">*</span>:</div>
            <div class="about-fild">
             <textarea name="business_desc" id="business_desc" placeholder="Business Description" class="texarea-select" cols="" rows=""></textarea>
            <div class="errr" style= " <?php if(form_error('business_desc')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_business_desc"><?php echo form_error('business_desc'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Contact Number <span class="star">*</span>:</div>
            <div class="about-fild">
              <input type="text" class="select-about" placeholder=" eg. 9876543210" name="contact_no" id="contact_no" value="">
             <div class="errr" style= " <?php if(form_error('contact_no')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_contact_no"><?php echo form_error('contact_no'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset-->
           <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">&nbsp;</div>
            <div class="about-fild">
              <div class="save-btn">
                  <input id="btn_upgrade" class="btn-select-save" type="submit" name="btn_upgrade" value="submit">
              </div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset-->
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
       <?php 
	   }
	   else
	   {
	   ?>
        <div class="new-heading" style="margin-top:10px;">
          <div class="new-heading-inner">
             your request send to admin so please waiting some time.
            <div class="clr"></div>
          </div>
        </div>    
       <?php
	   }?>
    </div>
    </form>
    <!--profile-inner-->
    <div class="clr"></div>
  </div>
  <!--inner--> 
</div>
