<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i>Purchased Product</h1>
       <h4>Purchased Product</h4>
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
        <li class="active">Purchased Product</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-product" id="frm-manage-product" action="<?php echo base_url().'superadmin/product/multipleaction/';?>"  method="post">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Purchased Product</h3>
                <div class="box-tool">
                   <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Refresh" href="<?php echo base_url().'superadmin/product/purchased/'; ?>"><i class="fa fa-repeat"></i></a>
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
                        <div id="message" class="alert alert-danger" style="display:none;"></div>
                        <div id="message_confirm" class="alert alert-danger" style="display:none;"></div>
                     </div>
				  </div>
                   <input type="hidden" id="status_chck" name="status_chck" value="" />
                    <table class="table table-advance" <?php if(count($fetch_purchased_product)>0){?> id="table1" <?php } ?>>
                       <thead>
                           <tr>
                               <th style="width:18px"><input type="checkbox" /></th>
                               <th>Email</th>
                               <th>User Name</th>
                               <th>Product Point</th>
                               <th>Date</th>
                               <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php
						 if(count($fetch_purchased_product)>0)
						 {
						   foreach($fetch_purchased_product as $product)
						   {  	
						 ?>
                             <tr>
                           <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $product['purchase_id'];?>"/></td> 
                           <td><?php echo $product['email_id']; ?></td>
                                <td><?php echo $product['user_slug']; ?></td>
                                <td style="vertical-align:top;"><?php echo $product['purchase_point']; ?></td>
                                 <td><?php echo date('dS M,Y',strtotime($product['purchase_date'])); ?></td>
                                <td>
                                <select class="form-control purchased_status" id="purchased_status" name="purchased_status" style="width:120px;" lang="<?php echo $product['purchase_id'];?>">
                                <option value="Pending" <?php if($product['status']=='Pending'){echo 'selected="selected"';}?>>Pending</option>
                                <option value="Approved" <?php if($product['status']=='Approved'){echo 'selected="selected"';}?>>Approved</option>
                                <option value="Cancel" <?php if($product['status']=='Cancel'){echo 'selected="selected"';}?>>Cancel</option>
                                </select>
                                <span id="loader" style="display:none;"><img src="<?php echo base_url();?>images/712.GIF" width="20px" height="20px" /></span>
                                </td>
                             </tr>
                        <?php }}else { ?>
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