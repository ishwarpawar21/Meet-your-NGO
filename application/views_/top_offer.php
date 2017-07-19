<?php $fetch_brand=$this->master_model->getRecords('tbl_brand_master',array('brand_status'=>'1'));?>

<div class="contain"> 

  <!--inner-->

    

  <div class="new-coupon-inner"> 

      <!--contain-left-->

      <div class="contain-left">

        <!--inner-->

        <div class="co-pages">

        	<div class="new-heading-new">

            <div class="new-heading-new1">

            	<div class="new-heading-main-head-left"><img src="<?php echo base_url();?>images/se-icon.png" style=" margin-top:-5px;" width="30" height="20" alt="icon" /> Top Offer</div>

            <div class="clr"></div>

            </div>

            </div>

            <div class="clr"></div>

        </div>

        <!--inner-->

        <div class="co-pages" style=" padding-bottom:0px;"> 

          <?php

		   if(count($product_coupon)>0)

		   {

			foreach($product_coupon as $rowcoupon)

			{ 

			?>

              <!--main-box-->

              <div class="product-outre">

                <div class="product-left"><a href="<?php echo  $rowcoupon['product_details_url']; ?>" target="_blank"><img src="<?php echo $rowcoupon['coupon_image']; ?>" width="147" height="149" alt="product" /></a></div>

                <div class="product-right">

                  <div class="product-right-innet-left">

                    <div class="product-titme">

                    <a href="<?php echo  $rowcoupon['product_details_url']; ?>" target="_blank">

                    <?php echo $rowcoupon['coupon_id']; 

					if(strlen($rowcoupon['coupon_title'])>200)

					{echo substr($rowcoupon['coupon_title'],0,66)."...."; }

					else

					{echo substr($rowcoupon['coupon_title'],0,66); }

					?></a></div>

                    <div class="product-desk"><?php echo substr($rowcoupon['coupon_desc'],0,150); ?></div>

                    <div class="product-code">

                      <?php

					 	  $checkCoupon=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'fb_share','login_id'=>$this->session->userdata('login_id'),'coupon_id'=>$rowcoupon['coupon_id']));

						  if(count($checkCoupon)>0 && $this->session->userdata('login_id')!='')

						  { 

						  ?>

						 <div class="product-code-left">CODE :</div>

						  <div class="product-code-left">

							<div class="code-btn-inner">

							  <div class="btn-code">

							  <a href="javascript:void(0)" class="fancybox"><?php echo $rowcoupon['coupon_code']; ?>

							   <span class="btn-code-arow"><img src="<?php echo base_url();?>images/btn-arow.png" width="22" height="22" alt="arow" /></span>

							  </a> 

							  </div>

							  <div class="clr"></div>

							</div>

						 </div>

                      <?php 

						}

					   	  else

					  	  {

					   ?>

                       <div class="product-code-left">

                        <div class="code-btn-inner">

                          <div class="btn-code">

                          <a href="<?php echo base_url().'share_coupon/'.base64_encode($rowcoupon['coupon_id']).'/'; ?>" class="fancybox fancybox.ajax">

                          View Coupon Code

                          <span class="btn-code-arow">

                          <img src="<?php echo base_url();?>images/btn-arow.png" width="22" height="22" alt="arow" />

                          </span>

                          </a> 

                          </div>

                          <div class="clr"></div>

                        </div>

                      </div>

                       <?php 

					   }

					  ?>

                      <div class="product-code-left">

                        <div class="buy-btn-inner">

                          <div class="btn-buy-now"><a href="<?php echo  $rowcoupon['product_details_url']; ?>" target="_blank">BUY NOW<span class="btn-code-arow"><img src="<?php echo base_url();?>images/btn-arow.png" width="22" height="22" alt="arow" /></span></a> </div>

                          <div class="clr"></div>

                        </div>

                      </div>

                      <div class="product-code-left">

                        <div class="product-code-left">Total Points :</div>

                          <div class="product-code-left" style=" padding-right:0px;">

                            <div class="product-dollar">

                            <?php

							$totShare = $this->master_model->getRecordSum('tbl_userscored_point',array('coupon_id'=>$rowcoupon['coupon_id'],'point_type'=>'fb_share'),'share_point');

							if($totShare)

							{echo $totShare;}

							else

							{echo '0';}

							?>

                            </div>

                          </div>

                         <div class="clr"></div>

                      </div>

                      <div class="clr"></div>

                    </div>

                    <div class="clr"></div>

                  </div>

                  <div class="product-right-innet-top"> 

                    <!--success-->

                    <a href="<?php echo  $rowcoupon['product_details_url']; ?>" target="_blank">

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

                    </a>

                    <!--success--> 

                    <div class="product-inner-price">

                      <div class="product-code-left">PRICE :</div>

                      <div class="product-code-left" style=" padding-right:0px;"><div class="product-dollar"><?php echo $rowcoupon['product_price']; ?></div> </div>

                      <div class="clr"></div>

                    </div>

                  </div>

                  <div class="clr"></div>

                  <div class="comment-box">

                    <div class="comment-box-inner"><img src="<?php echo base_url();?>images/clock.png" width="18" height="18" alt="icon" style=" margin-top:4px;"/></div>

                    <div class="comment-box-inner showTimer_<?php echo $rowcoupon['coupon_id'] ?>" style="width:120px;"></div>

                    <?php include('timer.php');?>

                      <div class="comment-box-inner"><img src="<?php echo base_url();?>images/comment.png" width="12" height="12" alt="comment-icon" style=" margin-top:7px;"/></div>

                      <div class="comment-box-inner" style="width:100px;"><a href="<?php echo base_url().'share_coupon/'.base64_encode($rowcoupon['coupon_id']).'/'; ?>" class="fancybox fancybox.ajax"><?php  echo $this->master_model->getRecordCount('tbl_coupon_comments',array('couponid'=>$rowcoupon['coupon_id']));  ?> comments</a></div>

                      <div class="comment-box-inner" style="width:150px;">brand- 

                        <a href="<?php echo base_url();?>brand/<?php echo $rowcoupon['brand_slug'];?>/"><?php echo stripslashes(ucfirst($rowcoupon['brand_title']));?></a>

                      </div>

                    <?php if($this->session->userdata('login_id')!='')

					{?>

                    <div class="comment-box-inner" style="width:160px; float:right;" id="loadlikeunlikediv">

                     <?php

				 $coupon_count=$this->master_model->getRecordCount('tbl_save_master',array('tbl_save_master.couponid'=>$rowcoupon['coupon_id'],'tbl_save_master.coupon_login_id'=>$this->session->userdata('login_id')));

				if($coupon_count==0 && $this->session->userdata('login_id')!='')

				{?>

                    <a href="#" class="save_coupon" id="save_coupon" rel="<?php echo base64_encode($rowcoupon['coupon_id']);?>" >

                        <div class="product-save-in alreadydone" style="display:block;" id="coupon_<?php echo $rowcoupon['coupon_id'];?>" >

                        <div class="product-like-out" >

                         <i class="fa fa-star" style=" margin-top:6px; margin-left:4px; " title="Favourite Coupon" ></i>

                        </div>

                        <div class="clr"></div>

                        </div>

                     </a>

                 <?php 

				 }

				 else 

				 {

			    ?>

                   <a href="#fade" class="initialism fade_open">

                     <div class="product-save-in" >

                        <div class="product-like-out" >

                             <i class="fa fa-star" style=" margin-top:6px; margin-left:4px; " title="Favourite Coupon"></i>

                        </div>

                        <div class="clr"></div>

                      </div>

                    </a>

                 <?php }?>  

                         <a href="#" class="like_unlike" id="like_unlike" lang="<?php echo base64_encode(1);?>" rel="<?php echo $rowcoupon['coupon_id'];?>" title="Like Coupon">

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

                         <a href="#" class="like_unlike" id="like_unlike" lang="<?php echo base64_encode(0);?>" rel="<?php echo $rowcoupon['coupon_id'];?>" title="Unlike Coupon" >

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

                    <?php 

					//}

					}

					else 

					{?>

               			 <div class="comment-box-inner" style="width:160px; float:right;" id="loadlikeunlikediv">

                         <a href="#fade" class="initialism fade_open" >

                    	    <div class="product-save-in">

                            <div class="product-like-out" >

                            <i class="fa fa-star" style=" margin-top:6px; margin-left:4px;" title="Favourite Coupon"></i>

                            </div>

                            <div class="clr"></div>

                        </div>

                         </a>

                         <a href="#fade" class="initialism fade_open" title="Like Coupon">

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

                         <a href="#fade" class="initialism fade_open" title="Unlike Coupon">

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

          <?php } ?>

		   <div class="job-pagging">  

		     <div class="paginate paginate-dark">

		      <?php echo $links; ?>

              </div>

           </div>

		  <?php }else{?>

           <div class="err-message">No Data Found .</div>

           <?php } ?>

          <div class="clr"></div>

        </div>

        

        <div class="clr"></div>

      </div>

      <!--contain-left--> 

      <!--contain-right-->

      <div class="contain-right">

     	 <?php include('right-panel.php'); ?>

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

        <div class="top-close-title" align="center">

        <?php if($this->session->userdata('login_id')=='')

			{ ?> Login First

		<?php } 

		else{?>

        Already Coupon save in favourite list.

        <?php }?>

        </div>

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

						   <?php if($this->session->userdata('login_id')==''){ ?>

                              Hello Friend, If you want to Like/Unlike/Favourite this coupon then please login first<br/>

                              <a href="<?php echo base_url('login')?>"> Click Here</a> for Login.

                            <?php } else{?>

                            Hello, you already save this Coupon in favourite list.	

                          <?php }?>

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

<?php

$fb_postid = $this->uri->segment(2);

if($this->session->userdata('isShared')=='yes' && $this->session->userdata('isPostId')==$fb_postid)

{

	echo '<a href="'.base_url().'home/showcoupon/'.base64_encode($_COOKIE['selectedCoupon']).'/'.$fb_postid.'/" id="openCoupon" class="fancybox fancybox.ajax"></a>';

 } 

?>