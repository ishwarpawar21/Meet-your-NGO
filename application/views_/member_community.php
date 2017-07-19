<div class="contain"> 
  <!--inner-->
  <div class="innar-page"> 
    <!--profile-inner-->
    <div class="profile-top">
      <?php include('profile-header.php'); ?>
    </div>
    <!--my-profile-->
    <div class="my-profile-outer"> 
      <!--profile-left-->
      <div class="community-left">
        <div class="active-inner">
          <div class="about-heading">
            <div class="latest-sub-title">Top 10 Community Contributors <span>People helping people save!</span> <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
          </div>
        </div>
        <div class="active-inner">
          <div class="new-heading-new">
            <div class="new-heading-new1">
              <div class="com-list-btn" style=" background:none; padding-bottom:11px;">
                <div class="com-list-all"> <a href="javascript:void(0);" class="current"> Dashboard </a></div>
                <div class="com-list-all">|</div>
                <div class="com-list-all"> <a href="<?php echo base_url().'community/faq/'; ?>"> FAQ's </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/shared_coupon/';?>" >Shared Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/liked_coupon/';?>" >Liked Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/commented_coupon/';?>">Commented Coupon </a></div>
                <div class="clr"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="active-inner"> 
          <!--left-->
          <div class="com-inner-left">
            <div class="com-inner-top" style=" position:relative;"> <!--<span class="footer-link-inner" style="float:left; position: absolute !important; left:10px; top:4px; text-align:left;font-family: 'Open Sans Semibold',sans-serif; font-size: 14px;"><a href="javascript:void(0);" class="next_point">All</a></span>--> Most points 
            <span style="margin-top:05px;">
                <select id="check_month" name="check_month">
                  <option value="all" <?php if(isset($_POST['check_month']) && $_POST['check_month']=='all'){echo 'selected="selected"';} ?>>All</option>
                  <option value="1" <?php if(date('m')=='1'){echo 'selected="selected"';}?>>January</option>
                  <option value="2" <?php if(date('m')=='2'){echo 'selected="selected"';}?>>February</option>
                  <option value="3" <?php if(date('m')=='3'){echo 'selected="selected"';}?>>March</option>
                  <option value="4" <?php if(date('m')=='4'){echo 'selected="selected"';}?>>April</option>
                  <option value="5" <?php if(date('m')=='5'){echo 'selected="selected"';}?>>May </option>
                  <option value="6" <?php if(date('m')=='6'){echo 'selected="selected"';}?>>June </option>
                  <option value="7" <?php if(date('m')=='7'){echo 'selected="selected"';}?>>July </option>
                  <option value="8" <?php if(date('m')=='8'){echo 'selected="selected"';}?>>August </option>
                  <option value="9" <?php if(date('m')=='9'){echo 'selected="selected"';}?>>September </option>
                  <option value="10" <?php if(date('m')=='10'){echo 'selected="selected"';}?>>October </option>
                  <option value="11" <?php if(date('m')=='11'){echo 'selected="selected"';}?>>November </option>
                  <option value="12" <?php if(date('m')=='12'){echo 'selected="selected"';}?>>December </option>
                </select>
             </span> 
            </div>
            <input type="hidden" name="txt_limit" id="txt_limit" value="10" />
            <div class="com-list-outer" id="most_point">
              <?php
			      $i=0;
				  if(count($Userpoints)>0)
				  {
					  $i=1;
					  foreach($Userpoints as $rowpoint)
					  {
						  if($rowpoint['user_type'] == 'seller')
						 {
							 $this->db->select('profilepic');
							 $getImage=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.loginid'=>$rowpoint['login_id']));
							 if(isset($getImage[0]['profilepic']) && $getImage[0]['profilepic']!='')
							 {$imagePath ='uploads/profile_image/thumb/'.$getImage[0]['profilepic'];}
							 else
							 {$imagePath ='images/profile-img.jpg'; }
						 }
						 else
						 {
							 $this->db->select('profile_picture');
							 $getUserPoint=$this->master_model->getRecords('tbl_user_master',array('tbl_user_master.login_id'=>$rowpoint['login_id']));
							 if(isset($getImage[0]['profile_picture']) && $getImage[0]['profile_picture']!='')
							 {$imagePath ='uploads/profile_image/thumb/'.$getImage[0]['profile_picture'];}
							 else
							 {$imagePath ='images/profile-img.jpg';}
						 }
						?>
                        <div class="com-list">
                            <div class="com-list1"><?php echo $i; ?></div>
                            <div class="com-list2"><img src="<?php echo base_url().$imagePath;?>" width="45" height="45" alt="img" /></div>
                            <div class="com-list3"><a href="javascript:void(0);"><?php echo $rowpoint['user_slug']; ?></a></div>
                            <div class="com-list4"><?php echo $rowpoint['total'];  ?>
                              <div class="clr"></div>
                              <span>points</span> </div>
                            <div class="clr"></div>
                       </div>
                      <?php
						$i++;
					  }
					  if($i>10)
					  {
					  ?>
					  <div class="com-list-btn">
						 <button name="" class="com-list-next next_point" value="" id="next_point" type="button" > More Contented <i class="fa fa-angle-right"></i></button>
						 <div id="loading_more" style="display:none;"><img src="<?php echo base_url().'images/myloader_20x20.gif'; ?>" style="padding:10px 0 0 100px;"/></div>
					  </div>
					  <?php
					   } 
			      }
				  else
				  {
				?>
                <div class="err-message">No Data Found .</div>
                <?php	  
				  }
				 ?>
              <!--list-box-btn-->
              
              <!--list-box-btn-->
              <div class="clr"></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--left--> 
          <!--right-->
          <div class="com-inner-right">
            <div class="com-inner-top">Redeemed points <!--<span>01-10</span>--> </div>
            <div class="com-list-outer">
              <?php 
			   if(count($productperchase)>0){ 
			     $i=1;
			     foreach($productperchase as $rowperchase)
			     {
					 if($rowperchase['user_type']=='seller')
					 {
					   $image=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$rowperchase['login_id']));
					   if($image[0]['profilepic']!='')
					   {$imagePath=base_url().'uploads/profile_image/thumb/'.$image[0]['profilepic'];}
					   else
					   {$imagePath=base_url().'images/profile-img.jpg';}
					 }
					 else
					 {
					   $image=$this->master_model->getRecords('tbl_user_master',array('login_id'=>$rowperchase['login_id']));
					   if($image[0]['profile_picture']!='')
					   {$imagePath=base_url().'uploads/profile_image/thumb/'.$image[0]['profile_picture'];}
					   else
					   {$imagePath=base_url().'images/profile-img.jpg';}
					 }
					 $this->db->select('SUM(purchase_point) as perchaseTotal');
					 $UsersumTotal=$this->master_model->getRecords('tbl_purchase_point',array('purchase_login_id'=>$rowperchase['login_id']));
			   ?>
                  <!--list-box-->
                  <div class="com-list">
                    <div class="com-list1"><?php echo $i; ?></div>
                    <div class="com-list2"> <img src="<?php echo $imagePath; ?>" width="45" height="45" alt="img" /> </div>
                    <div class="com-list3"><a href="javascript:void(0);"><?php echo $rowperchase['user_slug']; ?></a></div>
                    <div class="com-list4"><?php echo $UsersumTotal[0]['perchaseTotal'];  ?>
                      <div class="clr"></div>
                      <span>points</span> </div>
                    <div class="clr"></div>
                  </div>
                  <!--list-box-->
              <?php
				    $i++; 
				  }
				}else
				{
			   ?>
                 <div class="err-message">No Data Found .</div>
				<?php }?>
              <!--list-box-btn--> 
              <!--list-box-btn-->
              <div class="clr"></div>
            </div>
            <div class="clr"></div>
          </div>
          <!--right-->
          <div class="clr"></div>
        </div>
        <?php if($seldetail[0]['user_type']=='seller'){?>
        <div class="active-inner">
          <div class="submit-heading">
            <div class="latest-sub-title">Coupon added by-
              <?php if(isset($seldetail[0]['user_slug'])){ echo $seldetail[0]['user_slug'];}?>
              <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow-arb.png" width="20" height="21" alt="arow" /></span></div>
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
						  ?>
						 <div class="product-code-left">CODE :</div>
                       <div class="latecom-box-inner" style="margin-top:3px;">
						  <?php echo $allcoupon['coupon_code']; ?>
                          </div>
				<?php	  
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
		 }
		 else
		 {
		?>
        <div class="active-inner"> 
          <!--first-->
          <div class="latest-coupontitle">No Coupon Available.</div>
          <!--first-->
          <div class="clr"></div>
        </div>
        <?php } ?>
        <div class="clr"></div>
        <?php } else {?>
        <div class="active-inner">
          <div class="submit-heading">
            <div class="latest-sub-title">Coupon's shared by-
              <?php if(isset($seldetail[0]['user_slug'])){ echo $seldetail[0]['user_slug'];}?>
              <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow-arb.png" width="20" height="21" alt="arow" /></span></div>
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
						  ?>
                           <div class="product-code-left">CODE :</div>
                      <div class="latecom-box-inner" style="margin-top:3px;">
						  <?php echo $allcoupon['coupon_code']; ?>
                          </div>
				<?php	}?>
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
        <?php } 
		}
		?>
        <div class="clr"></div>
       <?php if(count($fetchCoupon)>5){?>
        <ul class="_tsc_pagination tsc_paginationA tsc_paginationA01">
        		<li class="current"><a href="<?php echo base_url(); ?>member/<?php echo $seldetail[0]['user_slug']; ?>/submitted_coupon/1">1</a></li>
                <li><a href="<?php echo base_url(); ?>member/<?php echo $seldetail[0]['user_slug']; ?>/submitted_coupon/2">2</a></li>
                <li><a href="<?php echo base_url(); ?>member/<?php echo $seldetail[0]['user_slug']; ?>/submitted_coupon/2">&gt;</a></li>
        </ul>
        <div class="clr"></div>
        <?php } ?>
      </div>
      <!--profile-left--> 
      <!--profile-right-->
      <div class="community-right">
        <?php include('right-panel.php'); ?>
      </div>
      <!--profile-right-->
      
      <div class="clr"></div>
    </div>
    <!--my-profile--> 
    <!--profile-inner-->
    
    <div class="clr"></div>
  </div>
  <!--inner--> 
</div>
<script type="text/javascript">
$(document).ready(function(){
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
</script> 
