<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa fa-pencil-square-o"></i>Update User</h1>
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
        <li class="active">Update User </li>
    </ul>
</div>
       <?php if(isset($success) || $this->session->flashdata('success'))
			  {?>
              	<div class="alert alert-success"><?php echo $success;echo $this->session->flashdata('success');?> </div>
       <?php  } 
			 if(isset($error) || $this->session->flashdata('error'))
			 { ?>	
                <div class="alert alert-danger"><?php echo $error; echo $this->session->flashdata('error')?> </div> 
      <?php  }?> 
                    
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>User</h3>
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
                      <label style="font-style:italic" class="col-sm-3 col-lg-6 control-label"><strong>Update <?php echo $userinfo[0]['username'];?> Information :</strong></label>
                  </div> 
                 </div> 
                 <div class="col-md-6 "> 
                   <div class="form-group">
                      <label style="font-style:italic" class="col-sm-3 col-lg-6 control-label"><strong>About User :</strong></label>
                  </div> 
                  <div class="form-group">
                       <label class="col-xs-3 col-lg-4"> Username : </label>
                     <div class="col-sm-7 col-lg-7 " >
                       <input type="text" class="form-control" readonly="readonly" name="username" id="username" value="<?php echo $userinfo[0]['username'];?>" data-rule-required="true" />
                       <div class="error_msg" id="error_username" style="display:none;"></div>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">First Name :</label>
                     <div class="col-sm-7 col-lg-7 " >
                      <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $userinfo[0]['first_name'];?>" data-rule-required="true" />
                      <div class="error_msg" id="error_first_name" style="display:none;"></div>
                      </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Last Name :</label>
                     <div class="col-sm-7 col-lg-7 " >
                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $userinfo[0]['last_name'];?>" data-rule-required="true" />
                        <div class="error_msg" id="error_last_name" style="display:none;"></div>
                      </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Contact Number :</label>
                     <div class="col-sm-7 col-lg-7 " >
                        <input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $userinfo[0]['contact_no'];?>" data-rule-required="true" data-rule-number="true"/>
                        <div class="error_msg" id="error_contact_no" style="display:none;"></div>
                      </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Address :</label>
                     <div class="col-sm-7 col-lg-7 " >
                         <textarea id="address" class="form-control col-md-4" data-rule-required="true" rows="6" name="address"><?php echo $userinfo[0]['address'];?></textarea>
                        <div class="error_msg" id="error_address" style="display:none;"></div>
                      </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">City :</label>
                     <div class="col-sm-7 col-lg-7 " >
                           <input type="text" class="form-control" name="city_id" id="city_id" value="<?php echo $userinfo[0]['city_id'];?>" data-rule-required="true" />
                           <div class="error_msg" id="error_city_id" style="display:none;"></div>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">State :</label>
                     <div class="col-sm-7 col-lg-7 " >
                          <input type="text" class="form-control" name="state_id" id="state_id" value="<?php echo $userinfo[0]['state_id'];?>" data-rule-required="true" />
                           <div class="error_msg" id="error_state_id" style="display:none;"></div>
                    </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Country : </label>
                     <div class="col-sm-7 col-lg-7 " >
                       <select class="form-control" name="country_id" id="country_id" data-rule-required="true" >
                          <option value="">Select Country</option>
                          <?php 
						  foreach($fetchcountry as $rowcountry)
						  {?>
                            <option value='<?php echo $rowcountry['id'];?>' <?php if($rowcountry['id']==$userinfo[0]['country_id']){ echo 'selected="selected"';}?>>
							<?php echo $rowcountry['country'];?></option>
                           <?php }?>
                        </select> <div class="error_msg" id="error_country_id" style="display:none;"></div>
					  </div>
                  </div>
                  </div>
                  <div class="col-md-6 "> 
                  <div class="form-group">
                  <label style="font-style:italic" class="col-sm-3 col-lg-6 control-label"><strong>User Credential :</strong></label>
                  </div>
                  <div class="form-group">
                  <label class="col-xs-3 col-lg-4" >Email Id :</label>
                  <div class="col-sm-7 col-lg-7 ">
                 <input type="text" readonly="readonly" class="form-control" name="seller_email_id" id ="seller_email_id" value="<?php echo $userinfo[0]['email_id'];?>" data-rule-required="true" data-rule-email="true"/>
                 <input  type="hidden" name="loginid" id="loginid" value="<?php echo $userinfo[0]['login_id'];?>" />
                 <div class="error_msg" id="error_seller_email_id" style="display:none;"></div>
			      </div>
                  </div>
                  <div class="form-group">
                  <label class="col-xs-3 col-lg-4"> Password : </label>
                     <div class="col-sm-7 col-lg-7 " >
                    <input id="password" class="form-control" type="password" data-rule-minlength="6" data-rule-required="true" name="password" value="<?php echo $userinfo[0]['password'];?>">
                    <div class="error_msg" id="error_password" style="display:none;"></div>
					  </div>
                  </div>
                  <div class="form-group">
                      <label style="font-style:italic" class="col-sm-3 col-lg-6 control-label"><strong>My Profile Photo :</strong></label>
                  </div>
                  <div class="form-group">
                      <label class="col-xs-3 col-lg-4">Profile Image :</label>
                       <div class="col-sm-7 col-lg-7 " >
                         <?php if($userinfo[0]['profile_picture']!="") 
						 {?>
                         <img src="<?php echo base_url();?>uploads/profile_image/<?php echo $userinfo[0]['profile_picture'];?>" width="55" height="55"/><?php }
						 else
					    {?>
                       <img src="<?php echo base_url();?>images/default_user_icon.png" width="55" height="55"  />
                       <?php }?>
               		  </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-xs-3 col-lg-4">New Image :</label>
                       <div class="col-sm-7 col-lg-7 " >
                       <input name="profile_picture" id="profile_picture" type="file" onchange="return check_Files(this.value,this.id,'btn_update_user');" />
                       <input name="profile_pictureold" id="profile_pictureold" type="hidden"  value="<?php echo $userinfo[0]['profile_picture'];?>"/>
               		  </div>
                  </div>
                  <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-5">
                                            <button type="submit" class="btn btn-primary" name="btn_update_user" id="btn_update_user">Update</button>
                                         <!--   <button type="reset" class="btn">Cancel</button>-->
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