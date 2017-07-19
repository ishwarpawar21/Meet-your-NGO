<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i>Manage Coupon</h1>
       <h4>Manage Coupon</h4>
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
        <li class="active">Manage Coupon</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-coupon" id="frm-manage-coupon" action="<?php echo base_url().'superadmin/seller/deletemultiplecoupon/'.$this->uri->segment(4).'';?>"  method="post">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Manage Coupon</h3>
                <div class="box-tool">
                <div class="box-tool">
                	<a class="show-tooltip" title="Back" href="<?php echo base_url().'superadmin/seller/manageseller/' ?>">
<i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
                   <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                	<div class="btn-group">
                    	<!--<a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Add cuopon" href="<?php //echo base_url().'superadmin/admin//';?>"><i class="fa fa-plus"></i></a>-->
                        <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Active" href="javascript:void(0);" onclick="javascript : return multipleactivestatus('frm-manage-coupon');"><i class="fa fa-dot-circle-o"></i></a>
                         <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Block" href="javascript:void(0);" onclick="javascript : return multipleblockstatus('frm-manage-coupon');"><i class="fa fa-circle-o"></i></a>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Delete selected" href="javascript:void(0);" onclick="javascript : return multipledeletconfirm('frm-manage-coupon');"><i class="fa fa-trash-o"></i></a>
                    </div>
                    <div class="btn-group">
                   <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Refresh" href="<?php echo base_url().'superadmin/seller/managecoupon/'.$this->uri->segment(4); ?>"><i class="fa fa-repeat"></i></a>
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
                    <table class="table table-advance" <?php if(count($fetch_manage_coupon)>0){?> id="table1" <?php } ?>>
                       <thead>
                           <tr>
                               <th style="width:18px"><input type="checkbox" /></th>
                               <th>Coupon Title</th>
                               <th>Coupon Image</th>
                               <th>Coupon Desc</th>
                               <th>Coupon Code</th>
                               <th>Expirydate</th>
                               <th>Deal</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						
						 if(count($fetch_manage_coupon)>0)
						 { 
						   foreach($fetch_manage_coupon as $coupon)
						   {  	
								$pos = strpos($coupon['coupon_discount'],'%');
								if($pos == false)
								{ $_Prefix= '$'.number_format($coupon['coupon_discount'],2).' off'; }
								else
								{ $_Prefix=$coupon['coupon_discount'].' off'; }
								$title=urlencode("Get ".$_Prefix." on ".$coupon['coupon_title']);
								//base_url()."share/details/".$coupon['coupon_id']."/";
								$url=urlencode('http://www.webwingtechnologies.co.in/coupon/share/details/2/');
								$summary=urlencode($coupon['coupon_desc']);
								$image=urlencode($coupon['coupon_image']);
							/*$title=urlencode("How to Create a Custom Facebook ");
					$url=urlencode("http://www.webwingtechnologies.co.in/coupon/share/details/2/");
					$summary=urlencode("Learn how to create a!");
					$image=urlencode("http://www.daddydesign.com/ClientsTemp/Tutorials/custom-iframe-share-button/images/thumbnail.jpg");*/
						 ?>
                             <tr>
                           <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $coupon['coupon_id'];?>"/></td> 
                                <td><?php echo $coupon['coupon_title']; ?></td>
                               
                               <?php if($coupon['coupon_image']==""){ ?>
                                <td>&nbsp;</td>
								<?php }else {?>
                                <td><img src="<?php echo $coupon['coupon_image']; ?>" height="50" width="50" title=<?php $coupon['coupon_image']; ?> /></td>
								<?php }?>
                                
                                <td style="vertical-align:top;"><?php echo stripslashes(substr(strip_tags($coupon['coupon_desc'],'<p>'),0,40)); ?></td>
                                 <td><?php echo $coupon['coupon_code']; ?></td>
                                 <td><?php echo $coupon['coupon_expirydate']; ?></td>
                                 <?php if($coupon['deal']=='deal'){?> 
                                 <td><a href="<?php echo base_url().'superadmin/seller/deal/'.base64_encode($coupon['login_id']).'/'.base64_encode($coupon['coupon_id']).'/coupon/';?>">Deactive Deal</a></td><?php }
								 else{?>
                                <td> <a href="<?php echo base_url().'superadmin/seller/deal/'.base64_encode($coupon['login_id']).'/'.base64_encode($coupon['coupon_id']).'/deal/';?>">Active Deal</a></td><?php }?>
                                <td>
                                	<?php if($coupon['coupon_status']==0){ ?>
                                	<a href="<?php echo base_url().'superadmin/seller/couponstatus/'.base64_encode($coupon['login_id']).'/'.base64_encode($coupon['coupon_id']).'/1/';?>" title="Block"><i class="fa fa-circle-o"></i></a>							<?php }
									else {?>
									<a href="<?php echo base_url().'superadmin/seller/couponstatus/'.base64_encode($coupon['login_id']).'/'.base64_encode($coupon['coupon_id']).'/0/';?>"  title="Active"><i class="fa fa-dot-circle-o"></i></a>
									<?php }	?>
                                </td>
                                <td>
                              
	             <a style="font-size:20px;color:#000;"  onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=550,height=400');" target="_parent" href="javascript: void(0)"><i class="fa fa-facebook-square"></i></a>  
	            
        	
                                <a style="font-size:20px;color:#000;" class="show-tooltip deleteconfirm" href="<?php echo base_url().'superadmin/seller/deletecoupon/'.base64_encode($coupon['login_id']).'/'.base64_encode($coupon['coupon_id']);?>" onclick="javascript : return deletconfirm();" title="Delete" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
								</td>               
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