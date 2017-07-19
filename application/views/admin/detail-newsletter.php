<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa fa-pencil-square"></i>Newsletter Detail</h1>

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
        	<a href="<?php echo base_url().'superadmin/newsletter/manage/'; ?>">Manage Newsletter</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Newsletter Detail</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>Newsletter Details</h3>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/newsletter/manage/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data">
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Subject </label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <label class="col-sm-3 col-lg-9 control-label" style="text-align:left"><?php echo $newsdetail[0]['newsletter_subject']; ?></label>
					  </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Title </label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <label class="col-sm-3 col-lg-9 control-label" style="text-align:left"><?php echo $newsdetail[0]['news_title']; ?></label>
					  </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Description</label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <label class="col-sm-3 col-lg-9 control-label" style="text-align:left"><?php echo $newsdetail[0]['news_description']; ?></label>
					  </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->
