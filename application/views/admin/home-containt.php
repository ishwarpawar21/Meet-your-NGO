<!-- BEGIN Page Title -->

<div class="page-title">

    <div style="clear:both !important;">

        <h1><i class="fa fa-pencil-square"></i>Home containt</h1>



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

        	<a href="<?php echo base_url().'superadmin/'; ?>">Home containt</a>

            <span class="divider"><i class="fa fa-angle-right"></i></span>

        </li>

        <li class="active">Home containt</li>

    </ul>

</div>



<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->

<div class="row">

    <div class="col-md-12">

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i>Home containt</h3>
                </div>
        </div>
        

      <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i>Purpose of website</h3>

                <div class="box-tool">

                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>

                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->

                </div>

            </div>

            <div class="box-content">

              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">


                     <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Purpose of website: </label>
 <?php 
                          $resultn=$this->db->query("select * from home_page_table where id=1")->row(); ?>
                     <div class="col-sm-9 col-lg-10 controls">
                     <input name="purposeofwebsite" class="col-sm-3 col-lg-2 form-control"  type="text"  value="<?=$resultn->containt_data?>">
                                                
                                                </div>
                     

                   </div>

              
                 
                  <div class="form-group">

                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                        <input type="submit" value="Update" class="btn btn-primary" name="btn_update_perpose" id="btn_update_news" onclick="return checkCheckBoxes(this.form);">

                         <button type="reset" class="btn">Cancel</button>
                 
                     

                         
                    
                   </div>

                   </div>

               </form>

            </div>
            </div>        
              
<div class="row">

    <div class="col-md-12">

    <?php if($this->session->flashdata('error')!=''){  ?>

     <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>

     <?php } 

    if($this->session->flashdata('success')!=''){?>	

    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>

    <?php } ?>

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-table"></i> Headings</h3>

                <div class="box-tool">

                  

                </div>

            </div>

          

            <form name="frmfrm-manage-frontpages" id="frm-manage-frontpages" action="<?php echo base_url().'superadmin/admin/add_field_list?page=home-containt';?>"  method="post">

            <div class="box-content">

           

                <div class="btn-toolbar pull-right clearfix">

                  

                  

                    <div class="btn-group">

                        <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/frontpages/managefrontpage/'; ?>"><i class="fa fa-repeat"></i></a>

                    </div>

                    

                    

                </div>

                <br/><br/>

                <div class="clearfix"></div>

                

                <div class="table-responsive" style="border:0">

                 	

                    <table class="table table-advance"  id="table1">

                       <thead>

                            <tr>

                               

                               <th>Heading</th>

                               <th>Heading contain</th>

                               <th>Sub heading</th>
                               <th>Link</th>
                               <th>Status</th>

                    <!--           <th>Status</th>-->

                               <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                         <?php 
                          $result=$this->db->query("select * from tbl_home_page_heading");
			              if($result->result() > 0)
		                  {
		                    foreach($result->result() as $row)
		                     {
		         	       ?>

                             <tr>

                           

                                <td><?=$row->id; ?></td>

                                <td><?=$row->heading; ?></td>

                                <td><?=$row->sub_heading; ?></td>
                                <td><?=$row->link; ?></td>

                              <td>                        <?php
//echo $row->status;
if($row->status==0)
{
	 
?>       
         <a href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve_heading=btn_approve_heading&set=1&id=<?=$row->id?>" class="btn btn-danger" style="background-color: #ff0000;border-color: #ff4646" title data-rel="tooltip" data-original-title="Make This Inactive" >
          <i class="fa fa-thumbs-down"></i></a>
<?php
}
else
{
?>
         <a class="btn btn-warning green" href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve_heading=btn_approve_heading&set=0&id=<?=$row->id?>" title data-rel="tooltip" data-original-title="Make This Active" href="">
          <i class="fa fa-thumbs-up"></i>                                   </a>

<?php 
}
?></td>

                                <td>

								<a href="<?=base_url()?>superadmin/admin/edithomepageheading?id=<?=$row->id?>" title="edit"><i class="fa fa-edit"  style="font-size: 18px;"></i>

                                </a>

                           

                          		</td>               

                             </tr>

                        <?php 

						   }

						 }

						 else

						 { ?>

                         

                        <tr>

                          <td colspan="6"><div class="alert alert-danger" style="text-align:center;">No Data Found.</div></td>

                        </tr>

                        <?php } ?>

                        

                        </tbody>

                    </table>

                </div>

            </div>

            </form>

        </div>

    </div>

