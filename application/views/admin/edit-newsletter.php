<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa-pencil-square"></i>Update Newsletter</h1>

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
        	<a href="<?php echo base_url().'superadmin/newsletter/manage/'; ?>">Manage Newsletter</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Update Newsletter</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Update Newsletter</h3>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/newsletter/manage/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>
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
                      <label class="col-sm-3 col-lg-2 control-label">Subject </label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <input type="text" class="form-control" name="newsletter_subject" id="newsletter_subject" placeholder="Subject" value="<?php echo $newsinfo[0]['newsletter_subject']; ?>" data-rule-required="true" />
                         <?php echo form_error('newsletter_subject'); ?>
                         <div class="error_msg" id="error_newsletter_subject" style="display:none;"></div>
                      </div>
                   </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Title </label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <input type="text" class="form-control" name="news_title" id="news_title" placeholder="News Tilte" value="<?php echo $newsinfo[0]['news_title']; ?>" data-rule-required="true" />
                         <?php echo form_error('news_title'); ?>
                         <div class="error_msg" id="error_news_title" style="display:none;"></div>
                      </div>
                   </div>
                  <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Description</label>
                     <div class="col-sm-9 col-lg-10 controls">
                     <textarea class="form-control col-md-12 ckeditor" name="news_description"  id="news_description" rows="6" data-rule-required="true"><?php echo $newsinfo[0]['news_description']; ?></textarea>
                     <?php echo form_error('news_description'); ?>
                       <div class="error_msg" id="error_news_description" style="display:none;"></div>
                    </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" value="Update" class="btn btn-primary" name="btn_update_newsletter" id="btn_add_newsletter">
                        <!-- <button type="reset" class="btn">Cancel</button>-->
                   </div>
                   </div>
               </form>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script> 