 <link rel="stylesheet" href="<?php echo base_url();?>assets/prettyPhoto/css/prettyPhoto.css">
<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa-rss-square"></i>Banner</h1>
        <h4>Add Banner</h4>
    </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url().'superadmin/admin/dashboard/'; ?>">Home</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li>
        	<a href="#">Manage Banner</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Banner</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Add Banner</h3>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url('superadmin/admin/managebanner/')?>" title="Back"><i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="col-sm-12">
					<?php 
                      if($error!=''){  ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } 
                      if($this->session->flashdata('success')!=''){?>	
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php } ?>
                    <?php
                    if($this->session->flashdata('error')!=''){?>	
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>
                    </div>
                  </div>
                 <div class="form-group">
                      <?php if($ban!=''){ ?>
                      <div class="col-sm-7" style="float:right;display:none">
					  <?php }else {?>
                      <div class="col-sm-7" style="float:right;">  
					  <?php } ?>
                      <a href="javascript:void(0);" id='add-image'><span class="glyphicon glyphicon-plus-sign" style="font-size: 20px;"></span></a>
                      <span style="margin-left:05px;">
                      <a href="javascript:void(0);" id='remove-image'><span class="glyphicon glyphicon-minus-sign" style="font-size: 20px;"></span></a>
                      </span>
                      </div>
                      </div>
                     <div id="pdfappend" class="class-add">
                       <label class="col-sm-3 col-lg-2 control-label"><?php if($ban!=''){?>Image <br /><br /><br /><br /><br /><br /><?php }?>Banner <br /><br /><br /><br />Link</label>
                      <div class="col-sm-4 col-lg-4 controls">
                      <?php if($ban!=''){?>
						   <img src="<?php echo base_url().'uploads/banners/'.$ban[0]['banner_image']; ?>" height="100px"  title="<?php $ban[0]['banner_image']; ?>"/>
                         <?php }?>
                       <input type="file" class="form-control" name="<?php if($ban!=''){echo 'newimg';}else{echo 'banner_image[]';} ?>" id="banner_image" placeholder="Image" onchange="return loadImage_new(this.name,'<?php if($ban==''){echo 'btn_ban';}else{echo 'btn_banner';}?>',this.id);" /><br /><span class="label label-important">NOTE!</span><span>Size of image should be 1170X354.</span><br /><br />
                       <input type="text" name="link" id="linkb" class="form-control" value="<?php if($ban!=''){echo $ban[0]['link'];} ?>" placeholder="Link" />
                       <div class="error_msg" id="error_banner" style="display:none;"></div>
                       <?php echo form_error('banner_img'); ?><br /><br />
                       </div>
                       <div class="clr"></div>
                       </div> 
                       <div id="append" class="add-class"></div>
                     <div class="error_msg" id="error_banner_img" style="display:none;"></div>
                     <div class="error_msg" id="error_banner_img1" style="display:none;"></div>
                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" value="Submit" class="btn btn-primary" name="<?php if($ban!=''){echo 'btn_update';}else{echo 'btn_banner';} ?>"   id="<?php if($ban==''){echo 'btn_ban';}else{echo 'btn_banner';}?>" >
                        <a href="<?php echo base_url('superadmin/admin/managebanner/')?>">
                        <button class="btn" type="button">Cancel</button>
                        </a>
                     </div>
                 </div>
               <ul class="gallery" style="float:left;">
               <?php 
			   if(count($fetch_banner)>0)
			   { 
				   foreach($fetch_banner as $banner)
				   {
				   ?>
                                   <li>
                                        <a href="<?php echo base_url().'uploads/banners/'.$banner['banner_image']; ?>" rel="prettyPhoto" title="Description of image">
                                            <div>
                                                <img src="<?php echo base_url().'uploads/banners/'.$banner['banner_image']; ?>" height="100px"  title="<?php $banner['banner_image']; ?>"/>
                                                <i></i>
                                            </div>
                                        </a>
                                      
                                        <div class="gallery-tools">
                                        <a href="<?php echo base_url().'superadmin/admin/managebanner/'.base64_encode($banner['banner_id'])?>"><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo base_url().'superadmin/admin/deletebanner/'.$banner['banner_id'].'/'.$banner['banner_image'];?>" onclick="javascript : return deletconfirm();"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                         
                                         <div ><?php echo $banner['link'];?></div>
                                    </li>
                   <?php
				        
                    }
					?>
                   
                    <?php
				  } 
			   ?>   
                </ul> 
                 <div class="clr"></div>   
                  </div>
             </form>
             </div>
            </div>
        </div>
    </div>
   
</div>


<!-- END Main Content -->
 <!--basic scripts-->
       
        <!--page specific plugin scripts-->
        
        <script src="<?php echo base_url();?>assets/prettyPhoto/js/jquery.prettyPhoto.js"></script>
       

       


     
 
        