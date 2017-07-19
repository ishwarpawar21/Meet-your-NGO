<?php

?><!-- BEGIN Page Title -->

<div class="page-title">

    <div style="clear:both !important;">

        <h1><i class="fa fa-pencil-square"></i>Set experience point</h1>



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

        	<a href="<?php echo base_url().'superadmin/'; ?>">Set experience point</a>

            <span class="divider"><i class="fa fa-angle-right"></i></span>

        </li>

        <li class="active">Set experience point</li>

    </ul>

</div>



<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->

<div class="row">

    <div class="col-md-12">

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i>Add Locality</h3>

                <div class="box-tool">

                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>

                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->

                </div>

            </div>

            <div class="box-content">

              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">


                  <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Set exprience point</label>

                      <div class="col-sm-6 controls">
                        <?php $result=$this->db->query("select set_exp_point from set_exp_point_table WHERE id=1")->row(); ?>
                         <input type="number" class="form-control" name="set_exp_point" id="set_exp_point" placeholder="set point" value="<?=$result->set_exp_point?>" data-rule-required="true" />

                         <?php echo form_error('set_exp_point'); ?>

                         <div class="error_msg" id="error_faq_ques" style="display:none;"></div>

                      </div>

                   </div>

              

                  <div class="form-group">

                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                        <input type="submit" value="Add" class="btn btn-primary" name="btn_set_exp_point" id="btn_set_exp_point" onclick="return checkCheckBoxes(this.form);">

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