<?php 

	$todaytime =date("0000-00-00 H:i:s");  

	/*Off Line Functinality Start*/

	if($this->uri->segment(2)!='offline')

	{

		$siteon=$this->master_model->getRecordCount('tbl_site_status',array('site_id'=>'1','site_status'=>'1'));

		if($siteon==0)

		{redirect(base_url().'home/offline/');}

	}

	/*Off Line Functinality End*/

	/*Visitor Count Functinality Start*/

	$data=$this->session->all_userdata();

	$date1=date('Y-m-d');

	$where=array(

	 'ipaddress' => $data['ip_address'],

	 'visit_date' => $date1

	);

	$query = $this->db->query("SELECT * FROM tbl_visitor_master WHERE DATE(visit_date) = '".$date1."' AND ipaddress= '".$data['ip_address']."'");

	if($query->num_rows()==0)

	{

	  $date=date('Y-m-d H:i:s');

	  $vistitor = array(

						'ipaddress' => $data['ip_address'],

						 'count' => '1',

						  'visit_date' => $date

						);

	  $this->master_model->insertRecord('tbl_visitor_master',$vistitor);}

	 /*Visitor Count Functinality End*/



	$className = $this->router->fetch_class();

	$methodName = $this->router->fetch_method();

	$testParam = $className.'|'.$methodName;



//echo $this->router->fetch_class().'|'.$this->router->fetch_method();

//require_once APPPATH.'libraries/facebook/facebook.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

if($testParam == 'share|details')

{echo '<title>'.$page_title.'</title>';

echo '<link href="'.$imageUrl.'" rel="apple-touch-icon" />';

echo '<meta name="description" itemprop="description" content="'.$metaDescription.'" />';

}

else

{echo '<title>Coupon | '.$page_title.'</title>';}

?>



<link href="<?php echo base_url(); ?>css/coupon.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>popup/css/popup.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>css/jquery.fancybox.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>css/jQuery_Pagination.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>css/global_search.css" rel="stylesheet" type="text/css" />

<!--top-slider-->

<script>var site_url='<?php echo base_url(); ?>';var my_time=1100;</script>

<script src="<?php echo base_url(); ?>js/jquery.min.js" type="text/javascript"></script>
<!--<script src="<?php echo base_url(); ?>js/front/jquery-slider.js" type="text/javascript"></script>-->

<script type="text/javascript" src="<?php echo base_url(); ?>js/front/sliderman.1.3.6.js"></script>

<script src="<?php echo base_url(); ?>js/jquery.countdown.min.js" type="text/javascript"></script>

<!--top-slider-->
<script type="text/javascript"  src="<?php echo base_url(); ?>js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.core.js"></script>
<script type="text/javascript"  src="<?php echo base_url(); ?>js/jquery.ui.rcarousel.js"></script>
<script type="text/javascript">
	jQuery(function( $ ) {
		$( "#carousel" ).rcarousel({
			auto: {
				enabled: true,
				interval: 3000,
				direction: "next"
			}
		});
		
		$( "#ui-carousel-next" )
			.add( "#ui-carousel-prev" )
			.hover(
				function() {
					$( this ).css( "opacity", 0.7 );
				},
				function() {
					$( this ).css( "opacity", 1.0 );
				}
			);				
	});
</script>

<!--client-slider-->

<script src="<?php echo base_url(); ?>js/front-validation.js" type="text/javascript"></script>



<script type="text/javascript" src="<?php echo base_url(); ?>popup/js/jquery.popupoverlay.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fancybox.js"></script>

<script src="<?php echo base_url(); ?>js/jquery.blockUI.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>js/jquery-ui-1.8.2.custom.min.js" type="text/javascript"></script>

<script language="javascript">

