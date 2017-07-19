<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa fa-pencil-square-o"></i>User Details</h1>
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
        	<a href="<?php echo base_url().'superadmin/user/manageuser/'; ?>">Manage User</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">User  Details</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>User Details</h3>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/user/manageuser/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data">
                  <div class="row">
                 <div class="col-md-12 ">  
                   <div class="form-group">
                      <label style="font-style:italic" class="col-sm-3 col-lg-6 control-label"><strong>User Details Information :</strong></label>
                  </div> 
                 </div> 
                 <div class="col-md-6 "> 
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Name :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo stripslashes(ucfirst($userdetail[0]['first_name'].' '.$userdetail[0]['last_name'])); ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Email Id :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $userdetail[0]['email_id']; ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Contact Number :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $userdetail[0]['contact_no']; ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">City :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $userdetail[0]['city_id']; ?>
					  </div>
                  </div>
                   
                  <div class="form-group">
                        <label class="col-xs-3 col-lg-4">Profile Image :</label>
                       <div class="col-sm-7 col-lg-7 " >
                        
                         <?php if($userdetail[0]['profile_picture']!="") 
						 {?>
                         <img src="<?php echo base_url();?>uploads/profile_image/<?php echo $userdetail[0]['profile_picture'];?>" width="55" height="55"/><?php }
						 else
						 {?>
                          <img src="<?php echo base_url();?>images/default_user_icon.png" width="55" height="55"  />
                         <?php }?>
             		  </div>
                  </div>
                  </div>
                 
                  <div class="col-md-6 "> 
                   
                      <div class="form-group">
                       <label class="col-xs-3 col-lg-4"> Username : </label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php if($userdetail[0]['username']!=""){echo $userdetail[0]['username'];}else{echo '--';} ?>
					  </div>
                  </div>
                  <div class="form-group">
                       <label class="col-xs-3 col-lg-4"> Password : </label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $userdetail[0]['password'];?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Address :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $userdetail[0]['address']; ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">State :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $userdetail[0]['state_id']; ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Country :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <?php echo $userdetail[0]['country']; ?>
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