<!DOCTYPE HTML>
<html>
<head>
<title>MeetYourNGO | <?=$page_title?> </title>
<link href="<?=base_url()?>../site_assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
<script type='text/javascript' src="<?=base_url()?>../site_assets/js/jquery-1.11.1.min.js"></script>
<link href="<?=base_url()?>../site_assets/css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href="<?=base_url()?>../site_assets/css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?=base_url()?>../site_assets/js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<link rel="stylesheet" href="<?=base_url()?>../site_assets/css/fwslider.css" media="all">
<script src="<?=base_url()?>../site_assets/js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>../site_assets/js/fwslider.js"></script>
<script src="<?=base_url()?>../site_assets/js/menu_jquery.js"></script>

<script src="<?=base_url()?>../site_assets/js/jquery.sumoselect.js"></script>
<link href="<?=base_url()?>../site_assets/css/sumoselect.css" rel="stylesheet" />
<!--end slider -->
</head>
<body>
<!-- header_top -->
<div class="top_bg">
<div class="container">
<div class="header_top">
	<div class="top_left">
		<h2><a> Call us at +91 95 95 1600 95 </a></h2>
	</div>
	<div class="top_right">
		<ul>
<?php
	if($this->session->userdata('username'))
	{
?>
		
		<?php
			if($this->session->userdata('account_type')=='org')	
			{
		?>
		    <li>Welcome <?php if($this->session->userdata('name')){ echo $this->session->userdata('name');}else{ echo $this->session->userdata('username');}?></li> |
			<li><a href="<?=base_url()?>organisation_acc/">My Account</a></li>
		<?php
			}
			else
			if($this->session->userdata('account_type')=='vol')	
			{
		?>
			 <li>Welcome <?=$this->session->userdata('username')?></li> |
			<li><a href="<?=base_url()?>volunteer_acc/">My Account</a></li>
		<?php
			}
		?>
<?php		
	}else{		
?>			
			<li><a href="<?=base_url()?>site/signup_org">Sign Up</a></li>|
			<li class="login" >
						<div id="loginContainer"><a href="#" id="loginButton"><span>Login</span></a>
						    <div id="loginBox">                
						        <form method="post" id="loginForm" action="<?=base_url()?>site/login">
						                <fieldset id="body">
						                	<fieldset>
						                          <label for="email">Account Type</label>
						                          	<input type="radio" name="account_type" style="width: 15px" value="for_org" required=""/><i style="color: #999;font-size:14px;">For Organisation</i>
						                          	<input type="radio" name="account_type" style="width: 15px" value="for_vol" required=""/><i style="color: #999;font-size:14px;">For Volunteer</i>
						                                                 
						                    </fieldset>
						                    
						                	<fieldset>
						                          <label for="email">Email Address</label>
						                          <input type="text" name="email" id="email" required="" placeholder="Email Address">
						                    </fieldset>
						                    <fieldset>
						                            <label for="password">Password</label>
						                            <input type="password" name="password" id="password" required="" placeholder="Password">
						                     </fieldset>
						                    <input type="submit" id="login" name="login" value="Sign in">
						                	 
						            	</fieldset>
						            <!--<span><a href="#">Forgot your password?</a></span>-->
							 </form>
				        </div>
			      </div>
			</li>
			
<?php
	}
?>			
			
		</ul>
	</div>
	<div class="clearfix"> </div>
</div>
</div>
</div>
<!-- header -->
<div class="header_bg">
<div class="container">
	<div class="header">
		<div class="logo">
			<a href="<?=base_url()?>site"><img src="<?=base_url()?>../site_assets/images/logo.png" alt="MeetYourNGO"/> </a>
			<?php 
             $result=$this->db->query("select * from home_page_table where id=1")->row();?>
			<p><?=$result->containt_data;?></p>
		</div>
		<!-- start header_right -->
		<div class="header_right">
		<!-- 
		<div class="search">
		    <form>
		    	<input type="text" value="" placeholder="search...">
				<input type="submit" value="">
			</form>
		</div> -->
		<div class="clearfix"> </div>
		</div>
		<!-- start header menu -->
		<ul class="megamenu skyblue">
			<li><a class="color1" href="<?=base_url()?>site">Home</a></li>
			<li><a class="color2" href="<?=base_url()?>site/volunteers">Volunteers</a></li>
			<li><a class="color3" href="<?=base_url()?>site/organisation">Non-Profit Organisation</a></li>
			<li><a class="color4" href="<?=base_url()?>site/about_us">About us</a></li>
			<li><a class="color5" href="<?=base_url()?>site/contact">Contact us</a></li>
		</ul> 
	</div>
</div>
</div>
<!-- content -->