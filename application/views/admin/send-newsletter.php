<style>
.error_msg {
	color:#F00;
}
</style>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<!-- BEGIN Page Title -->
<div class="page-title">
  <div>
    <h1><i class="fa fa-desktop"></i>Send Newsletter</h1>

  </div>
</div>
<!-- END Page Title --> 
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <li> <i class="fa fa-home"></i> <a href="<?php echo base_url().'superadmin/admin/dashboard/'; ?>">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
    <li class="active">Send Newsletter</li>
  </ul>
</div>
<!-- END Breadcrumb --> 
<!-- BEGIN Main Content -->
<form name="frm-send-newsletter" id="frm-send-newsletter" action="<?php echo base_url().'superadmin/newsletter/send/'.$this->uri->segment(4).'/'; ?>"  method="post">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-title">
          <h3><i class="fa fa-bars"></i>Send Newsletter</h3>
          <div class="box-tool"> 
            <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>--> 
          </div>
        </div>
        <div class="box-content">
          <div class="btn-toolbar pull-right clearfix">
           <div class="btn-group"> <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Add Newsletter" href="<?php echo base_url().'superadmin/newsletter/add/';?>"><i class="fa fa-plus"></i></a> 
             <a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Delete selected" href="javascript:void(0);" onclick="javascript : return deletesendnewsletter('<?php //echo base_url();?>');"><i class="fa fa-trash-o"></i></a> </div>
            <div class="btn-group"><a class="btn btn-circle btn-to-success btn-bordered btn-primary  show-tooltip" title="Refresh" href="<?php echo base_url().'superadmin/newsletter/send/'; ?>"><i class="fa fa-repeat"></i></a></div>
          </div>
          <br/>
          <br/>
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">
            <?php 
            if($this->session->flashdata('error')!=''){?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php } 
            if($this->session->flashdata('success')!=''){?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php } ?>
            <div class="row">
            <div class="col-md-9">
            <div class="form-group">
           <!--  <label class="col-sm-2 control-label" style="text-align:right; margin-top:5px">User Type</label>
            <div class="col-sm-5 col-lg-3 controls"> 
            <input type="hidden" id="news_del" name="news_del" value="" />
             <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" class="form-control txt_name" >
                <option value="">Select User type </option>
                 <option value="<?php echo base_url().'superadmin/newsletter/send/seller/' ?>" <?php if($this->uri->segment(4)=='seller'){echo 'selected="selected"';} ?>>Upgraded USer </option>
                 <option value="<?php echo base_url().'superadmin/newsletter/send/user/' ?>" <?php if($this->uri->segment(4)=='user'){echo 'selected="selected"';} ?>>Regular User </option>
              </select>
              -->
               <div id="err_news_title" class="error_msg" style="display:none;"></div>
              </div>
         	 <div class="clr"></div>
            </div>
            </div>
            <div class="col-md-9">
            <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:right; margin-top:5px">Title</label>
            <div class="col-sm-5 col-lg-3 controls"> 
            <input type="hidden" id="news_del" name="news_del" value="" />
              <select name="news_title" id="news_title" class="form-control txt_name" >
                <option value=""> Select Title </option>
                <?php foreach($fetch_newsletter as $new) {?>
                <option value="<?php echo $new['news_id']; ?>" <?php if(isset($new['news_id']) && $new['news_id'] == $new['news_title']) ?>><?php echo $new['news_title']; ?></option>
                <?php } ?>
              </select>
               <div id="err_news_title" class="error_msg" style="display:none;"></div>
              </div>
         	 <div class="col-sm-1 col-lg-2 controls"> 
          <input type="submit"  name="btn_send_newsletter" id="btn_send_newsletter" value="Send" class="btn btn-primary" onclick="javascript : return sendmultiplenewsletter()"/>
          </div>
             <div class="clr"></div>
            </div>
            </div>
            </div>
            <br />
            <table class="table table-advance" <?php if(count($fetch_subscriber)>0){?> id="table1" <?php } ?>>
              <thead>
                <tr>
                  <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                  <th>Email Id</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				 if(count($fetch_subscriber)>0)
				 {
				   foreach($fetch_subscriber as $rowsub)
				   {  	
				?>
                <tr>
                  <td style="width:18px">
                    <input type="checkbox" name="check_email[]" id="check_email" value="<?php echo $rowsub['sub_email']; ?>"/></td>
				  <td><?php echo $rowsub['sub_email']; ?></td>
                </tr>
                <?php 
				   }
				}
				else
				{
				?>
                <tr>
                  <td colspan="4"><div class="alert alert-danger" style="text-align:center;">No Data Found.</div></td>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/admin-validation.js"></script>