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
          <div class="new-heading">
            <div class="new-heading-inner">
              <div class="new-heading-main-head-left">My Profile <span>(<a href="<?php echo base_url().'seller/edit/';?>">Edit profile</a>)</span> </div>
              <div class="clr"></div>
            </div>
          </div>
        </div>
        <div class="active-inner">
          <div class="new-heading-new">
            <div class="new-heading-new1">
              <div class="com-list-btn" style=" background:none; padding-bottom:11px;">
                <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$this->session->userdata('user_slug').'/submitted_coupon/';?>" class="current">Submitted Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$this->session->userdata('user_slug').'/shared_coupon/';?>">Shared Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$this->session->userdata('user_slug').'/liked_coupon/';?>" >Liked Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$this->session->userdata('user_slug').'/commented_coupon/';?>">Commented Coupon </a></div>
                <div class="clr"></div>
              </div>
            </div>
          </div>
        </div>
      
        <div class="active-inner">
          <div class="submit-heading">
            <div class="latest-sub-title">Coupon added by- <?php echo $this->session->userdata('user_slug');?> <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow-arb.png" width="20" height="21" alt="arow" /></span></div>
          </div>
        </div>
        <?php  if(count($fetchCoupon)>0)
				{  foreach ($fetchCoupon as $allcoupon)  {?>
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
                 <div class="latecom-box-inner">
                   <a href="javascript:void(0)"  id="delete_coupon" class="delete_coupon" name="delete_coupon" rel="delcoupon_<?php echo $allcoupon['coupon_id'];?>">Delete</a>
                 </div>
                 <div class="latecom-box-inner">
                   <a href="<?php echo base_url();?>seller/updatecoupon/<?php echo base64_encode($allcoupon['coupon_id']);?>">Edit</a>
                 </div>
                <div class="clr"></div>
              </div>
                
            <div class="clr"></div>    
            </div>
            <div class="clr"></div>
            </div>
        <?php } }else{?>
        <div class="active-inner"> 
          <!--first-->
          <div class="latest-coupontitle">No Coupon Available.</div>
          <!--first-->
          <div class="clr"></div>
        </div>
        <?php } ?>
        <div class="clr"></div>
       
       
        <?php echo $page_links; ?>
        <div class="clr"></div>
        
          <div class="active-inner">
          <div class="submit-heading">
            <div class="latest-sub-title">Comments For <?php echo $this->session->userdata('user_slug');?> <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow-arb.png" width="20" height="21" alt="arow" /></span></div>
          </div>
        </div>
        <div class="active-inner" >
          <div class="active-box" style="background:none !important;" >
          <?php
		    $getrecord=$this->master_model->getRecords('admin_login');
			$message=$this->master_model->getRecords('tbl_community_message');
		  ?>
          <div class="active-box-inner">
                <div class="comments-box">
                  <div class="comments-box-left"><img src="<?php  echo base_url(); ?>uploads/admin/<?php echo $getrecord[0]['admin_img'];?>" width="36" height="36" alt="user"/></div>
                  <div class="comments-box-right" style="width:755px !important;">
                    <div class="comments-arow"></div>
                    <div class="comments-outer">
                      <div class="comments-desk"  style="font-size:15px;font-weight:bold;color:#eb8f2e;">Welcome <?php echo $this->session->userdata('user_slug'); ?></div>
                      <div class="comments-desk"><?php echo nl2br($message[0]['message_desc']);?></div>
                      <div class="clr"></div>
                      <div class="comments-posted"></div>
                      <div class="comments-title" style="float:right;"><span>by- Admin</span></div>
                    </div>
                  </div>
                  <div class="clr"></div>
                </div>
              </div>
              <div class="clr"></div>
            <div id="load_more_ctnt"><!--style="overflow:scroll;overflow-y:auto;overflow-x:hidden;height:200px;"-->
              <?php 
			  if(count($dataComments)>0)
			  {
					foreach($dataComments as $userCmnt)
					{
						$id=$userCmnt['id'];
						  if($userCmnt['user_type']=='seller')
							  {
								   $getImage=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$userCmnt['login_id'])); 
								   $imageName = $getImage[0]['profilepic'];
								   $imagePath = 'uploads/profile_image/thumb/'.$imageName;
								   if(!file_exists($imagePath) || $imageName =='')
								   {$imagePath = 'images/profile-icon.png';}
							  }
							  else
							  {
								  $getImage=$this->master_model->getRecords('tbl_user_master',array('login_id'=>$userCmnt['login_id']));
								  $imageName = $getImage[0]['profile_picture'];
								  $imagePath = 'uploads/profile_image/thumb/'.$imageName;
								  if(!file_exists($imagePath) || $imageName =='')
								   {$imagePath = 'images/profile-icon.png';}
							   }
				 ?>
              <div class="active-box-inner">
                <div class="comments-box">
                  <div class="comments-box-left"><img src="<?php echo base_url().$imagePath;?>" width="36" height="36" alt="user"/></div>
                  <div class="comments-box-right" style="width:755px !important;">
                    <div class="comments-arow"></div>
                    <div class="comments-outer">
                      <div class="comments-desk"><?php echo nl2br($userCmnt['comments']);?></div>
                      <div class="clr"></div>
                      <div class="comments-posted"><span><a href="<?php echo base_url().'community/member/'.$userCmnt['user_slug'].'/' ?>"><?php echo $userCmnt['user_slug']; ?></a></span></div>
                      <div class="comments-title" style="float:right;"><span>&nbsp;
                        <form name="frmCmnt_<?php echo $userCmnt['id'];?>" method="post" style="width:auto !important;">
                          <input type="hidden" name="commentId" value="<?php echo $userCmnt['id'];?>" />
                          <button type="submit" class="com-refresh" name="btnDelete" >delete</button>
                        </form>
                        </span></div>
                      <div class="comments-title" style="float:right;"><span> <a href="<?php echo base_url().'community/member/'.$userCmnt['user_slug'].'/' ?>">reply on <?php echo $userCmnt['user_slug'].'\'s profile' ?></a> </span></div>
                    </div>
                  </div>
                  <div class="clr"></div>
                </div>
              </div>
              <div class="clr"></div>
              <?php	
			  		}
					if(count($dataComments)>10)
					{
					echo '<div class="active-inner" style="text-align:center;"><div class="more_div">
								<a href="javascript:void(0);">
									<div id="load_more_'.$id.'" class="more_tab">
											<div class="more_button" id="'.$id.'">Load More Content</div>
									</div>
								</a>
								</div></div>';
					}
				}
			
		 ?>
              
            </div>
            <div class="clr"></div>
          </div>
          <div class="clr"></div>
        </div>
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
