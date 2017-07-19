<!--<link rel="stylesheet" href="<?php //echo base_url();?>css/front/coupon.css" />-->
<?php if($this->uri->segment(1)=='user'){redirect(base_url().'seller/edit/');} ?>
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
          <div class="new-heading-main-head-left">Edit Profile <span>(<a href="<?php echo base_url('seller/profile');?>">View Profile</a>)</span></div>
          <div class="clr"></div>
        </div>
      </div>
      <div class="clr"></div>
    </div>
   <?php if($this->session->flashdata('success')){?><div class="right-message" ><?php echo $this->session->flashdata('success'); ?></div> <?php } ?>
  <?php if($this->session->flashdata('error')){?><div class="err-message" ><?php echo $this->session->flashdata('error'); ?></div> <?php } ?>
    <form method="post"  id="form_edit_profile" name="form_edit_profile" enctype="multipart/form-data">
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
              <input type="text" class="select-about" placeholder="Enter First Name" name="firstname" id="firstname" value="<?php if(isset($seldetail[0]['firstname']) && $seldetail[0]['firstname']!=''){ echo $seldetail[0]['firstname'];} else{if(isset($seldetail[0]['username'])){echo $seldetail[0]['username'];}}?>">
              <div class="errr" style= " <?php if(form_error('firstname')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_firstname"><?php echo form_error('firstname'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Last name  <span class="star">*</span>:</div>
            <div class="about-fild">
              <input type="text" class="select-about" placeholder="Enter Last Name" name="lastname" id="lastname" value="<?php if(isset($seldetail[0]['lastname'])){  echo $seldetail[0]['lastname']; }?>">
                <div class="errr" style= " <?php if(form_error('lastname')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_lastname"><?php echo form_error('lastname'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Gender :</div>
            <div class="about-fild">
              <select name="gender" id="gender" class="select-list">
                <option value="1" <?php if(isset($seldetail[0]['gender'])){ if( $seldetail[0]['gender']=='1'){echo 'selected="selected"';} }?> >Male</option>
                <option value="0" <?php if(isset($seldetail[0]['gender'])){ if($seldetail[0]['gender']=='0'){echo 'selected="selected"';} }?> >Female</option>
              </select>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Birthday <span class="star">*</span>:</div>
            <div class="about-fild">
            <input type="text" class="select-about"  name="DOB" id="DOB" value="<?php if(isset($seldetail[0]['DOB'])){ echo $seldetail[0]['DOB'];}?>" readonly="readonly">
            <div class="errr" style= " <?php if(form_error('DOB')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_DOB"><?php echo form_error('DOB'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">City <span class="star">*</span>:</div>
            <div class="about-fild">
            <input type="text" class="select-about" placeholder="Enter City" name="city" id="city" value="<?php if(isset($seldetail[0]['city'])){ echo $seldetail[0]['city'];}?>">
            <div class="errr" style= " <?php if(form_error('city')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_city"><?php echo form_error('city'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">State <span class="star">*</span>:</div>
            <div class="about-fild">
              <input type="text" class="select-about" placeholder="Enter State" name="state" id="state" value="<?php if(isset($seldetail[0]['state'])){ echo $seldetail[0]['state'];}?>">
              <div class="errr" style= " <?php if(form_error('state')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_state"><?php echo form_error('state'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Zip Code <span class="star">*</span>:</div>
            <div class="about-fild">
              <input type="text" class="select-about" placeholder="Enter zip code" name="zipcode" id="zipcode" value="<?php if(isset($seldetail[0]['zipcode'])){ echo $seldetail[0]['zipcode'];}?>">
             <div class="errr" style= " <?php if(form_error('zipcode')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_zipcode"><?php echo form_error('zipcode'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Country <span class="star">*</span>:</div>
            <div class="about-fild">
              <select name="countryid" id="countryid" class="select-list">
             	 <option value="">Select Country</option>
                 <?php 
				 foreach($fetchcountry as $rowcountry){?>
                 <option value='<?php echo $rowcountry['id'];?>' <?php if(isset($seldetail[0]['countryid'])){ if($rowcountry['id']==$seldetail[0]['countryid']){ echo 'selected="selected"';}}?>>
							<?php echo $rowcountry['country'];?></option>
                 <?php }?>
              </select>
              <div class="clr"></div>
               <div class="errr" style= " <?php if(form_error('countryid')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_countryid"><?php echo form_error('countryid'); ?></div>
            </div>
          <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Website :</div>
            <div class="about-fild">
              <input type="text" class="select-about" placeholder="Enter Website" name="Website" id="Website" value="<?php if(isset($seldetail[0]['Website'])){echo $seldetail[0]['Website'];}?>">
           <!--  <div class="errr" style= " <?php //if(form_error('Website')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_Website"><?php //echo form_error('Website'); ?></div>-->
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Brief bio <span class="star">*</span>:</div>
            <div class="about-fild">
              <textarea name="briefbio" id="briefbio" placeholder="Enter brief bio" class="texarea-select" cols="" rows=""><?php if(isset($seldetail[0]['briefbio'])){ echo $seldetail[0]['briefbio']; }?></textarea>
             <div class="errr" style= " <?php if(form_error('briefbio')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_briefbio"><?php echo form_error('briefbio'); ?></div>
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
          <!--<div class="co-pages">
            <div class="photo-left">
              <div class="co-fild-coupons">
                <div class="fileUpload btn btn-brows">
                 <span>Select New Photo</span>
                  <input type="file" class="upload" title="Select New Photo" id="profilepic" name="profilepic" onchange="return check_Files(this.value,this.id,'btn_update_seller');" >
                  <input name="profilepicold" id="profilepicold" type="hidden"  value="<?php //if(isset($seldetail[0]['profilepic'])){ echo $seldetail[0]['profilepic'];}?>"/>
           		  <!--<div class="errr" style= " <?php //if(form_error('profilepic')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_profilepic"><?php //echo form_error('profilepic'); ?></div>	
                 <div class="clr">
                </div>
                </div>
              </div>
              <div class="clr"></div>
            </div>
            <div class="photo-right">
            <?php //if(isset($seldetail[0]['profilepic']) && $seldetail[0]['profilepic']!=''){  ?>
            <img src="<?php //echo base_url();?>uploads/profile_image/<?php //echo $seldetail[0]['profilepic'];?>" width="100" height="100"/>
           <?php //} else {?>
			   <img src="<?php //echo base_url(); ?>images/profile-img.jpg" width="100" height="100"/>
			  <?php  //}?> 
            </div>
            <div class="clr"></div>
          </div>-->
           <div class="about-fild-text">Profile Image :</div>
           <div class="about-fild">
                         <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new img-thumbnail" style="width: 100px; height: 100px;">
                                <?php if(isset($seldetail[0]['profilepic']) && $seldetail[0]['profilepic']!=''){  ?>
                                <img src="<?php echo base_url().'uploads/profile_image/'.$seldetail[0]['profilepic']; ?>" alt="" style="width: 100px; height: 100px;"/>
                                <?php } else {?>
			   					<img src="<?php echo base_url(); ?>images/profile-img.jpg" width="100" height="100"/>
			  					 <?php  }?> 
                            </div>
                             <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 100px; max-height: 100px; "></div>
                            <div>
                               <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                               <span class="fileupload-exists">Change</span>
                               <input type="file" class="default" name="profilepic" id="profilepic" />
                               <input type="hidden" class="default" name="profilepicold" id="profilepicold" value="<?php if(isset($seldetail[0]['profilepic']) && $seldetail[0]['profilepic']!=''){ echo $seldetail[0]['profilepic']; } ?>"/>
                               </span>
                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                            <div class="errr" style= " <?php if(form_error('profilepic')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_profilepic">
							<?php echo form_error('profilepic'); ?>
                            </div>
                         </div>
                      </div>
          <div class="co-pages">
            <div class="save-btn" style="padding-left:10px;">
              <input type="submit" value="Save Changes" class="btn-select-save" name="btn_update_seller" id="btn_update_seller" lang="edit">
            </div>
            <div class="clr"></div>
          </div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
<!--      <div class="submit-heading">
        <div class="submit-inner-title">Delete Account <span class="title-arow"><img src="<?php //echo base_url(); ?>images/title-arow-arb.png" width="20" height="21" alt="arow" /></span></div>
      </div>
      <div class="delete-ac">
        <div class="about-form">
          <div class="privacy-fild-text"> Permanently remove your account and all information associated with it?</div>
          <div class="privacy-fild-text">
          <a href="<?php //echo base_url('seller/delete');?>" id="deleteaccount" name="deleteaccount" >
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
