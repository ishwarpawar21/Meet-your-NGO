<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-cogs"></i> Manage Points</h1>
        <h4>Update Points</h4>
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
        <li class="active">Update Points</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i> Update Points</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content">
             <div class="form-group">
                   <?php if($this->session->flashdata('error')){ ?>
                   <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                   <?php } ?>
                   <?php if($this->session->flashdata('success')){ ?>
                   <div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div>
                   <?php } ?>
                  </div>
               <form action="<?php echo base_url().'superadmin/admin/points/'; ?>" class="form-horizontal" id="validation-form" method="post">
                
                  <div class="form-group">
                     <label class="col-sm-3 col-lg-2 control-label" for="password">Facebook Share Point :</label>
                     <div class="col-sm-6 col-lg-4 controls">
                       <input type="text" name="fb_share_point" id="fb_share_point" class="form-control"  value="<?php echo $manage_points[0]['fb_share_point'];?>"/>
                       <div class="error_msg" id="error_fb_share_point" style="display:none;"></div>
                     </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Like point :</label>
                    <div class="col-sm-6 col-lg-4 controls">
                      <input type="text" name="like_point" id="like_point" class="form-control"  value="<?php echo $manage_points[0]['like_point'];?>"/>
                      <div class="error_msg" id="error_like_point" style="display:none;"></div>
                    </div>
                   </div>
                   <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Coupon Comment Point:</label>
                    <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="coupon_commnet_point" id="coupon_commnet_point" class="form-control"  value="<?php echo $manage_points[0]['coupon_commnet_point'];?>"/>
                     <div class="error_msg" id="error_coupon_commnet_point" style="display:none;"></div>
                    </div>
                   </div>
                   <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Community Point:</label>
                    <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="community_point" id="community_point" class="form-control"  value="<?php echo $manage_points[0]['community_point'];?>"/>
                     <div class="error_msg" id="error_community_point" style="display:none;"></div>
                    </div>
                   </div>
                  <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                            <input type="submit" class="btn btn-primary" value="Submit" name="btn_update_point" id="btn_update_point">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i> Per Day Limit</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content">
             <div class="form-group">
                   <?php if($this->session->flashdata('error1')){ ?>
                   <div class="alert alert-danger"><?php echo $this->session->flashdata('error1'); ?></div>
                   <?php } ?>
                   <?php if($this->session->flashdata('success1')){ ?>
                   <div class="alert alert-success"><?php echo $this->session->flashdata('success1');?></div>
                   <?php } ?>
                  </div>
               <form action="<?php echo base_url().'superadmin/admin/points/'; ?>" class="form-horizontal" id="validation-form" method="post">
                
                  <div class="form-group">
                     <label class="col-sm-2 col-lg-4 control-label" for="password">Per Day Limit :</label>
                     <div class="col-sm-2 col-lg-4 controls">
                     <input type="text" name="per_day" id="per_day" class="form-control"  value="<?php echo $manage_points[0]['per_day_point'];?>"/>
                     <div class="error_msg" id="error_per_day" style="display:none;width:220px;"></div>
                     </div>
                  </div>
                  
                  <div class="form-group">
                  <label class="col-sm-2 col-lg-4 control-label" for="password"></label>
                        <div class="col-sm-2 col-lg-4 controls">
                            <input type="submit" class="btn btn-primary" value="Submit" name="btn_update_perday_point" id="btn_update_perday_point">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->
