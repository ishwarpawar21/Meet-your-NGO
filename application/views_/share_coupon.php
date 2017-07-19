<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Share Coupon</title>
<style type="text/css">
.fancybox-skin {
    background: none repeat scroll 0 0 #fff !important;
    border: 4px solid #fff;
    border-radius: 10px;
    color: #444;
    position: relative;
    text-shadow: none;
}
</style>
<script src="<?php echo base_url(); ?>js/front-validation.js" type="text/javascript"></script>
</head>
<body>
<!--main-box-->

<div class="product-outre">
  <div class="product-left"><a href="<?php echo  $productCoupon[0]['product_details_url']; ?>" target="_blank"><img src="<?php echo $productCoupon[0]['coupon_image']; ?>" width="147" height="149" alt="product" /></a></div>
  <div class="product-right">
    <div class="product-right-innet-left">
      <div class="product-titme"><a href="<?php echo $productCoupon[0]['product_details_url']; ?>" target="_blank"><?php echo $productCoupon[0]['coupon_title']; ?></a></div>
      <div class="product-desk"><?php echo substr($productCoupon[0]['coupon_desc'],0,150); ?></div>
      <div class="product-code"> 
        <?php if($this->session->userdata('login_id')==''){ 
        echo '<div class="product-code-left">
          <div class="code-btn-inner">
            <div class="btn-code"><a href="javascript:void(0);" id="_facebook" class="myFbShare" name="'.$productCoupon[0]['coupon_id'].'">share coupon on facebook to view the coupon code <span class="btn-code-arow"><img src="'.base_url().'images/btn-arow.png" width="22" height="22" alt="arow" /></span> </a> </div>
            <div class="clr"></div>
          </div>
        </div>';
   } else { 
   $set_per_day_limit=$this->master_model->getRecords('tbl_points_master',array('points_id'=>'1'));
   $per_day_share=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'fb_share','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(share_point) as share_point');
   $per_day_like=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'like','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(like_point) as like_point');
   $per_day_comment=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'comment','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(comment_point) as comment_point');
  $total=$per_day_share[0]['share_point']+$per_day_like[0]['like_point']+$per_day_comment[0]['comment_point'];
  $checkCoupon=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'fb_share','login_id'=>$this->session->userdata('login_id'),'coupon_id'=>$productCoupon[0]['coupon_id']));
	      if(count($checkCoupon)>0) { 
          echo '<div class="product-code">
             <div class="product-code-left">Coupon Code :</div>
             <div class="product-code-left">
              <div class="code-btn-inner">
                 <div class="latecom-code">'.$productCoupon[0]['coupon_code'].'</div>
              <div class="clr"></div>
            </div>
           </div>
       </div>';
     }else { 
       echo '<div class="product-code">
         <div class="product-code-left">
          <div class="code-btn-inner">';
		  if($total>=$set_per_day_limit[0]['per_day_point'])
		  {
			  echo ' <div class="btn-code">
            <a href="javascript:void(0);" class="per_day" >share coupon on facebook to view the coupon code<span class="btn-code-arow"><img src="'.base_url().'images/btn-arow.png" width="22" height="22" alt="arow" /></span> </a> 
            </div>';
		  }
		  else
		  {
           echo ' <div class="btn-code">
            <a href="javascript:void(0);" id="_facebook" class="myFbShare" name="'.$productCoupon[0]['coupon_id'].'">share coupon on facebook to view the coupon code<span class="btn-code-arow"><img src="'.base_url().'images/btn-arow.png" width="22" height="22" alt="arow" /></span> </a> 
            </div>';
		  }
            echo '
            <div class="clr"></div>
          </div>
        </div>
        <div class="clr"></div>
        </div>';
        }   } ?>
        
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>
    <div class="product-right-innet-top"> 
      <!--success-->
       <a href="<?php echo  $productCoupon[0]['product_details_url']; ?>" target="_blank">
      <div class="success-inner">
        <div class="success-title">
          <?php
			if($productCoupon[0]['product_reviews']!='')
			{ 
			  $review=explode(':-',$productCoupon[0]['product_reviews']);
			  $review_check=str_replace('(','',$review[0]);
			  $review_check1=str_replace(')','',$review_check);
			  $review_check2=str_replace('customer','',$review_check1);
		  ?>
                      <img src="<?php echo $review[1]; ?>"  alt="review" />
                      <div class="success-title"><?php echo  $review_check2; ?></div>
          <?php
						}
						else
						{ echo '<div class="success-title">0 reviews</div>'; }
						
                         $pos = strpos($productCoupon[0]['coupon_discount'],'%');
					    if($pos == false)
						{ $new_pos= '$'.number_format($productCoupon[0]['coupon_discount'],2).' Off'; }
						else
						{  $new_pos=$productCoupon[0]['coupon_discount'].' Off'; }
					 ?>
        </div>
        <div class="success-100pur"><?php echo $new_pos; ?> </div>
        <div class="clr"></div>
      </div>
      </a>
      <div class="product-code-left" style="margin-top:10px;">
          <div class="buy-btn-inner">
            <div class="btn-buy-now"><a href="<?php echo  $productCoupon[0]['product_details_url']; ?>" target="_blank">BUY NOW<span class="btn-code-arow"><img src="<?php echo base_url();?>images/btn-arow.png" width="22" height="22" alt="arow" /></span></a> </div>
            <div class="clr"></div>
          </div>
        </div>
      <!--success-->
      <div class="product-inner-price">
       <div class="clr"></div>
      </div>
    </div>
    <div class="clr"></div>
    <div class="comment-box">
      <div class="comment-box-inner"><img src="<?php echo base_url();?>images/clock.png" width="18" height="18" alt="icon" style=" margin-top:4px;"/></div>
      <div class="comment-box-inner showTimer_<?php echo $productCoupon[0]['coupon_id'] ?>" style="width:120px;"></div>
      <script type="text/javascript">
		$(document).ready(function(){
			var endDate = "<?php echo date('Y/m/d',strtotime($productCoupon[0]['coupon_expirydate']));?>";
		   $('.showTimer_<?php echo $productCoupon[0]['coupon_id']; ?>').countdown(endDate, function(event) {
			$(this).html(event.strftime('Expires in %D days'));
		  });
		});
		</script>
      <div class="comment-box-inner"><img src="<?php echo base_url();?>images/comment.png" width="12" height="12" alt="comment-icon" style=" margin-top:7px;"/></div>
      <div class="comment-box-inner _openBox" style="width:150px;text-decoration:underline;cursor:pointer;">
        <span id="_counter_<?php echo $productCoupon[0]['coupon_id']; ?>"><?php  echo $this->master_model->getRecordCount('tbl_coupon_comments',array('couponid'=>$productCoupon[0]['coupon_id']));   ?></span>
        add comments</div>
      <div class="comment-box-inner" style="width:150px;">brand- <a href="<?php echo base_url();?>brand/<?php echo $productCoupon[0]['brand_slug'];?>"><?php echo stripslashes(ucfirst($productCoupon[0]['brand_title']));?></a> </div>
      
        <div class="product-code-left">PRICE :</div>
        <div class="product-code-left" style="padding-right:0px;">
          <div class="product-dollar"><?php echo $productCoupon[0]['product_price']; ?></div>
        </div>
      
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div style="margin-top:5px;">
      <div style="display:none;" id="divLoader" class="new-heading">
        <div style="text-align:center;" class="new-heading-inner"> <img width="60" height="60" alt="myloader.gif" src="http://server-1/coupon/images/myloader.gif"> </div>
      </div>
      <div id="commentContainer" class="comment-box" style="display:none;">
        <form name="postComment" method="post" action="">
          <span style="font-weight:bold;">Add Comment</span>
          <textarea id="couponComment" name="couponComment" rows="2" cols="5" class="texarea-select" placeholder="Leave your comment..." style="padding:1%;height:55px;"></textarea>
          <input type="hidden" value="<?php echo $productCoupon[0]['coupon_id']; ?>" id="txtCouponid" name="txtCouponid" />
          <input type="hidden" value="<?php echo $this->session->userdata('login_id'); ?>" id="txtSenderid" name="txtSenderid" />
          <span style="font-style:italic;">Post as <?php echo $this->session->userdata('user_slug'); ?></span>
          <div style="margin-top:6px; padding-right:6px; float:right; width:300px;" class="about-fildset">
            <input type="button" name="btnCancel" id="btnCancel" class="submit-button" value="Cancel" style="float:right;height:34px; line-height:31px; padding:0px 10px;" />
            <input type="button" name="btnDoCmnt" id="_btnDoCmnt" class="submit-button" value="Post comment" style="float:right;margin-right:5px; height:34px; line-height:31px; padding:0px 10px;" />
            <div class="clr"></div>
          </div>
          <div class="clr"></div>
        </form>
      </div>
    </div>
  </div>
  <div class="clr"></div>
