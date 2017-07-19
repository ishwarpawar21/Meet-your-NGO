<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/admin-validation.js"></script>
<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
       <h1><i class="fa fa-pencil-square"></i>Manage Blogs</h1>
       <h4>Blogs</h4>
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
        <li class="active">Manage Blogs</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<form name="frm-manage-blogs" id="frm-manage-blogs" action="<?php echo base_url().'superadmin/blogs/manageblogs/';?>"  method="post">
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
            <div class="box-title">
                <h3><i class="fa fa-pencil-square"></i> Manage Blogs</h3>
                <div class="box-tool">
                   <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
                        <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Add blogs" href="<?php echo base_url().'superadmin/blogs/addblogs/';?>"><i class="fa fa-plus"></i></a>
                       <button type="submit" name="multiple_delete" id="multiple_delete"  class="btn btn-circle btn-primary btn-bordered btn-primary"><i class="fa fa-trash-o"></i></button>
                    </div>
                    <div class="btn-group">
                       <button type="submit" name="blockmultiple" id="blockmultiple" class="btn btn-circle btn-primary btn-bordered btn-primary"><i class="fa fa-unlock-alt"></i></button>
                    </div>
                      <div class="btn-group">
                       <button type="submit" name="unblockmultiple" id="unblockmultiple"  class="btn btn-circle btn-primary btn-bordered btn-primary"><i class="fa fa-unlock"></i></button>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-circle btn-primary btn-bordered btn-primary" title="Refresh" href="<?php echo base_url().'superadmin/blogs/manageblogs/'; ?>"><i class="fa fa-repeat"></i></a>
                    </div>
                    
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                 
                    <table class="table table-advance" <?php if(count($blogs)>0){?> id="table1" <?php } ?>>
                       <thead>
                            <tr>
                               <th style="width:18px">
                                <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                               <th>Name </th>
                               <th>Description</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
						 if(count($blogs)>0)
						 {
						   foreach($blogs as $blog)
						   {  	
						 ?>
                             <tr>
                                <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del[]" value="<?php echo $blog['blog_id']; ?>"/></td>
                                <td><?php echo stripslashes($blog['blog_title']); ?></td>
                                <td><?php echo stripslashes(substr($blog['blog_desc'],0,120)); ?></td>
                                <td>
<?php if($blog['blog_status']=='1')
{ ?>

<a href="<?php echo base_url('superadmin/blogs/chantgestatusblogs/0/'.$blog['blog_id']);?>" title="Click here for Block"><i class="fa fa-unlock" style="font-size: 20px;"></i></a>
<?php } else{ ?>
<a href="<?php echo base_url('superadmin/blogs/chantgestatusblogs/1/'.$blog['blog_id']);?>" title="Click here for Active"><i class="fa fa-unlock-alt" style="font-size: 20px;"></i></a>
										
								<?php } ?>
                                </td>
                                <td>
                               
                                
                                <a  href="<?php echo base_url().'superadmin/blogs/updateblog/'.$blog['blog_id'];?>" title="Click here for Edit"><i class="fa fa-edit"  style="font-size: 18px;"></i>
                                </a>
                                <a href="<?php echo base_url().'superadmin/blogs/deleteblogs/'.$blog['blog_id'];?>" onclick="javascript : return deletconfirm();" title="Click here for Delete" ><i class="fa fa-trash-o"  style="font-size: 18px;"></i></a>
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
        </div>
    </div>
</div>
</form>
<!-- END Main Content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.js"></script>