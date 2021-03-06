 <!-- BEGIN Content -->
<div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="fa fa-plus-circle"></i> Categories</h1>
            <h4>Add Category</h4>
        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url(),'superadmin/dashboard/'; ?>">Home</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li >
                <a href="<?php echo base_url().'superadmin/categories/manage' ?>"> Manage Categories</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active"> Add Category</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->
	<!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
        	<?php if($this->session->flashdata('success')!=""){ ?>
            <div class="alert alert-success">
                <button class="close" data-dismiss="alert">×</button>
                <strong>Success! </strong><?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php }if($this->session->flashdata('error')!=""){ ?>
            <div class="alert alert-danger">
                <button class="close" data-dismiss="alert">×</button>
                <strong>Error! </strong><?php echo strip_tags($this->session->flashdata('error')); ?>
            </div>
            <?php } ?>
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i> Add Category</h3>
                    <div class="box-tool">
                        <a href="<?php echo base_url().'superadmin/categories/manage'?>"><i class="fa fa-chevron-up"></i></a>
                        <!--<a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                    </div>
                </div>
                <div class="box-content">
                	<form action="" class="form-horizontal" id="validation-form" name="frm-add-category" method="post">
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label" for="category_name">Category Name:</label>	
                            
                        	<div class="col-sm-6 col-lg-4 controls">
                            	<input type="text" name="category_name" id="category_name" class="form-control"  data-rule-minlength="3" placeholder="Category Name" />
                            	<div class="error_msg"><?php if(form_error('category_name')!=""){echo form_error('category_name');} ?></div>
                                <div class="error_msg" id="error_category_name" style="display:none;"></div>
                            </div>
                        </div>
						
                        <?php /*?><div class="form-group">
                            <label for="select" class="col-sm-3 col-lg-2 control-label">Parent</label>
                            <div class="col-sm-6 col-lg-4 controls">
                                <select class="form-control" name="parent_cat" id="parent_cat" >
                                    <option value="0,0">-- Parent Category --</option>
                                    <?php 
										if(count($parent)>0)
										{
											foreach($parent as $parent)
											{
												$class="depth1";
												if($parent->category_level==2){$class="depth2";}
									?>
                                    	<option class="<?php echo $class; ?>" value="<?php echo $parent->category_id.','.$parent->category_level; ?>"><?php echo $parent->category_name; ?></option>
                                    <?php
											}
										}
									?>
                                </select><div class="error_msg" id="error_parent_cat" style="display:none;"></div>
                            </div>
                        </div><?php */?>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                <input type="submit" name="add_category" id="add_category" class="btn btn-primary" value="Submit">
                                <input type="reset" class="btn" value="Cancel">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- END Main Content -->