<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa-renren"></i>Dynamic pages</h1>
        <h4>Update Dynamic pages</h4>
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
        	<a href="<?php echo base_url().'superadmin/frontpages/managefrontpage/'; ?>">Manage Front Pages</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Dynamic pages</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i> Dynamic pages</h3>
                <div class="box-tool">
                	<a class="show-tooltip" title="" href="<?php echo base_url().'superadmin/frontpages/managefrontpage' ?>">
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
                                <form class="form-horizontal" id="validation-form" method="post">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <!-- BEGIN Left Side -->
                                            <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="page_name"> Name</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    <input type="text" class="form-control" placeholder="Page Name" id="page_name" name="page_name" data-rule-required="true" value="<?php echo $frontcontent[0]['front_page_name']; ?>"><div class="error_msg" id="error_page_name" style="display:none;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="page_title">Title</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    <input type="text" class="form-control" placeholder="Page Title" id="page_title" name="page_title" data-rule-required="true" value="<?php echo $frontcontent[0]['front_page_title']; ?>">
                                                    <div class="error_msg" id="error_page_title" style="display:none;"></div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="meta_title">Meta Title</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    <input type="text" class="form-control" placeholder="Meta Title" id="meta_title" name="meta_title" data-rule-required="true" value="<?php echo $frontcontent[0]['meta_title']; ?>">
                                                    <div class="error_msg" id="error_meta_title" style="display:none;"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="meta_keyword">Meta Keyword</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    <input type="text" class="form-control" placeholder="Meta Keyword" id="meta_keyword" name="meta_keyword" data-rule-required="true" value="<?php echo $frontcontent[0]['meta_keywords']; ?>">
                                                    <div class="error_msg" id="error_meta_keyword" style="display:none;"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="meta_desc">Meta Description</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                   <textarea class="form-control" rows="5" id="meta_desc" name="meta_desc" data-rule-required="true"><?php echo $frontcontent[0]['meta_desc']; ?></textarea>
                                               <div class="error_msg" id="error_meta_desc" style="display:none;"></div>   
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="page_description">Description</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                   <textarea class="form-control col-md-12 ckeditor" name="page_description"  id="page_description" rows="6" data-rule-required="true"><?php echo $frontcontent[0]['front_page_description']; ?></textarea>
                                                   <div class="error_msg" id="error_page_description" style="display:none;"></div>   
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                                   <button class="btn btn-primary" type="submit" name="brm_frontpage" id="brm_frontpage" ><i class="fa fa-check"></i> Save</button>
                                                   <button class="btn" type="reset">Cancel</button>
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

