<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/admin-validation.js"></script>
<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i>Seller Point's</h1>
      <!-- <h4>Seller's</h4>-->
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
        <li class="active">Seller Point's</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-seller-points" id="frm-manage-seller-points" action="<?php echo base_url().'superadmin/seller/multiactionchange/';?>"  method="post">
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
                     <h3><i class="fa fa-pencil-square"></i> Seller Point's</h3>
                     <div class="box-tool"></div>
                  </div>
              <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/seller/sellerpoints/'; ?>"><i class="fa fa-repeat"></i></a> 
                    </div>
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                  <input type="hidden" id="status_chck" name="status_chck" value="" />
                    <table class="table table-advance" <?php if(count($seller_point)>0){?> id="table1" <?php } ?>>
                       <thead>
                            <tr>
                               <th style="width:18px">
                               <input type="checkbox"/></th>
                               <th>Name </th>
                               <th>Username </th>
                               <th>Email Id </th>
                               
                               <th>Share Point</th>
                               <th>Like Point</th>
                               <th>Comment Point</th>
                               <th>Community Point</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						 if(count($seller_point)>0)
						 {
						   foreach($seller_point as $point)
						   { 
						     $sell=$point['login_id'];
							//echo  $query[0]['SUM(comment_point)'];
						    
						   ?>
                             <tr>
                                <td style="width:18px">
                                <input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $point['login_id']; ?>"/>
                                </td>
                                <td><?php echo stripslashes(ucfirst($point['firstname']).' '.$point['lastname']);?></td>
                                <td><?php echo stripslashes($point['username']);?></td>
                                <td><?php echo $point['email_id'];?></td>
                                <td><?php 
								$this->db->select_sum('share_point');
							    $getsum=$this->master_model->getRecords('tbl_userscored_point',array('login_id'=>$sell));
							    echo $getsum[0]['share_point'];
								 ?></td>
                                <td><?php  
								$this->db->select_sum('like_point');
							    $getsum=$this->master_model->getRecords('tbl_userscored_point',array('login_id'=>$sell));
							    echo $getsum[0]['like_point'];
							    ?></td>
                                <td><?php 
								$this->db->select_sum('comment_point');
							    $getsum=$this->master_model->getRecords('tbl_userscored_point',array('login_id'=>$sell));
							    echo $getsum[0]['comment_point'];
								?></td>
                                <td>
								<?php 
								$this->db->select_sum('community_point');
							    $getsum=$this->master_model->getRecords('tbl_userscored_point',array('login_id'=>$sell));
							    echo $getsum[0]['community_point'];
								?></td>
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