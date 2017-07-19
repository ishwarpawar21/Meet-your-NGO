<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa-envelope-o"></i>Update Message</h1>
        <h4>Update Message</h4>
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
        <!--<li>
        	<a href="<?php echo base_url().'superadmin/admin/addmessage/'; ?>">Manage Message</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>-->
        <li class="active">Update Message</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Update Message</h3>
                <div class="box-tool">
                    <!--<a  class="show-tooltip" href="<?php //echo base_url().'superadmin/admin/addmessage/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>-->
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
                      <label class="col-sm-3 col-lg-2 control-label">Title </label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <input type="text" class="form-control" name="message_title" id="message_title" placeholder="Message Title" value="<?php echo $message[0]['message_title']; ?>" />
                         <?php echo form_error('message_title'); ?>
                         <div class="error_msg" id="error_message_title" style="display:none;"></div>
                      </div>
                   </div>
                  
                  <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Description</label>
                     <div class="col-sm-9 col-lg-10 controls">
                     <textarea class="form-control col-md-12 ckeditor" name="message_desc"  id="message_desc" rows="6" ><?php echo $message[0]['message_desc']; ?></textarea>
                     <?php echo form_error('message_desc'); ?>
                       <div class="error_msg" id="error_message_desc" style="display:none;"></div>
                    </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" value="Update" class="btn btn-primary" name="btn_update_message" id="btn_update_message">
                       
                     </div>
                   </div>
               </form>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script> 
