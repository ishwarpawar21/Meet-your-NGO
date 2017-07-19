<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="author" content="Your name" />
<title>Coupon.com</title>
<!--<link href="<?php //echo base_url();?>css/amazoop.css" rel="stylesheet" type="text/css" />-->
<!--<link href='//fonts.googleapis.com/css?family=IM+Fell+English:400,400italic|Open+Sans:300,400' rel='stylesheet' type='text/css'>-->
</head>
<body>
<div class="page-under">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="row">
                  <?php 
				    if($this->uri->segment(2)=='offline')
					{
					  $siteon=$this->master_model->getRecordCount('tbl_site_status',array('site_id'=>'1','site_status'=>'1'));
					  if($siteon==1)
					  {redirect(base_url());}
					}
				   ?>
                   <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>images/page-under.png" alt="page" /></a>
                </div>
            </div>
        </div>
    </div>    
</div>
</body>
</html>