<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/admin-validation.js"></script>
<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i>Manage User's</h1>
      <!-- <h4>User's</h4>-->
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
        <li class="active">Manage User's</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-user" id="frm-manage-user" action="<?php echo base_url().'superadmin/user/multiactionchange/';?>"  method="post">
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
                <h3><i class="fa fa-pencil-square"></i> Manage User's</h3>
                <div class="box-tool">
                   <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
<!--               <button type="submit" name="multiple_delete" id="multiple_delete"  class="btn btn-circle btn-primary btn-bordered btn-primary"><i class="fa fa-trash-o"></i></button>-->
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Delete Selected" href="javascript:void(0);" onclick="javascript : return multipledeletconfirm('frm-manage-user');">
                    <i class="fa fa-trash-o"></i>
                    </a>
                    </div>
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Block" href="javascript:void(0);" onclick="javascript : return multipleactivestatus('frm-manage-user');">
                    <i class="fa fa-unlock-alt"></i>
                    </a>
                    </div>
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Active" href="javascript:void(0);" onclick="javascript : return multipleblockstatus('frm-manage-user');">
                    <i class="fa fa-unlock"></i>
                    </a>
                   <!-- <button type="submit" name="unblockmultiple" id="unblockmultiple"  class="btn btn-circle btn-primary btn-bordered btn-primary"><i class="fa fa-unlock"></i></button>-->
                    </div>
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/user/manageuser/'; ?>"><i class="fa fa-repeat"></i></a> 
                    </div>
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                  <input type="hidden" id="status_chck" name="status_chck" value="" />
                    <table class="table table-advance" <?php if(count($fetch_user)>0)
					{?> id="table1" <?php } ?>>
                       <thead>
                            <tr>
                               <th style="width:18px">
                               <input type="checkbox"/></th>
                               <th>Name </th>
                               <th>Username </th>
                               <th>Email Id </th>
                               <th>Contact Number</th>
                               <th>State</th>
                               <th>City</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						 if(count($fetch_user)>0)
						 {
						   foreach($fetch_user as $user)
						   { 
						     $sell=$user['login_id'];
						   ?>
                             <tr>
                                <td style="width:18px">
                                <input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $user['login_id']; ?>"/>
                                </td>
                                <td><?php echo stripslashes(ucfirst($user['first_name']).' '.$user['last_name']);?></td>
                                <td><?php echo stripslashes($user['username']);?></td>
                                <td><?php echo $user['email_id'];?></td>
                                <td><?php echo $user['contact_no'];?></td>
                                <td><?php echo $user['state_id'];?></td>
                                <td><?php echo $user['city_id'];?></td>
                                <td>
								<?php if($user['user_status']=='1') { ?>
								<a href="<?php echo base_url('superadmin/user/userstatus/'.base64_encode($user['login_id']).'/0');?>" title="Click here for Block">
                                <i class="fa fa-unlock" style="font-size: 20px;"></i>
                                </a>
								<?php } else{ ?>
								<a href="<?php echo base_url('superadmin/user/userstatus/'.base64_encode($user['login_id']).'/1');?>" title="Click here for Active">
                                <i class="fa fa-unlock-alt" style="font-size: 20px;"></i>
                                </a>
								<?php } ?>
                                </td>
                                <td>
                                <a  href="<?php echo base_url().'superadmin/user/updateuser/'.base64_encode($user['user_id']);?>" title="Click here for Edit"><i class="fa fa-edit"  style="font-size: 18px;"></i>
                                </a>
                                <a href="<?php echo base_url().'superadmin/user/deleteuser/'.base64_encode($user['user_id']).'/'.base64_encode($user['login_id']);?>" onclick="javascript : return deletconfirm();" title="Click here for Delete" ><i class="fa fa-trash-o"  style="font-size: 18px;"></i></a>
                               <a class="glyphicon glyphicon-eye-open" title="Details" href="<?php echo base_url().'superadmin/user/detail/'.base64_encode($user['user_id']);?>"></a>
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
	$('.message_new').fadeOut(3000);
	},3000);
 });
</script>