$(document).ready(function(event){

	

$("#txtSearch").autocomplete({

source: "<?php echo base_url(); ?>home/global_search/?action=search",

minLength: 1,

select: function(event, ui) {

var getUrl = ui.item.id;

if(getUrl != '#') {

location.href = getUrl;

}

},



html: true, 



open: function(event, ui) {

$(".ui-autocomplete").css("z-index", 1000);

}

});



	

$('.fancybox').fancybox({'centerOnScroll':true});

$('#fade').popup({

      transition: 'all 0.3s',

      autozindex: true

    }); 

<?php

$fb_postid = $this->uri->segment(2);

if($this->session->userdata('isShared')=='yes' && $this->session->userdata('isPostId')==$fb_postid)

{echo '$( "#openCoupon" ).trigger( "click" );';}



?>



$('.more_button').live("click",function() 

{

var getId = $(this).attr("id");

if(getId)

{

$("#load_more_"+getId).html('<img src="<?php echo base_url().'images/myloader_20x20.gif'; ?>" style="padding:10px 0 0 100px;"/>');  

$.ajax({

type: "POST",

url: "<?php echo base_url().'seller/more_content/'; ?>",

data: "getLastContentId="+ getId, 

cache: false,

success: function(html){

$("#load_more_ctnt").append(html);

$("#load_more_"+getId).remove();

}

});

}

else

{

$(".more_tab").html('The End');

}

return false;

});





 });

</script>

<!--client-slider-->

<!--fancy-scroll-->

<script src="<?php echo base_url(); ?>js/jquery.slimscroll.js" type="text/javascript"></script>

<script type="text/javascript">

    $(function(){

      $('.testDiv').slimScroll({

          height: '300px'

      });



    });

</script>

<?php 
if($testParam=='seller|submit' || $testParam=='submit|index'){ ?>
<!--fancy-scroll-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>popup/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>datepicker/css/zebra_datepicker.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>datepicker/javascript/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.wallform.js"></script>
<?php } ?>
</head>
<body>
<!--wrapper-start-->
<div class="wrapper">
<!--header-start-->

