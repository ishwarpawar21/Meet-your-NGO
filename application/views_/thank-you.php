<!--start-contain-inner-->
<div class="contain"> 
			<!--inner-->
			<div class="innar-page">
			<div class="profile-top">
			</div>
			<!--login-inner-->
			<div class="">
		<!--<div class="">Hello, you don't have permission to add coupon. If you want to add coupon then please contact Admin for that. Thank you very much!  </div>-->
        <div class="coupons-right" style="width:800px; margin-left:185px;">
        <div class="coupons-heading-desk" style=" float:left; width:770px; padding-top:20px; padding-right:30px;">
        <!--<div class="coupons-heading">Coupon Permission</div>-->
        <div style="text-align:center;"><img src="<?php echo base_url();?>images/thank-you.png" width="192" height="151" alt="thank" /></div>
       <?php
		 if($msg=='unsubscribe') {?>
        <div class="thank-you" style="text-align:center;"><strong>You have been unsubscribed successfully.<br /></strong>
        </div> 
        <?php }
		 if($msg=='done') {?>
        <div class="thank-you" style="text-align:center;"><strong>You have been already unsubscribed.<br /></strong>
        </div> 
        <?php }?>
        </div>
        <div class="clr"></div>
      </div>
      	<div class="clr"></div>
			</div>
			<!--login-inner-->
			<div class="clr"></div>
			</div>
			<!--inner--> 
			</div>

