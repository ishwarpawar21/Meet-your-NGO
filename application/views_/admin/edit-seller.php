<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa fa-pencil-square-o"></i>Update Seller</h1>
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
        <li class="active">Update Seller </li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Seller</h3>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/seller/manageseller/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data">
                  <div class="row">
                 <div class="col-md-12 ">  
                   <div class="form-group">
                      <label style="font-style:italic" class="col-sm-3 col-lg-6 control-label"><strong>Update <?php echo $selinfo[0]['username'];?> Information :</strong></label>
                  </div> 
                 </div> 
                 <div class="col-md-6 "> 
                   <div class="form-group">
                      <label style="font-style:italic" class="col-sm-3 col-lg-6 control-label"><strong>About Seller :</strong></label>
                  </div> 
                  <div class="form-group">
                       <label class="col-xs-3 col-lg-4"> Username : </label>
                     <div class="col-sm-7 col-lg-7 " >
                       <input type="text" class="form-control" name="username" id="username" readonly="readonly" value="<?php echo $selinfo[0]['username'];?>" data-rule-required="true" />
                       <div class="error_msg" id="error_username" style="display:none;"></div>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">First Name :</label>
                     <div class="col-sm-7 col-lg-7 " >
                      <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $selinfo[0]['firstname'];?>" data-rule-required="true" />
                      <div class="error_msg" id="error_firstname" style="display:none;"></div>
                      </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Last Name :</label>
                     <div class="col-sm-7 col-lg-7 " >
                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $selinfo[0]['lastname'];?>" data-rule-required="true" />
                        <div class="error_msg" id="error_lastname" style="display:none;"></div>
                      </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Gender :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <input type="radio" name="gender" id="gender" value="1" <?php if($selinfo[0]['gender']=='1'){echo 'checked="checked"';}?> /> Male
                       <input type="radio" name="gender" id="gender" value="0" <?php if($selinfo[0]['gender']=='0'){echo 'checked="checked"';}?> /> Female
                      </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Date Of Birth :</label>
                     <div class="col-sm-7 col-lg-7 " >
                       <input type="text" class="form-control" name="DOB" id="DOB" value="<?php echo $selinfo[0]['DOB'];?>" data-rule-required="true" />
                       <div class="error_msg" id="error_DOB" style="display:none;"></div>
          		  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">City :</label>
                     <div class="col-sm-7 col-lg-7 " >
                           <input type="text" class="form-control" name="city" id="city" value="<?php echo $selinfo[0]['city'];?>" data-rule-required="true" />
                           <div class="error_msg" id="error_city" style="display:none;"></div>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">State :</label>
                     <div class="col-sm-7 col-lg-7 " >
                          <input type="text" class="form-control" name="state" id="state" value="<?php echo $selinfo[0]['state'];?>" data-rule-required="true" />
                           <div class="error_msg" id="error_state" style="display:none;"></div>
                    </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Country : </label>
                     <div class="col-sm-7 col-lg-7 " >
                       <select class="form-control" name="countryid" id="countryid" data-rule-required="true" >
                          <option value="">Select Country</option>
                          <?php 
						  foreach($fetchcountry as $rowcountry)
						  {?>
                            <option value='<?php echo $rowcountry['id'];?>' <?php if($rowcountry['id']==$selinfo[0]['countryid']){ echo 'selected="selected"';}?>>
							<?php echo $rowcountry['country'];?></option>
                           <?php }?>
                        </select> <div class="error_msg" id="error_countryid" style="display:none;"></div>
					  </div>
                  </div>
                  <div class="form-group">
                      <label class="col-xs-3 col-lg-4">Zipcode :</label>
                     <div class="col-sm-7 col-lg-7 " >
                      <input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php echo $selinfo[0]['zipcode'];?>" data-rule-required="true" />
                       <div class="error_msg" id="error_zipcode" style="display:none;"></div>
					  </div>
                  </div>
                  
                  <div class="form-group">
                  <label class="col-xs-3 col-lg-4">Website :</label>
                   <div class="col-sm-7 col-lg-7 " >
                   <input type="text" class="form-control" name="Website" id="Website" value="<?php echo $selinfo[0]['Website'];?>" />
                  <!-- <div class="error_msg" id="error_Website" style="display:none;"></div>-->
      			   </div>
                   </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-4">Brief Biodata :</label>
                     <div class="col-sm-7 col-lg-7 "><textarea id="briefbio" name="briefbio" class="form-control col-md-4" rows="6" data-rule-required="true" ><?php echo $selinfo[0]['briefbio']; ?></textarea>
                     <div class="error_msg" id="error_briefbio" style="display:none;"></div>
					  </div>
                  </div>
                  </div>
                  <div class="col-md-6 "> 
                  <div class="form-group">
                  <label style="font-style:italic" class="col-sm-3 col-lg-6 control-label"><strong>Seller Credential :</strong></label>
                  </div>
                  <div class="form-group">
                  <label class="col-xs-3 col-lg-4" >Email Id :</label>
                  <div class="col-sm-7 col-lg-7 " >
                 <input type="text" class="form-control" readonly="readonly" name="seller_email_id" id ="seller_email_id" value="<?php echo $selinfo[0]['email_id'];?>" data-rule-required="true" data-rule-email="true" />
                 <input  type="hidden" name="loginid" id="loginid" value="<?php echo $selinfo[0]['login_id'];?>" /> 
                  <div class="error_msg" id="error_seller_email_id" style="display:none;"></div>
			      </div>
                  </div>
                  <div class="form-group">
                  <label class="col-xs-3 col-lg-4"> Password : </label>
                     <div class="col-sm-7 col-lg-7 " >
                    <input id="password" class="form-control" type="password" data-rule-minlength="6" data-rule-required="true" name="password" value="<?php echo $selinfo[0]['password'];?>">
                    <div class="error_msg" id="error_password" style="display:none;"></div>
					  </div>
                  </div>
                  <div class="form-group">
                      <label style="font-style:italic" class="col-sm-3 col-lg-6 control-label"><strong>My Profile Photo :</strong></label>
                  </div>
                  <div class="form-group">
                      <label class="col-xs-3 col-lg-4">Profile Image :</label>
                       <div class="col-sm-7 col-lg-7 " >
                         <?php if($selinfo[0]['profilepic']!="") 
						 {?>
                         <img src="<?php echo base_url();?>uploads/profile_image/<?php echo $selinfo[0]['profilepic'];?>" width="55" height="55"/><?php }
						 else
					    {?>
                       <img src="<?php echo base_url();?>images/default_user_icon.png" width="55" height="55"  />
                       <?php }?>
               		  </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-xs-3 col-lg-4">New Image :</label>
                       <div class="col-sm-7 col-lg-7 " >
                       <input name="profilepic" id="profilepic" type="file" onchange="return check_Files(this.value,this.id,'btn_update_seller');" />
                       <input name="profilepicold" id="profilepicold" type="hidden"  value="<?php echo $selinfo[0]['profilepic'];?>"/>
               		  </div>
                  </div>
                  <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-5">
                                            <button type="submit" class="btn btn-primary" name="btn_update_seller" id="btn_update_seller">Update</button>
                                            <button type="reset" class="btn">Cancel</button>
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
<link rel="stylesheet" href="<?php echo base_url();?>css/datepicker.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script> 
<script type="text/javascript" >
$("#DOB").datepicker({dateFormat: 'yy-mm-dd'});
</script> 