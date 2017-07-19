<!-- BEGIN Page Title -->

<div class="page-title">

    <div style="clear:both !important;">

        <h1><i class="fa fa-pencil-square"></i>Home page contain</h1>



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

        	<a href="<?php echo base_url().'superadmin/'; ?>">Home page contain</a>

            <span class="divider"><i class="fa fa-angle-right"></i></span>

        </li>

        <li class="active">Home page contain</li>

    </ul>

</div>



<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->
 

<div class="row">

    <div class="col-md-12">

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i>Home page contain</h3>

                <div class="box-tool">

                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>

                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->

                </div>

            </div>

            <div class="box-content">

              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">


                  <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Image: </label>

                      <div class="col-sm-6 controls">

                         <label for="exampleInputEmail1"> Select images To add in Slider</label>
                                            <input type="file"   required="" name="files1" id="userfile"  >
                                            <?php echo '<span style="color:red">'.form_error('store_name') . '</span>';?>
                                            <label for="exampleInputEmail1">Image Title</label>
                                             <input type="text" class="form-control" required name="img_title" id="userfile"  >
                                            <?php echo '<span style="color:red">'.form_error('img_titl') . '</span>';?>

                         <div class="error_msg" id="error_faq_ques" style="display:none;"></div>

                      </div>

                   </div>

              

                  <div class="form-group">

                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                       <button type="submit" name="add_new_hp_img" class="btn btn-primary">Add New Image</button>

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
                <h3><i class="fa fa-pencil-square"></i> Manage locality</h3>
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
                   <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="80">Sr No</th>
                                                <th>Image</th>
                                                  <th>Image Title</th>
                                                <th width="100">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
<?php

$num=1;

		$q = $this->db->query("select * from hp_slider");
        
		        if($q->num_rows()>0)
		        {
		            foreach($q->result() as $row)
		            {
	
?>                                            
                                            <tr>
                                            
                                                <td><?=$num?></td>
                                                <td>
                                                	<img  src="<?=base_url()?>../site_assets/images/<?=$row->hp_img_id?>.jpg" width="100px" height="100px"/>
                                                </td>
                                                
                                                 <td>
                                                	 <?=$row->hp_img_title?>
                                                </td>
                                                 
                                                
                                                <td>
                                                	
                                                	 
                                                	<a href="<?=base_url()?>superadmin/admin/hp_slider?ch=del&page=admin_slider&hp_img_id=<?=$row->hp_img_id?>" title="Delete Store">
                                                		<i class="fa  fa-minus-square" style="color: red"></i> Delete
                                                	</a>
                                                	
                                                 </td>
                                                 
                                            </tr>
<?php

     $num++;
		            }
		        }                                            
?>		        
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Image</th>
                                                <th>Image Title</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </tfoot>
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