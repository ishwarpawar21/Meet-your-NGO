$(document).ready(function(){
//validation for Login Start (Yogesh)
$('._openBox').live('click',function(){
	   <!--$('#commentContainer').toggle('slow');-->
	    $('#commentContainer').css('display','block');
		$(this).addClass('remove');
		$(this).removeClass('_openBox');
	});
	$('.remove').live('click',function(){
	   $('#commentContainer').css('display','none');
	   $(this).addClass('_openBox');
	   $(this).removeClass('remove');
	});
	$('#btnCancel').live('click',function(){
	  $('#commentContainer').css('display','none');
	  $(this).addClass('_openBox');
	});
	$('#_btnDoCmnt').click(function(){
    var _txtSenderid		= 	$('#txtSenderid').val();
	var _txtCouponid		= 	$('#txtCouponid').val();
	var _userComment 		= 	$('#couponComment').val();
	if(_txtSenderid != '' || _txtCouponid != '')
	{
		if(_userComment == '' || _userComment.match(/^\s+$/))
		{ alert('Please write your comment in box.'); $('#couponComment').focus();}
		else
		{
			$('#divLoader').css('display','block');
			$('#divLoader').html('<div style="text-align:center;" class="new-heading-inner"><img width="60" height="60" alt="myloader.gif" src="'+site_url+'images/myloader.gif"></div>');
			var dataString = {senderid:_txtSenderid,couponid:_txtCouponid,comments:_userComment,}
			$.ajax({
						type: 'POST',
						url: site_url+'home/post_new_comment/',
						data:dataString,
						dataType : 'json',
						success:function(res)
						{
							if(res.status=='success')
							{
								$('#divLoader').html('<div class="right-message">Thanks - your comment posted successfully.</div>');
								$('#dynamicCmnt').html(res.commentDiv790px);
								$('#postedComment_'+_txtCouponid).html(res.commentDiv+''+res.moreLoaderDiv);
								$('#counter_'+_txtCouponid).html(res.commentCnt);
								$('#_counter_'+_txtCouponid).html(res.commentCnt);
								$('#couponComment').val('');
							}
							else  if(res.status=='limit') 
							{
								$('#divLoader').css('display','none');
								alert('Your daily limit is finished.Please try tommorrow.');
							}
							else
							{
								$('#commentContainer').css('display','block');
								$('#divLoader').css('display','none');
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
	
});
$('.per_day').click(function(){
		alert('Your daily share limit is finished.Please try tommorrow.');
	});	
$('#btnPostCmnt').click(function(){
	var _txtSenderid		= 	$('#txtSenderid').val();
	var _txtReceiverid	= 	$('#txtReceiverid').val();
	var _userComment 		= 	$('#userComment').val();
	if(_txtSenderid != '' && _txtReceiverid != '')
	{
		if(_userComment == '' || _userComment.match(/^\s+$/))
		{ alert('Please write your comment in box.'); $('#userComment').focus();}
		else
		{
			$('#commentContainer').css('display','none');
			$('#divLoader').css('display','block');
			var dataString = {senderid:_txtSenderid,receiverid:_txtReceiverid,comments:_userComment,}
			$.ajax({
						type: 'POST',
						url: site_url+'community/post_comment/',
						data:dataString,
						success:function(res)
						{
							if(res=='done')
							{
								$('#divLoader').remove();
								$('#commentContainer').css('display','block');
								$('#commentContainer').html('<div class="new-heading-inner"><div class="right-message">Thanks - your comment will appear on the recipients\'s profile page soon.</div></div>');
							}
							else
							{
								$('#commentContainer').css('display','block');
								$('#divLoader').css('display','none');
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
	});
   $('#check_month').live('change',function(){
	 var month=$(this).val();
     var dataString = {month:month}
		 $.ajax({
					type: 'POST',
					url: site_url+'community/mostpoint/',
					data:dataString,
					statusCode: {
								404: function() {
								 alert('Could not contact server.');
								},
								500: function() {
								 alert('A server-side error has occurred.');
								}
							  },
							  success:function(res)
							  {
								$('#most_point').html(res);
							  }
				});
   });
 	  $('#next_point').live('click',function(){
       var month=$('#check_month').val();
	   var page_val=parseInt($('#txt_limit').val())+2;
	   var dataString = {month:month,limit:page_val}
	       $('#txt_limit').val(page_val);
		   $('#next_point').hide();
		   $("#loading_more").show();
		   $.ajax({
					type: 'POST',
					url : site_url+'community/mostpoint/',
					data:dataString,
					statusCode: {
								 404: function() {
								 alert('Could not contact server.');
								},
								 500: function() {
								 alert('A server-side error has occurred.');
								}
							  },
							  success:function(res)
							  {
								 $('#most_point').html(res);
								 $('#next_point').show();
		                         $("#loading_more").hide();
							  }
				});
   });
   
$('#btn_login').click(function(){
		var email = document.getElementById('email');
		var password = document.getElementById('password');
		var filter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(email.value=="")
		{
			$('#error_email').show();
			$('#error_email').fadeIn(2000);
			document.getElementById('error_email').innerHTML='The Email Id field is required.';
			email.focus();
			setTimeout(function(){
				$('#email').css('border-color','#CECECE');
				$('#error_email').fadeOut();
				},1000)
			return false;
		}
		else if(!filter.test(email.value))
		{
			$('#error_email').show();
			$('#error_email').fadeIn(2000);
			document.getElementById('error_email').innerHTML='Valid Email Id is required.';
			email.focus();
			setTimeout(function(){
				$('#email').css('border-color','#CECECE');
				$('#error_email').fadeOut();
				},1000)
			return false;
		}
		else if(password.value=="")
		{
			$('#error_password').show();
			$('#error_password').fadeIn(2000);
			document.getElementById('error_password').innerHTML='The Password field is required.';
			password.focus();
			setTimeout(function(){
				$('#password').css('border-color','#CECECE');
				$('#error_password').fadeOut();
				},1000)
			return false;
		}
	});
//validation for Login  User End
//validation for Sign Up Start (Yogesh)
$('#btn_save').click(function(){
		var email = document.getElementById('email');
		var user_slug = document.getElementById('user_slug');
		var password = document.getElementById('password');
		var filter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(email.value=="")
		{
			$('#error_email').show();
			$('#error_email').fadeIn(2000);
			document.getElementById('error_email').innerHTML='The Email Id field is required.';
			email.focus();
			setTimeout(function(){
				$('#email').css('border-color','#CECECE');
				$('#error_email').fadeOut();
				},1000)
			return false;
		}
		else if(!filter.test(email.value))
		{
			$('#error_email').show();
			$('#error_email').fadeIn(2000);
			document.getElementById('error_email').innerHTML='Valid Email Id is required.';
			email.focus();
			setTimeout(function(){
				$('#email').css('border-color','#CECECE');
				$('#error_email').fadeOut();
				},1000)
			return false;
		}
		else if(user_slug.value=="")
		{
			$('#error_user_slug').show();
			$('#error_user_slug').fadeIn(2000);
			document.getElementById('error_user_slug').innerHTML='The Name field is required.';
			user_slug.focus();
			setTimeout(function(){
				$('#user_slug').css('border-color','#CECECE');
				$('#error_user_slug').fadeOut();
				},1000)
			return false;
		}
		else if(password.value=="")
		{
			$('#error_password').show();
			$('#error_password').fadeIn(2000);
			document.getElementById('error_password').innerHTML='The Password field is required.';
			password.focus();
			setTimeout(function(){
				$('#password').css('border-color','#CECECE');
				$('#error_password').fadeOut();
				},1000)
			return false;
		}
	});
//validation for Sign Up  User End
//validation for Forgot PasswordStart (Yogesh)
$('#btn_forgot_password').click(function(){
		var email = document.getElementById('email');
		var filter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(email.value=="")
		{
			$('#error_email').show();
			$('#error_email').fadeIn(2000);
			document.getElementById('error_email').innerHTML='The Email Id field is required.';
			email.focus();
			setTimeout(function(){
				$('#email').css('border-color','#CECECE');
				$('#error_email').fadeOut();
				},1000)
			return false;
		}
		else if(!filter.test(email.value))
		{
			$('#error_email').show();
			$('#error_email').fadeIn(2000);
			document.getElementById('error_email').innerHTML='Valid Email Id is required.';
			email.focus();
			setTimeout(function(){
				$('#email').css('border-color','#CECECE');
				$('#error_email').fadeOut();
				},1000)
			return false;
		}
	});
//validation for Forgot Password User End
//validation for Edit Seller Start (Yogesh)
$('#btn_update_seller').click(function(){
		//var username = document.getElementById('username');
		var firstname = document.getElementById('firstname');
		var lastname = document.getElementById('lastname');
		var DOB = document.getElementById('DOB');
		var city = document.getElementById('city');
		var state = document.getElementById('state');
		var zipcode = document.getElementById('zipcode');
		var countryid = document.getElementById('countryid');
		//var Website = document.getElementById('Website');
		var briefbio = document.getElementById('briefbio');
		var profilepic = document.getElementById('profilepic');
		var chkimg = profilepic.value.split(".");
	    var extension = chkimg[1];
		
		//var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
		if(firstname.value=="")
		{
			$('#error_firstname').show();
			$('#error_firstname').fadeIn(2000);
			document.getElementById('error_firstname').innerHTML='The First Name field is required.';
			firstname.focus();
			setTimeout(function(){
				$('#firstname').css('border-color','#CECECE');
				$('#error_firstname').fadeOut();
				},1000)
			return false;
		}
		else if(lastname.value=="")
		{
			$('#error_lastname').show();
			$('#error_lastname').fadeIn(2000);
			document.getElementById('error_lastname').innerHTML='The Last Name field is required.';
			lastname.focus();
			setTimeout(function(){
				$('#lastname').css('border-color','#CECECE');
				$('#error_lastname').fadeOut();
				},1000)
			return false;
		}
		else if(DOB.value=="")
		{
			$('#error_DOB').show();
			$('#error_DOB').fadeIn(2000);
			document.getElementById('error_DOB').innerHTML='The DOB field is required.';
			DOB.focus();
			setTimeout(function(){
				$('#DOB').css('border-color','#CECECE');
				$('#error_DOB').fadeOut();
				},1000)
			return false;
		}
		else if(city.value=="")
		{
			$('#error_city').show();
			$('#error_city').fadeIn(2000);
			document.getElementById('error_city').innerHTML='The City field is required.';
			city.focus();
			setTimeout(function(){
				$('#city').css('border-color','#CECECE');
				$('#error_city').fadeOut();
				},1000)
			return false;
		}
		else if(state.value=="")
		{
			$('#error_state').show();
			$('#error_state').fadeIn(2000);
			document.getElementById('error_state').innerHTML='The State field is required.';
			state.focus();
			setTimeout(function(){
				$('#state').css('border-color','#CECECE');
				$('#error_state').fadeOut();
				},1000)
			return false;
		}
		else if(zipcode.value=="")
		{
			$('#error_zipcode').show();
			$('#error_zipcode').fadeIn(2000);
			document.getElementById('error_zipcode').innerHTML='The Zipcode field is required.';
			zipcode.focus();
			setTimeout(function(){
				$('#zipcode').css('border-color','#CECECE');
				$('#error_zipcode').fadeOut();
				},1000)
			return false;
		}
		else if(countryid.value=="")
		{
			$('#error_countryid').show();
			$('#error_countryid').fadeIn(2000);
			document.getElementById('error_countryid').innerHTML='The Country field is required.';
			countryid.focus();
			setTimeout(function(){
				$('#countryid').css('border-color','#CECECE');
				$('#error_countryid').fadeOut();
				},1000)
			return false;
		}
		/*else if(Website.value=="")
		{
			$('#error_Website').show();
			$('#error_Website').fadeIn(2000);
			document.getElementById('error_Website').innerHTML='The Website field is required.';
			Website.focus();
			setTimeout(function(){
				$('#Website').css('border-color','#CECECE');
				$('#error_Website').fadeOut();
				},1000)
			return false;
		}
		else if(!pattern.test(Website.value))
		{
			$('#error_Website').show();
			$('#error_Website').fadeIn(2000);
			document.getElementById('error_Website').innerHTML='The Valide URL is required.';
			Website.focus();
			setTimeout(function(){
				$('#Website').css('border-color','#CECECE');
				$('#error_Website').fadeOut();
				},1000)
			return false;
		}*/
		else if(briefbio.value=="")
		{
			$('#error_briefbio').show();
			$('#error_briefbio').fadeIn(2000);
			document.getElementById('error_briefbio').innerHTML='The Brief biodata field is required.';
			briefbio.focus();
			setTimeout(function(){
				$('#briefbio').css('border-color','#CECECE');
				$('#error_briefbio').fadeOut();
				},1000)
			return false;
		}
		else if((profilepic.value!='') && (extension!='jpg' && extension!='jpeg' && extension!='gif' && extension!='png'))
		{
				$('#error_profilepic').show();
				$('#error_profilepic').fadeIn(3000);
				document.getElementById('error_profilepic').innerHTML='The file type you are attempting to upload is not allowed.';
				profilepic.focus();
				setTimeout(function(){
				$('#profilepic').css('border-color','#CECECE');
				$('#error_profilepic').fadeOut();
				},3000)
				return false;
		}
	});
//validation for Edit Seller End
//validation for Edit User Start (Yogesh)
$('#btn_update_user').click(function(){
		var first_name = document.getElementById('first_name');
		var last_name = document.getElementById('last_name');
		var contact_no = document.getElementById('contact_no');
		var address = document.getElementById('address');
		var city_id = document.getElementById('city_id');
		var state_id = document.getElementById('state_id');
		var country_id = document.getElementById('country_id');
		var profile_picture = document.getElementById('profile_picture');
		var chkimg = profile_picture.value.split(".");
	    var extension = chkimg[1];
		if(first_name.value=="")
		{
			$('#error_first_name').show();
			$('#error_first_name').fadeIn(2000);
			document.getElementById('error_first_name').innerHTML='The First Name field is required.';
			first_name.focus();
			setTimeout(function(){
				$('#first_name').css('border-color','#CECECE');
				$('#error_first_name').fadeOut();
				},1000)
			return false;
		}
		else if(last_name.value=="")
		{
			$('#error_last_name').show();
			$('#error_last_name').fadeIn(2000);
			document.getElementById('error_last_name').innerHTML='The Last Name field is required.';
			last_name.focus();
			setTimeout(function(){
				$('#last_name').css('border-color','#CECECE');
				$('#error_last_name').fadeOut();
				},1000)
			return false;
		}
		else if(contact_no.value=="")
		{
			$('#error_contact_no').show();
			$('#error_contact_no').fadeIn(2000);
			document.getElementById('error_contact_no').innerHTML='The Contact Number field is required.';
			contact_no.focus();
			setTimeout(function(){
				$('#contact_no').css('border-color','#CECECE');
				$('#error_contact_no').fadeOut();
				},1000)
			return false;
		}
		else if(isNaN(contact_no.value))
		{
			$('#error_contact_no').show();
			$('#error_contact_no').fadeIn(2000);
			document.getElementById('error_contact_no').innerHTML='The Contact Number field is numeric.';
			contact_no.focus();
			setTimeout(function(){
				$('#contact_no').css('border-color','#CECECE');
				$('#error_contact_no').fadeOut();
				},1000)
			return false;
		}
		else if(address.value=="")
		{
			$('#error_address').show();
			$('#error_address').fadeIn(2000);
			document.getElementById('error_address').innerHTML='The Address field is required.';
			address.focus();
			setTimeout(function(){
				$('#address').css('border-color','#CECECE');
				$('#error_address').fadeOut();
				},1000)
			return false;
		}
		else if(city_id.value=="")
		{
			$('#error_city_id').show();
			$('#error_city_id').fadeIn(2000);
			document.getElementById('error_city_id').innerHTML='The City field is required.';
			city_id.focus();
			setTimeout(function(){
				$('#city_id').css('border-color','#CECECE');
				$('#error_city_id').fadeOut();
				},1000)
			return false;
		}
		else if(state_id.value=="")
		{
			$('#error_state_id').show();
			$('#error_state_id').fadeIn(2000);
			document.getElementById('error_state_id').innerHTML='The State field is required.';
			state_id.focus();
			setTimeout(function(){
				$('#state_id').css('border-color','#CECECE');
				$('#error_state_id').fadeOut();
				},1000)
			return false;
		}
		else if(country_id.value=="")
		{
			$('#error_country_id').show();
			$('#error_country_id').fadeIn(2000);
			document.getElementById('error_country_id').innerHTML='The Country field is required.';
			country_id.focus();
			setTimeout(function(){
				$('#country_id').css('border-color','#CECECE');
				$('#error_country_id').fadeOut();
				},1000)
			return false;
		}
		else if((profile_picture.value!='') && (extension!='jpg' && extension!='jpeg' && extension!='gif' && extension!='png'))
		{
				$('#error_profile_picture').show();
				$('#error_profile_picture').fadeIn(3000);
				document.getElementById('error_profile_picture').innerHTML='The file type you are attempting to upload is not allowed.';
				profile_picture.focus();
				setTimeout(function(){
				$('#profile_picture').css('border-color','#CECECE');
				$('#error_profile_picture').fadeOut();
				},3000)
				return false;
		}
	});
//validation for Edit User End
//validation for Contact Us Start (Yogesh)
$('#btn_contact_us').click(function(){
		var con_first_name = document.getElementById('con_first_name');
		var cont_last_name = document.getElementById('cont_last_name');
		var cont_email = document.getElementById('cont_email');
		var cont_mobile = document.getElementById('cont_mobile');
		var cont_message = document.getElementById('cont_message');
		var filter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		if(con_first_name.value=="")
		{
			$('#error_con_first_name').show();
			$('#error_con_first_name').fadeIn(2000);
			document.getElementById('error_con_first_name').innerHTML='The First Name field is required.';
			con_first_name.focus();
			setTimeout(function(){
				$('#con_first_name').css('border-color','#CECECE');
				$('#error_con_first_name').fadeOut();
				},1000)
			return false;
		}
		else if(cont_last_name.value=="")
		{
			$('#error_cont_last_name').show();
			$('#error_cont_last_name').fadeIn(2000);
			document.getElementById('error_cont_last_name').innerHTML='The Last Name field is required.';
			cont_last_name.focus();
			setTimeout(function(){
				$('#cont_last_name').css('border-color','#CECECE');
				$('#error_cont_last_name').fadeOut();
				},1000)
			return false;
		}
		else if(cont_email.value=="")
		{
			$('#error_cont_email').show();
			$('#error_cont_email').fadeIn(2000);
			document.getElementById('error_cont_email').innerHTML='The Email field is required.';
			cont_email.focus();
			setTimeout(function(){
				$('#cont_email').css('border-color','#CECECE');
				$('#error_cont_email').fadeOut();
				},1000)
			return false;
		}
		else if(!filter.test(cont_email.value))
		{
			$('#error_cont_email').show();
			$('#error_cont_email').fadeIn(2000);
			document.getElementById('error_cont_email').innerHTML='Valid Email id is required.';
			cont_email.focus();
			setTimeout(function(){
				$('#cont_email').css('border-color','#CECECE');
				$('#error_cont_email').fadeOut();
				},1000)
			return false;
		}
		else if(cont_mobile.value=="")
		{
			$('#error_cont_mobile').show();
			$('#error_cont_mobile').fadeIn(2000);
			document.getElementById('error_cont_mobile').innerHTML='The Contact Number field is required.';
			cont_mobile.focus();
			setTimeout(function(){
				$('#cont_mobile').css('border-color','#CECECE');
				$('#error_cont_mobile').fadeOut();
				},1000)
			return false;
		}
		else if(isNaN(cont_mobile.value))
		{
			$('#error_cont_mobile').show();
			$('#error_cont_mobile').fadeIn(2000);
			document.getElementById('error_cont_mobile').innerHTML='Enter Contact Number field is numeric.';
			cont_mobile.focus();
			setTimeout(function(){
				$('#cont_mobile').css('border-color','#CECECE');
				$('#error_cont_mobile').fadeOut();
				},1000)
			return false;
		}
		else if(cont_message.value=="")
		{
			$('#error_cont_message').show();
			$('#error_cont_message').fadeIn(2000);
			document.getElementById('error_cont_message').innerHTML='The Message field is required.';
			cont_message.focus();
			setTimeout(function(){
				$('#cont_message').css('border-color','#CECECE');
				$('#error_cont_message').fadeOut();
				},1000)
			return false;
		}
	});
//validation for Contact Us End
//validation for Change Password Start (Yogesh)
$('#btn_change_password').click(function(){
		var current_pass = document.getElementById('current_pass');
		var new_pass = document.getElementById('new_pass');
		var confirm_pass = document.getElementById('confirm_pass');
		if(current_pass.value=="")
		{
			$('#error_current_pass').show();
			$('#error_current_pass').fadeIn(2000);
			document.getElementById('error_current_pass').innerHTML='The Old Password field is required.';
			current_pass.focus();
			setTimeout(function(){
				$('#current_pass').css('border-color','#CECECE');
				$('#error_current_pass').fadeOut();
				},1000)
			return false;
		}
		else if(new_pass.value=="")
		{
			$('#error_new_pass').show();
			$('#error_new_pass').fadeIn(2000);
			document.getElementById('error_new_pass').innerHTML='The New Password field is required.';
			new_pass.focus();
			setTimeout(function(){
				$('#new_pass').css('border-color','#CECECE');
				$('#error_new_pass').fadeOut();
				},1000)
			return false;
		}
		else if(confirm_pass.value=="")
		{
			$('#error_confirm_pass').show();
			$('#error_confirm_pass').fadeIn(2000);
			document.getElementById('error_confirm_pass').innerHTML='The Confirm Password field is required.';
			confirm_pass.focus();
			setTimeout(function(){
				$('#confirm_pass').css('border-color','#CECECE');
				$('#error_confirm_pass').fadeOut();
				},1000)
			return false;
		}
		else if(confirm_pass.value!=new_pass.value)
		{
			$('#error_confirm_pass').show();
			$('#error_confirm_pass').fadeIn(2000);
			document.getElementById('error_confirm_pass').innerHTML='The Confirm Password & New Password is not match.';
			confirm_pass.focus();
			setTimeout(function(){
				$('#confirm_pass').css('border-color','#CECECE');
				$('#error_confirm_pass').fadeOut();
				},1000)
			return false;
		}
	});
//validation for Change Password End
//validation for Delete Conformation Message start
$('#deleteaccount').click(function(){
		if(confirm("ARE YOU SURE you wish to permanently remove your profile and all associated information?"))
		{ return true;}
		else 
		{return false;}
	});
//validation for Delete Conformation Message End
//validation for Single Coupon Asion Number Start (Yogesh)
$('#btn_check').click(function(){
		var store = document.getElementById('store');
		if(store.value=="")
		{
			$('#error_store').show();
			$('#error_store').fadeIn(3000);
			document.getElementById('error_store').innerHTML='The ASIN number field is required.';
			store.focus();
			setTimeout(function(){
				$('#store').css('border-color','#CECECE');
				$('#error_store').fadeOut();
				},1000)
			return false;
		}
	});
//validation for Single Coupon Asion Number End
//validation for Submit Coupon Start (Yogesh)
$('#btn_coupon').click(function(){
		var product_price = document.getElementById('product_price');
		var coupon_title = document.getElementById('coupon_title');
		var coupon_desc = document.getElementById('coupon_desc');
		var store = document.getElementById('store');
		var coupon_code = document.getElementById('coupon_code');
		var amount_type = document.getElementById('amount_type');
		var coupon_discount = document.getElementById('coupon_discount');
		var cate_id = document.getElementById('cate_id');
		var brand_id = document.getElementById('brand_id');
		var exp_date = document.getElementById('exp_date');
		var regex = /^[0-9\,.$]*$/;
		
		if(product_price.value=="")
		{
			$('#error_product_price').show();
			$('#error_product_price').fadeIn(3000);
			document.getElementById('error_product_price').innerHTML='The Product price field is required.';
			product_price.focus();
			setTimeout(function(){
				$('#product_price').css('border-color','#CECECE');
				$('#error_product_price').fadeOut();
				},1000)
			return false;
		}
		else if(!regex.test(product_price.value))
		{
			$('#error_product_price').show();
			$('#error_product_price').fadeIn(3000);
			document.getElementById('error_product_price').innerHTML='The coupon price is only numeric.';
			product_price.focus();
			setTimeout(function(){
				$('#product_price').css('border-color','#CECECE');
				$('#error_product_price').fadeOut();
				},1000)
			return false;
		}
		else if(coupon_title.value=="")
		{
			$('#error_coupon_title').show();
			$('#error_coupon_title').fadeIn(3000);
			document.getElementById('error_coupon_title').innerHTML='The Coupon title field is required.';
			coupon_title.focus();
			setTimeout(function(){
				$('#coupon_title').css('border-color','#CECECE');
				$('#error_coupon_title').fadeOut();
				},1000)
			return false;
		}
		else if(coupon_desc.value=="")
		{
			$('#error_coupon_desc').show();
			$('#error_coupon_desc').fadeIn(3000);
			document.getElementById('error_coupon_desc').innerHTML='The Coupon description field is required.';
			coupon_desc.focus();
			setTimeout(function(){
				$('#coupon_desc').css('border-color','#CECECE');
				$('#error_coupon_desc').fadeOut();
				},1000)
			return false;
		}
		else if(store.value=="")
		{
			$('#error_store').show();
			$('#error_store').fadeIn(3000);
			document.getElementById('error_store').innerHTML='The ASIN number field is required.';
			store.focus();
			setTimeout(function(){
				$('#store').css('border-color','#CECECE');
				$('#error_store').fadeOut();
				},1000)
			return false;
		}
		else if(coupon_code.value=="")
		{
			$('#error_coupon_code').show();
			$('#error_coupon_code').fadeIn(3000);
			document.getElementById('error_coupon_code').innerHTML='The coupon code number field is required.';
			coupon_code.focus();
			setTimeout(function(){
				$('#coupon_code').css('border-color','#CECECE');
				$('#error_coupon_code').fadeOut();
				},1000)
			return false;
		}
		else if(amount_type.value=="")
		{
			$('#error_amount_type').show();
			$('#error_amount_type').fadeIn(3000);
			document.getElementById('error_amount_type').innerHTML='The discount field is required.';
			amount_type.focus();
			setTimeout(function(){
				$('#amount_type').css('border-color','#CECECE');
				$('#error_amount_type').fadeOut();
				},1000)
			return false;
		}
		else if(coupon_discount.value=="")
		{
			$('#error_coupon_discount').show();
			$('#error_coupon_discount').fadeIn(3000);
			document.getElementById('error_coupon_discount').innerHTML='The coupon price field is required.';
			coupon_discount.focus();
			setTimeout(function(){
				$('#coupon_discount').css('border-color','#CECECE');
				$('#error_coupon_discount').fadeOut();
				},1000)
			return false;
		}
		else if(isNaN(coupon_discount.value))
		{
			$('#error_coupon_discount').show();
			$('#error_coupon_discount').fadeIn(3000);
			document.getElementById('error_coupon_discount').innerHTML='The coupon price field is numeric.';
			coupon_discount.focus();
			setTimeout(function(){
				$('#coupon_discount').css('border-color','#CECECE');
				$('#error_coupon_discount').fadeOut();
				},1000)
			return false;
		}
		else if(cate_id.value=="")
		{
			$('#error_cate_id').show();
			$('#error_cate_id').fadeIn(3000);
			document.getElementById('error_cate_id').innerHTML='The category field is required.';
			cate_id.focus();
			setTimeout(function(){
				$('#cate_id').css('border-color','#CECECE');
				$('#error_cate_id').fadeOut();
				},1000)
			return false;
		}
		else if(brand_id.value=="")
		{
			$('#error_brand_id').show();
			$('#error_brand_id').fadeIn(3000);
			document.getElementById('error_brand_id').innerHTML='The brand field is required.';
			brand_id.focus();
			setTimeout(function(){
				$('#brand_id').css('border-color','#CECECE');
				$('#error_brand_id').fadeOut();
				},1000)
			return false;
		}
		else if(exp_date.value=="")
		{
			$('#error_exp_date').show();
			$('#error_exp_date').fadeIn(3000);
			document.getElementById('error_exp_date').innerHTML='The date field is required.';
			exp_date.focus();
			setTimeout(function(){
				$('#exp_date').css('border-color','#CECECE');
				$('#error_exp_date').fadeOut();
				},1000)
			return false;
		}
	});
//validation for Submit Coupon End
//Like Unlike Coupon Start (Yogesh)
$('.like_unlike').click(function(){
		var status=$(this).attr('lang');
		var loginid=$(this).attr('rel');
		$.ajax({
				url : site_url+"choice/"+status+"/"+loginid,
				data: '',
				type: "POST",
				dataType: "json",
				success: function(data)
				{
					if(data.like!='')
					{
						if(data.like=='like')
						{
						  $('#like'+loginid).html(data.likecount);
						  $('#txt_like'+loginid).val(data.likecount);
						  if($('#txt_unlike'+loginid).val()!='0' && data.first!='first')
						  {
							var unlike_cout=parseInt($('#txt_unlike'+loginid).val())-1;
							$('#unlike'+loginid).html(unlike_cout);
						  }
						  /*check total point*/
						   var PointTotal=parseInt($('#txt_pointTotal'+loginid).val());
						   var AddPointLike=parseInt($('#PointLikeDb'+loginid).val());
						   var TotalSumshow=PointTotal+AddPointLike;
						   $('#total_point'+loginid).html(TotalSumshow);
						   $('#txt_pointTotal'+loginid).val(TotalSumshow);
						   /*check total point*/
						  
						}
						if(data.like=='unlike')
						{
						  $('#unlike'+loginid).html(data.likecount);
						  $('#txt_unlike'+loginid).val(data.likecount);
						  if($('#txt_like'+loginid).val()!='0' && data.first!='first')
						  {
						    var like_cout=parseInt($('#txt_like'+loginid).val())-1;
							$('#like'+loginid).html(like_cout);
							/*check total point*/
							var PointTotal=parseInt($('#txt_pointTotal'+loginid).val());
							var AddPointLike=parseInt($('#PointLikeDb'+loginid).val());
							var TotalSumshow=PointTotal-AddPointLike;
							$('#total_point'+loginid).html(TotalSumshow);
							$('#txt_pointTotal'+loginid).val(TotalSumshow);
							/*check total point*/
						  }
						}
					}
					if(data.like=='')
					{
						alert("Hello, you alredy done this action.");
						//$('.LoadingImage').css('display','none');
					}
					if(data.like=='Finished')
					{
						alert('Your points for today are already finished');
					}
				},
		});	
		return false;
	});
//Like Unlike Coupon  End
//Save Coupon in favourite list Start (Yogesh)
$('.save_coupon').click(function(){
	var coupon_id=$(this).attr('rel');
	var coupon_next_id=$(this).find('.alreadydone').attr('id');
		if(confirm('Are you sure, you want to add this Coupon in favourite list?'))
		{
			$.ajax({
				url : site_url+"savecoupon/"+coupon_id,
				data: '',
				type: "POST",
				success: function(data)
				{
					if(data=="INSERT")
					{
						//$('#'+coupon_next_id).hide();
						alert("Coupon added in favourite list succesfully.");
					}
					if(data=="ALREADY")
					{
						//$('#'+coupon_next_id).hide();
						alert("Already coupon add in favourite list.");
					}
					if(data=="ERROR")
					{
						alert("Error while coupon adding in favourite list.");
					}
					
				},
			});
			return false;
		}
		else
		{
			return false;
		}
	});
//Save Coupon in favourite list End 
//Delete Seller Coupon from profilr page Start (Yogesh)
$('.delete_coupon').click(function(){
		var coupon_id=$(this).attr('rel');
		var del_id=coupon_id.split("_");
		if(confirm('Are you sure, you want to delete this Coupon permanently?'))
		{
			$.ajax({
				url : site_url+"deletecoupon/"+del_id[1],
				data: '',
				type: "POST",
				success: function(data)
				{
					if(data=="DELETE")
					{
						$('#'+coupon_id).hide();
					}
					if(data=="ERROR")
					{
						alert("Error while coupon deleting.");
					}
				},
			});
			return false;
		}
		else
		{
			return false;
		}
	});
//Delete Seller Coupon from profilr page End 
//validation for Brand ADD ,Edit Start (Yogesh)
$('#btn_add_brand').click(function(){
		var type=$(this).attr('lang');
		var brand_image = document.getElementById('brand_image');	
		var brand_title = document.getElementById('brand_title');
		var brand_desc = document.getElementById('brand_desc');
		var chkimg = brand_image.value.split(".");
	    var extension = chkimg[1];
			if((brand_image.value!='') && (extension!='jpg' && extension!='jpeg' && extension!='gif' && extension!='png'))
			{
					$('#error_brand_image').show();
					$('#error_brand_image').fadeIn(2000);
					document.getElementById('error_brand_image').innerHTML='The file type you are attempting to upload is not allowed.';
					brand_image.focus();
					setTimeout(function(){
					$('#brand_image').css('border-color','#CECECE');
					$('#error_brand_image').fadeOut();
					},1000)
					return false;
			}
			else if(type=='add' && brand_image.value=="")
			{
					$('#error_brand_image').show();
					$('#error_brand_image').fadeIn(2000);
					document.getElementById('error_brand_image').innerHTML='The image field is required.';
					brand_image.focus();
					setTimeout(function(){
						$('#brand_image').css('border-color','#CECECE');
						$('#error_brand_image').fadeOut();
						},1000)
					return false;
			}
			else if(brand_title.value=="")
			{
					$('#error_brand_title').show();
					$('#error_brand_title').fadeIn(2000);
					document.getElementById('error_brand_title').innerHTML='The title field is required.';
					brand_title.focus();
					setTimeout(function(){
						$('#brand_title').css('border-color','#CECECE');
						$('#error_brand_title').fadeOut();
						},1000)
					return false;
				}
			else if(brand_desc.value=="")
			{
				$('#error_brand_desc').show();
				$('#error_brand_desc').fadeIn(2000);
				document.getElementById('error_brand_desc').innerHTML='The description field is required.';
				brand_desc.focus();
				setTimeout(function(){
					$('#brand_desc').css('border-color','#CECECE');
					$('#error_brand_desc').fadeOut();
					},1000)
				return false;
			 }
	});
//validation for Brand Add, Edit End
//validation for Submit Coupon Start (Yogesh)
$('#btn_update_coupon').click(function(){
		var product_price= document.getElementById('product_price');
		var coupon_title= document.getElementById('coupon_title');
		var coupon_desc= document.getElementById('coupon_desc');
		var coupon_code = document.getElementById('coupon_code');
		//var amount_type = document.getElementById('amount_type');
		var coupon_discount = document.getElementById('coupon_discount');
		var cate_id = document.getElementById('cate_id');
		var brand_id = document.getElementById('brand_id');
		var exp_date = document.getElementById('exp_date');
		//var filter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var regex = /^[0-9\,.$]*$/;
		
		if(product_price.value=="")
		{
			$('#error_product_price').show();
			$('#error_product_price').fadeIn(3000);
			document.getElementById('error_product_price').innerHTML='The coupon price field is required.';
			product_price.focus();
			setTimeout(function(){
				$('#product_price').css('border-color','#CECECE');
				$('#error_product_price').fadeOut();
				},1000)
			return false;
		}
		//else if(isNaN(product_price.value))
		else if(!regex.test(product_price.value))
		{
			$('#error_product_price').show();
			$('#error_product_price').fadeIn(3000);
			document.getElementById('error_product_price').innerHTML='The coupon price is only numeric.';
			product_price.focus();
			setTimeout(function(){
				$('#product_price').css('border-color','#CECECE');
				$('#error_product_price').fadeOut();
				},1000)
			return false;
		}
		else if(coupon_title.value=="")
		{
			$('#error_coupon_title').show();
			$('#error_coupon_title').fadeIn(3000);
			document.getElementById('error_coupon_title').innerHTML='The coupon title field is required.';
			coupon_title.focus();
			setTimeout(function(){
				$('#coupon_title').css('border-color','#CECECE');
				$('#error_coupon_title').fadeOut();
				},1000)
			return false;
		}
		else if(coupon_desc.value=="")
		{
			$('#error_coupon_desc').show();
			$('#error_coupon_desc').fadeIn(3000);
			document.getElementById('error_coupon_desc').innerHTML='The coupon description field is required.';
			coupon_desc.focus();
			setTimeout(function(){
				$('#coupon_desc').css('border-color','#CECECE');
				$('#error_coupon_desc').fadeOut();
				},1000)
			return false;
		}
		else if(coupon_code.value=="")
		{
			$('#error_coupon_code').show();
			$('#error_coupon_code').fadeIn(3000);
			document.getElementById('error_coupon_code').innerHTML='The coupon code number field is required.';
			coupon_code.focus();
			setTimeout(function(){
				$('#coupon_code').css('border-color','#CECECE');
				$('#error_coupon_code').fadeOut();
				},1000)
			return false;
		}
		else if(coupon_discount.value=="")
		{
			$('#error_coupon_discount').show();
			$('#error_coupon_discount').fadeIn(3000);
			document.getElementById('error_coupon_discount').innerHTML='The coupon price field is required.';
			coupon_discount.focus();
			setTimeout(function(){
				$('#coupon_discount').css('border-color','#CECECE');
				$('#error_coupon_discount').fadeOut();
				},1000)
			return false;
		}
		else if(isNaN(coupon_discount.value))
		{
			$('#error_coupon_discount').show();
			$('#error_coupon_discount').fadeIn(3000);
			document.getElementById('error_coupon_discount').innerHTML='The coupon price field is numeric.';
			coupon_discount.focus();
			setTimeout(function(){
				$('#coupon_discount').css('border-color','#CECECE');
				$('#error_coupon_discount').fadeOut();
				},1000)
			return false;
		}
		else if(cate_id.value=="")
		{
			$('#error_cate_id').show();
			$('#error_cate_id').fadeIn(3000);
			document.getElementById('error_cate_id').innerHTML='The category field is required.';
			cate_id.focus();
			setTimeout(function(){
				$('#cate_id').css('border-color','#CECECE');
				$('#error_cate_id').fadeOut();
				},1000)
			return false;
		}
		else if(brand_id.value=="")
		{
			$('#error_brand_id').show();
			$('#error_brand_id').fadeIn(3000);
			document.getElementById('error_brand_id').innerHTML='The brand field is required.';
			brand_id.focus();
			setTimeout(function(){
				$('#brand_id').css('border-color','#CECECE');
				$('#error_brand_id').fadeOut();
				},1000)
			return false;
		}
		else if(exp_date.value=="")
		{
			$('#error_exp_date').show();
			$('#error_exp_date').fadeIn(3000);
			document.getElementById('error_exp_date').innerHTML='The date field is required.';
			exp_date.focus();
			setTimeout(function(){
				$('#exp_date').css('border-color','#CECECE');
				$('#error_exp_date').fadeOut();
				},1000)
			return false;
		}
	});
//validation for Submit Coupon End
//validation for Edit Upgrate User Start (Yogesh)
$('#btn_upgrade').click(function(){
		var business_name = document.getElementById('business_name');
		var business_type = document.getElementById('business_type');
		var business_desc = document.getElementById('business_desc');
		var contact_no = document.getElementById('contact_no');
		
		if(business_name.value=="")
		{
			$('#error_business_name').show();
			$('#error_business_name').fadeIn(2000);
			document.getElementById('error_business_name').innerHTML='The Business Name field is required.';
			business_name.focus();
			setTimeout(function(){
				$('#business_name').css('border-color','#CECECE');
				$('#error_business_name').fadeOut();
				},1000)
			return false;
		}
		else if(business_type.value=="")
		{
			$('#error_business_type').show();
			$('#error_business_type').fadeIn(2000);
			document.getElementById('error_business_type').innerHTML='The Business Type field is required.';
			business_type.focus();
			setTimeout(function(){
				$('#business_type').css('border-color','#CECECE');
				$('#error_business_type').fadeOut();
				},1000)
			return false;
		}
		else if(business_desc.value=="")
		{
			$('#error_business_desc').show();
			$('#error_business_desc').fadeIn(2000);
			document.getElementById('error_business_desc').innerHTML='The Business Description field is required.';
			business_desc.focus();
			setTimeout(function(){
				$('#business_desc').css('border-color','#CECECE');
				$('#error_business_desc').fadeOut();
				},1000)
			return false;
		}
		else if(contact_no.value=="")
		{
			$('#error_contact_no').show();
			$('#error_contact_no').fadeIn(2000);
			document.getElementById('error_contact_no').innerHTML='The Contact number field is required.';
			contact_no.focus();
			setTimeout(function(){
				$('#contact_no').css('border-color','#CECECE');
				$('#error_contact_no').fadeOut();
				},1000)
			return false;
		}
		else if(isNaN(contact_no.value))
		{
			$('#error_contact_no').show();
			$('#error_contact_no').fadeIn(2000);
			document.getElementById('error_contact_no').innerHTML='The Contact number field is numeric.';
			contact_no.focus();
			setTimeout(function(){
				$('#contact_no').css('border-color','#CECECE');
				$('#error_contact_no').fadeOut();
				},1000)
			return false;
		}
	});
//validation for Edit Upgrate User End
});
//Image Validation  Start(yogesh)
function check_Files(fileName,eleId,button_name)
{     
		var ext_a = fileName.substring(fileName.lastIndexOf('.') + 1);
		if(ext_a == "jpg" || ext_a == "jpeg" || ext_a == "gif" || ext_a == "png" || ext_a == "GIF" || ext_a == "JPG" || ext_a == "JPEG" || ext_a == "PNG")
		{
			document.getElementById(button_name).disabled=false;
			return true;
		}
		else 
		{
		alert("Invalid File Format.");
		document.getElementById(button_name).disabled=true;
		document.getElementById(eleId).focus();
		document.getElementById(eleId).value="";
		return false;
		}}		
//Image Validation  Start(yogesh)
//Delete ConformationValidation Start 
function deletconfirm()
{
	if(confirm('Are you sure to delete this record ?'))
	{
		return true;
	}
	else
	{
		return false;
	}}	
//Delete ConformationValidation  End
<!--Newsletter  start (Yogesh)-->
function subscribe_newsletter()
{	
	var email_id=document.getElementById('email_id');
	var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
	if(email_id.value=="")
	{
		$('#error_v').show();
			$('#error_email_id').fadeIn(3000);
			document.getElementById('error_email_id').innerHTML='Email Id is required.';
			email_id.focus();
			setTimeout(function(){
				$('#email_id').css('border-color','#CECECE');
				$('#error_email_id').fadeOut();
				},1000)
			return false;
	}
	else if(!filter.test(email_id.value))
	{	
		$('#error_email_id').show();
			$('#error_email_id').fadeIn(3000);
			document.getElementById('error_email_id').innerHTML='Enter Valide Email Id.';
			email_id.focus();
			setTimeout(function(){
				$('#email_id').css('border-color','#CECECE');
				$('#error_email_id').fadeOut();
				},1000)
			return false;
	}
	else
	{
	document.getElementById("subscribe_news").disabled=true;
	datastring='chk_email='+email_id.value;
	$.ajax({
				type: 'POST',
			 	dataType: "text",
			 	cache: false,
			 	data:datastring,
             	url:site_url+'newletter',
				success: function(data)
				{
					if(data=="INSERT")
					{
						$("#newsletteradd").show();
						setTimeout(function(){
						$('#newsletteradd').fadeOut();
						document.getElementById('email_id').value='';
						$("#newsletteradd").none();
						},2000)
					}
					if(data=="ALREADY")
					{
						$('#error_v').show();
						$('#error_email_id').fadeIn(1500);
						document.getElementById('error_email_id').innerHTML='You already subscribed for our newsletter.';
						email_id.focus();
						setTimeout(function(){
						$('#email_id').css('border-color','#CECECE');
						$('#error_email_id').fadeOut();
						document.getElementById('email_id').value='';
						},4000)
					}
					document.getElementById("subscribe_news").disabled=false;
				},
			});
	return false;		
	}}
<!--Newsletter close-->