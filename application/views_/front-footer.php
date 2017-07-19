<!--footer-start-->
<div class="footer">
  <div class="footer-top">
    <div class="footer-inner">
      <div class="footer-social-title">Stay connected with us</div>
      <div class="footer-social-titleimg">
      <?php
	   $getdata=$this->master_model->getRecords('tbl_social',array('social_id'=>'1'));
	   ?>
        <div class="footer-social-titleimg-left"><a href="<?php echo $getdata[0]['twitter']; ?>" target="_blank"><img src="<?php echo base_url(); ?>images/twitter-icon.jpg" width="60" height="60" alt="twitter" /> </a> </div>
        <div class="footer-social-titleimg-left"><a href="<?php echo $getdata[0]['facebook']; ?>" target="_blank"><img src="<?php echo base_url(); ?>images/facebook-icon.jpg" width="60" height="60" alt="facebook" /> </a></div>
        <div class="footer-social-titleimg-left"><a href="<?php echo $getdata[0]['googleplus']; ?>" target="_blank"><img src="<?php echo base_url(); ?>images/gplus-icon.jpg" width="60" height="60" alt="gplus" /></a></div>
        <div class="clr"></div>
      </div>
      <div class="footer-link">
        <div class="footer-link-bag">Quick Links :</div>
        <div class="footer-link-inner"><a href="<?php echo base_url();?>">Home</a></div>
        <div class="footer-link-inner"><a href="<?php echo base_url('about-us');?>">About Us</a></div>
        <div class="footer-link-inner"><a href="<?php echo base_url('press');?>">Press </a></div>
        <div class="footer-link-inner"><a href="<?php echo base_url('jobs');?>">Careers </a></div>
        <div class="footer-link-inner"><a href="<?php echo base_url('privacy-policy');?>">Privacy Policy </a></div>
<!--    <div class="footer-link-inner"><a href="#">Blog </a></div>
        <div class="footer-link-inner"><a href="#">Sitemap </a></div>-->
        <div class="footer-link-inner"><a href="<?php echo base_url('contact-us');?>">Contact Us</a></div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="footer-btm">Copyright &copy; <?php echo date('Y'); ?> Coupon. All rights reserved.</div>
  <div class="clr"></div>
</div>
<!--footer-end-->
</div>
<!--wrapper-end-->
<?php
$onClass 	 = $this->router->fetch_class();
$onMethod = $this->router->fetch_method();
$_combine = $onClass.'|'.$onMethod;
$flag = 0;
switch($_combine)
{
	case 'share|details':case 'home|showcode':$flag =1;
}
if($flag==0)
{
?>
<script type="text/javascript">
   window.fbAsyncInit = function() {
		 //Initiallize the facebook using the facebook javascript sdk
		 FB.init({ 
		   appId  :'<?php echo $this->config->item('appID'); ?>', // App ID 
		   cookie :true, // enable cookies to allow the server to access the session
		   status :true, // check login status
		   xfbml  :true, // parse XFBML
		   oauth  :true //enable Oauth 
		 });
	   };
	   //Read the baseurl from the config.php file
	   (function(d){
		   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		   if (d.getElementById(id)) {return;}
				   js = d.createElement('script'); js.id = id; js.async = true;
				   js.src = "//connect.facebook.net/en_US/all.js";
				   ref.parentNode.insertBefore(js, ref);
			}(document));
		//Onclick for fb login
	 $('#facebook').click(function(e) {
			  FB.login(function(response) {
			  if(response.authResponse) {
				parent.location ='<?php echo base_url(); ?>home/checkfacebook/';
			   //redirect uri after closing the facebook popup
			  }
	 		},{scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); 
	 });
 </script>
 <?php } ?>
 <div id="fb-root"></div>
<script type="text/javascript">
$(document).ready(function(){

$('.show_more_cmnt').live("click",function() 
{
	var getId = $(this).attr("id");
	if(getId)
	{
		var splId = getId.split('|');
	$("#load_more_"+splId[0]).html('<img src="<?php echo base_url().'images/myloader_20x20.gif'; ?>" style="padding:10px 0 0 100px;"/>');  
	$.ajax({
	type: "POST",
	url: "<?php echo base_url().'home/more_content/'; ?>",
	data: "getLastContentId="+ getId, 
	cache: false,
	success: function(html){
	$("#postedComment_"+splId[1]).append(html);
	$("#load_more_"+splId[0]).remove();
	}
	});
	}
	else
	{
	$("#more_tab_"+splId[0]).html('The End');
	}
	return false;
});

	
	
$('.openBox').live('click',function(){
	var cid = $('#txtArray').val();
	var splId = cid.split(',');
	var id = $(this).attr('name');
	var clickedId = id.split('_');
	for(var i = 0; i < splId.length ; i++)
	{
		if(clickedId[1]==splId[i])
		{ $('#commentContainer_'+splId[i]).css('display','block'); }
		else
		{$('#commentContainer_'+splId[i]).css('display','none');}
	}
	
});
$('.btnCancel').live('click',function(){
	var id = $(this).attr('id');
	$('#commentContainer_'+id).css('display','none');
});
 $('.btnDoCmnt').live('click',function(){
	var id = $(this).attr('id');
	var _txtSenderid		= 	$('#txtSenderid_'+id).val();
	var _txtCouponid		= 	$('#txtCouponid_'+id).val();
	var _userComment 		= 	$('#couponComment_'+id).val();
	if(_txtSenderid != '')
	{
		if(_txtSenderid != '' && _txtCouponid != '')
		{
			if(_userComment == '' || _userComment.match(/^\s+$/))
			{ 
				alert('Please write your comment in box.'); 
				$('#couponComment_'+id).focus();
			}
			else
			{
				$('#divLoader_'+id).css('display','block');
				$('#divLoader_'+id).html('<div style="text-align:center;" class="new-heading-inner"><img width="60" height="60" alt="myloader.gif" src="'+site_url+'images/myloader.gif"></div>');
				var dataString = {senderid:_txtSenderid,couponid:_txtCouponid,comments:_userComment,}
				$.ajax({
							type: 'POST',
							url: site_url+'home/post_comment/',
							data:dataString,
							success:function(res)
							{
								if(res!='error' && res!='limit')
								{
									 $('#divLoader_'+id).html('<div class="right-message">Thanks - your comment posted successfully.</div>'); 
									 $('#postedComment_'+id).html(res);
									 $('#couponComment_'+id).val('');
									 var _counter = $('#counter_'+id).html();
									 var newCnt  = parseInt(_counter)+1;
									 $('#counter_'+id).html(newCnt);
								}
								else if(res=='limit')
								{
								  alert('Your daily limit is finished.Please try tommorrow.');	
								  $('#divLoader_'+id).css('display','none');
								}
								else
								{
									$('#divLoader_'+id).css('display','none');
									alert('Error! please try after some time.');
								}
							}
					});
			}
		}
		else
		{
			alert('Error in posting comment!\nPlease contact to admin.');
		}
	}
	else
	{
		alert('Please login to post comment.');
	}
  });
})
 </script>
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1512439695640622&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</body></html>