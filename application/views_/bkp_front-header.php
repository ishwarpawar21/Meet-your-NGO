<?php //require_once APPPATH.'libraries/facebook/facebook.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coupon | <?php echo $page_title; ?></title>
<link href="<?php echo base_url(); ?>css/coupon.css" rel="stylesheet" type="text/css" />
<!--top-slider-->
<script>var site_url='<?php echo base_url(); ?>';var my_time=1100;</script>
<script src="<?php echo base_url(); ?>js/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/front/sliderman.1.3.6.js"></script>
<!--top-slider-->
<!--client-slider-->
<script src="<?php echo base_url(); ?>js/front-validation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/front/jquery-slider.js" type="text/javascript"></script>

<script language="javascript" type="text/javascript">

$(document).ready(function(){
	$("#openMenu").mouseover(function(){
		//alert(1);
			$("#closeMenu").css('display','block');
	});
	$(".wrapper").mouseenter(function(){
			$("#closeMenu").css('display','none');
	});
	$("#openMenu").mouseenter(function(){
		//alert(1);
			$("#closeMenu").css('display','block');
	});
	$("#closeMenu").mouseleave(function(){
			$("#closeMenu").css('display','none');
	});
})
</script>
<script src="<?php echo base_url(); ?>js/jquery.countdown.js" type="text/javascript"></script>
<!--client-slider-->
</head>
<body>
 <?php
	$className = $this->router->fetch_class();
	$methodName = $this->router->fetch_method();
	$testParam = $className.'|'.$methodName;
 ?>
<!--wrapper-start-->
<div class="wrapper">
<!--header-start-->
<div class="header"> 
  <!--top-logo-->
  <div class="logo-area">
    <div class="header-inner">
      <div class="logo-left"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/coupon-logo.jpg" width="153" height="66" alt="coupon-logo" /></a></div>
      <div class="logo-right">
        <div class="left-search">
          <input class="select-search" value="Search for your favourite merchant, product or category" onfocus="if(this.value === 'Search for your favourite merchant, product or category') this.value = '';" onblur="if(this.value === '') this.value = 'Search for your favourite merchant, product or category';"  name="search" type="text" />
        </div>
        <div class="left-search-btn">
          <button class="btn-search"><i class="fa fa-search"></i></button>
        </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <!--top-logo--> 
  <!--top-menu-->
  <div class="header-inner">
    <div class="menu-bag">
        <div class="menu-home">
        <a href="<?php  echo base_url();?>">
        <img src="<?php echo base_url(); ?>images/home-icon.png" width="22" height="23" style=" margin-top:9px;" alt="home" />
        </a>
        </div>
        <div class="menu-category" >
            <ul id="menutop">
    <li style="width:141px; text-align:center; color:#FFF; padding:0px !important;"><a href="javascript:void(0);"  style=" background-color:#00496f; height:40px; font-size:14px; font-family:'Open Sans',sans-serif; line-height:40px; padding:0px 15px 0px 15px; "> All Categories <i class="fa fa-chevron-down"></i></a>
    <ul class="sub-menu">
            <li><a href="#">Adult</a></li>
            <li><a href="#">Books &amp; Stationary</a></li>
            <li><a href="#">Entertainment</a></li>
            <li><a href="#">Home Furnishing &amp; Decor</a></li>
            <li><a href="#">Recharge</a></li>
            <li><a href="#">Web Hosting &amp; Domains</a></li>
            <li><a href="#">Appliances</a></li>
            <li><a href="#">Camera &amp; Accessories</a></li>
            <li><a href="#">Fashion</a></li>
            <li><a href="#">Kids,Babies &amp; Toys</a></li>
            <li><a href="#">Sports &amp; Fitness</a></li>
            <li><a href="#">Education &amp Learning</a></li>
            <li><a href="#">Automotive</a></li>
            <li><a href="#">Computer, Laptops &amp; Gaming</a></li>
            <li><a href="#">Flowers, Gifts &amp; Jewellery</a></li>
            <li><a href="#">Miscellaneous</a></li>
            <li><a href="#">Travel</a></li>
            <li><a href="#">Automotive</a></li>
            <li><a href="#">Beauty &amp; Health</a></li>
            <li><a href="#">Education &amp; Learning</a></li>
            <li><a href="#">Food &amp; Dining</a></li>
            <li><a href="#">Mobile &amp; Tablets</a></li>
            <li><a href="#">TV, Audio/Video &amp; Movies</a></li>
            <li><a href="#">home furnishing &amp Decor</a></li>
      </ul>
    </li>
