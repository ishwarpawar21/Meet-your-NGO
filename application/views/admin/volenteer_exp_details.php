<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa-pencil-square"></i>Volenteer eperience Detail</h1>

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
        	<a href="<?php echo base_url().'superadmin/admin/add_field_list?page=volenteer_exp'; ?>"Volenteer eperience Detail</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Volenteer eperience</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>VOlenteer eperience Details</h3>
                <?php $result=$this->db->query("select * from volunteer_exp WHERE id=".$_GET['id'])->row(); ?>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/admin/add_field_list?page=volenteer_exp';?>" title="Back"><i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data">
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Name of org </label>
                      <div class="col-sm-9 col-lg-10 controls">
                        <?php $result_o=$this->db->query("select o_name_of_org from organisation where id=".$result->ngo_id)->row();?>
                                
                         <label class="col-sm-3 col-lg-9 control-label" style="text-align:left"><?=$result_o->o_name_of_org?></label>
					  </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Date and time </label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <label class="col-sm-3 col-lg-9 control-label" style="text-align:left"><?=$result->date_tyme?></label>
					  </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Description</label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <label class="col-sm-3 col-lg-9 control-label" style="text-align:left"><?=$result->experience?></label>
					  </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->