</div>


            
            
            
            
           

    
    
    
      <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i>Text below slider</h3>

                <div class="box-tool">

                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>

                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->

                </div>

            </div>

            <div class="box-content">

              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">


                     <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Upcoming event: </label>
 <?php 
                          $resultt=$this->db->query("select * from tbl_homepage_news where id=2")->row(); ?>
                     <div class="col-sm-9 col-lg-10 controls">
                                                   <textarea class="form-control col-md-12 ckeditor" name="text_below"  id="text_below" rows="6" data-rule-required="true"><?=$resultt->contain?></textarea>
                                                </div>
                     

                   </div>

              
                 
                  <div class="form-group">

                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                        <input type="submit" value="Update" class="btn btn-primary" name="btn_update_textb" id="btn_update_textb" onclick="return checkCheckBoxes(this.form);">

                         <button type="reset" class="btn">Cancel</button>
                 
                     

                           <?php
//echo $row->status;
if($resultt->status==0)
{
	 
?>       
         <a href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve_textb=btn_approve_textb&set=1&id=<?=$resultt->id?>" class="btn btn-danger" style="background-color: #ff0000;border-color: #ff4646" title data-rel="tooltip" data-original-title="Make This Inactive" >
          <i class="fa fa-thumbs-down"></i></a>
<?php
}
else
{
?>
         <a class="btn btn-warning green" href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve_textb=btn_approve_textb&set=0&id=<?=$resultt->id?>" title data-rel="tooltip" data-original-title="Make This Active" href="">
          <i class="fa fa-thumbs-up"></i>                                   </a>

<?php 
}
?>
                    
                   </div>

                   </div>

               </form>

            </div>
            </div>
            
             <div class="clearfix"></div>
             
                <div class="row">

    <div class="col-md-12">

    <?php if($this->session->flashdata('error')!=''){  ?>

     <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>

     <?php } 

    if($this->session->flashdata('success')!=''){?>	

    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>

    <?php } ?>

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-table"></i> Middle contain</h3>

                <div class="box-tool">

                  

                </div>

            </div>

          

            <form name="frmfrm-manage-frontpages" id="frm-manage-frontpages" action="<?php echo base_url().'superadmin/frontpages/managefrontpage/';?>"  method="post">

            <div class="box-content">

           

                <div class="btn-toolbar pull-right clearfix">

                

                  

                    <div class="btn-group">

                        <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/admin/add_field_list?page=home-containt'; ?>"><i class="fa fa-repeat"></i></a>
                         
                    </div>

                    

                    

                </div>

                <br/><br/>

                <div class="clearfix"></div>

                

                <div class="table-responsive" style="border:0">

                 	

                    <table class="table table-advance"  id="table1">

                       <thead>

                            <tr>

                               

                               <th>sr.no</th>

                              

                               <th>Heading</th>
                               <th>Sub Heading</th>
                                <th>Contain</th>
                                <th>link</th>
                                <th>Image</th>
                               <th>Status</th>
                               
                               <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                         <?php 
                          $resultm=$this->db->query("select * from tbl_homepage_middle");
			              if($resultm->result() > 0)
		                  {
		                    foreach($resultm->result() as $rowm)
		                     {
		         	       ?>

                             <tr>

                           

                                <td><?=$rowm->id; ?></td>

                                <td><?=$rowm->heading; ?></td>
                                <td><?=$rowm->subheading; ?></td>
                                
                                <td><?=$rowm->contain; ?></td>
                                <td><?=$rowm->link; ?></td>

                               <td>     <img src="<?=base_url()?>../site_assets/images/pic<?=$rowm->id?>.jpg?<?=time()?>" class="img-responsive" height="100px" width="100px" alt=""/> </td> <td>                  <?php
//echo $row->status;
if($rowm->status==0)
{
	 
?>       
         <a href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve_mid=btn_approve_mid&set=1&id=<?=$rowm->id?>" class="btn btn-danger" style="background-color: #ff0000;border-color: #ff4646" title data-rel="tooltip" data-original-title="Make This Inactive" >
          <i class="fa fa-thumbs-down"></i></a>
<?php
}
else
{
?>
         <a class="btn btn-warning green" href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve_mid=btn_approve_mid&set=0&id=<?=$rowm->id?>" title data-rel="tooltip" data-original-title="Make This Active" href="">
          <i class="fa fa-thumbs-up"></i>                                   </a>

<?php 
}
?></td>

                                <td>

								   <a href="<?=base_url()?>superadmin/admin/edithomepagemid?id=<?=$rowm->id?>" title="edit"><i class="fa fa-edit"  style="font-size: 18px;"></i>

                                </a>

                           

                          		</td>               

                             </tr>

                        <?php 

						   }

						 }

						 else

						 { ?>

                         

                        <tr>

                          <td colspan="6"><div class="alert alert-danger" style="text-align:center;">No Data Found.</div></td>

                        </tr>

                        <?php } ?>

                        

                        </tbody>

                    </table>

                </div>

            </div>

            </form>

        </div>

    </div>

