<!-- BEGIN Page Title -->

<div class="page-title">

    <div style="clear:both !important;">

        <h1><i class="fa fa-pencil-square"></i>Add days of week field</h1>



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

        	<a href="<?php echo base_url().'superadmin/'; ?>">Add days of week field</a>

            <span class="divider"><i class="fa fa-angle-right"></i></span>

        </li>

        <li class="active">Add Days of week</li>

    </ul>

</div>



<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->

<div class="row">

    <div class="col-md-12">

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i>Add days of week field</h3>

                <div class="box-tool">

                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>

                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->

                </div>

            </div>

            <div class="box-content">

              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">


                  <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label"> Days of week: </label>

                      <div class="col-sm-6 controls">

                         <input type="text" class="form-control"	name="days_of_week" id="days_of_week" placeholder="days of week" value="" data-rule-required="true" />

                         <?php echo form_error('days_of_week'); ?>

                         <div class="error_msg" id="error_days_of_week" style="display:none;"></div>

                      </div>

                   </div>

              

                  <div class="form-group">

                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
	
                        <input type="submit" value="Add" class="btn btn-primary" name="btn_add_dayofweek" id="btn_add_dayofweek" onclick="return checkCheckBoxes(this.form);">

                         <button type="reset" class="btn">Cancel</button>

                   </div>

                   </div>

               </form>

            </div>
            
             <div class="clearfix"></div>
               
                
                
                
            
            
            
            
            
            
           

    </div>
    
    
    
    
    
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
                <h3><i class="fa fa-pencil-square"></i> Manage days of week</h3>
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
                               <th style="width:18px">No</th>
                               
                               <th>Days	 of week</th>
                               <th>Opreation</th>                              
                               
                            </tr>
                        </thead>
                        <tbody>
                <?php 
                $cnt=0;
                $result=$this->db->query("select * from days_of_week_table");
			    if($result->result() > 0)
		        {
		         foreach($result->result() as $row)
		         { $cnt++;
		         	?>
						  
                             <tr>
                                <td style="width:18px">
                                <?=$cnt?>
                                </td>
                                
                                 <td><?=$row->days_of_week;?></td>
                                 <td><a href="<?=base_url()?>superadmin/admin/add_field_list?page=edit-day_of_week&id=<?=$row->id?>" title="edit">
                                                				<i class="fa  fa-edit"></i>
                                                			</a>
                                                			<a href="<?=base_url()?>superadmin/admin/add_field_list?btn_delete=delete_days_of_week&page=add-day_of_week&id=<?=$row->id?>" title="delete">
                                                				<i class="fa  fa-trash-o" style="color: red"></i>
                                                			</a></td>
                                
                             </tr>
                <?php
                 }
                }else{ ?>
                        <tr>
                          <td colspan="4"><div class="alert alert-danger" style="text-align:center;">No Data Found.</div></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    
    

</div>

<!-- END Main Content -->

  


<!-- END Main Content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.js"></script>