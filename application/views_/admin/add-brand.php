<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1>  <i class="fa fa-pencil-square"></i> Brand</h1>
        <h4>Add Brand</h4>
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
        <li class="active">Add Brand</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-pencil-square"></i> Brand</h3>
                <div class="box-tool">
                	<a class="show-tooltip" title="Back" href="<?php echo base_url().'superadmin/admin/managebrand/' ?>">
<i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
						<?php 
                          if($error!=''){  ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } 
                          if($this->session->flashdata('success')!=''){?>	
                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php } ?>
                                <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <!-- BEGIN Left Side -->
                                            <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="brand_title">Title</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    <input type="text" class="form-control" placeholder="Brand Title" id="brand_title" name="brand_title" data-rule-required="true" >
                                                    <div class="error_msg" id="error_brand_title" style="display:none;"></div>
                                                </div>
                                            </div>
                                         
                                            
                                            <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="title_desc">Description</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                   <textarea class="form-control col-md-12 ckeditor" name="brand_desc"  id="brand_desc" rows="6" data-rule-required="true"></textarea>
                                                   <div class="error_msg" id="error_brand_desc" style="display:none;"></div>
                                                </div>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="blog_logo">Brand Image</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                   <input type="file" name="brand_image" id="brand_image" value="" ><div class="error_msg" id="error_brand_image" style="display:none;"></div>
                                                    <?php if($upload_error!='') 
													  {?>  <div class="error_msg"  style="display:show;"><?php echo $upload_error; ?></div> <?php }?>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                                   <button class="btn btn-primary" type="submit" name="btn_add_brand" id="btn_add_brand">Submit</button>
                                                   <a href="<?php echo base_url() ;?>superadmin/admin/addbrand">
                                                   <button class="btn" type="button">Cancel</button>
                                                   </a>
                                                </div>
                                            </div>
                                          <!-- END Left Side -->
                                       </div>
                                    </div>
                                 </form>
                            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script> 