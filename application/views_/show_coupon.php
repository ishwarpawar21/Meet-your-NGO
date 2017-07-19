<!--main-box-->
<div class="product-outre">
  <div class="product-left"><a href="#"><img src="<?php echo $productCoupon[0]['coupon_image']; ?>" width="147" height="149" alt="product" /></a></div>
  <div class="product-right">
    <div class="product-right-innet-left">
      <div class="product-titme"><a href="#"><?php echo $productCoupon[0]['coupon_title']; ?></a></div>
      <div class="product-desk"><?php echo $productCoupon[0]['coupon_desc']; ?></div>
      
      <div class="product-code">
        <div class="product-code-left">CODE :</div>
        <div class="product-code-left">
          <div class="code-btn-inner">
             <div class="latecom-code"><?php echo $productCoupon[0]['coupon_code']; ?> </div>
          <div class="clr"></div>
        </div>
       </div>
       <div class="product-code-left">
          <div class="buy-btn-inner">
            <div class="btn-buy-now"><a href="<?php echo  $productCoupon[0]['product_details_url']; ?>" target="_new">BUY NOW<span class="btn-code-arow"><img src="<?php echo base_url();?>images/btn-arow.png" width="22" height="22" alt="arow" /></span></a> </div>
            <div class="clr"></div>
          </div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>
    <div class="product-right-innet-top"> 
      <!--success-->
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
        <div class="success-100pur"><?php echo $new_pos; ?>
          <?php //echo $productCoupon[0]['product_price']; ?>
        </div>
        <div class="clr"></div>
      </div>
      <!--success--> 
      <div class="product-inner-price">
                      <div class="product-code-left">PRICE :</div>
                      <div class="product-code-left" style=" padding-right:0px;"><div class="product-dollar"><?php echo $productCoupon[0]['product_price']; ?></div> </div>
                      <div class="clr"></div>
                    </div>
    </div>
    <div class="clr"></div>
    <div class="comment-box">
      <div class="comment-box-inner"><img src="<?php echo base_url();?>images/clock.png" width="18" height="18" alt="icon" style=" margin-top:4px;"/></div>
      <div class="comment-box-inner showTimer_<?php echo $productCoupon[0]['coupon_id'] ?>" style="width:200px;"></div>
     <script type="text/javascript">
		$(document).ready(function(){
			var endDate = "<?php echo date('Y/m/d',strtotime($productCoupon[0]['coupon_expirydate']));?>";
			// var date = new Date(new Date().valueOf() + 15 * 24 * 60 * 60 * 1000);
		  //dateFormat is YYYY/MM/DD
		  $('.showTimer_<?php echo $productCoupon[0]['coupon_id']; ?>').countdown(endDate, function(event) {
			$(this).html(event.strftime('Expires in %D days'));
		  });
		});
		</script>
      <div class="comment-box-inner"><img src="<?php echo base_url();?>images/comment.png" width="12" height="12" alt="comment-icon" style=" margin-top:7px;"/></div>
      <div class="comment-box-inner openBox" style="width:120px;text-decoration:underline;cursor:pointer;"><?php  echo $this->master_model->getRecordCount('tbl_coupon_comments',array('couponid'=>$productCoupon[0]['coupon_id']));   ?> comments</div>
      <div class="comment-box-inner" style="width:100px;"> <a href="<?php echo base_url();?>brand/<?php echo $productCoupon[0]['brand_slug'];?>"><?php echo stripslashes(ucfirst($productCoupon[0]['brand_title']));?></a> </div>
      
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div style="margin-top:5px;">
      <div style="display:none;" id="divLoader" class="new-heading">
        <div style="text-align:center;" class="new-heading-inner"> <img width="60" height="60" alt="myloader.gif" src="<?php echo base_url();?>images/myloader.gif"> </div>
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
            <input type="button" name="btnDoCmnt" id="btnDoCmnt" class="submit-button" value="Post comment" style="float:right;margin-right:5px; height:34px; line-height:31px; padding:0px 10px;" />
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
  <fieldset>
    <legend>Showing 5 most recent comments</legend>
    <?php      
      if(count($myPagination['commentData']) > 0) {     
	    echo ' <div id="divID">';
		foreach($myPagination['commentData'] as $val) { 
		
	if(	$val['user_type']=='seller')
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
	$('.openBox').live('click',function(){
		$('#commentContainer').css('display','block');
	});
	$('#btnCancel').live('click',function(){
		$('#commentContainer').css('display','none');
	});
	$('#btnDoCmnt').click(function(){
	var _txtSenderid		= 	$('#txtSenderid').val();
	var _txtCouponid		= 	$('#txtCouponid').val();
	var _userComment 		= 	$('#couponComment').val();
	if(_txtSenderid != '' || _txtCouponid != '')
	{
		if(_userComment == '' || _userComment.match(/^\s+$/))
		{ alert('Please write your comment in box.'); $('#couponComment').focus();}
		else
		{
			$('#commentContainer').css('display','none');
			$('#divLoader').css('display','block');
			var dataString = {senderid:_txtSenderid,couponid:_txtCouponid,comments:_userComment,}
			$.ajax({
						type: 'POST',
						url: site_url+'home/post_comment/',
						data:dataString,
						success:function(res)
						{
							if(res=='done')
							{
								$('#divLoader').css('display','none');
								$('#commentContainer').css('display','block');
								$('#commentContainer').html('<div class="right-message">Thanks - your comment posted successfully.</div>');
								document.location.reload();
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


});
</script>