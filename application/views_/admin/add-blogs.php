<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1>  <i class="fa fa-pencil-square"></i> Blogs</h1>
        <h4>Add Blogs</h4>
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
        <li class="active">Add Blogs</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-pencil-square"></i> Blogs</h3>
                <div class="box-tool">
                	<a class="show-tooltip" title="" href="<?php echo base_url().'superadmin/blogs/manageblogs' ?>">
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
                                                <label class="col-xs-3 col-lg-2 control-label" for="blog_name">Name</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                    <input type="text" class="form-control" placeholder="Page Name" id="blog_name" name="blog_name" data-rule-required="true" >
                                                </div>
                                            </div>
                                         
                                            
                                            <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="blog_desc">Description</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                   <textarea class="form-control col-md-12 ckeditor" name="blog_desc"  id="blog_desc" rows="6" data-rule-required="true"></textarea>
                                                </div>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label class="col-xs-3 col-lg-2 control-label" for="blog_logo">Blog Image</label>
                                                <div class="col-sm-9 col-lg-10 controls">
                                                   <input type="file" name="blog_logo" id="blog_logo" value="" >
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                                   <button class="btn btn-primary" type="submit" name="btn_add_blogs" id="btn_add_blogs"><i class="fa fa-check"></i> Save</button>
                                                   <a href="<?php echo base_url() ;?>superadmin/blogs/manageblogs/">
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