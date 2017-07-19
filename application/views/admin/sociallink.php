<!-- BEGIN Page Title -->

<div class="page-title">

    <div>

        <h1><i class="fa fa-cogs"></i> Social Links</h1>

        <h4>Update of social link</h4>

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

        <li class="active">Social Links</li>

    </ul>

</div>

<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->

<div class="row">

    <div class="col-md-12">

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i> Social Links</h3>

                <div class="box-tool">

                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>

                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>

                </div>

            </div>

            <div class="box-content">

             <div class="form-group">

                   <?php if($this->session->flashdata('error')){ ?>

                   <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>

                   <?php } ?>

                   <?php if($this->session->flashdata('success')){ ?>

                   <div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div>

                   <?php } ?>

                  </div>

               <form action="<?php echo base_url().'superadmin/admin/sociallink/'; ?>" class="form-horizontal" id="validation-form" method="post">

                

                  <div class="form-group">

                     <label class="col-sm-3 col-lg-2 control-label" for="password">Facebook Links :</label>

                     <div class="col-sm-6 col-lg-4 controls">

                       <input type="text" name="facebook_link" id="facebook_link" class="form-control" data-rule-required="true"  value="<?php echo $social_link[0]['facebook'];?>"/>
                       <div class="error_msg" id="error_facebook_link" style="display:none;"></div>

                     </div>

                  </div>

                  <div class="form-group">

                    <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Twitter Links :</label>

                    <div class="col-sm-6 col-lg-4 controls">

                      <input type="text" name="twitter_link" id="twitter_link" class="form-control"  value="<?php echo $social_link[0]['twitter'];?>"/>
                      <div class="error_msg" id="error_twitter_link" style="display:none;"></div>

 
                    </div>

                   </div>
                   <input type="hidden" name="linkedin_link" id="linkedin_link" class="form-control"  value="<?php echo $social_link[0]['linkedin'];?>" />

                 <!-- <div class="form-group">

                    <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Linkedin Links :</label>

                    <div class="col-sm-6 col-lg-4 controls">
                    </div>

                   </div>-->

                   <div class="form-group">

                    <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Google Links :</label>

                    <div class="col-sm-6 col-lg-4 controls">

                       <input type="text" name="googleplus" id="googleplus" class="form-control"  value="<?php echo $social_link[0]['googleplus'];?>"/>
                        <div class="error_msg" id="error_googleplus" style="display:none;"></div>

                    </div>

                   </div>

                  <div class="form-group">

                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                            <input type="submit" class="btn btn-primary" value="Submit" name="btn_social" id="btn_social">

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- END Main Content -->



