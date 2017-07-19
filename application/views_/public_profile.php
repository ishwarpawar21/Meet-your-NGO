<?php 
 $_class 	=	 $this->router->fetch_class();
 $_method	=	 $this->router->fetch_method();
 $_combine	=	$_class.'|'.$_method;
 ?><div class="contain"> 
  <!--inner-->
  <div class="innar-page"> 
    <!--profile-inner-->
    <div class="profile-top">
      <div class="profile-bag"> 
        <!--profile-left-->
        <?php  
		    if($seldetail[0]['user_type'] == 'seller')
				 {
						 if(isset($seldetail[0]['profilepic']) && $seldetail[0]['profilepic']!='')
						 {  
						 	$imagePath = 'uploads/profile_image/thumb/'.$seldetail[0]['profilepic'];  
							if(!file_exists($imagePath ))
							{$imagePath = 'images/profile-img.jpg';}
						 }
						 else
						 {$imagePath = 'images/profile-img.jpg'; }
				 }
				 else
				 {
						 if(isset($seldetail[0]['profile_picture']) && $seldetail[0]['profile_picture']!='')
						 {  
						 		$imagePath = 'uploads/profile_image/thumb/'.$seldetail[0]['profile_picture'];  
								if(!file_exists($imagePath ))
								{$imagePath = 'images/profile-img.jpg';}
						 }
						 else
						 {$imagePath = 'images/profile-img.jpg'; }
				 }
 
            echo '<div class="profile-images"><img src="'.base_url().$imagePath.'" width="155" height="158" alt="profile-img" /></div>';
               ?>
        <!--profile-left--> 
        <!--profile-left-->
        <div class="profile-right">
          <div class="profile-title">
            <?php  if(isset($seldetail[0]['user_slug'])){ echo $seldetail[0]['user_slug'];} ?>
          </div>
          <div class="profile-desk">
            <?php  if(isset($seldetail[0]['user_slug'])){ echo $seldetail[0]['user_slug'];}?>
            joined the community 
            <?php 
			$reg_date=$this->master_model->getRecords('tbl_login_master',array('user_slug'=>$seldetail[0]['user_slug']),'registraion_date');
			if(count($reg_date>0))
			{
			$like_time=strtotime($reg_date[0]['registraion_date']);
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
			if($diff>=3600)
			{
				echo ' ago';
			}?> </div> 
            <?php if($this->session->userdata('email_id')!='' && $this->session->userdata('login_id')!='')
			{?>
            <div class="profile-menu">
      <a href="<?php echo base_url().$this->session->userdata('user_type').'/profile/';?>">
      <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/profile-icon.png" width="16" height="17" alt="profile-icon" /></div>
      <div class="profile-menu-out">My Profile</div>
      </a>
      <div class="clr"></div>
      <?php if($_method=='profile' || $_method=='edit'){?> <div class="profile-menu-act"></div><?php } ?>
    </div>
            <div class="profile-menu"><a href="<?php echo base_url().$this->session->userdata('user_type').'/favourite_coupon/';?>">
              <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/fevorite.png" width="20" height="17" alt="fevorite" /></div>
              <div class="profile-menu-out">Favorite Coupon</div>
              </a>
              <div class="clr"></div>
             <?php if($_method=='favourite_coupon'){?> <div class="profile-menu-act"></div><?php } ?>
            </div>
            <div class="profile-menu"><a href="<?php echo base_url().$this->session->userdata('user_type').'/accountpreferences/';?>">
              <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/message.png" width="14" height="17" alt="message" /></div>
              <div class="profile-menu-out">Account Preferences</div>
              </a>
              <div class="clr"></div>
              <?php if($_method=='accountpreferences'){?> <div class="profile-menu-act"></div><?php } ?>
            </div>
            <div class="profile-menu"><a href="<?php echo base_url().'community/';?>">
              <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/comunity.png" width="24" height="17" alt="comunity" /></div>
              <div class="profile-menu-out">Community</div>
              </a>
              <div class="clr"></div>
              <?php  if($_class.'|'.$_method=='community|index' || $_class.'|'.$_method=='community|faq'){?><div class="profile-menu-act"></div><?php } ?>
            </div>
            <div class="profile-menu" style="border:none;"><a href="<?php echo base_url().'product/';?>">
              <div class="profile-menu-in"><i class="fa fa-briefcase"></i></div>
              <div class="profile-menu-out">Product</div>
              </a>
              <div class="clr"></div>
              <?php if($_class.'|'.$_method=='product|index' || $_class.'|'.$_method=='product|myproduct'){?> <div class="profile-menu-act"></div><?php } ?>
            </div>
          <?php  }}
		  else {redirect(base_url());}?>
          <div class="clr"></div>
        </div>
        <!--profile-left-->
        <div class="clr"></div>
      </div>
    </div>
    <div class="my-profile-outer"> 
      <!--profile-left-->
      <div class="my-profile-left">
      <div class="active-inner">
          <div class="new-heading-new">
            <div class="new-heading-new1">
              <div class="com-list-btn" style=" background:none; padding-bottom:11px;">
              <?php  if($seldetail[0]['user_type'] == 'seller'){?>
                <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/submitted_coupon/';?>" <?php echo $myClass_a; ?> >Submitted Coupon </a></div>
                <div class="com-list-all">|</div>
                <?php } ?>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/shared_coupon/';?>" <?php echo $myClass_b; ?>>Shared Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/liked_coupon/';?>" <?php echo $myClass_c; ?>>Liked Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/commented_coupon/';?>" <?php echo $myClass_d; ?>>Commented Coupon </a></div>
                <div class="clr"></div>
              </div>
            </div>
          </div>
        </div>
      
        <div class="active-inner">
          <div class="submit-heading">
            <div class="latest-sub-title">
              <?php echo $subTitle.' ';if(isset($seldetail[0]['user_slug'])){ echo $seldetail[0]['user_slug'];}?>
              <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow-arb.png" width="20" height="21" alt="arow" /></span></div>
          </div>
        </div>
        <?php   
		if(count($fetchRecords)>0)
		{  
		foreach ($fetchRecords as $allcoupon)  {?>
        <div class="latecom-outer" id="delcoupon_<?php echo $allcoupon['coupon_id'];?>">
          	<div class="latecom-left"> <img src="<?php echo $allcoupon['coupon_image'];?>" width="133" height="133" alt="logo" /> </div>
            <div class="latecom-right">
            	<div class="latecom-titme"><a href="#"><?php
					//echo $allcoupon['coupon_id'].'&nbsp;&nbsp;&nbsp;';
					if(strlen($allcoupon['coupon_title'])>300)
					{echo substr($allcoupon['coupon_title'],0,90)."...."; }
					else
					{echo substr($allcoupon['coupon_title'],0,90); }
					?>
				 </a></div>
            	<div class="chatproduct-desk"><?php echo $allcoupon['coupon_desc'];?></div>
                <div class="chatproduct-desk"><?php echo $allcoupon['product_manufacturer'];?></div>
                <div class="comment-box">
                <div class="latecom-box-inner">
                  <img src="<?php echo base_url();?>images/clock.png" width="18" height="18" alt="icon" style=" margin-top:4px;"/>
                </div>
                <div class="latecom-box-inner showTimer_<?php echo $allcoupon['coupon_id'] ?>" id="showTimer_<?php echo $allcoupon['coupon_id'] ?>">
                <i class="fa fa-time"></i>
                  <script type="text/javascript">
                    $(document).ready(function(){
                    var endDate = "<?php echo date('Y/m/d',strtotime($allcoupon['coupon_expirydate']));?>";
                    // var date = new Date(new Date().valueOf() + 15 * 24 * 60 * 60 * 1000);
                    //dateFormat is YYYY/MM/DD
                    $('.showTimer_<?php echo $allcoupon['coupon_id'] ?>').countdown(endDate, function(event) {
                    $(this).html(event.strftime('Expires in %D days'));
                    });
                    });
                    </script> 
                 </div>
                <?php 
				  $checkCoupon=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'fb_share','login_id'=>$this->session->userdata('login_id'),'coupon_id'=>$allcoupon['coupon_id']));
					  if(count($checkCoupon)>0 && $this->session->userdata('login_id')!='')
					  { 
						  if($this->session->userdata('user_slug')==$this->uri->segment('2'))
						  {?>
                           <div class="product-code-left">CODE :</div>
                       <div class="latecom-box-inner" style="margin-top:3px;">
						  <?php echo $allcoupon['coupon_code']; ?>
                          </div>
				<?php	  }
						}?>
                <div class="latecom-box-inner">
                   <img src="<?php echo base_url();?>images/comment.png" width="12" height="12" alt="comment-icon" style=" margin-top:7px;"/>
                </div>
                <div class="latecom-box-inner">
                <?php  echo $this->master_model->getRecordCount('tbl_coupon_comments',array('couponid'=>$allcoupon['coupon_id']));  ?>
              comments
                </div>
                <div class="latecom-box-inner">
                 <?php 
                 $coupon_like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('tbl_like_unlike_master.coup_id'=>$allcoupon['coupon_id'],'tbl_like_unlike_master.like_id'=>'1')); ?>
               Likes (<?php echo $coupon_like_count;?>) 
                </div>
                <div class="latecom-box-inner">
                 <?php 
                 $coupon_unlike_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('tbl_like_unlike_master.coup_id'=>$allcoupon['coupon_id'],'tbl_like_unlike_master.unlike_id'=>'1')); ?>
            Unlikes (<?php echo $coupon_unlike_count;?>)
                </div>
                <div class="clr"></div>
              </div>
              <div class="clr"></div>    
            </div>
            <div class="clr"></div>
            </div>
        <?php } 
		} else{?>
        <div class="active-inner"> 
          <!--first-->
          <div class="latest-coupontitle">No Coupon Available.</div>
          <!--first-->
          <div class="clr"></div>
        </div>
        <?php } ?>
        <div class="clr"></div>
      
        <?php echo $page_links; ?> </div>
      <!--profile-left--> 
      
      <!--profile-right-->
      <div class="my-profile-right">
        <?php include('right-panel.php'); ?>
      </div>
      <!--profile-right-->
      
      <div class="clr"></div>
    </div>
    <!--profile-inner-->
    
    <div class="clr"></div>
  </div>
  <!--inner--> 
</div>
