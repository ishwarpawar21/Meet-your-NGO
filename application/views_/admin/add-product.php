<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa-pencil-square"></i>Add Product</h1>
        <h4>Add Product</h4>
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
        	<a href="<?php echo base_url().'superadmin/product/manage/'; ?>">Manage Product</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Add Product</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Add Product</h3>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/product/manage/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>
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
                      <label class="col-sm-3 col-lg-2 control-label">Product Image</label>
                      <div class="col-sm-9 col-md-10 controls">
                         <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                            </div>
                             <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                               <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                               <span class="fileupload-exists">Change</span>
                               <input type="file" class="default" name="product_image" id="product_image" />
                               </span>
                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                <div class="error_msg" id="error_product_image" style="display:none;"></div>
                            </div>
                         </div>
                       <?php if($upload_error!='') 
					  {?>  <div class="error_msg"  style="display:show;"><?php echo $upload_error; ?></div> <?php }?>
                      </div>
                </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Title </label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Product Tilte" value=""/>
                         <?php echo form_error('product_title'); ?>
                         <div class="error_msg" id="error_product_title" style="display:none;"></div>
                      </div>
                   </div>
                  <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Description</label>
                     <div class="col-sm-9 col-lg-10 controls"><textarea id="product_desc" class="form-control col-md-12 ckeditor"   name="product_desc"></textarea>
                     <?php echo form_error('product_desc'); ?>
                       <div class="error_msg" id="error_product_desc" style="display:none;"></div>
                    </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 col-lg-2 control-label">Point </label>
                     <div class="col-sm-9 col-lg-10 controls">
                     <input type="text" class="form-control" name="product_point" id="product_point" placeholder="Product Point" value="" />
                         <?php echo form_error('product_point'); ?>
                         <div class="error_msg" id="error_product_point" style="display:none;"></div>
                      </div>
                   </div>
                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" value="Add" class="btn btn-primary" name="btn_add_product" id="btn_update_product" lang="add">
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