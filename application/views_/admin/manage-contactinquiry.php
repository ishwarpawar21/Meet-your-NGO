<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/admin-validation.js"></script>
<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-phone-square"></i>Contact Enquiries</h1>
       <h4>Contact Enquiries</h4>
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
        <li class="active">Manage Contact Enquiries</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-cont" id="frm-manage-cont" action="<?php echo base_url().'superadmin/frontpages/deletemultiplecontactinq/';?>"  method="post">
<div class="row">

    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-table"></i>Manage Contact Enquiries</h3>
                <div class="box-tool">
                   <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                	<div class="btn-group">
                        <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Delete selected" href="javascript:void(0);" onclick="javascript : return multipledeletconfirm('frm-manage-cont');"><i class="fa fa-trash-o"></i></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/frontpages/managecontactinquiry/'; ?>"><i class="fa fa-repeat"></i></a>
                    </div>
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                
                <div class="table-responsive" style="border:0">
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
                    <table class="table table-advance" <?php if(count($fetch_manage_contactinquiry)>0){?> id="table1" <?php } ?>>
                       <thead>
                       
                            <tr>
                               <th style="width:18px"><input type="checkbox" /></th>
                               <th>Name</th>
                               <th>Mobile No.</th>
                               <th>Email</th>
                               <th>Message</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						 if(count($fetch_manage_contactinquiry)>0)
						 {
						   foreach($fetch_manage_contactinquiry as $rowcontactinquiry)
						   {  	
						 ?>
                             <tr>
                                <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $rowcontactinquiry['con_id']; ?>"/></td>
                                <td><?php echo stripslashes(ucfirst($rowcontactinquiry['con_first_name'])).' '.stripslashes(ucfirst($rowcontactinquiry['cont_last_name']));?></td>
                                <td><?php echo $rowcontactinquiry['cont_mobile']; ?></td>
                                <td><?php echo $rowcontactinquiry['cont_email']; ?></td>
                                <td style="vertical-align:top;"><?php echo stripslashes(substr(strip_tags($rowcontactinquiry['cont_message'],'<p>'),0,80)); ?></td>
                                <td>
                                	<a class="btn btn-danger btn-sm show-tooltip deleteconfirm" href="<?php echo base_url().'superadmin/admin/deletecontactinquiry/'.base64_encode($rowcontactinquiry['con_id']);?>" onclick="javascript : return deletconfirm();" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                    
                                  <a title="Click here to view more" href="<?php echo base_url() ; ?>superadmin/admin/contactenquirydetails/<?php echo base64_encode($rowcontactinquiry['con_id']);  ?>">
<i class="fa fa-eye" style="font-size: 18px;"></i>
</a>
								</td>               
                             </tr>
                        <?php    }}else{ ?>
                        <tr>
                          <td colspan="7"><div class="alert alert-danger" style="text-align:center;">No Data Found.</div></td>
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
<script type="text/javascript">
$(document).ready( function ()
{	$("#contact_new_ref").load(location.href+'#contact_new_ref'); });
</script>