</ul>
        </div>
        <div id="menu">
          <ul>
            <li><a href="#">Mobiles &amp; Tablets</a></li>
            <li><a href="#">Fashion</a></li>
            <li><a href="#">Travel</a></li>
            <li><a href="#">Food &amp; Dining</a></li>
            <li><a href="#">Computers, Laptops &amp; Gaming</a></li>
            <?php 
			if($this->session->userdata('email_id')=='' && $this->session->userdata('login_id')=='')
			{ 
			?>
			<li><a href="<?php echo base_url('login');?>">Log in</a></li>
            <?php 
			} 
			?>
          </ul>
        </div>
        <div class=" menu-topoffers"><a href="#">Top Offers</a></div>
        <?php 
		if($this->session->userdata('email_id')!='' && $this->session->userdata('login_id')!='')
		{ 
		 if($this->session->userdata('user_type')=='seller')
		 {
		?>
        <div class="single-category">
        	<div class="language">
            <ul class="menu-user">
              <li><a href="" class="user-arrow"><?php echo $this->session->userdata('user_slug'); ?> <i class="fa fa-chevron-down"></i></a>
                <ul>
                   <li><a href="<?php echo base_url(); ?>seller/profile/">Profile</a></li>
                   <li><a href="<?php echo base_url(); ?>seller/submit/">Submit A Coupon</a></li>
                   <li><a href="#">Account Preferences</a></li>
                   <li><a href="#">Community</a></li>
                   <li><a href="<?php echo base_url().'home/signout/' ?>">Sign Out</a></li>
                </ul>
              </li>
            </ul>
            <!-- end .menu --> 
          </div>
        </div>
        <?php
		 }
		 else
		 {
		  ?>
          <div class="single-category">
                <div class="language">
                <ul class="menu-user">
                  <li>
                    <a href="" class="user-arrow"><?php echo $this->session->userdata('user_slug'); ?> <i class="fa fa-chevron-down"></i></a>
                    <ul>
                       <li><a href="<?php echo base_url(); ?>user/profile/">Profile</a></li>
                       <li><a href="#">Account Preferences</a></li>
                       <li><a href="#">Community</a></li>
                       <li><a href="<?php echo base_url().'home/signout/' ?>">Sign Out</a></li>
                    </ul>
                  </li>
                </ul>
                <!-- end .menu --> 
              </div>
             </div>
          <?	 
		 }
		} ?>
        <!--drop-menu-->
        <div class="drop-menu" style="display:none;" id="closeMenu">
        	<div class="drop-menu-outer">
            	<div id="dropmenu">
                	<ul>
                        <li><a href="#">Adult</a></li>
                        <li><a href="#">Books &amp; Stationary</a></li>
                        <li><a href="#">Entertainment</a></li>
                        <li><a href="#">Home Furnishing &amp; Decor</a></li>
                        <li><a href="#">Recharge</a></li>
                        <li><a href="#">Web Hosting &amp; Domains</a></li>
                        <li><a href="#">Appliances</a></li>
                        <li><a href="#">Camera &amp; Accessories</a></li>
                        <li><a href="#">Fashion</a></li>
                        <li><a href="#">Kids,Babies &amp; Toys</a></li>
                        <li><a href="#">Sports &amp; Fitness</a></li>
                        <li><a href="#">Education &amp Learning</a></li>
                        <li><a href="#">Automotive</a></li>
                        <li><a href="#">Computer, Laptops &amp; Gaming</a></li>
                        <li><a href="#">Flowers, Gifts &amp; Jewellery</a></li>
                        <li><a href="#">Miscellaneous</a></li>
                        <li><a href="#">Travel</a></li>
                        <li><a href="#">Automotive</a></li>
                        <li><a href="#">Beauty &amp; Health</a></li>
                        <li><a href="#">Education &amp; Learning</a></li>
                        <li><a href="#">Food &amp; Dining</a></li>
                        <li><a href="#">Mobile &amp; Tablets</a></li>
                        <li><a href="#">TV, Audio/Video &amp; Movies</a></li>
                        <li><a href="#">home furnishing &amp Decor</a></li>
                        <div class="clr"></div>
                    </ul>
                </div>
            <div class="clr"></div>    
            </div>
        </div>
        <!--drop-menu-->
        <div class="clr"></div>
      </div>
  </div>
  <!--top-menu--> 
 <?php if($testParam=="home|index" || $testParam=="home|page" || $testParam=="home|faq" ){ ?>
  <!--top-slider-->
  
  <div class="slider-inner">
    <div id="slider_container_1">
      <div id="SliderName">
      <?php 
      $fetch_banner=$this->master_model->getRecords('tbl_banner_master');
       foreach($fetch_banner as $banner)
	   { ?>
	   <a href="<?php echo $banner['link'];?>"><img src="<?php echo base_url().'uploads/banners/'.$banner['banner_image']; ?>" width="1170" height="354" alt="slide" /></a> <?php }?></div>
      <div id="SliderNameNavigation"></div>
      <script type="text/javascript">
                 // we created new effect and called it 'demo01'. We use this name later.
			     Sliderman.effect({name: 'demo02', cols: 10, rows: 5, delay:10, fade: true, order: 'straight_stairs'});

				var demoSlider = Sliderman.slider({container: 'SliderName', width:1170, height:354, effects: 'demo02',
				display: {
						pause: true, // slider pauses on mouseover
						autoplay:3000, // 3 seconds slideshow
						always_show_loading: 200, // testing loading mode
						description: {background: '#ffffff', opacity: 0.5, height: 50, position: 'bottom'}, // image description box settings
						loading: {background: '#000000', opacity: 0.2, image: '<?php echo base_url(); ?>images/loading.gif'}, // loading box settings
						buttons: {opacity: 1, prev: {className: 'SliderNamePrev', label: ''}, next: {className: 'SliderNameNext', label: ''}}, // Next/Prev buttons settings
						navigation: {container:'SliderNameNavigation', label: '&nbsp;'} // navigation (pages) settings
					}});
               </script> 
    </div>
  </div>
  <!--top-slider-->
  <?php } ?>
  <div class="clr"></div>
</div>
<!--header-end--> 