<!-- BEGIN Content -->
<div id="main-content">
    <!-- BEGIN Page Title -->
	<div class="page-title">
        <div>
            <h1><i class="fa fa-list-alt"></i> Categories</h1>
            <h4>Manage Categories</h4>
        </div>
	</div>
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url().'superadmin/admin/dashboard/'; ?>">Home</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active">Manage Categories</li>
        </ul>
    </div>
	<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->
<form name="frm-manage-category" id="frm-manage-category" method="post" action="<?php echo base_url().'superadmin/categories/multipleaction' ?>">
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
                <strong>Error! </strong><?php echo $this->session->flashdata('error'); ?>
            </div>
       <?php } ?>
        <div id="message_limit"  class="alert alert-danger" style="display:none;"></div>
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-list-alt"></i> Manage Categories</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
                        <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Add new record" href="<?php echo base_url().'superadmin/categories/add' ?>">
                        <i class="fa fa-plus"></i>
                        </a>
                    <button type="submit" name="multicat_block" id="multicat_block"  class="btn btn-circle btn-primary btn-bordered btn-primary" onclick="return check_mult_action('chkcat[]','frm-manage-category');"><i class="fa fa-unlock-alt"></i></button>
                	<button type="submit" name="multicat_unblock" id="multicat_unblock"  class="btn btn-circle btn-primary btn-bordered btn-primary" onclick="return check_mult_action('chkcat[]','frm-manage-category');"><i class="fa fa-unlock"></i> </button>
                	<button type="submit" name="multicat_del" id="multicat_del" class="btn btn-circle btn-primary btn-bordered btn-primary" onclick="return check_mult_action('chkcat[]','frm-manage-category');"><i class="fa fa-trash-o"></i></button>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/categories/manage' ?>"><i class="fa fa-repeat"></i></a>
                    </div>
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <?php if(count($categories)>0){ ?>
                    <div class="table-responsive" style="border:0">
                    <table class="table table-advance" id="table1">
                        <thead>
                            <tr>
                                <th style="width:18px"><input type="checkbox" /></th>
                                <th>Category Name</th>
                                <th>Menu Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
							foreach($categories as $cat)
							{
								$class="";
								if($cat->category_level==2){$class='manage-depth2';}
								else 
								if($cat->category_level==3){$class='manage-depth3';}
								$res=$this->master_model->getRecordCount('tbl_coupon_master',array('coupon_cat_id'=>$cat->category_id));	
						?>
                                <tr>
                                    <td>
                                    <?php  
								if($res>0){?>
                                    <input type="checkbox" id="chkcat[]" name="chkcat[]" value=""/>
                                      <?php }else{?>
                                      <input type="checkbox" id="chkcat[]" name="chkcat[]" value="<?php echo $cat->category_id; ?>" />
                                      <?php } ?>
                                    </td>
                                    <td class="<?php echo $class; ?>"><?php echo $cat->category_name; ?></td>
                                    <td><input type="checkbox" id="catemenu" name="catemenu[]" value="<?php echo $cat->category_id; ?>"  class="cate_menu" <?php if($cat->category_menu=='1'){echo ' checked="checked"';}?>/></td>
                                    
                                <td>
                                 <?php  
								if($res>0){?>
                                <span class="label label-info" style="padding-top:2px;"><i class=""></i> In Use</span>
                                <?php }else{?>
                                <?php if($cat->category_status==0){ ?>
                                <a href="<?php echo base_url().'superadmin/categories/changestatus/'.base64_encode($cat->category_id).'/1/';?>"><i class="fa fa-unlock-alt" style="font-size: 20px;"></i></a>							<?php }
                                else {?>
                                <a href="<?php echo base_url().'superadmin/categories/changestatus/'.base64_encode($cat->category_id).'/0/';?>"><i class="fa fa-unlock" style="font-size: 20px;"></i></a>
								<?php }	?>
                                 <?php }?>        
                                </td>
                                <td>
                                <a  title="Edit selected" href="<?php echo base_url().'superadmin/categories/edit/'.base64_encode($cat->category_id); ?>"><i class="fa fa-edit" style="font-size: 18px;"></i></a> 
                                <?php  
								if($res>0){?>
                                <span class="label label-info" style="padding-top:2px;"><i class=""></i> In Use</span>
                                <?php }else{?>                                
                                <a  title="Delete" href="<?php echo base_url().'superadmin/categories/delete/'.base64_encode($cat->category_id); ?>" onclick="return del_confirm();" ><i class="fa fa-trash-o" style="font-size: 18px;"></i></i></a>
                                <?php }?>                                
                                  </td>
                                </tr>
                         <?php
						    }
						 ?>
                        </tbody>
                    </table>
                    </div>
                <?php } else{ ?>
                <div class="alert alert-info">
                    <button class="close" data-dismiss="alert">×</button>
                    <strong>Sorry!</strong> No records found.
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</form>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.js"></script>
