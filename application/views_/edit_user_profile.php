<!--<link rel="stylesheet" href="<?php //echo base_url();?>css/front/coupon.css" />-->
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
          <div class="new-heading-main-head-left">Edit Profile <span>(<a href="<?php echo base_url('user/profile');?>">View Profile</a>)</span></div>
          <div class="clr"></div>
        </div>
      </div>
      <div class="clr"></div>
    </div>
   <?php if($this->session->flashdata('success')){?><div class="right-message" ><?php echo $this->session->flashdata('success'); ?></div> <?php } ?>
  <?php if($this->session->flashdata('error')){?><div class="err-message" ><?php echo $this->session->flashdata('error'); ?></div> <?php } ?>
    <form method="post"  id="form_edit_profile_user" name="form_edit_profile_user" enctype="multipart/form-data">
    <div class="co-pages">
      <div class="about-left">
        <div class="about-heading">
        <div class="about-inner-title">About Me <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
        </div>
        <div class="about-form"> 
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">First name <span class="star">*</span> :</div>
            <div class="about-fild">
              <input type="text" class="select-about" placeholder="Enter First Name" name="first_name" id="first_name" value="<?php if(isset($userinfo[0]['first_name']) && $userinfo[0]['first_name']!=''){ echo $userinfo[0]['first_name']; }else {if(isset($userinfo[0]['username'])){echo $userinfo[0]['username'];} }?>">
               <div class="errr" style= " <?php if(form_error('first_name')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_first_name"><?php echo form_error('first_name'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Last name  <span class="star">*</span>:</div>
            <div class="about-fild">
              <input type="text" class="select-about" placeholder="Enter Last Name" name="last_name" id="last_name" value="<?php if(isset($userinfo[0]['last_name'])){  echo $userinfo[0]['last_name']; }?>">
                <div class="errr" style= " <?php if(form_error('last_name')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_last_name"><?php echo form_error('last_name'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
            <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Contact Number <span class="star">*</span>:</div>
            <div class="about-fild">
            <input type="text" class="select-about" placeholder="Enter Contact Number" name="contact_no" id="contact_no" value="<?php if(isset($userinfo[0]['contact_no'])){ echo $userinfo[0]['contact_no'];}?>">
            <div class="errr" style= " <?php if(form_error('contact_no')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_contact_no"><?php echo form_error('contact_no'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Address <span class="star">*</span>:</div>
            <div class="about-fild">
              <textarea name="address" id="address" placeholder="Enter Address" class="texarea-select" cols="" rows=""><?php if(isset($userinfo[0]['address'])){ echo $userinfo[0]['address']; }?></textarea>
             <div class="errr" style= " <?php if(form_error('address')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_address"><?php echo form_error('address'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset-->
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">City <span class="star">*</span>:</div>
            <div class="about-fild">
            <input type="text" class="select-about" placeholder="Enter City" name="city_id" id="city_id" value="<?php if(isset($userinfo[0]['city_id'])){ echo $userinfo[0]['city_id'];}?>">
            <div class="errr" style= " <?php if(form_error('city_id')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_city_id"><?php echo form_error('city_id'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">State <span class="star">*</span>:</div>
            <div class="about-fild">
              <input type="text" class="select-about" placeholder="Enter State" name="state_id" id="state_id" value="<?php if(isset($userinfo[0]['state_id'])){ echo $userinfo[0]['state_id'];}?>">
              <div class="errr" style= " <?php if(form_error('state_id')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_state_id"><?php echo form_error('state_id'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Country <span class="star">*</span>:</div>
            <div class="about-fild">
              <select name="country_id" id="country_id" class="select-list">
             	 <option value="">Select Country</option>
                 <?php 
				 foreach($fetchcountry as $rowcountry)
				 {?>
                 <option value='<?php echo $rowcountry['id'];?>' <?php if(isset($userinfo[0]['country_id'])){ if($rowcountry['id']==$userinfo[0]['country_id']){ echo 'selected="selected"';}}?>>
							<?php echo $rowcountry['country'];?></option>
                 <?php }?>
              </select>
              <div class="clr"></div>
               <div class="errr" style= " <?php if(form_error('country_id')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_country_id"><?php echo form_error('country_id'); ?></div>
            </div>
          <div class="clr"></div>
          </div>
          <!--fildset--> 
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="about-right">
        <div class="about-heading">
          <div class="about-inner-title">My Profile Photo <span class="title-arow">
          <img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" />
          </span></div>
        </div>
        <div class="about-form">
          <div class="about-fild-text">Profile Image :</div>
          <div class="about-fild">
                         <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new img-thumbnail" style="width: 100px; height: 100px;">
                                <?php if(isset($userinfo[0]['profile_picture']) && $userinfo[0]['profile_picture']!=''){  ?>
                                <img src="<?php echo base_url().'uploads/profile_image/'.$userinfo[0]['profile_picture']; ?>" alt="" style="width: 100px; height: 100px;"/>
                                <?php } else {?>
			   					<img src="<?php echo base_url(); ?>images/profile-img.jpg" width="100" height="100"/>
			  					 <?php  }?> 
                            </div>
                             <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 100px; max-height: 100px; "></div>
                            <div>
                               <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                               <span class="fileupload-exists">Change</span>
                               <input type="file" class="default" name="profile_picture" id="profile_picture" />
                               <input type="hidden" class="default" name="profile_pictureold" id="profile_pictureold" value="<?php if(isset($userinfo[0]['profile_picture']) && $userinfo[0]['profile_picture']!=''){  echo $userinfo[0]['profile_picture']; }?>"/>
                               </span>
                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                            <div class="errr" style= " <?php if(form_error('profile_picture')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_profile_picture">
							<?php echo form_error('profile_picture'); ?>
                            </div>
                         </div>
                      </div>	
          <div class="co-pages">
            <div class="save-btn" style="padding-left:10px;">
              <input type="submit" value="Save Changes" class="btn-select-save" name="btn_update_user" id="btn_update_user">
            </div>
            <div class="clr"></div>
          </div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      <!--<div class="submit-heading">
        <div class="submit-inner-title">Delete Account <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow-arb.png" width="20" height="21" alt="arow" /></span></div>
      </div>
      <div class="delete-ac">
        <div class="about-form">
          <div class="privacy-fild-text"> Permanently remove your account and all information associated with it?</div>
          <div class="privacy-fild-text">
          <a href="<?php echo base_url('user/delete');?>" id="deleteaccount" name="deleteaccount" >
          Delete Account
          </a> 
           </div>
        </div>
        <div class="clr"></div>
      </div>-->
      <div class="clr"></div>
    </div>
    </form>
    <!--profile-inner-->
    <div class="clr"></div>
  </div>
  <!--inner--> 
</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>datepicker/css/zebra_datepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>datepicker/javascript/zebra_datepicker.js"></script>
<script>
 $(document).ready(function(){
 $('#DOB').Zebra_DatePicker({
		 format: 'd-m-Y',
		 direction:-1,
	});
 });
</script>