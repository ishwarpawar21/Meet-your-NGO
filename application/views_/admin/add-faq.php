<!-- BEGIN Page Title -->

<div class="page-title">

    <div style="clear:both !important;">

        <h1><i class="fa fa-pencil-square"></i>Add FAQ</h1>



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

        	<a href="<?php echo base_url().'superadmin/faq/manage/'; ?>">Manage FAQ</a>

            <span class="divider"><i class="fa fa-angle-right"></i></span>

        </li>

        <li class="active">Add FAQ</li>

    </ul>

</div>



<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->

<div class="row">

    <div class="col-md-12">

        <div class="box">

            <div class="box-title">

                <h3><i class="fa fa-bars"></i>Add FAQ</h3>

                <div class="box-tool">

                    <a  class="show-tooltip" href="<?php echo base_url().'superadmin/faq/manage/';?>" title="Back"><i class="fa fa-chevron-up"></i></a>

                   <!-- <a data-action="close" href="#"><i class="fa fa-times"></i></a>-->

                </div>

            </div>

            <div class="box-content">

              <form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">

                  <div class="form-group">

                    <div class="col-sm-12">

               		 	<?php if($this->session->flashdata('error')!=''){  ?>

                		 <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>

               			 <?php } 

                	 	if($this->session->flashdata('success')!=''){?>	

                	 	<div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>

					 	<?php } ?>

                     </div>

                  </div>

                  <div class="form-group">

                    <label class="col-sm-3 col-lg-2 control-label">Category</label>

                    <div class="col-sm-9 col-lg-10 controls">

                    <!--<label class="checkbox-inline">

                        <input type="checkbox"  name="faqcat_id[]"  id="faqcat_id"  class="chk_checked course_add" value="1"/><?php echo "Help"; ?>

                      </label>-->

                      <label class="checkbox-inline">

                          <input type="checkbox"  name="faqcat_id[]" id="faqcat_id"  class="chk_checked course_add" value="2"/><?php echo "Contact Us"; ?>

                      </label>

                      <label class="checkbox-inline">

                            <input type="checkbox"  name="faqcat_id[]" id="faqcat_id" class="chk_checked course_add"  value="3"/><?php echo "Community"; ?>

                      </label>

                    </div>

                    <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>

                    <div class="error_msg col-sm-9 col-lg-9" id="error_faqcat_id" style="display:none;"></div>

                  </div>

                  <div class="form-group">

                      <label class="col-sm-3 col-lg-2 control-label">Question </label>

                      <div class="col-sm-9 col-lg-10 controls">

                         <input type="text" class="form-control" name="faq_ques" id="faq_ques" placeholder="Question" value="" data-rule-required="true" />

                         <?php echo form_error('faq_ques'); ?>

                         <div class="error_msg" id="error_faq_ques" style="display:none;"></div>

                      </div>

                   </div>

                  <div class="form-group">

                    <label class="col-sm-3 col-lg-2 control-label">Answer</label>

                     <div class="col-sm-9 col-lg-10 controls">

                     <textarea class="form-control col-md-12 ckeditor" name="faq_ans"  id="faq_ans" rows="6" data-rule-required="true" ></textarea>

                     <?php echo form_error('faq_ans'); ?>
                      <div class="error_msg" id="error_faq_ans" style="display:none;"></div>

                    </div>

                  </div>

                  <div class="form-group">

                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                        <input type="submit" value="Submit" class="btn btn-primary" name="btn_add_faq" id="btn_add_faq" onclick="return checkCheckBoxes(this.form);">

                         <button type="reset" class="btn">Cancel</button>

                   </div>

                   </div>

               </form>

            </div>

        </div>

    </div>

</div>

<!-- END Main Content -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script> 