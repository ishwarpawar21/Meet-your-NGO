<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/admin-validation.js"></script>
<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i>Manage Seller's</h1>
      <!-- <h4>Seller's</h4>-->
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
        <li class="active">Manage Seller's</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-seller" id="frm-manage-seller" action="<?php echo base_url().'superadmin/seller/multiactionchange/';?>"  method="post">
<div class="row">
    <div class="col-md-12">
        <div class="box">
         <?php 
                      if($this->session->flashdata('error')!=''){  ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } 
                      if($this->session->flashdata('success')!=''){?>	
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php } ?>
                         <div id="message" class="alert alert-danger" style="display:none;"></div>
                        <div id="message_confirm" class="alert alert-danger" style="display:none;"></div>
            <div class="box-title">
                <h3><i class="fa fa-pencil-square"></i> Manage Seller's</h3>
                <div class="box-tool">
                   <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
<!--               <button type="submit" name="multiple_delete" id="multiple_delete"  class="btn btn-circle btn-primary btn-bordered btn-primary"><i class="fa fa-trash-o"></i></button>-->
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Delete" href="javascript:void(0);" onclick="javascript : return multipledeletconfirm('frm-manage-seller');">
                    <i class="fa fa-trash-o"></i>
                    </a>
                    </div>
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Block" href="javascript:void(0);" onclick="javascript : return multipleactivestatus('frm-manage-seller');">
                    <i class="fa fa-unlock-alt"></i>
                    </a>
                    </div>
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Active" href="javascript:void(0);" onclick="javascript : return multipleblockstatus('frm-manage-seller');">
                    <i class="fa fa-unlock"></i>
                    </a>
                   <!-- <button type="submit" name="unblockmultiple" id="unblockmultiple"  class="btn btn-circle btn-primary btn-bordered btn-primary"><i class="fa fa-unlock"></i></button>-->
                    </div>
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/seller/manageseller/'; ?>"><i class="fa fa-repeat"></i></a> 
                    </div>
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                  <input type="hidden" id="status_chck" name="status_chck" value="" />
                    <table class="table table-advance" <?php if(count($fetch_seller)>0){?> id="table1" <?php } ?>>
                       <thead>
                            <tr>
                               <th style="width:18px">
                               <input type="checkbox"/></th>
                               <th>Name </th>
                               <th>Username </th>
                               <th>Email Id </th>
                               <th>Manage Brand's</th>                    
                               <th>Coupon</th>  
                               <th>View coupon</th>                  
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						 if(count($fetch_seller)>0)
						 {
						   foreach($fetch_seller as $seller)
						   { 
						     $sell=$seller['loginid'];
						   ?>
                             <tr>
                                <td style="width:18px">
                                <input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $seller['seller_id']; ?>"/>
                                </td>
                                <td><?php echo stripslashes(ucfirst($seller['firstname']).' '.$seller['lastname']);?></td>
                                <td><?php echo stripslashes($seller['username']);?></td>
                                <td><?php echo $seller['email_id'];?></td>
                                <td>
                                <a href="javascript:void(0);" id="coupon<?php echo $seller['seller_id']; ?>" class="coupon" lang="<?php echo $seller['seller_id']; ?>">Brand's</a>
                                  <input type="text" name="brand" id="brand_<?php echo $seller['seller_id']; ?>"  value="<?php echo $seller['brandaccess']; ?>" style="width:30px; display:none"  class="btn_coupon" lang="<?php echo $seller['seller_id']; ?>" /> 
                                 <a href="javascript:void(0);" class="add show-tooltip" lang="<?php echo $seller['seller_id'];?>" id="add<?php echo $seller['seller_id'];?>" title="Submit" style="display:none; width:10px"><i class="fa fa-plus-circle"></i></a>
                                 <!-- <input type="button" class="add" lang="<?php echo $seller['loginid'];?>" id="add<?php echo $seller['seller_id'];?>" style="display:none; width:10px"/>-->
                                 <a href="javascript:void(0);" class="can show-tooltip" lang="<?php echo $seller['seller_id']; ?>" title="cancle"  style="display:none; width:10px" id="can<?php echo $seller['seller_id']; ?>"><i class="fa fa-times"></i></a> <div class="error_msg" id="error_brans<?php echo $seller['seller_id']; ?>"  style="display:none;"></div>
                                  <!--<input type="button" class="can" lang="<?php echo $seller['loginid']; ?>"  style="display:none; width:10px" id="can<?php echo $seller['seller_id']; ?>" />-->
                                </td>
                                <td>
                                 <a href="#" id="co<?php echo $seller['seller_id']; ?>" class="co" lang="<?php echo $seller['seller_id'];?>">Coupon </a>
                                 <input type="text" name="coupon" value="<?php echo $seller['addcoupon']; ?>" class="cupon" style="width:30px; display:none" id="co_<?php echo $seller['seller_id']; ?>" lang="<?php echo $seller['seller_id']; ?>"/>  
                        <a href="javascript:void(0);" name="addc" class="addc show-tooltip" lang="<?php echo $seller['seller_id']; ?>" id="addc<?php echo $seller['seller_id']; ?>" title="Submit" style="display:none; width:10px"><i class="fa fa-plus-circle"></i></a>        
                     <!-- <input type="button" name="addc" class="addc" lang="<?php echo $seller['loginid']; ?>" id="addc<?php echo $seller['seller_id']; ?>" style="display:none; width:10px" />-->
                      <a href="javascript:void(0);"  class="canc show-tooltip"   name="canc" lang="<?php echo $seller['seller_id']; ?>" id="canc<?php echo $seller['seller_id']; ?>" title="cancle" style="display:none; width:10px" /><i class="fa fa-times"></i></a><div class="error_msg" id="error_coupon<?php echo $seller['seller_id']; ?>"  style="display:none;"></div>
                                </td>
                                <td>
                                 <?php $coupon=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.login_id'=>$seller['loginid']));
								 $count=count($coupon);
								 ?>
                                <a href="<?php echo base_url('superadmin/seller/managecoupon/'.base64_encode($seller['loginid']));?>">View Coupon (<?php echo $count;?>)</a>
                                 <?php
								if($seller['coupon_notification']=='new'){ ?>
                                <span class="message_new label label-success label-small pull-middle">New</span>
                                <?php } 
								$update_notification_status=array('coupon_notification'=>'old'); 
				 				$this->master_model->updateRecord('tbl_seller_details',$update_notification_status,array('seller_id'=>$seller['seller_id']));?>
                                </td>
                                <td>
								<?php if($seller['user_status']=='1') { ?>
								<a href="<?php echo base_url('superadmin/seller/sellerstatus/'.base64_encode($seller['loginid']).'/0');?>" title="Click here for Block">
                                <i class="fa fa-unlock" style="font-size: 20px;"></i>
                                </a>
								<?php } else{ ?>
								<a href="<?php echo base_url('superadmin/seller/sellerstatus/'.base64_encode($seller['loginid']).'/1');?>" title="Click here for Active">
                                <i class="fa fa-unlock-alt" style="font-size: 20px;"></i>
                                </a>
								<?php } ?>
                                </td>
                                <td>
                                <a  href="<?php echo base_url().'superadmin/seller/updateseller/'.base64_encode($seller['seller_id']);?>" title="Click here for Edit"><i class="fa fa-edit"  style="font-size: 18px;"></i>
                                </a>
                                <a href="<?php echo base_url().'superadmin/seller/deleteseller/'.base64_encode($seller['seller_id']).'/'.base64_encode($seller['loginid']);?>" onclick="javascript : return deletconfirm();" title="Click here for Delete" ><i class="fa fa-trash-o"  style="font-size: 18px;"></i></a>
                               <a class="glyphicon glyphicon-eye-open" title="Details" href="<?php echo base_url().'superadmin/seller/detail/'.base64_encode($seller['seller_id']);?>"></a>
                                </td>
                             </tr>
                        <?php  } }else{ ?>
                        <tr>
                          <td colspan="9"><div class="alert alert-danger" style="text-align:center;">No Data Found.</div></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<!-- END Main Content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.js"></script>
<script language="javascript">
$(document).ready(function(){
   setTimeout(function(){
	$('.message_new').fadeOut(10000);
	},10000);
 });
</script>
