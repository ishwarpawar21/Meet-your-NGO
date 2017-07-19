<!-- BEGIN Page Title -->

<div class="page-title">

    <div style="clear:both !important;">

        <h1><i class="fa fa-pencil-square"></i>Edit home page</h1>



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

        	<a href="<?php echo base_url().'superadmin/'; ?>">Edit home page</a>

            <span class="divider"><i class="fa fa-angle-right"></i></span>

        </li>

        <li class="active">Edit home page</li>

    </ul>

</div>



<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->

<div class="row">

    <div class="col-md-12">

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i>Edit home page </h3>

                <div class="box-tool">

                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>

                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->

                </div>

            </div>

            <div class="box-content">

              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">
               <input type="hidden" name="edit_id" value="<?=$_GET['id']?>">
                 

                 
<?php 
                        $result=$this->db->query("select * from tbl_homepage_footer where id=".$_GET['id'])->row(); ?>
                  <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">heading: </label>

                      <div class="col-sm-9 col-lg-10 controls">
                       

                         <input type="text" class="form-control" name="heading" id="homepage_heading" placeholder="State name" value="<?=$result->heading?>" data-rule-required="true" />

                         <?php echo form_error('heading'); ?>

                         <div class="error_msg" id="heading" style="display:none;"></div>

                      </div>

                   </div>
                     <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">contain: </label>

                      <div class="col-sm-9 col-lg-10 controls">
                      
                      <textarea class="form-control col-md-12 ckeditor" name="contain"  id="contain" rows="6" data-rule-required="true"><?=$result->contain?>"</textarea>
                                               

                        

                         <?php echo form_error('contain'); ?>

                         <div class="error_msg" id="homepage_sub_heading" style="display:none;"></div>

                      </div>

                   </div>


              

                  <div class="form-group">

                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                        <input type="submit" value="Update" class="btn btn-primary" name="btn_update_footer" id="btn_update_footer" onclick="return checkCheckBoxes(this.form);">
                        
                        

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