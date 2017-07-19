<?php
$total_1 = $total_2 = $total_2 = $totalPoints =0;
$total_1		= 		$this->master_model->getRecordSum('tbl_userscored_point',array('login_id'=>$this->session->userdata('login_id')),'share_point');
$total_2 		=	 	$this->master_model->getRecordSum('tbl_userscored_point',array('login_id'=>$this->session->userdata('login_id')),'like_point');
$total_3 		=		$this->master_model->getRecordSum('tbl_userscored_point',array('login_id'=>$this->session->userdata('login_id')),'comment_point');
//$total_4 		=		$this->master_model->getRecordSum('tbl_userscored_point',array('login_id'=>$this->session->userdata('login_id')),'community_point');
$pending_product=$this->master_model->getRecords('tbl_purchase_point',array('purchase_login_id'=>$this->session->userdata('login_id'),'status'=>'Pending'),'SUM(purchase_point) as point');
$approved_product=$this->master_model->getRecords('tbl_purchase_point',array('purchase_login_id'=>$this->session->userdata('login_id'),'status'=>'Approved'),'SUM(purchase_point) as point');
$cancel_product=$this->master_model->getRecords('tbl_purchase_point',array('purchase_login_id'=>$this->session->userdata('login_id'),'status'=>'Cancel'),'SUM(purchase_point) as point');

$subtract_point=$pending_product[0]['point']+$approved_product[0]['point'];
$totalPoints1 = $total_1+$total_2+$total_3;
$totalPoints =$totalPoints1-$subtract_point;
$total_1 = $total_1==''?0:$total_1;
$total_2 = $total_2==''?0:$total_2;
$total_3 = $total_3==''?0:$total_3;
$total=$total_1+$total_2+$total_3;

$pointsHtml = '<div class="active-inner">
  <div class="about-heading">
    <div class="about-inner-title">Stats <span class="title-arow"><img src="'.base_url().'images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
  </div>
</div>
<div class="active-inner"><div class="points">
    <div class="point-left">
      <div class="point-inner-text">'.$totalPoints.'<br/>
        points</div>
      <div class="point-what">
	  <a href="'.base_url('what-is-this').'" class="fancybox fancybox.ajax">
  		What is this?
   		</a> 
	  </div>
    </div>
    <div class="point-right">
      <div class="point-outer">
        <div class="point-inleft">Coupon shared:</div>
        <div class="point-inright">'.$total_1.'</div>
        <div class="clr"></div>
      </div>
      <div class="point-outer">
        <div class="point-inleft">Coupon Liked:</div>
        <div class="point-inright">'.$total_2.'</div>
        <div class="clr"></div>
      </div>
      <div class="point-outer">
        <div class="point-inleft">Coupons commented:</div>
        <div class="point-inright">'.$total_3.'</div>
        <div class="clr"></div>
      </div>
	  <div class="point-outer">
        <div class="point-inleft">Total Points:</div>
        <div class="point-inright">'.$total.'</div>
        <div class="clr"></div>
      </div>
	  <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div><div class="clr"></div>
</div>
';

$fbHTML = '<div class="active-inner">
  <div class="about-heading">
    <div class="about-inner-title">Find us on Facebook <span class="title-arow"><img src="'.base_url().'images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
  </div>
</div>
<div class="active-inner">
  <div class="points-menu">
