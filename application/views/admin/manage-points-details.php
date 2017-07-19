<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/admin-validation.js"></script>
<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i><?php echo $userData[0]['user_slug']; ?> Point's</h1>
      <!-- <h4>User's</h4>-->
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
        <li class="active">User Point's</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-user-points" id="frm-manage-user-points" action="<?php echo base_url().'superadmin/user/multiactionchange/';?>"  method="post">
<div class="row">
    <div class="col-md-12">
        <div class="box">
					<?php 
                    if($this->session->flashdata('error')!=''){  ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } 
                    if($this->session->flashdata('success')!=''){?>	
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php } ?>
                   <div id="message" class="alert alert-danger" style="display:none;"></div>
                  <div id="message_confirm" class="alert alert-danger" style="display:none;"></div>
                  <div class="box-title">
                     <h3><i class="fa fa-pencil-square"></i> <?php echo $userData[0]['user_slug']; ?> Point's</h3>
                     <div class="box-tool">
                      <?php if($this->uri->segment(2)=='user'){?>
                      <a class="show-tooltip" title="Back" href="<?php echo base_url().'superadmin/user/userpoints/';?>" data-original-title="Back"><i class="fa fa-chevron-up"></i></a>
                     <?php } 
					   if($this->uri->segment(2)=='seller'){?>
                       <a class="show-tooltip" title="Back" href="<?php echo base_url().'superadmin/seller/sellerpoints/';?>" data-original-title="Back"><i class="fa fa-chevron-up"></i></a>
                       <?php } ?>
</div>
                  </div>
              <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/user/userpoints/';?>"><i class="fa fa-repeat"></i></a> 
                    </div>
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                  <input type="hidden" id="status_chck" name="status_chck" value="" />
                    <table class="table table-advance" <?php if(count($AllPoints)>0){?> id="table1" <?php } ?>>
                       <thead>
                            <tr>
                               <th style="width:18px">
                               <input type="checkbox"/></th>
                               <th>Coupon Title</th>
                               <th>Coupon Image</th>
                               <?php if($this->uri->segment(4)=='comment'){ ?>
                               <th>Comment Point</th>
                               <?php } ?>
                               <?php if($this->uri->segment(4)=='community') {?>
                                <th>Community Point</th>
                               <?php } ?>
                               <?php if($this->uri->segment(4)=='like') {?>
                                <th>Like Point</th>
                               <?php } ?>
                               <?php if($this->uri->segment(4)=='fb_share') {?>
                                <th>Facebook share Point</th>
                               <?php } ?>
                           <!--<th>Community Point</th>
                               <th>Total Point</th>
                               <th>Used Point</th>-->
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						 if(count($AllPoints)>0)
						 {
						   foreach($AllPoints as $point)
						   {
							   $sell=$point['login_id'];
							   ?>
                             <tr>
                               <td style="width:18px">
                                <input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $point['login_id']; ?>"/>
                                </td>
                                <td>
                                <?php echo $point['coupon_title']; ?>
                                </td>
                                <td>
                                <img src="<?php echo $point['coupon_image']; ?>" width="50" height="50"  />
                                </td>
                                <td>
                                 <?php if($this->uri->segment(4)=='comment'){echo $point['comment_point']; } ?>
                               <?php if($this->uri->segment(4)=='community'){echo $point['comment_point']; } ?>
                               <?php if($this->uri->segment(4)=='like') { echo $point['like_point']; } ?>
                               <?php if($this->uri->segment(4)=='fb_share'){echo $point['share_point']; }?>
								</td>
                             </tr>
                        <?php  } }else{ ?>
                        <tr>
                          <td colspan="8"><div class="alert alert-danger" style="text-align:center;">No Data Found.</div></td>
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