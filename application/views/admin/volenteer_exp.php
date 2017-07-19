<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/admin-validation.js"></script>
<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i>Manage Volenteer Experience</h1>
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
        <li class="active">Manage Volenteer Experience</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-newsletter" id="frm-manage-newsletter" action=""  method="post">
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
                <h3><i class="fa fa-pencil-square"></i>Manage Volenteer Experience</h3>
                <div class="box-tool">
                   <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
          
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                  <input type="hidden" id="status_chck" name="status_chck" value="" />
                    <table class="table table-advance">
                       <thead>
                            <tr>
                               <th style="width:18px">
                               <input type="checkbox"/></th>
                               <th>NGO Name </th>
                               <th>Volennteer </th>
                               <th>Experience </th>
                               <th>Status</th>
                               <th>Action</th>
                               <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						 $cnt=0;
                         $result=$this->db->query("select * from volunteer_exp");
			             if($result->result() > 0)
		                 {
		                  foreach($result->result() as $row)
		                   { $cnt++;  ?>
                             <tr>
                                <td style="width:18px">
                                 <?=$cnt?>
                                </td>
                                <?php $result_o=$this->db->query("select o_name_of_org from organisation where id=".$row->ngo_id)->row();?>
                                <td><?=$result_o->o_name_of_org?></td>
                                
                                <td><?=$row->vol_id?></td>
                                <td><?=$row->experience?></td>
                                <td><?=$row->date_tyme?></td>
                                
      <td>                        <?php
echo $row->admin_status;
if($row->admin_status=='Pending')
{
	 
?>       
         <a href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve=approve_exp&set=Approve&page=volenteer_exp&id=<?=$row->id?>&ngoid=<?=$row->ngo_id?>" class="btn btn-danger" style="background-color: #ff0000;border-color: #ff4646" title data-rel="tooltip" data-original-title="Make This Inactive" >
          <i class="fa fa-thumbs-down"></i></a>
<?php
}
else
{
?>
         <a class="btn btn-warning green" title data-rel="tooltip" data-original-title="Make This Active" href="">
          <i class="fa fa-thumbs-up"></i>                                   </a>

<?php 
}
?></td>
                                
                                
                                <td>
                                <a href="<?=base_url()?>superadmin/admin/add_field_list?page=volenteer_exp_details&id=<?=$row->id?>" title="view">
                                                				<i class="fa  fa-edit"></i>
                                                			</a>
                                                			<a href="<?=base_url()?>superadmin/admin/add_field_list?btn_delete=delete_exp&page=volenteer_exp&id=<?=$row->id?>" title="delete">
                                                				<i class="fa  fa-trash-o" style="color: red"></i>
                                                			</a>
                              
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