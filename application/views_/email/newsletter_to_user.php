<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Newletter</title>
<style type="text/css">
.link-menu{font-family:Arial, Helvetica, sans-serif; font-size:13px;text-align:center; color:#fff833; text-decoration:none;}
a.link-menu:hover{font-family:Arial, Helvetica, sans-serif; font-size:13px;text-align:center; color:#fff; text-decoration:none;}
.link-menu2{font-family:Arial, Helvetica, sans-serif; font-size:13px;text-align:center; color:#2E9BC8; text-decoration:none; font-weight:bold;}
a.link-menu2:hover{font-family:Arial, Helvetica, sans-serif; font-size:13px;text-align:center; color:#525252; text-decoration:none; font-weight:bold;}
.link-menu3{font-family: Tahoma, Geneva, sans-serif; font-size:15px;text-align:center; color:#c72a23; text-decoration:none; font-weight:bold; line-height:20px;}
a.link-menu3:hover{font-family: Tahoma, Geneva, sans-serif; font-size:15px;text-align:center; color:#000; text-decoration:none; font-weight:bold; line-height:20px;}

</style>
</head>
<body style="background:#f1f1f1 (<?php echo base_url(); ?>images/emailer_bg.jpg) repeat-x; margin:0px; padding:0px;">
<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td align="center" valign="top" style="background-image:(<?php echo base_url(); ?>images/dd.png); background-repeat:no-repeat; display:block; height:2px;">
      </td>
  </tr>
  <tr>
    <td align="center" valign="top">
    <table width="630" border="0" align="center" cellpadding="0" cellspacing="0" style=" margin-bottom:20px;">
        <tr>
          <td height="24"><img src="<?php echo base_url(); ?>images/emailer_spacer.png" width="630" height="24" alt="emailer_spacer" /></td>
        </tr>
        <tr>
          <td><table width="630" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #c72a25;">
              <tr>
                <td align="left" valign="top">
                <table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center" valign="top" style="border:1px solid #c72a25;"><table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center" valign="top" style="padding-top:10px; padding-bottom:10px;line-height:20px;font-family:Arial, Helvetica, sans-serif; font-size:13px;text-align:center; color:#fff;background-color:#c72a25;">You have received this email because you have subscribed to the Coupon newsletter.<br />
                              If you cannot read this email, you can view the <a href="<?php echo base_url().'superadmin/newsletter/onlineversion/'.base64_encode($sub_id).'/'.base64_encode($news_id);?>" class="link-menu" target="_blank">Online Version</a><br />
                              To be sure to receive our Emails, please add <a href="mailto:<?php echo $admin_email;?>" class="link-menu"><?php echo $admin_email;?></a> to your address book.</td>
                        </tr>
                        <tr>
                          <td align="center" valign="top"><table width="630" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td style="background-color:#c72a25; width:10px;"><img src="<?php echo base_url(); ?>images/emailer_spacer.png" width="10" height="12" alt="emailer_spacer" /></td>
                              <td align="left" valign="top" style="width:610px;"><table width="610" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" valign="top" style=" background-color:#f7f7f7;"><table width="630" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="180" height="64" style="height:40px;line-height:40px;font-family:Arial, Helvetica, sans-serif; font-size:13px; padding-right:10px; font-weight:bold; text-align:right; color:#525252;"><?php echo date('d M Y'); ?></td>
              </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td align="center" valign="top"> <table width="576" border="0" align="center" cellpadding="0" cellspacing="0" style=" background-color:#FFF;">
                                    <tr>
                                      <td><img src="<?php echo base_url(); ?>images/emailer_spacer.png" width="586" height="12" alt="emailer_spacer" /></td>
                                      </tr>
                                      <tr>
                                      <td height="28" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#525252;">Welcome To Coupon, </td>
                                    </tr>
                                    <tr>
                                      <td height="28" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#525252;"><?php echo stripslashes($news_title); ?>, </td>
                                    </tr>
                                    <tr>
                                      <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;color:#525252; text-align:justify;"><?php echo stripslashes($news_discription);?>. </td>
                                      </tr>
                                    <tr>
                                      <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#525252;">&nbsp;</td>
                                      </tr>
                    
                                    <tr>
                                      <td height="10"><img src="<?php echo base_url(); ?>images/emailer_spacer.png" width="600" height="10" alt="emailer_spacer" /></td>
                                      </tr>
                                    <tr>
                                      <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;color:#525252; text-align:center;">
                                       
                                        </td>
                                      </tr>
                                    <tr>
                                      <td align="left" valign="top"></td>
                                      </tr>
                                    <tr>
                                      <td align="left" valign="top"></td>
                                      </tr>
                                    </table> </td>
                                </tr>
                                <tr>
                                  <td align="left"><img src="<?php echo base_url(); ?>images/emailer_spacer.png" width="500" height="20" alt="emailer_spacer" /></td>
                                </tr>
                              </table></td>
                              <td style="background-color:#c72a25; width:10px;"><img src="<?php echo base_url(); ?>images/emailer_spacer.png" width="10" height="12" alt="emailer_spacer" /></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="center" valign="top" style="padding-top:10px; padding-bottom:10px;line-height:20px;font-family:Arial, Helvetica, sans-serif; font-size:13px;text-align:center; color:#fff;background-color:#c72a25;">You can <a href="<?php echo base_url();?>superadmin/newsletter/unsubscribe/<?php echo base64_encode($sub_id);?>"  class="link-menu">unsubscribe</a> from this newsletter at any time.<br />
                                        We respect your personal information and we will not share them with any other parties.<br />
                                        For further details, please review our <a href="<?php echo base_url().'home/termscondition/'; ?>" class="link-menu" target="_blank">terms and conditions</a>.</td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top">
                      </td>
                    </tr>
                  </table>
                  </td>
              </tr>
            </table></td>
        </tr>
      </table>
   </td>
  </tr>
  <tr>
    <td align="center" valign="top"></td>
  </tr>
</table>
</body>
</html>