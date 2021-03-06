<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/admin-validation.js"></script>
<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i>Manage Newsletter</h1>
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
        <li class="active">Manage Newsletter</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-newsletter" id="frm-manage-newsletter" action="<?php echo base_url().'superadmin/newsletter/multiactionchange/';?>"  method="post">
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
                <h3><i class="fa fa-pencil-square"></i> Manage Newsletter</h3>
                <div class="box-tool">
                   <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                	<div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Add" href="<?php echo base_url().'superadmin/newsletter/add/'; ?>"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Delete Selected" href="javascript:void(0);" onclick="javascript : return multipledeletconfirm('frm-manage-newsletter');">
                    <i class="fa fa-trash-o"></i>
                    </a>
                    </div>
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Block" href="javascript:void(0);" onclick="javascript : return multipleactivestatus('frm-manage-newsletter');">
                    <i class="fa fa-unlock-alt"></i>
                    </a>
                    </div>
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Active" href="javascript:void(0);" onclick="javascript : return multipleblockstatus('frm-manage-newsletter');">
                    <i class="fa fa-unlock"></i>
                    </a>
                    </div>
                    <div class="btn-group">
                    <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/newsletter/manage/'; ?>"><i class="fa fa-repeat"></i></a>
                    </div>
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                  <input type="hidden" id="status_chck" name="status_chck" value="" />
                    <table class="table table-advance" <?php if(count($fetch_newsletter)>0){?> id="table1" <?php } ?>>
                       <thead>
                            <tr>
                               <th style="width:18px">
                               <input type="checkbox"/></th>
                               <th>Subject </th>
                               <th>Title </th>
                               <th>Description </th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						 if(count($fetch_newsletter)>0)
						 {
						   foreach($fetch_newsletter as $newsletter)
						   {  ?>
                             <tr>
                                <td style="width:18px">
                                <input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $newsletter['news_id']; ?>"/>
                                </td>
                                <td><?php echo stripslashes(substr(ucfirst($newsletter['newsletter_subject']),0,40));?></td>
                                <td><?php echo substr(stripslashes($newsletter['news_title']),0,30);?></td>
                                <td>
								<?php echo stripslashes(substr(strip_tags($newsletter['news_description'],'<p>'),0,70)); ?>
								</td>
                                <td>
								<?php if($newsletter['news_status']=='1')
								{ ?>
								<a href="<?php echo base_url('superadmin/newsletter/status/'.base64_encode($newsletter['news_id']).'/0');?>" title="Click here for Block">
                                <i class="fa fa-unlock" style="font-size: 20px;"></i>
                                </a>
								<?php } 
								else{ ?>
								<a href="<?php echo base_url('superadmin/newsletter/status/'.base64_encode($newsletter['news_id']).'/1');?>" title="Click here for Active">
                                <i class="fa fa-unlock-alt" style="font-size: 20px;"></i>
                                </a>
								<?php } ?>
                                </td>
                                <td>
                                <a  href="<?php echo base_url().'superadmin/newsletter/edit/'.base64_encode($newsletter['news_id']);?>" title="Click here for Edit"><i class="fa fa-edit"  style="font-size: 18px;"></i>
                                </a>
                                <a href="<?php echo base_url().'superadmin/newsletter/delete/'.base64_encode($newsletter['news_id']);?>" onclick="javascript : return deletconfirm();" title="Click here for Delete" ><i class="fa fa-trash-o"  style="font-size: 18px;"></i></a>
                               <a class="glyphicon glyphicon-eye-open" title="Details" href="<?php echo base_url().'superadmin/newsletter/detail/'.base64_encode($newsletter['news_id']);?>"></a>
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