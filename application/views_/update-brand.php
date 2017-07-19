<!--<link rel="stylesheet" href="<?php //echo base_url();?>css/front/coupon.css" />-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
<div class="contain"> 
  <!--inner-->
  <div class="innar-page"> 
    <!--profile-inner-->
    
    <div class="co-pages">
      <div class="new-heading-inner">
              <div class="new-heading-main-head"><img src="<?php echo base_url(); ?>images/se-icon.jpg" width="30" height="20" alt="icon" /> </div>
              <div class="new-heading-main-head-left">Edit Brand</div>
              <div class="new-heading-main-head-right" style=" padding-right:10px;"><a href="<?php echo base_url().'seller/sellerbrand/';?>">Back</a></div>
              <div class="clr"></div>
            </div>
      <div class="clr"></div>
    </div>
   <?php if($this->session->flashdata('success')){?><div class="right-message" ><?php echo $this->session->flashdata('success'); ?></div> <?php } ?>
  <?php if($this->session->flashdata('error')){?><div class="err-message" ><?php echo $this->session->flashdata('error'); ?></div> <?php } ?>
    <form method="post"  id="form_edit_profile_user" name="form_edit_profile_user" enctype="multipart/form-data">
    <div class="co-pages">
      <div class="about-left">
        
        <div class="about-form"> 
          <!--fildset--> 
          <div class="form-group">
                     <div class="about-fild-text">Brand Image :</div>
                      <div class="about-fild">
                         <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                               <img src="<?php echo base_url().'uploads/brand/'.$fetch_brand[0]['brand_image']; ?>" alt="" />
                            </div>
                             <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                               <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                               <span class="fileupload-exists">Change</span>
                               <input type="file" class="default" name="brand_image" id="brand_image" />
                               <input type="hidden" class="default" name="old_image" id="old_image" value="<?php echo $fetch_brand[0]['brand_image'] ;?>"/>
                               </span>
                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                              <div class="errr" style= " <?php if(form_error('brand_image')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_brand_image"><?php echo form_error('brand_image'); ?></div>
                         </div>
                     <?php if($upload_error!='') 
					  {?>  <div class="errr"  style="display:show;"><?php echo $upload_error; ?></div> <?php }?>
                      </div>
                </div>
          <!--fildset-->
          <!--fildset-->
          <div class="about-fildset" >
            <div class="about-fild-text">Title :</div>
            <div class="about-fild">
              <input type="text" class="form-control"  name="brand_title" id="brand_title" placeholder="Brand Tilte" value="<?php echo $fetch_brand[0]['brand_title']; ?>" style="width:358px" />
               <div class="errr" style= " <?php if(form_error('brand_title')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_brand_title"><?php echo form_error('brand_title'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--fildset--> 
          <!--fildset-->
          <div class="about-fildset">
            <div class="about-fild-text">Description :</div>
            <div class="about-fild"><textarea name="brand_desc" id="brand_desc" class="texarea-select" cols="" rows=""><?php echo stripslashes($fetch_brand[0]['brand_desc']); ?></textarea>
            <div class="errr" style= " <?php if(form_error('brand_desc')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_brand_desc"><?php echo form_error('brand_desc'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
     
          <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-4">
                        <input type="submit" value="Update" class="submit-button" name="btn_update_brand" id="btn_add_brand" lang="edit">
                     </div>
                   </div>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="about-right">
        <div class="my-profile-right">
       <?php include('right-panel.php'); ?>
      </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
   
      <div class="clr"></div>
    </div>
    </form>
    <!--profile-inner-->
    <div class="clr"></div>
  </div>
  <!--inner--> 
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>