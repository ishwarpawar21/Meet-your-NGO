<?php $fetch_brand=$this->master_model->getRecords('tbl_brand_master',array('brand_status'=>'1'));?>
<div class="contain"> 
  <!--inner-->
    <div class="product-log-top">
    <div class="product-logo-bag">
      <div class="product-log-inner">
        <div id="mcts1">
       <?php 
	   if(count($fetch_brand)>0)
	   {
	   foreach($fetch_brand as $brand)
	   { ?> 
       <a href="<?php echo base_url();?>brand/<?php echo $brand['brand_slug'];?>">
       <img src="<?php echo base_url().'uploads/brand/thumb/'.$brand['brand_image']; ?>" alt="partner_1" height="87" width="161" />
       </a> 
       <?php }} 
	    else
	    {?> 
         <a href="#"><img src="<?php echo base_url(); ?>images/logo1.jpg" alt="partner_1" height="87" width="161" /></a> 
        <?php }?>
         </div>
        <div class="clr"></div>
      </div>
    </div>
  </div>
 	 <div class="new-coupon-inner"> 
      <!--contain-left-->
      <div class="contain-left">
        <div class="co-pages">
          <div class="new-heading">
            <div class="new-heading-inner">
              <div class="new-heading-main-head"><img src="<?php echo base_url();?>images/se-icon.jpg" width="30" height="20" alt="icon" /> </div>
              <div class="new-heading-main-head-left">New Coupons</div>
              <div class="new-heading-main-head-right">There are currently <span><?php echo count($product_coupon);?></span> active coupons</div>
              <div class="clr"></div>
            </div>
          </div>
          <div class="clr"></div>
        </div>
        <div class="co-pages" style=" padding-bottom:0px;"> 
          <?php
		   if(count($product_coupon)>0)
		   {
			foreach($product_coupon as $rowcoupon)
			{ ?>
              <!--main-box-->
              <div class="product-outre">
                <div class="product-left"><a href="#"><img src="<?php echo $rowcoupon['coupon_image']; ?>" width="147" height="149" alt="product" /></a></div>
                <div class="product-right">
                  <div class="product-right-innet-left">
                    <div class="product-titme"><a href="#"><?php echo $rowcoupon['coupon_title']; ?></a></div>
                    <div class="product-desk"><?php echo $rowcoupon['coupon_desc']; ?></div>
                    
                    <div class="product-inner-price">
                      <div class="product-code-left">PRICE :</div>
                      <div class="product-code-left"><div class="product-dollar"><?php echo $rowcoupon['product_price']; ?></div> </div>
                      <div class="clr"></div>
                    </div>
                    
                    <div class="product-code">
                      <div class="product-code-left">CODE :</div>
                      <div class="product-code-left">
                        <div class="code-btn-inner">
                          <div class="btn-code"><a href="#">View Coupon Code<span class="btn-code-arow"><img src="<?php echo base_url();?>images/btn-arow.png" width="22" height="22" alt="arow" /></span> </a> </div>
                          <div class="clr"></div>
                        </div>
                      </div>
                      <div class="product-code-left">
                        <div class="buy-btn-inner">
                          <div class="btn-buy-now"><a href="<?php echo  $rowcoupon['product_details_url']; ?>" target="_new">BUY NOW<span class="btn-code-arow"><img src="<?php echo base_url();?>images/btn-arow.png" width="22" height="22" alt="arow" /></span></a> </div>
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
						if($rowcoupon['product_reviews']!='')
						{ 
						  $review=explode(':-',$rowcoupon['product_reviews']);
						  $review_check=str_replace('(','',$review[0]);
						  $review_check1=str_replace(')','',$review_check);
						  $review_check2=str_replace('customer','',$review_check1);
						?>
                           <img src="<?php echo $review[1]; ?>"  alt="review" />
                           <div class="success-title"><?php echo  $review_check2; ?></div>
                        <?php
						}
						else
						{
						   echo '<div class="success-title">0 reviews</div>';
						}
						
                         $pos = strpos($rowcoupon['coupon_discount'],'%');
					    if($pos == false)
						{
						 $new_pos= '$'.number_format($rowcoupon['coupon_discount']).' Off';
						}
						else
						{
					     $new_pos=$rowcoupon['coupon_discount'].' Off';
						}
					 ?>
                       </div>
                       <div class="success-100pur"><?php echo $new_pos; ?><?php //echo $rowcoupon['product_price']; ?></div>
                      <div class="clr"></div>
                    </div>
                    <!--success--> 
                  </div>
                  <div class="clr"></div>
                  <div class="comment-box">
                    <div class="comment-box-inner"><img src="<?php echo base_url();?>images/clock.png" width="18" height="18" alt="icon" style=" margin-top:4px;"/></div>
                    <?php include('timer.php');?>
                    <div class="comment-box-inner countdown styled" style="width:200px;"></div>
                    
                    
                    
                    <div class="comment-box-inner"><img src="<?php echo base_url();?>images/comment.png" width="12" height="12" alt="comment-icon" style=" margin-top:7px;"/></div>
                    <div class="comment-box-inner" style="width:120px;">320 comments</div>
                     <div class="comment-box-inner" style="width:100px;">
                      <a href="<?php echo base_url();?>brand/<?php echo $rowcoupon['brand_slug'];?>"><?php echo stripslashes(ucfirst($rowcoupon['brand_title']));?></a>
                     </div>
                     
                    <?php if($this->session->userdata('login_id')!='') 
					{?>
                    <div class="comment-box-inner" style="width:152px;" id="loadlikeunlikediv">
                         <a href="#" class="like_unlike" id="like_unlike" lang="<?php echo base64_encode(1);?>" rel="<?php echo $rowcoupon['coupon_id'];?>">
                        <div class="LoadingImage" style="display:none;"><img src="<?php echo base_url();?>images/loading2.gif"/></div>
                        <div class="product-like-in">
                            <div class="product-like-out">
                           <img src="<?php echo base_url();?>images/like.png" width="17" height="24" alt="like" style=" margin-top:2px;"/>
                            </div>
                            <div class="product-like-out loadlikediv" id="like<?php echo $rowcoupon['coupon_id'];  ?>">
                            <?php  echo $like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$rowcoupon['coupon_id'],'like_id'=>'1'));?>
                            </div>
                            <div class="clr"></div>
                        </div>
                          <input type="hidden" id="txt_like<?php echo $rowcoupon['coupon_id'];?>" value="<?php echo $like_count ?>" />
                        </a>
                         <a href="#" class="like_unlike" id="like_unlike" lang="<?php echo base64_encode(0);?>" rel="<?php echo $rowcoupon['coupon_id'];?>" >
                        <div class="product-unlike-in">
                            <div class="product-like-out" >
                            <img src="<?php echo base_url();?>images/unlike.png" width="17" height="24" alt="like" style=" margin-top:2px;"/>
                            </div>
                            <div class="product-like-out" id="unlike<?php echo $rowcoupon['coupon_id'];  ?>">
							<?php  echo $like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$rowcoupon['coupon_id'],'unlike_id'=>'1'));?></div>
                            <input type="hidden" id="txt_unlike<?php echo $rowcoupon['coupon_id'];?>" value="<?php echo $like_count ?>" />
                            <div class="clr"></div>
                        </div>
                        <div class="LoadingImage" style="display:none;"><img src="<?php echo base_url();?>images/loading2.gif"/></div>
                        </a>
                        <div class="clr"></div>
                    </div>
                    <?php }
					else {?>
               			 <div class="comment-box-inner" style="width:152px;" id="loadlikeunlikediv">
                         <a href="#fade" class="initialism fade_open">
                        <div class="product-like-in">
                            <div class="product-like-out">
                           <img src="<?php echo base_url();?>images/like.png" width="17" height="24" alt="like" style=" margin-top:2px;"/>
                            </div>
                            <div class="product-like-out loadlikediv" id="like<?php echo $rowcoupon['coupon_id'];  ?>">
                            <?php  echo $like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$rowcoupon['coupon_id'],'like_id'=>'1'));?>
                            </div>
                            <div class="clr"></div>
                        </div>
                          <input type="hidden" id="txt_like<?php echo $rowcoupon['coupon_id'];?>" value="<?php echo $like_count ?>" />
                        </a>
                         <a href="#fade" class="initialism fade_open" >
                        <div class="product-unlike-in">
                            <div class="product-like-out" >
                            <img src="<?php echo base_url();?>images/unlike.png" width="17" height="24" alt="like" style=" margin-top:2px;"/>
                            </div>
                            <div class="product-like-out" id="unlike<?php echo $rowcoupon['coupon_id'];  ?>">
							<?php  echo $like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$rowcoupon['coupon_id'],'unlike_id'=>'1'));?></div>
                            <input type="hidden" id="txt_unlike<?php echo $rowcoupon['coupon_id'];?>" value="<?php echo $like_count ?>" />
                            <div class="clr"></div>
                        </div>
                        </a>
                        <div class="clr"></div>
                    </div>
                    <?php }?>
                    <div class="clr"></div>
                  </div>
                </div>
                <div class="clr"></div>
              </div>
              <!--main-box-->
          <?php }}else{?>
           <div class="err-message">No Data Found .</div>
           <?php } ?>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
      <!--contain-left--> 
      <!--contain-right-->
      <div class="contain-right">
     <?php //include('newsletter-subscribe.php'); ?>  
        <div class="deily-deal-inner">
          <div class="deily-deal-title">Daily DEALS
            <div class="clr"></div>
            <span>Spread the saving with Everyone!</span> </div>
        </div>
        <!--main-deal-->
        <div class="deal-roduct">
          <div class="deal-roduct-img"><img src="<?php echo base_url();?>images/shoes.jpg" width="215" height="129" alt="product" /></div>
          <div class="see-deal">
            <div class="btn-see-deal"> <a href="#">Click to see Deal</a> </div>
          </div>
          <div class="deal-roduct-title">Wildcraft Laptop Backpack (Blue)</div>
          <div class="deal-roduct-desk">At Shop Clues</div>
          <div class="deal-roduct-price">
            <div class="deal-roduct-price1">Rs. 12,990</div>
            <div class="deal-roduct-pricer">Rs. 3,199</div>
            <div class="clr"></div>
          </div>
          <div class="clr"></div>
        </div>
        <!--main-deal--> 
        <!--main-deal-->
        <div class="deal-roduct">
          <div class="deal-roduct-img"><img src="<?php echo base_url();?>images/shoes.jpg" width="215" height="129" alt="product" /></div>
          <div class="see-deal">
            <div class="btn-see-deal"> <a href="#">Click to see Deal</a> </div>
          </div>
          <div class="deal-roduct-title">Wildcraft Laptop Backpack (Blue)</div>
          <div class="deal-roduct-desk">At Shop Clues</div>
          <div class="deal-roduct-price">
            <div class="deal-roduct-price1">Rs. 12,990</div>
            <div class="deal-roduct-pricer">Rs. 3,199</div>
            <div class="clr"></div>
          </div>
          <div class="clr"></div>
        </div>
        <!--main-deal--> 
          <div class="active-inner">
            <div class="about-heading">
              <div class="about-inner-title">Browse By Categories <span class="title-arow"><img src="<?php echo base_url();?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
            </div>
          </div>
          <div class="active-inner">
            <div class="points-menu">
              <div id="pointsmenu">
                <ul>
                  <li><a href="#">All Categories</a></li>
                  <li><a href="#">Mobiles and Tablets</a></li>
                  <li><a href="#">Food and Dining</a></li>
                  <li><a href="#">Computers Laptop and Gaming</a></li>
                  <li><a href="#">All Categories</a></li>
                  <li><a href="#">Mobiles and Tablets</a></li>
                  <li><a href="#">Food and Dining</a></li>
                  <li><a href="#">Computers Laptop and Gaming</a></li>
                  <li><a href="#">All Categories</a></li>
                  <li><a href="#">Mobiles and Tablets</a></li>
                  <li><a href="#">Food and Dining</a></li>
                  <li><a href="#">Computers Laptop and Gaming</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="active-inner">
            <div class="about-heading">
              <div class="about-inner-title">Find us on Facebook <span class="title-arow"><img src="<?php echo base_url();?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
            </div>
          </div>
          <div class="active-inner">
            <div class="points-menu"><img src="<?php echo base_url();?>images/facebook-share.jpg" width="252" height="359" alt="facebook-share" /></div>
          </div>
        <div class="clr"></div>
      </div>
      <!--contain-right-->
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
  <!--inner--> 
