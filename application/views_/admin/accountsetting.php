<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
                <!-- BEGIN Page Title -->
                <div class="page-title">
                    <div>
                        <h1><i class="fa fa-cogs"></i> Account Setting</h1>
                        <h4>Account Setting</h4>
                    </div>
                </div>
                <!-- END Page Title -->
                <!-- BEGIN Breadcrumb -->
                <div id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo base_url(); ?>superadmin/admin/dashboard/">Home</a>
                            <span class="divider"><i class="fa fa-angle-right"></i></span>
                        </li>
                        <li class="active">Account Setting</li>
                    </ul>
                </div>
                <!-- END Breadcrumb -->
                <!-- BEGIN Main Content -->
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-pink">
                            <div class="box-title">
                                <h3><i class="fa fa-file"></i> Edit Profile</h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                            <div class="form-group">
								<?php 
                                if($error!=''){  ?>
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                                <?php } 
                                if($success!=''){?>	
                                <div class="alert alert-success"><?php echo $success; ?></div>
                                <?php } ?>
                            </div>
                                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                      <label class="col-sm-3 col-lg-2 control-label">Image Upload</label>
                                      <div class="col-sm-9 col-md-10 controls">
                                         <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                               <img src="<?php echo base_url(); ?>uploads/admin/<?php echo  $result[0]['admin_img'] ;?>" alt="" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                               <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="file_upload" id="file_upload"/>
                                               <input type="hidden" class="default" name="old_image" id="old_image" value="<?php echo  $result[0]['admin_img'] ;?>"/>
                                               </span>
                                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                         </div>
                                        <div class="error_msg" id="error_file_upload" style="display:none;"></div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                    
                                        <label class="col-sm-3 col-lg-2 control-label">Username</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" value="<?php echo $result[0]['admin_username'] ?>" class="form-control" name="username" id="username" data-rule-required="true" />
                                            <!--<span class="help-inline"><a href="#">Request new ?</a></span>-->
                                            <div class="error_msg" id="error_username" style="display:none;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">Email</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" value="<?php echo $result[0]['admin_email'] ?>" class="form-control" name="email" id="email" data-rule-required="true" data-rule-email="true"/>
                                             <div class="error_msg" id="error_email" style="display:none;"></div>
                                        </div>
                                    </div>
                                  
                                  <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">Phone</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" value="<?php echo $result[0]['phone'] ?>" class="form-control" name="phone" id="phone" data-rule-required="true" data-rule-email="true" />
                                            <div class="error_msg" id="error_phone" style="display:none;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">Fax</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" value="<?php echo $result[0]['fax'] ?>" class="form-control" name="fax" id="fax" data-rule-required="true" data-rule-email="true"/>
                                            <div class="error_msg" id="error_fax" style="display:none;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">Address</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <textarea  class="form-control" name="address" id="address" data-rule-required="true" data-rule-email="true"/><?php echo $result[0]['admin_address'] ?></textarea>
                                            <div class="error_msg" id="error_address" style="display:none;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                            <button type="submit" class="btn btn-primary" name="btn_account" id="btn_account">Submit</button>
                                           
                                        </div>
                                   </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row hidden-xs">
                    <div class="col-md-12">
                        <div class="box box-black">
                            <div class="box-title">
                                <h3><i class="fa fa-file"></i> Admin Emails</h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                                           </div>
                            </div>
                            <div class="box-content">
                            <div class="form-group">
								<?php 
                                if($error3!=''){  ?>
                                <div class="alert alert-danger"><?php echo $error3; ?></div>
                                <?php } 
                                if($success3!=''){?>	
                                <div class="alert alert-success"><?php echo $success3; ?></div>
                                <?php } ?>
                            </div>
                                <form action="#" class="form-horizontal form-bordered" method="post">
                                    
                                    
                                    <div class="form-group">
                                        <label for="password4" class="col-sm-3 col-lg-2 control-label">Info Email</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" name="info_email" id="info_email" placeholder="Info Email Address" class="form-control" data-rule-required="true" value="<?php echo $emails[0]['info_email'] ?>" data-rule-email="true">
                                            <div class="error_msg" id="error_info_email" style="display:none;"></div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="form-group">
                                        <label for="contact_email" class="col-sm-3 col-lg-2 control-label">Contact Email</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" name="contact_email" id="contact_email" placeholder="Contact Email Address" class="form-control" value="<?php echo $emails[0]['contact_email'] ?>" data-rule-required="true" data-rule-email="true">
                                            <div class="error_msg" id="error_contact_email" style="display:none;"></div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="form-group">
                                        <label for="password4" class="col-sm-3 col-lg-2 control-label">Support Email</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" name="support_email" id="support_email" placeholder="Support Email Address" class="form-control" value="<?php echo $emails[0]['support_email'] ?>"data-rule-required="true" data-rule-email="true">
                                            <div class="error_msg" id="error_support_email" style="display:none;"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group last">
                                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                           <button type="submit" class="btn btn-primary" name="btn_info_mail" id="btn_info_mail"> Submit</button>
                                           
                                        </div>
                                    </div>
                                 </form>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-orange">
                            <div class="box-title">
                                <h3><i class="fa fa-file"></i> Change Password</h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                            <div class="form-group">
								<?php 
                                if($error1!=''){  ?>
                                <div class="alert alert-danger"><?php echo $error1; ?></div>
                                <?php } 
                                if($success1!=''){?>	
                                <div class="alert alert-success"><?php echo $success1; ?></div>
                                <?php } ?>
                            </div>
                                <form method="post" class="form-horizontal" id="validation-form">
                                    <div class="form-group">
                                        <label class="col-sm-4 col-md-5 control-label">Current password</label>
                                        <div class="col-sm-8 col-md-7 controls">
                                            <input type="password" class="form-control" name="current_pass" id="current_pass" data-rule-minlength="6" data-rule-required="true" value="" />
                                            <div class="error_msg" id="error_current_pass" style="display:none;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 col-md-5 control-label">New password</label>
                                        <div class="col-sm-8 col-md-7 controls">
                                            <input type="password" class="form-control" data-rule-minlength="6" data-rule-required="true" name="new_pass" id="new_pass"  />
                                            <div class="error_msg" id="error_new_pass" style="display:none;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 col-md-5 control-label">Re-type new password</label>
                                        <div class="col-sm-8 col-md-7 controls">
                                            <input type="password" class="form-control" data-rule-minlength="6" data-rule-required="true" name="confirm_pass" id="confirm_pass" />
                                            <div class="error_msg" id="error_confirm_pass" style="display:none;"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-5">
                                            <button type="submit" class="btn btn-primary" name="btn_password" id="btn_password">Submit</button>
                                           
                                        </div>
                                   </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-red">
                            <div class="box-title">
                                <h3><i class="fa fa-file"></i> Site Status</h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                            <div class="form-group">
								<?php 
                                if($error2!=''){  ?>
                                <div class="alert alert-danger"><?php echo $error2; ?></div>
                                <?php } 
                                if($success2!=''){?>	
                                <div class="alert alert-success"><?php echo $success2; ?></div>
                                <?php } ?>
                            </div>
                                <form method="post" class="form-horizontal">
                                    <div class="form-group">
                                       <label class="col-sm-3 col-lg-2 control-label">Site Status</label>
                                       <div class="col-sm-9 col-lg-10 controls">
                                          <label class="radio">
                                              <input type="radio" name="site_status" value="1" <?php if($status[0]['site_status']=='1') { echo 'checked="checked"'; } ?>  /> Online
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="site_status" value="0" <?php if($status[0]['site_status']=='0') { echo 'checked="checked"'; } ?>/> Offline
                                          </label>  
                                          
                                       </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-5">
                                            <button type="submit" class="btn btn-primary" name="btn_status" id="btn_status">Submit</button>            
                                        </div>
                                   </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
             
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>