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

                <h3><i class="fa fa-bars"></i>Edit home page</h3>

                <div class="box-tool">

                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>

                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->

                </div>

            </div>

            <div class="box-content">

              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">
               <input type="hidden" name="edit_id" value="<?=$_GET['id']?>">
                 

                 
<?php 
                        $result=$this->db->query("select * from tbl_homepage_middle where id=".$_GET['id'])->row(); ?>
                  <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Heading: </label>

                      <div class="col-sm-9 col-lg-10 controls">
                       

                         <input type="text" class="form-control" name="homepage_mheading" id="homepage_mheading" placeholder="heading" value="<?=$result->heading?>" data-rule-required="true" />

                         <?php echo form_error('homepage_mheading'); ?>

                         <div class="error_msg" id="homepage_mheading" style="display:none;"></div>

                      </div>

                   </div>
                     <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Subheading: </label>

                      <div class="col-sm-9 col-lg-10 controls">
                       

                         <input type="text" class="form-control" name="homepage_msub_heading" id="homepage_msub_heading" placeholder="Sub heading" value="<?=$result->subheading?>" data-rule-required="true" />

                         <?php echo form_error('homepage_msub_heading'); ?>

                         <div class="error_msg" id="homepage_msub_heading" style="display:none;"></div>

                      </div>

                   </div>
                    <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Link: </label>

                      <div class="col-sm-9 col-lg-10 controls">
                       

                         <input type="text" class="form-control" name="homepage_mheading_link" id="homepage_mheading_link" placeholder="link" value="<?=$result->link?>" data-rule-required="true" />

                         <?php echo form_error('homepage_mheading_link'); ?>

                         <div class="error_msg" id="homepage_sub_heading" style="display:none;"></div>

                      </div>

                   </div>
                    
                    
                    
                    <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Select file (180*180px): </label>

                      <div class="col-sm-9 col-lg-10 controls">
                       
                         <input type="file"   required="" name="files1" id="userfile"  >
                          <?php echo '<span style="color:red">'.form_error('store_name') . '</span>';?>
                         

                         <?php echo form_error('homepage_mcontain'); ?>

                         <div class="error_msg" id="homepage_mcontain" style="display:none;"></div>

                      </div>

                   </div>
                    <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Contain: </label>

                      <div class="col-sm-9 col-lg-10 controls">
                       
                         <textarea  class="form-control" name="homepage_mcontain" id="homepage_mcontain" placeholder="link" value="<?=$result->link?>" data-rule-required="true"><?=$result->contain?></textarea>
                         

                         <?php echo form_error('homepage_mcontain'); ?>

                         <div class="error_msg" id="homepage_mcontain" style="display:none;"></div>

                      </div>

                   </div>


              

                  <div class="form-group">

                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                        <input type="submit" value="Update" class="btn btn-primary" name="btn_update_mid" id="btn_update_mid" onclick="return checkCheckBoxes(this.form);">
                        
                        

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