</div>
<!--Popup Div Start-->
<div id="fade" class="well">
    <div class="top-close-area">
        <div class="top-close-title" align="center">Login First</div>
        <div class="top-close-right"><button class="fade_close button-close "></button></div>
        <div class="clr"></div>
    </div>
    <form method="post" name="loginfirst" id="loginfirst" >
      <div class="inner-form-area">
        <!--left-site-->
            <div class="col-md-11">
            <div class="panel panel-cascade" style="box-shadow:none; background:none;">
                 <div class="ro">
                    <div class="form-group">
                       <div class="right-col">
                            <div class="co-pages fild-text-popup">
                            Hello Friend, If you want to Like/Unlike this coupon then please login first<br/>
                           <a href="<?php echo base_url('login')?>"> Click Here</a> for Login.
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                    </div>    
                 </div>
            </div>
          </div>
          <!--left-site-->
         <div class="clr"></div>
       </div>    
    </form>
</div>
<!--Popup Div End-->
<!--Popup JS & CSS Start-->
<link href="<?php echo base_url(); ?>popup/css/popup.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>popup/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>popup/js/jquery.popupoverlay.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>popup/js/bootstrap.min.js"></script>
<script language="javascript">
$(document).ready(function(event){
$('#fade').popup({
      transition: 'all 0.3s',
      autozindex: true
    }); 
 });
</script>
<!--Popup JS & CSS End-->