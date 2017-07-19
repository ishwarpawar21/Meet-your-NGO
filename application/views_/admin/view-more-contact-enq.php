<style type="text/css">
.blue_text{color:#58b1fc !important; font-weight:bold ; margin-top:-6px !important; }
</style>
<!-- BEGIN Page Title -->
<div class="page-title">
    <div style="clear:both !important;">
        <h1><i class="fa  fa-share-square-o"></i>Contact Enquries</h1>
        <h4>View details of contact enquries</h4>
    </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->

<script type="text/javascript">
$(document).ready( function ()
{	$("#contact_new_ref").load(location.href+'#contact_new_ref'); });
</script>
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url().'superadmin/admin/dashboard/'; ?>">Home</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li>
        	<a href="<?php echo base_url().'superadmin/admin/managecontactinquiry/'; ?>">Manage Contact Enquiries</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">View Contact Enquiries Details</li>
    </ul>
</div>

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i>View Contact Enquiries</h3>
                <div class="box-tool">
                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/admin/managecontactinquiry/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>
                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="col-sm-12">
				
                    </div>
                  </div>
                   <div class="form-group">
                          <label class="col-xs-3 col-lg-2">Name :</label>
                     <div class="col-sm-7 col-lg-7 " >
                        <?php echo  ucfirst($contact_details[0]['con_first_name']).' '.ucfirst($contact_details[0]['cont_last_name']);  ?>
					  </div>
                  </div>
                  <div class="form-group">
                          <label class="col-xs-3 col-lg-2">Contact Email :</label>
                     <div class="col-sm-7 col-lg-7 " >
                        <?php echo  $contact_details[0]['cont_email'];  ?>
					  </div>
                  </div>
                   
                   <div class="form-group">
                          <label class="col-xs-3 col-lg-2">Contact Number :</label>
                     <div class="col-sm-7 col-lg-7 " >
                        <?php echo  $contact_details[0]['cont_mobile'];  ?>
					  </div>
                  </div>
                    <div class="form-group">
                          <label class="col-xs-3 col-lg-2">Message :</label>
                     <div class="col-sm-7 col-lg-7 " >
                      <?php echo  stripslashes($contact_details[0]['cont_message']);  ?>
					  </div>
                  </div>   
                 </form>
            </div>
        </div>
    </div>
</div>