</div>
             <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i>Upcoming event</h3>

                <div class="box-tool">

                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>

                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->

                </div>

            </div>

            <div class="box-content">

              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">


                     <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Upcoming event: </label>
 <?php 
                          $resultn=$this->db->query("select * from tbl_homepage_news where id=1")->row(); ?>
                     <div class="col-sm-9 col-lg-10 controls">
                                                   <textarea class="form-control col-md-12 ckeditor" name="upcoming_event"  id="upcoming_event" rows="6" data-rule-required="true"><?=$resultn->contain?></textarea>
                                                </div>
                     

                   </div>

              
                 
                  <div class="form-group">

                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                        <input type="submit" value="Update" class="btn btn-primary" name="btn_update_news" id="btn_update_news" onclick="return checkCheckBoxes(this.form);">

                         <button type="reset" class="btn">Cancel</button>
                 
                     

                           <?php
//echo $row->status;
if($resultn->status==0)
{
	 
?>       
         <a href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve_news=btn_approve_news&set=1&id=<?=$resultn->id?>" class="btn btn-danger" style="background-color: #ff0000;border-color: #ff4646" title data-rel="tooltip" data-original-title="Make This Inactive" >
          <i class="fa fa-thumbs-down"></i></a>
<?php
}
else
{
?>
         <a class="btn btn-warning green" href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve_news=btn_approve_news&set=0&id=<?=$resultn->id?>" title data-rel="tooltip" data-original-title="Make This Active" href="">
          <i class="fa fa-thumbs-up"></i>                                   </a>

<?php 
}
?>
                    
                   </div>

                   </div>

               </form>

            </div>
            </div>
            
             <div class="clearfix"></div>
             
             
             
               
              <div class="row">

    <div class="col-md-12">

    <?php if($this->session->flashdata('error')!=''){  ?>

     <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>

     <?php } 

    if($this->session->flashdata('success')!=''){?>	

    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>

    <?php } ?>

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-table"></i> Footer contain</h3>

                <div class="box-tool">

                  

                </div>

            </div>

          

            <form name="frmfrm-manage-frontpages" id="frm-manage-frontpages" action="<?php echo base_url().'superadmin/frontpages/managefrontpage/';?>"  method="post">

            <div class="box-content">

           

                <div class="btn-toolbar pull-right clearfix">

                

                  

                    <div class="btn-group">

                        <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/admin/add_field_list?page=home-containt'; ?>"><i class="fa fa-repeat"></i></a>
                         
                    </div>

                    

                    

                </div>

                <br/><br/>

                <div class="clearfix"></div>

                

                <div class="table-responsive" style="border:0">

                 	

                    <table class="table table-advance"  id="table1">

                       <thead>

                            <tr>

                               

                               <th>sr.no</th>

                              

                               <th>Heading</th>
                                <th>Contain</th>
                               <th>Status</th>
                               
                               <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                         <?php 
                          $resultf=$this->db->query("select * from tbl_homepage_footer");
			              if($resultf->result() > 0)
		                  {
		                    foreach($resultf->result() as $rowf)
		                     {
		         	       ?>

                             <tr>

                           

                                <td><?=$rowf->id; ?></td>

                                <td><?=$rowf->heading; ?></td>

                                <td style="vertical-align:top;"><?=$rowf->contain; ?></td>

                               <td>                        <?php
//echo $row->status;
if($rowf->status==0)
{
	 
?>       
         <a href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve_footer=btn_approve_footer&set=1&id=<?=$rowf->id?>" class="btn btn-danger" style="background-color: #ff0000;border-color: #ff4646" title data-rel="tooltip" data-original-title="Make This Inactive" >
          <i class="fa fa-thumbs-down"></i></a>
<?php
}
else
{
?>
         <a class="btn btn-warning green" href="<?=base_url()?>superadmin/admin/add_field_list?btn_approve_footer=btn_approve_footer&set=0&id=<?=$rowf->id?>" title data-rel="tooltip" data-original-title="Make This Active" href="">
          <i class="fa fa-thumbs-up"></i>                                   </a>

<?php 
}
?></td>

                                <td>

								   <a href="<?=base_url()?>superadmin/admin/edithomepagefooter?id=<?=$rowf->id?>" title="edit"><i class="fa fa-edit"  style="font-size: 18px;"></i>

                                </a>

                           

                          		</td>               

                             </tr>

                        <?php 

						   }

						 }

						 else

						 { ?>

                         

                        <tr>

                          <td colspan="6"><div class="alert alert-danger" style="text-align:center;">No Data Found.</div></td>

                        </tr>

                        <?php } ?>

                        

                        </tbody>

                    </table>

                </div>

            </div>

            </form>

        </div>

    </div>

</div>
                
                
            
            
            
            
            
            
           

    </div>
    <!-- END Main Content -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script> 
    
    
    
    
     
    
    

</div>

<!-- END Main Content -->

  


<!-- END Main Content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.js"></script>
