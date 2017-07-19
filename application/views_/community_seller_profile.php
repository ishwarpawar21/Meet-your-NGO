<div class="contain"> 
  <!--inner-->
  <div class="innar-page"> 
    <!--profile-inner-->
    <div class="profile-top">
      <?php include('profile-header.php'); ?>
    </div>
    <div class="my-profile-outer"> 
      <!--profile-left-->
      <div class="my-profile-left">
      <div class="active-inner">
          <div class="new-heading-new">
            <div class="new-heading-new1">
              <div class="com-list-btn" style=" background:none; padding-bottom:11px;">
              <?php if($seldetail[0]['user_type']=='seller') {?>
                <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/submitted_coupon/';?>" class="current">Submitted Coupon </a></div>
                <div class="com-list-all">|</div>
                <?php 
				$optionalClass	= '';
				} else  {$optionalClass = 'class="current"';}
				
				?>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/shared_coupon/';?>" <?php echo $optionalClass; ?>>Shared Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/liked_coupon/';?>" >Liked Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/commented_coupon/';?>">Commented Coupon </a></div>
                <div class="clr"></div>
              </div>
            </div>
          </div>
        </div>
        
        <?php if($this->session->userdata('login_id')!=$selMemdetail[0]['login_id']){?>
        <div class="active-inner">
          <div class="about-heading">
            <div class="latest-sub-title">Comments For <?php echo $this->uri->segment(3);?> <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
          </div>
        </div>
        <div class="active-inner" >
          <div class="new-heading" id="divLoader" style="display:none;">
            <div class="new-heading-inner" style="text-align:center;"> <img src="<?php echo base_url().'images/myloader.gif' ?>" height="60" width="60" alt="myloader.gif" /> </div>
          </div>
          <form name="postComment" action="" method="post" >
            <div class="new-heading" id="commentContainer">
              <div class="new-heading-inner">
                <textarea style="padding:1%;" placeholder="Leave a comment for <?php echo $this->uri->segment(3);?>..." class="texarea-select" cols="" rows="" name="userComment" id="userComment"></textarea>
                <input type="hidden" name="txtSenderid" id="txtSenderid" value="<?php echo $this->session->userdata('login_id'); ?>" />
                <input type="hidden" name="txtReceiverid" id="txtReceiverid" value="<?php echo $selMemdetail[0]['login_id'];  ?>" />
                <div class="clr"></div>
                <div class="about-fildset" style="margin-top:15px;"> <span style="font-style:italic;">Logged in as <?php echo $this->session->userdata('user_slug'); ?></span>
                  <input type="button" style="float:right;margin-right:10px;" value="Leave a Comment" class="submit-button" id="btnPostCmnt" name="btnPostCmnt" />
                  <div class="clr"></div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <?php } ?>
        
        
          <div class="active-inner">
          <div class="submit-heading">
            <div class="latest-sub-title"><?php echo  $subTitle.' '; if(isset($seldetail[0]['user_slug'])){ echo $seldetail[0]['user_slug'];}?> <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow-arb.png" width="20" height="21" alt="arow" /></span></div>
          </div>
        </div>
        <?php   
			if(count($fetchCoupon)>0)
			{	 
			foreach ($fetchCoupon as $allcoupon)
			{?>
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
						  if($this->session->userdata('user_slug')==$this->uri->segment('3'))
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
				}else{?>
        <div class="active-inner"> 
          <!--first-->
          <div class="latest-coupontitle">No Coupon Available.</div>
          <!--first-->
          <div class="clr"></div>
        </div>
        <?php } ?>
        <div class="clr"></div>
      
        
          <?php if(count($fetchCoupon)>5){?>
        <ul class="_tsc_pagination tsc_paginationA tsc_paginationA01">
        		<li class="current"><a href="<?php echo base_url(); ?>member/<?php echo $seldetail[0]['user_slug']; ?>/submitted_coupon/1">1</a></li>
                <li><a href="<?php echo base_url(); ?>member/<?php echo $seldetail[0]['user_slug']; ?>/submitted_coupon/2">2</a></li>
                <li><a href="<?php echo base_url(); ?>member/<?php echo $seldetail[0]['user_slug']; ?>/submitted_coupon/2">&gt;</a></li>
        </ul>
        <div class="clr"></div>
        <?php } ?>
        <div class="clr"></div>
        
      </div>
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
