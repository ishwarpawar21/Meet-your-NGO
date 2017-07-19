<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>var site_url='<?php echo base_url(); ?>';</script>
 <script src="<?php echo base_url(); ?>js/jquery-1.8.2.js"></script>
<script src="<?php echo base_url(); ?>js/admin-validation.js" type="text/javascript"></script>
</head>

<body>
<form method="post" action="" >
                        <div class="span8">
                            <div class="news-bag">Newsletter Sign Up</div>
                            <div class="news-textbox">
                              <input name="user_email" id="user_email"  class="chk_email_address" placeholder="Enter your email address" type="text"/></div>
                            <div class="news-textbox">
                              <input name="btn_user_registration" id="btn_user_registration" class="news-btn" value="Subscribe" type="button" />
                            </div>
                            <div class="error" id="user_email1"></div>
                             <div class="clr"></div>
                            
                        </div>
                    </form>
</body>
</html>