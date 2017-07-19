<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa-pencil-square"></i>Update Brands</h1>
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
        	<a href="<?php echo base_url().'superadmin/seller/manageseller/'; ?>">Manage Seller</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Seller Brand Detail's</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Update Brand</h3>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/seller/manageseller/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">
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
                   <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Select Brands 
                    </label>
                    <div class="col-sm-9 col-lg-10 controls">
                    <?php 
					$info=explode(',',$sellerinfo[0]['brands_id']);
					if (count($brandinfo)>0)
					{
					foreach($brandinfo as $brand)
					{ ?>
					  <label class="checkbox-inline">
                     <input type="checkbox"  name="brands_id[]"  id="brands_id"  class="chk_checked" value="<?php echo $brand['brand_id']; ?>"
                      <?php if(in_array( $brand['brand_id'],$info)){echo 'checked="checked"';}?>/><?php echo $brand['brand_title']; ?>
                      </label>
                      <?php }}else { ?><span class="alert alert-danger" style="text-align:center;">Brand not found.</span><?php }?>
                    </div>
                    <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
                    <div class="error_msg col-sm-9 col-lg-9" id="error_brands_id" style="display:none;"></div>
                   </div>
                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" value="Submit" class="btn btn-primary" name="btn_update_brands" id="btn_update_brands" >
                         <button type="reset" class="btn">Cancel</button>
                   </div>
                   </div>
               </form>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->