<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i>Manage Product</h1>
       <h4>Manage Product</h4>
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
        <li class="active">Manage Product</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-product" id="frm-manage-product" action="<?php echo base_url().'superadmin/product/multipleaction/';?>"  method="post">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Manage Product</h3>
                <div class="box-tool">
                   <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
                    	<a class="btn btn-circle btn-primary btn-bordered btn-primary" href="<?php echo base_url();?>superadmin/product/add/" title="Add">
<i class="fa fa-plus"></i></a>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Active" href="javascript:void(0);" onclick="javascript : return multipleactivestatus('frm-manage-product');"><i class="fa fa-dot-circle-o"></i></a>
                         <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Block" href="javascript:void(0);" onclick="javascript : return multipleblockstatus('frm-manage-product');"><i class="fa fa-circle-o"></i></a>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Delete selected" href="javascript:void(0);" onclick="javascript : return multipledeletconfirm('frm-manage-product');"><i class="fa fa-trash-o"></i></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Refresh" href="<?php echo base_url().'superadmin/product/manage/'; ?>"><i class="fa fa-repeat"></i></a>
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
                    <table class="table table-advance" <?php if(count($fetch_manage_product)>0){?> id="table1" <?php } ?>>
                       <thead>
                           <tr>
                               <th style="width:18px"><input type="checkbox" /></th>
                               <th>Product Title</th>
                               <th>Description</th>
                               <th>Product Point</th>
                               <th>Image</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						 if(count($fetch_manage_product)>0)
						 {
						   foreach($fetch_manage_product as $product)
						   {  	
						 ?>
                             <tr>
                           <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $product['product_id'];?>"/></td> 
                                <td><?php echo stripslashes($product['product_title']); ?></td>
                                <td style="vertical-align:top;"><?php echo stripslashes(substr(strip_tags($product['product_desc'],'<p>'),0,60)); ?></td>
                                 <td><?php echo $product['product_point']; ?></td>
                                <td><img src="<?php echo base_url().'uploads/product_image/'.$product['product_image']; ?>" height="50" width="50" title=<?php $product['product_image']; ?> /></td>
                                <td>
                                	<?php if($product['product_status']==0){ ?>
                                	<a href="<?php echo base_url().'superadmin/product/status/'.base64_encode($product['product_id']).'/1/';?>" title="Block"><i class="fa fa-circle-o"></i></a>							<?php }
									else {?>
									<a href="<?php echo base_url().'superadmin/product/status/'.base64_encode($product['product_id']).'/0/';?>"  title="Active"><i class="fa fa-dot-circle-o"></i></a>
									<?php }	?>
                                </td>
                                <td>
                                <a class="btn btn-primary btn-sm show-tooltip" href="<?php echo base_url().'superadmin/product/update/'.base64_encode($product['product_id']);?>" data-original-title="Edit"><i class="fa fa-edit"></i>
                                </a>
                                <a class="btn btn-danger btn-sm show-tooltip deleteconfirm" href="<?php echo base_url().'superadmin/product/delete/'.base64_encode($product['product_id']).'/'.base64_encode($product['product_image']);?>" onclick="javascript : return deletconfirm();" title="Delete" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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