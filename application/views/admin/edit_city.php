<!-- BEGIN Page Title -->

<div class="page-title">

    <div style="clear:both !important;">

        <h1><i class="fa fa-pencil-square"></i>Add city</h1>



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

        	<a href="<?php echo base_url().'superadmin/'; ?>">Add city</a>

            <span class="divider"><i class="fa fa-angle-right"></i></span>

        </li>

        <li class="active">Add City</li>

    </ul>

</div>



<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->

<div class="row">

    <div class="col-md-12">

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i>Add city</h3>

                <div class="box-tool">

                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>

                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->

                </div>

            </div>

            <div class="box-content">

              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">
               <input type="hidden" name="edit_id" value="<?=$_GET['id']?>">
                <?php 
                        $resultu=$this->db->query("select * from city_table where id=".$_GET['id'])->row(); ?>
                 <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Selecte State: </label>

                      <div class="col-sm-6 controls">

                         <select class="form-control" name="state_name_update" id="state_name_update">
                <?php 
                $result=$this->db->query("select * from state_table");
			    if($result->result() > 0)
		        {
		         foreach($result->result() as $row)
		         {
		         	?>
                             <option <?php if($resultu->state=$row->state_name){echo "selected";}?>><?=$row->state_name;?></option>
              
                <?php
                 }
                }else{ ?>
                        <option>No state inserted</option>
                        <?php } ?>
                         </select>

                       

                         <div class="error_msg" id="error_faq_ques" style="display:none;"></div>

                      </div>

                   </div>

                 

                  <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">City name: </label>

                      <div class="col-sm-6 controls">

                         <input type="text" class="form-control"	name="city_name_update" id="city_name_update" placeholder="City name" value="<?=$resultu->city_name?>" data-rule-required="true" />

                         <?php echo form_error('city_name'); ?>

                         <div class="error_msg" id="error_faq_ques" style="display:none;"></div>

                      </div>

                   </div>

              

                  <div class="form-group">

                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                        <input type="submit" value="Add city" class="btn btn-primary" name="btn_city_update" id="btn_city_update" onclick="return checkCheckBoxes(this.form);">

                         <button type="reset" class="btn">Cancel</button>

                   </div>

                   </div>

               </form>

            </div>
            
             <div class="clearfix"></div>
               
                
                
                
            
            
            
            
            
            
           

    </div>
    
    
    
    
    
       
    
    

</div>

<!-- END Main Content -->

  


<!-- END Main Content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.js"></script>