<div class="header"> 

  <!--top-logo-->

  <div class="logo-area">

    <div class="header-inner">

      <div class="logo-left"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/coupon-logo.jpg" width="153" height="66" alt="coupon-logo" /></a></div>

      <div class="logo-right">

      <form onsubmit="return false;" name="frmSearch" action="">

        <div class="left-search">

        

          <input class="select-search" value="Search for your favourite brand" onfocus="if(this.value === 'Search for your favourite brand') this.value = '';" onblur="if(this.value === '') this.value = 'Search for your favourite brand';"  name="txtSearch" id="txtSearch" type="text" />

        </div>

        </form>

        <!--<div class="left-search-btn">

          <button class="btn-search"><i class="fa fa-search"></i></button>

        </div>-->

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

  		 	 <li style="width:141px; text-align:center; color:#FFF; padding:0px !important;">

   			 <a href="javascript:void(0);"  style=" background-color:#00496f; height:40px; font-size:14px; font-family:'Open Sans',sans-serif; line-height:40px; padding:0px 15px 0px 15px; "> All Categories <i class="fa fa-chevron-down"></i></a>

  	 		 <ul class="sub-menu">

			  <?php 

                 $this->db->order_by('tbl_category_master.category_name','ASC');

                 $category=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1')); 

                 if(count($category)>0)

                 {

                    foreach($category as $rowcat)

                    {	 

              ?>

                    <li><a href="<?php echo base_url().'category/'.$rowcat['category_slug'].'/';?>"><?php echo ucfirst($rowcat['category_name']); ?></a></li>

           <?php    } 

                 }

                 else

                 { ?>

                    <li><a href="#">No data found.</a></li>

           <?php } ?>

   	</ul>

   			 </ul>

        </div>

        <div id="menu">

          <ul>

         <?php 

		 $this->db->order_by('tbl_category_master.category_name','ASC');

	     $limicategory=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1','category_menu'=>'1')); 

	     if(count($limicategory)>0)

		 {

		    foreach($limicategory as $rowcat)

		    {

		   ?>	

             <li><a href="<?php echo base_url().'category/'.$rowcat['category_slug'].'/';?>"><?php echo ucfirst($rowcat['category_name']); ?></a></li>

           <?php

			}

		 }	

		 if($this->session->userdata('email_id')=='' && $this->session->userdata('login_id')=='')

		 { 

		 ?>

	      <!--<li><a href="<?php //echo base_url('login');?>">Log in</a></li>-->  

          <li><a href="javascript:void(0);" id="facebook">Log in</a></li>

         <?php 

		} 

		?>

          </ul>

        </div>

        <div class=" menu-topoffers"><a href="<?php echo base_url('home/top_offer');?>">Top Offers</a></div>

        <?php 

		if($this->session->userdata('email_id')!='' && $this->session->userdata('login_id')!='')

		{ 

		 if($this->session->userdata('user_type')=='seller')

		 {

			  $this->db->select('tbl_seller_details.addcoupon');

			  $coupon_count=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$this->session->userdata('login_id')));	 

			  $coupon_master_count=$this->master_model->getRecordCount('tbl_coupon_master',array('login_id'=>$this->session->userdata('login_id')));		 

			  $remaincount=$coupon_count[0]['addcoupon']-$coupon_master_count;

			  if($remaincount>0)

			  {$remain_cnt=$remaincount;}

			  else{$remain_cnt='0';}

			  

			  $this->db->select('tbl_seller_details.brandaccess');

			  $coupon_count_brand=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$this->session->userdata('login_id')));	 

			  $coupon_master_brandcount=$this->master_model->getRecordCount('tbl_brand_master',array('login_id'=>$this->session->userdata('login_id')));		 

			  $remainbrandcount=$coupon_count_brand[0]['brandaccess']-$coupon_master_brandcount;

			  if($remainbrandcount>0)

			  {$remain_brndcnt=$remainbrandcount;}

			  else{$remain_brndcnt='0';}

			  

		?>

        <div class="single-category">

        	<div class="language">

            <ul class="menu-user">

              <li><a href="javascript:void(0);" class="user-arrow"  style=" padding:0px 6px;"><?php echo $this->session->userdata('user_slug'); ?> <i class="fa fa-chevron-down"></i></a>

                <ul>

                   <li><a href="<?php echo base_url(); ?>seller/profile/">Profile</a></li>

                   <li><a href="<?php echo base_url(); ?>seller/submit/">Submit A Coupon (<?php echo $remain_cnt;?>)</a></li>

                   <li><a href="<?php echo base_url();?>seller/sellerbrand/">Brand (<?php echo $remain_brndcnt;?>)</a></li>

                   <li><a href="<?php echo base_url();?>seller/accountpreferences/">Account Preferences</a></li>

                   <li><a href="<?php echo base_url().'member/'.$this->session->userdata('user_slug');?>/">My Profile</a></li>

                   <li><a href="<?php echo base_url();?>product/myproduct/">My Product</a></li>

                   <li><a href="<?php echo base_url(); ?>community/">Community</a></li>

                   <li><a href="<?php echo base_url().'home/signout/' ?>">Sign Out</a></li>

                </ul>

              </li>

            </ul>

            <!-- end .menu --> 

          </div>

        </div>

        <?php  }

		 else

		 {

		  ?>

          <div class="single-category">

                <div class="language">

                <ul class="menu-user">

                  <li>

                    <a href="javascript:void(0);" class="user-arrow" style=" padding:0px 6px;"><?php echo $this->session->userdata('user_slug'); ?><i class="fa fa-chevron-down"></i></a>

                    <ul>

                       <li><a href="<?php echo base_url(); ?>user/profile/">Profile</a></li>

                       <li><a href="<?php echo base_url(); ?>user/accountpreferences">Account Preferences</a></li>

                       <li><a href="<?php echo base_url();?>product/myproduct/">My Product</a></li>

                       <li><a href="<?php echo base_url(); ?>user/upgrade/">Upgrade to seller</a></li>

                       <li><a href="<?php echo base_url(); ?>community/">Community</a></li>

                       <li><a href="<?php echo base_url().'home/signout/' ?>">Sign Out</a></li>

                    </ul>

                  </li>

                </ul>

                <!-- end .menu --> 

              </div>

             </div>

          <?php }

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

 <?php if($testParam=="home|index" || $testParam=="home|page" || $testParam=="home|faq" || $testParam=="home|alldeal"){ ?>

  <!--top-slider-->

  <div class="slider-inner">

    <div id="slider_container_1">

      <div id="SliderName">

      <?php 

      $fetch_banner=$this->master_model->getRecords('tbl_banner_master');

       foreach($fetch_banner as $banner)

	   { ?>

	    <a href="<?php echo $banner['link'];?>"><img src="<?php echo base_url().'uploads/banners/'.$banner['banner_image']; ?>" width="1170" height="354" alt="slide" /></a>

 <?php } ?>

       </div>

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

