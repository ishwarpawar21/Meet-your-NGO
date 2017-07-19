<!--main-box-->
<div class="product-outre">
  <div class="product-left"><a href="#"><img src="<?php echo $productCoupon[0]['coupon_image']; ?>" width="147" height="149" alt="product" /></a></div>
  <div class="product-right">
    <div class="product-right-innet-left">
      <div class="product-titme"><a href="#"><?php echo $productCoupon[0]['coupon_title']; ?></a></div>
      <div class="product-desk"><?php echo $productCoupon[0]['coupon_desc']; ?></div>
      
      <div class="product-code">
        <!--<div class="product-code-left">CODE :</div>-->
        <div class="product-code-left">
          <div class="code-btn-inner">
            <div class="btn-code"><a href="javascript:void(0);" id="facebook" class="myFbShare" name="<?php echo $productCoupon[0]['coupon_id']; ?>">Facebook Share<span class="btn-code-arow"><img src="<?php echo base_url();?>images/btn-arow.png" width="22" height="22" alt="arow" /></span> </a> </div>
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
      <div class="comment-box-inner" style="width:120px;"> <?php   echo $this->master_model->getRecordCount('tbl_coupon_comments',array('couponid'=>$productCoupon[0]['coupon_id']));   ?> comments</div>
      <div class="comment-box-inner" style="width:100px;"> <a href="<?php echo base_url();?>brand/<?php echo $productCoupon[0]['brand_slug'];?>"><?php echo stripslashes(ucfirst($productCoupon[0]['brand_title']));?></a> </div>
      
      <div class="clr"></div>
    </div>
  </div>
  <div class="clr"></div>
</div>
<!--main-box-->
<div class="product-outre"  >
<fieldset>
<legend>Comments</legend>
<?php      
      if(count($myPagination['commentData']) > 0) {     
	    echo ' <div id="divID">';
		foreach($myPagination['commentData'] as $val) { 
	   ?>
  		    <div class="product-right" style="width:100%!important;float:none!important;">
                <div class="product-right-innet-left">
                  <div class="product-desk"><?php echo nl2br($val['comments']); ?></div>
                   <div class="product-code">
                    <div class="clr"></div>
                  </div>
                  <div class="clr"></div>
                </div>
    
    <div class="clr"></div>
                            <div class="comment-box">
                              <div class="comment-box-inner"><img src="<?php echo base_url();?>images/clock.png" width="18" height="18" alt="icon" style=" margin-top:4px;"/></div>
                              <div class="comment-box-inner" style="width:200px;">Posted on : <?php echo  date('d-m-Y',strtotime($val['posted_date']));?></div>
                             
                              <div class="comment-box-inner" style="width:120px;float:right;">by : <?php echo  $val['user_slug']; ?></div>
                              <div class="clr"></div>
                            </div>
  </div>
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
	 $('#facebook').click(function(e) {
			  FB.login(function(response) {
			  if(response.authResponse) {
				parent.location ='<?php echo base_url(); ?>home/checkfacebook/';
			   //redirect uri after closing the facebook popup
			  }
	 		},{scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); 
			
			
			
			
			
			
	 });
 </script>