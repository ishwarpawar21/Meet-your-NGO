<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa-pencil-square"></i>Update Brand</h1>
        <h4>Update Brand</h4>
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
        	<a href="<?php echo base_url().'superadmin/admin/managebrand/'; ?>">Manage Brand</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Update Brand</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Update Brand</h3>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/admin/managebrand/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="col-sm-12">
               		 	<?php if($this->session->flashdata('error')!=''){  ?>
                		 <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
               			 <?php } 
                	 	if($this->session->flashdata('success')!=''){?>	
                	 	<div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
					 	<?php } ?>
                        
                     </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Brand Image</label>
                      <div class="col-sm-9 col-md-10 controls">
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
                                <div class="error_msg" id="error_brand_image" style="display:none;"></div>
                            </div>
                         </div>
                       <?php if($upload_error!='') 
					  {?>  <div class="error_msg"  style="display:show;"><?php echo $upload_error; ?></div> <?php }?>
                      </div>
                </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Title </label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <input type="text" class="form-control" name="brand_title" id="brand_title" placeholder="Brand Tilte" value="<?php echo $fetch_brand[0]['brand_title']; ?>" />
                         <?php echo form_error('brand_title'); ?>
                         <div class="error_msg" id="error_brand_title" style="display:none;"></div>
                      </div>
                   </div>
                  
                  <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Description</label>
                     <div class="col-sm-9 col-lg-10 controls"><textarea id="brand_desc" class="form-control col-md-4" data-rule-required="true" rows="6" name="brand_desc"><?php echo $fetch_brand[0]['brand_desc']; ?></textarea>
                     <?php echo form_error('brand_desc'); ?>
                       <div class="error_msg" id="error_brand_desc" style="display:none;"></div>
                    </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" value="Update" class="btn btn-primary" name="btn_update_brand" id="btn_add_brand">
                     </div>
                   </div>
               </form>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>