<div class="fb_like" style="padding:4px;">
<script language="javascript">(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=294662060654393";fjs.parentNode.insertBefore(js, fjs);}(document, \'script\', \'facebook-jssdk\'));</script><div class="fb-like-box" data-href="https://www.facebook.com/webwingtechnologies/?fref=ts"  data-width="252" data-height="359" data-show-faces="true" data-stream="false" data-header="false"></div></div></div></div><div class="clr"></div>';


$categoryList = $appliedStyle = $categoryHTML ='';
if(isset($category))
if(count($category)>0)
{ 
	foreach($category as $rowcat)
	{
		$selectedStyle = $rowcat['category_slug']==$this->uri->segment(2)?'style="color:#f89938;"':'';
		$categoryList .= '<li> <a href="'.base_url().'category/'.$rowcat['category_slug'].'/'.'" '.$selectedStyle.' >'.ucfirst($rowcat['category_name']).'</a> </li>';
	}
} 
else 
{ 
$categoryList .= '<li> No data found.</li>';
} 
$appliedStyle = $this->uri->segment(2)==''?'style="color:#f89938;"':'';
$categoryHTML = '<div class="active-inner">
  <div class="about-heading">
    <div class="about-inner-title">Browse By Categories <span class="title-arow"><img src="'.base_url().'images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
  </div>
</div>
<div class="active-inner">
  <div class="points-menu">
    <div class="testDiv">
      <div id="pointsmenu">
        <ul>
			 <li><a href="'.base_url().'category/all/" '.$appliedStyle.'>All Categories</a></li>
          '.$categoryList.'
		</ul>
      </div>
    </div>
  </div>
</div>';

$className	 = $this->router->fetch_class();
$methodName = $this->router->fetch_method();
$_combine = $className.'|'.$methodName;
if($_combine == 'brand|allbrand')
{
?>
<form method="post" name="form_subscribe" id="form_subscribe">
  <div class="active-inner">
    <div class="right-message" style="display:none;" id="newsletteradd">Thank you for subscribing our newsletter.</div>
    <div class="news-inner">
      <div class="news-title">Subscribe to Newsletter</div>
      <div class="news-fild">
        <div class="news-left-fild">
          <input name="email_id" id="email_id" class="subscribe-search" placeholder="Enter your email" type="text" />
        </div>
        <div class="news-left-btn">
          <input name="subscribe_news" id="subscribe_news" class="subscribe-btn" value="Subscribe" type="submit" onClick="return subscribe_newsletter();"/>
        </div>
        <div class="clr"></div>
      </div>
      <div class="errr" style= " <?php if(form_error('email_id')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_email_id"></div>
    </div>
  </div>
</form>
<?php 
echo $pointsHtml; 
echo $categoryHTML;
echo $fbHTML;
?>
<!--End Of brand_coupon.php-->
<?php } 
if($_combine == 'seller|profile' || $_combine == 'brand|addbrand' || $_combine == 'community|member' || $_combine == 'seller|favourite_coupon' || $_combine == 'user|favourite_coupon' || $_combine == 'home|alldeal' || $_combine == 'seller|save_coupon' || $_combine == 'home|member' || $_combine == 'seller|sellerbrand' || $_combine == 'seller|updatebrand' || $_combine == 'seller|addbrand' || $_combine == 'user|profile') {
	 
echo $pointsHtml;
echo $categoryHTML;
echo $fbHTML;
?>
<!--End Of seller_profile.php-->
<?php }
if($_combine == 'product|index' || $_combine == 'product|myproduct') {	 
echo $pointsHtml;
//echo $categoryHTML;
echo $fbHTML;
?>
<!--<div class="active-inner">
  <div class="about-heading">
    <div class="about-inner-title">Find us on Facebook <span class="title-arow"><img src="<?php //echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
  </div>
</div>
<div class="active-inner">
  <div class="points-menu"><img src="<?php //echo base_url(); ?>images/facebook-share.jpg" width="252" height="359" alt="facebook-share" /></div>
</div>
<div class="clr"></div>-->
<!--End Of seller_profile.php-->
<?php }
if($_combine == 'community|index' || $_combine == 'community|page' || $_combine == 'community|faq'){ ?>
<div class="about-heading">
 <div class="about-inner-title">Who's Online? <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
</div>
<div class="online-outer">
  <?php
   $class=1;
	if(count($myPagination['onlineUsers'])>0)
	{
		 echo ' <div id="divID">';
		foreach($myPagination['onlineUsers']  as $_cM) 
		{
			$this->db->select('tbl_login_master.login_id,tbl_login_master.user_type');						
			$userinfo=$this->master_model->getRecords('tbl_login_master',array('user_slug'=>$_cM['user_slug']));
			if($userinfo[0]['user_type']=='seller')
			{
				//echo "**".$userinfo[0]['user_type'];
				$this->db->select('tbl_seller_details.profilepic,tbl_seller_details.seller_id,tbl_seller_details.loginid');						
				$userinfo=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$userinfo[0]['login_id']));
				if(count($userinfo)>0)
				{
				if($userinfo[0]['profilepic']=='')
				{$img='images/profile-img.jpg';}
				else{ $img='uploads/profile_image/thumb/'.$userinfo[0]['profilepic']; }
				}
				else
				{
					$img='images/profile-img.jpg';
				}
			}
			else
			{
				$this->db->select('tbl_user_master.profile_picture,tbl_user_master.user_id,tbl_user_master.login_id');						
				$userinfo=$this->master_model->getRecords('tbl_user_master',array('login_id'=>$userinfo[0]['login_id']));
				if(count($userinfo)>0)
				{
					if(isset($userinfo[0]['profile_picture']) && $userinfo[0]['profile_picture']!='')
					{$img='uploads/profile_image/thumb/'.$userinfo[0]['profile_picture'];}
					else
					{$img='images/profile-img.jpg';}
				}
				else
				{
					 $img='images/profile-img.jpg';
				}
			}
?>  
  <div  <?php if($class % 2){echo 'class="online-list"';}else{echo 'class="online-list-last"';}?>>
    <div class="online-list2"> <img src=" <?php echo base_url().$img; ?>" width="35" height="35" alt="img" /> </div>
    <div class="online-inner-right">
      <div class="online-list3"> <a href="<?php echo base_url();?>community/member/<?php echo $_cM['user_slug'];?>/"> <?php echo $_cM['user_slug'];?></a> </div>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
  <?php $class++;}
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
  
  <!--online-list-->
  <div class="clr"></div>
</div>
<div class="clr"></div>
<!--End Of member_community.php-->
<?php if($this->router->fetch_class()=='community')
{?>
<div class="about-heading">
              <div class="about-inner-title">Latest <span class="title-arow"><img src="<?php echo base_url();?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
            </div>
<div class="online-outer">
<?php 
$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_userscored_point.login_id');
$this->db->order_by('scored_date','DESC');
$login_id=$this->master_model->getRecords('tbl_userscored_point','','tbl_login_master.login_id,user_type,scored_id,coupon_id,point_type,scored_date,scored_id','','0','10');
$class=1;
if(count($login_id)>0)
{
	foreach($login_id as $log)
	{
			if($log['user_type']=='seller')
			{
				
				$details=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.loginid'=>$log['login_id']),'profilepic as profile_pic,firstname as first_name,lastname as last_name');
				$coupon_details=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_id'=>$log['coupon_id']),'coupon_title');
			}
			else
			{
				$details=$this->master_model->getRecords('tbl_user_master',array('tbl_user_master.login_id'=>$log['login_id']),'profile_picture as profile_pic,first_name,last_name');
				$coupon_details=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_id'=>$log['coupon_id']),'coupon_title');
			}
			if($details[0]['profile_pic']=='')
			{
				$img=base_url().'images/profile-img.jpg';
			}
			else
			{
				$img=base_url().'uploads/profile_image/thumb/'.$details[0]['profile_pic'];
			}
			if($log['point_type']=='fb_share')
			{
				$point_type='Share';
			}
			else if($log['point_type']=='comment')
			{
				$point_type=$log['point_type'].' on';
			}
			else
			{
				$point_type=$log['point_type'];
			}
		 	?>
		   <div  <?php if($class % 2){echo 'class="online-list"';}else{echo 'class="online-list-last"';}?>>
					<div class="online-list2"><img src="<?php echo $img;?>" width="35" height="35" alt="arow" /></div>
					<div class="online-inner-right">
						<div class="online-list3">
						<?php echo ucfirst($details[0]['first_name']).' '.ucfirst($details[0]['last_name']).' '.ucfirst($point_type).' '; if($log['point_type']!='community'){echo implode(' ', array_slice(explode(' ', $coupon_details[0]['coupon_title']), 0,2));}?></div>
                       <div class="online-list4"><span> 
					  <?php $like_time=strtotime($log['scored_date']);
							$curr_time=strtotime(date('Y-m-d H:i:s'));
							$diff=$curr_time - $like_time;
							if(intval( $diff / 86400 ) != '0')
							{
								if(intval( $diff / 86400 ) == '1')
								{
									echo sprintf("%02d day ", intval( $diff / 86400 ));
								}
								else
								{
									echo sprintf("%02d days ", intval( $diff / 86400 ));
								}
							}
							if(intval( ( $diff % 86400 ) / 3600) != '0')
							{
								if(intval( ( $diff % 86400 ) / 3600) == '1')
								{
									echo sprintf("%02d hour ", intval( ( $diff % 86400 ) / 3600));
								}
								else
								{
									echo sprintf("%02d hours ", intval( ( $diff % 86400 ) / 3600));
								}
							}
							if(intval( ( $diff / 60 ) % 60 ) != '0')
							{
								if(intval( ( $diff / 60 ) % 60 ) == '1')
								{
									echo sprintf("%02d min", intval( ( $diff / 60 ) % 60 ));
								}
								else
								{
									echo sprintf("%02d mins", intval( ( $diff / 60 ) % 60 ));
								}
							}
							if($diff>=60)
							{
								echo ' ago';
							}
							?> </span></div>
						<div class="clr"></div>
					</div>
					<div class="clr"></div>
				</div>
<?php
		$class++;	
	}
} ?>
</div>
<?php 
}
} 
if($_combine == 'home|index' || $_combine == 'home|showcode' || $_combine == 'home|top_offer' ){ ?>
<div class="deily-deal-inner">
  <div class="deily-deal-title">Daily DEALS
    <div class="clr"></div>
    <span>Spread the saving with Everyone!</span> </div>
</div>
<?php 
	   $chkcount=$this->master_model->getRecordCount('tbl_coupon_master',array('coupon_status'=>'1','deal'=>'deal'));
	   $this->db->limit(2);
	   $this->db->order_by("coupon_id", "random"); 
	   $fetch_deal=$this->master_model->getRecords('tbl_coupon_master',array('coupon_status'=>'1','deal'=>'deal'));
	   if(count($fetch_deal)>0)
	   {
		foreach($fetch_deal as $deal)
	   {?>
       
<!--main-deal-->
<div class="deal-roduct">
  <div class="deal-roduct-img">
  <a href="<?php echo  $deal['product_details_url']; ?>" target="_blank">
  <img src="<?php echo $deal['coupon_image']; ?>" alt="Deal" /> <!--width="215" height="129"--> 
  </a>
  </div>
  <div class="see-deal">
    <div class="btn-see-deal"> 
    <a href="<?php echo  $deal['product_details_url']; ?>" target="_blank">Click to see Deal</a> </div>
  </div>
  <div class="deal-roduct-title">
    <?php //echo $deal['product_price']; ?>
    <?php 
					if(strlen($deal['coupon_title'])>20)
					{echo substr($deal['coupon_title'],0,30).".."; }
					else
					{echo substr($deal['coupon_title'],0,30); }
					?>
  </div>
  <div class="deal-roduct-desk">
    <?php 
					if(strlen($deal['coupon_desc'])>10)
					{echo substr($deal['coupon_desc'],0,25).".."; }
					else
					{echo substr($deal['coupon_desc'],0,25); }
					?>
  </div>
  <div class="deal-roduct-price"> 
    <!--<div class="deal-roduct-price1">Rs. 12,990</div>-->
    <div class="deal-roduct-pricer"><?php echo $deal['product_price']; ?></div>
    <div class="clr"></div>
  </div>
  <div class="clr"></div>
</div>
<!--main-deal-->
<?php } 
		if($chkcount>2) {?>
<div class="see-deal active-inner">
  <div class="btn-see-deal"> <a href="<?php echo base_url('deal/');?>" title="More Deal">View More Deal</a> </div>
</div>
<?php 	}
		}
echo $categoryHTML;
echo $fbHTML;
?>
<!--End Of home.php-->
<?php } 
?>