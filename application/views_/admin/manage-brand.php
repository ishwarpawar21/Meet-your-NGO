<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i>Manage Brand</h1>
       <h4>Manage Brand</h4>
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
        <li class="active">Manage Brand</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-brand" id="frm-manage-brand" action="<?php echo base_url().'superadmin/admin/deletemultiplebrand/';?>"  method="post">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Manage Brand</h3>
                <div class="box-tool">
                   <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                	<div class="btn-group">
                    	<a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Active" href="javascript:void(0);" onclick="javascript : return multipleactivestatus('frm-manage-brand');"><i class="fa fa-dot-circle-o"></i></a>
                         <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Block" href="javascript:void(0);" onclick="javascript : return multipleblockstatus('frm-manage-brand');"><i class="fa fa-unlock-alt"></i></a>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Delete selected" href="javascript:void(0);" onclick="javascript : return multipledeletconfirm('frm-manage-brand');"><i class="fa fa-trash-o"></i></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Refresh" href="<?php echo base_url().'superadmin/admin/managebrand/'; ?>"><i class="fa fa-repeat"></i></a>
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
                    <table class="table table-advance" <?php if(count($fetch_manage_brand)>0){?> id="table1" <?php } ?>>
                       <thead>
                           <tr>
                               <th style="width:18px"><input type="checkbox" /></th>
                               <th>User Name</th>
                               <th>Brand Title</th>
                               <th>Description</th>
                               <th>Image</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						 if(count($fetch_manage_brand)>0)
						 {
						   foreach($fetch_manage_brand as $brand)
						   {  	
						 ?>
                             <tr>
                           <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $brand['brand_id'];?>"/></td> 
                                <td><?php echo ucfirst($brand['username']); ?></td>
                                <td><?php echo $brand['brand_title']; ?></td>
                                <td style="vertical-align:top;"><?php echo stripslashes(substr(strip_tags($brand['brand_desc'],'<p>'),0,60)); ?></td>
                                <td><img src="<?php echo base_url().'uploads/brand/'.$brand['brand_image']; ?>" height="50" width="50" title=<?php $brand['brand_image']; ?> /></td>
                                <td>
                                	<?php if($brand['brand_status']==0){ ?>
                                	<a href="<?php echo base_url().'superadmin/admin/brandstatus/'.base64_encode($brand['brand_id']).'/1/';?>" title="Block"><i class="fa fa-circle-o"></i></a>							<?php }
									else {?>
									<a href="<?php echo base_url().'superadmin/admin/brandstatus/'.base64_encode($brand['brand_id']).'/0/';?>"  title="Active"><i class="fa fa-dot-circle-o"></i></a>
									<?php }	?>
                                </td>
                                <td>
                                <a class="btn btn-primary btn-sm show-tooltip" href="<?php echo base_url().'superadmin/admin/updatebrand/'.base64_encode($brand['brand_id']);?>" data-original-title="Edit"><i class="fa fa-edit"></i>
                                </a>
                                 <?php 
								 $this->db->where('FIND_IN_SET('.$brand['brand_id'].',tbl_seller_details.brands_id)!=0');
								 $id=$this->master_model->getRecords('tbl_seller_details');
								 $cid=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_brand_id'=>$brand['brand_id']));
								 $bid=count($id);
								 $cd=count($cid);
								 if($bid=='0' && $cd=='0')
								 {
								 ?>
                                <a class="btn btn-danger btn-sm show-tooltip deleteconfirm" href="<?php echo base_url().'superadmin/admin/deletebrand/'.base64_encode($brand['brand_id']).'/'.base64_encode($brand['brand_image']);?>" onclick="javascript : return deletconfirm();" title="Delete" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
								</td>  <?php }else {?> <span class="btn btn-danger btn-sm show-tooltip" title="" data-original-title="In Use">
<i class="glyphicon glyphicon-ban-circle"></i>
</span><?php }?>             
                             </tr>
                        <?php 
						   }
						 }
						 else
						 { ?>
                         
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