</div>
<!--main-box-->
<div class="product-outre"  >
  <fieldset style="border-color: #e5e5e5 !important; background-color: #fff; border-radius: 6px;">
    <legend>Showing 5 most recent comments</legend>
    <?php      
      if(count($myPagination['commentData']) > 0) {     
	    echo ' <div id="divID"><div id="dynamicCmnt">';
		foreach($myPagination['commentData'] as $val) { 
		
	if($val['user_type']=='seller')
	{
		$this->db->select('profilepic');
		$profileImg = $this->master_model->getRecords('tbl_seller_details',array('loginid'=>$val['login_id']));
		if(isset($profileImg[0]['profilepic']) && $profileImg[0]['profilepic']!='')
		 {  $imagePath = 'uploads/profile_image/thumb/'.$profileImg[0]['profilepic'];  }
		 else
		 {$imagePath = 'images/profile-img.jpg'; }
	}
	else
	{
		$this->db->select('profile_picture');
		$profileImg = $this->master_model->getRecords('tbl_user_master',array('login_id'=>$val['login_id']));
		if(isset($profileImg[0]['profile_picture']) && $profileImg[0]['profile_picture']!='')
		 {  $imagePath = 'uploads/profile_image/thumb/'.$profileImg[0]['profile_picture'];  }
		 else
		 {$imagePath = 'images/profile-img.jpg'; }
	}
		
		/* */
	   ?>
    <!--comments-->
    <div class="comments-box">
      <div class="comments-box-left"><img src="<?php echo base_url().$imagePath;?>" width="36" height="36" alt="user"/></div>
      <div class="comments-box-right">
        <div class="comments-arow"></div>
        <div class="comments-outer">
          <div class="comments-desk"><?php echo nl2br($val['comments']); ?></div>
          <div class="clr"></div>
          <div class="comments-posted"><span><i class="fa fa-clock-o" style="font-size:14px;"></i> Posted on :</span> <?php echo  date('d-m-Y',strtotime($val['posted_date']));?></div>
          <div class="comments-title" style="float:right;"><span>by :</span> <a href="<?php echo base_url().'community/member/'.$val['user_slug'].'/'; ?>"><?php echo  $val['user_slug']; ?></a></div>
        </div>
      </div>
      <div class="clr"></div>
    </div>
    <!--comments-->
    
    <div class="clr"></div>
    <?php 
			}
			echo '</div>';
			echo $myPagination['page_links'];
			echo '</div>';
	  }
	  else
	  {
			echo '  <div class="product-right" style="width:100%!important;float:none!important;">
					<div class="product-right-innet-left">
					  <div class="product-titme" style="color:#000;">No comment posted yet.</div>
					   <div class="product-code">
						<div class="clr"></div>
					  </div>
					  <div class="clr"></div>
					</div></div>';
	  }?>
  </fieldset>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.myFbShare').click(function(){
		var _id = $(this).attr('name');
		var now = new Date();
   		now.setMonth( now.getMonth() + 1 ); 
		document.cookie= "selectedCoupon="+_id+";"+now.toUTCString()+";path=/";
	})
	
	function bindClicks() {
        $("ul.tsc_pagination a").click(paginationClick);        
    }
    
    function paginationClick() {
        var href = $(this).attr('href');
        $("#rounded-corner").css("opacity","0.4");
        
    
        $.ajax({
            type: "GET",
            url: href,            
            data: {},
            success: function(response)
            {                
                //alert(response);
                $("#rounded-corner").css("opacity","1");
                $("#divID").html(response);
                bindClicks();
            }
        });
 
        return false;
    }
    
    bindClicks();


})
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
	 $('#_facebook').click(function(e) {
			  FB.login(function(response) {
			  if(response.authResponse) {
				parent.location ='<?php echo base_url(); ?>home/sharefacebook/';
			   //redirect uri after closing the facebook popup
			  }
	 		},{scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); 
			
		 });
 </script>
 </body>
 </html>