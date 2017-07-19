<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Us | Emailer</title>
</head>
<body style="background-color:#fff; margin:0px; padding:0px;">
<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
  <style type="text/css">
.click { font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; font-size:15px; font-weight: normal; color:#f58220; text-decoration:none;transition: all 0.4s ease-in-out 0s;}
a.click:hover{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; font-size:15px; font-weight:normal; color:#373638; text-decoration: none;transition: all 0.4s ease-in-out 0s;}
</style>
  <tr>
    <td align="center" valign="top" style="background-color:#fff;box-shadow: 0 2px 3px #ccc;"><table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="64" align="left" valign="top"><table width="630" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="450" height="70" valign="middle">
            <!--    <a href="#">
                <img src="<?php //echo base_url(); ?>img/email/amazoop-logo.png" alt="logo-amazoop" width="184" height="58" border="0" style=" margin-top:5px; margin-bottom:5px;"/>								                </a>-->
                <a href="#"><img src="<?php echo base_url(); ?>images/coupon-logo.jpg" alt="logo-coupon" width="184" height="58" border="0" style=" margin-top:5px; margin-bottom:5px;"/></a>
                </td>
                <td width="180" height="64" style="height:40px;line-height:40px;font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; text-align:right; color:#333;"><?php echo date('d / M /Y'); ?></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="24"><img src="<?php echo base_url(); ?>img/email/emailer_spacer.png" width="630" height="35" alt="emailer_spacer" /></td>
       </tr>
        <tr>
          <td><table width="630" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #eee;border-radius: 6px;">
              <tr>
                <td align="left" valign="top"><table width="630" border="0" align="center" cellpadding="0" cellspacing="0" style="box-shadow: 0 2px 3px #ccc;border-radius:4px;background-color:#ffffff;">
                    <tr>
                      <td align="center" valign="top"><table width="586" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><img src="<?php echo base_url(); ?>img/email/emailer_spacer.png" width="586" height="12" alt="emailer_spacer" /></td>
                          </tr>
                          <tr>
        	                <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#525252; padding-bottom:12px; border-bottom:1px dashed #ccc; ">Dear  <?php echo ucfirst($first_name).' '.ucfirst($last_name); ?>,
                          
                             </td>
      	                 </tr>  
                          <tr>
        	                <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#525252; padding-bottom:12px;">
                            Thank you for contacting us on <a href="<?php echo base_url(); ?>" style="text-decoration:none" target="_blank">coupon.com</a>
                            </td>
      	                </tr>
                          <tr>
        	                <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#525252; padding-bottom:12px; ">
                            You will soon receive a details regarding the same.
                            </td>
      	                </tr>
                          <tr>
        	                <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#525252; padding-bottom:12px;">
                            For any further queries. please feel free to contact on email id <?php echo $admin_email; ?> or phone number (<?php echo $phone; ?>). 
                           </td>
      	                </tr>
                          <tr>
                            <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#525252; padding-bottom:10px;text-align:left;">Thanks & Regards</td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="90%" style="font-family: Tahoma, Geneva, sans-serif; font-size:13px; font-weight: normal; color:#525252; padding-bottom:10px; text-align:left;"><a href="<?php echo base_url(); ?>" style="text-decoration:none" target="_blank">coupon.com</a> &copy;  All Rights Reserved.</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                           <td><img src="<?php echo base_url(); ?>img/email/emailer_spacer.png" width="586" height="20" alt="emailer_spacer" /></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="28"><img src="<?php echo base_url(); ?>img/email/emailer_spacer.png" width="630" height="28" alt="emailer_spacer" /></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>