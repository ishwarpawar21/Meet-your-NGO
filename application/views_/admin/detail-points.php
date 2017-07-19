<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa fa-pencil-square-o"></i>Seller Points Details</h1>
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
        <li>
        	<a href="<?php echo base_url().'superadmin/seller/points/'.base64_encode($loginid); ?>">Manage Point's</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Seller Points Details</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Seller Points Details</h3>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/seller/points/'.base64_encode($loginid); ?>" title="Back"><i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data">
                  <div class="row">
                 <div class="col-md-12 ">  
                   <div class="form-group">
                      <label style="font-style:italic" class="col-sm-3 col-lg-6 control-label"><strong>Seller Points Details Information :</strong></label>
                  </div> 
                 </div> 
                 <div class="col-md-6 "> 
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Name :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo stripslashes(ucfirst($fetch_points_detail[0]['firstname'].' '.$fetch_points_detail[0]['lastname'])); ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Email Id :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $fetch_points_detail[0]['email_id']; ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Share Login id :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $fetch_points_detail[0]['share_login_id'];?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">City :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php if($fetch_points_detail[0]['poits_type']=='1') { echo "Facebook";}else{ echo "Twitter";}?>
					  </div>
                  </div>
                   <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Community Rank :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $fetch_points_detail[0]['community_rank']; ?>
					  </div>
                  </div>
                     <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Points Week :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $fetch_points_detail[0]['points_week']; ?>
					  </div>
                  </div>
                  <div class="form-group">
                        <label class="col-xs-3 col-lg-4">Coupons Used :</label>
                       <div class="col-sm-7 col-lg-7 " >
                        
                         <?php echo $fetch_points_detail[0]['coupons_used'];  ?>
             		  </div>
                  </div>
                  </div>
                 
                  <div class="col-md-6 "> 
                   
                      <div class="form-group">
                       <label class="col-xs-3 col-lg-4">Money Saved : </label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $fetch_points_detail[0]['money_saved'];?>
					  </div>
                  </div>
                  <div class="form-group">
                       <label class="col-xs-3 col-lg-4"> Comments Made : </label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $fetch_points_detail[0]['comments_made'];?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Coupons Submitted :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $fetch_points_detail[0]['coupons_submitted']; ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Coupons Rejected :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $fetch_points_detail[0]['coupons_rejected']; ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Saved Others :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $fetch_points_detail[0]['saved_others']; ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Earned :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $fetch_points_detail[0]['earned']; ?>
					  </div>
                  </div>
                 </div>
                 </div>
               </form>
            </div>
        </div>
    </div>
   
</div>
<!-- END Main Content -->