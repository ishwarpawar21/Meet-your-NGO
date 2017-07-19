<div class="contain"> 
  <!--inner-->
  <div class="new-coupon-inner"> 
    <!---->
    <div class="contain-left">
      <div class="co-pages">
        <div class="new-heading">
          <div class="new-heading-inner">
            <div class="new-heading-main-head"><img src="<?php echo base_url();?>images/se-icon.jpg" width="30" height="20" alt="icon" /> </div>
            <div class="new-heading-main-head-left">Coupon Details</div>
            <div class="clr"></div>
          </div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="co-pages" style=" padding-bottom:0px;"> 
        <?php if(isset($productCoupon[0]['coupon_id'])){ ?>
        
        <!--main-box-->
        <div class="product-outre">
                <div class="product-left"><a href="<?php echo  $productCoupon[0]['product_details_url']; ?>" target="_blank"><img src="<?php echo $productCoupon[0]['coupon_image']; ?>" width="147" height="149" alt="product" /></a></div>
                <div class="product-right">
                  <div class="product-right-innet-left">
                    <div class="product-titme">
                    <a href="<?php echo  $productCoupon[0]['product_details_url']; ?>" target="_blank">
                    <?php echo $productCoupon[0]['coupon_id'].' - '; 
					if(strlen($productCoupon[0]['coupon_title'])>200)
					{echo substr($productCoupon[0]['coupon_title'],0,66)."...."; }
					else
					{echo substr($productCoupon[0]['coupon_title'],0,66); }
					?></a></div>
                    <div class="product-desk"><?php echo substr($productCoupon[0]['coupon_desc'],0,150); ?></div>
                    <div class="product-code">
                      <?php
					 	  $checkCoupon=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'fb_share','login_id'=>$this->session->userdata('login_id'),'coupon_id'=>$productCoupon[0]['coupon_id']));
						  if(count($checkCoupon)>0 && $this->session->userdata('login_id')!='')
						  { 
						  ?>
						 <div class="product-code-left">CODE :</div>
						  <div class="product-code-left">
							<div class="code-btn-inner">
							  <div class="btn-code">
							  <a href="javascript:void(0)" class="fancybox"><?php echo $productCoupon[0]['coupon_code']; ?>
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
                          <a href="<?php echo base_url().'share_coupon/'.base64_encode($productCoupon[0]['coupon_id']).'/'; ?>" class="fancybox fancybox.ajax">
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
                          <div class="btn-buy-now"><a href="<?php echo  $productCoupon[0]['product_details_url']; ?>" target="_blank">BUY NOW<span class="btn-code-arow"><img src="<?php echo base_url();?>images/btn-arow.png" width="22" height="22" alt="arow" /></span></a> </div>
                          <div class="clr"></div>
                        </div>
                      </div>
                      <div class="product-code-left">
                        <div class="product-code-left">Total Points :</div>
                          <div class="product-code-left" style=" padding-right:0px;">
                            <div class="product-dollar">
                            <?php
							$totShare = $this->master_model->getRecordSum('tbl_userscored_point',array('coupon_id'=>$productCoupon[0]['coupon_id'],'point_type'=>'fb_share'),'share_point');
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
                    <a href="<?php echo  $productCoupon[0]['product_details_url']; ?>" target="_blank">
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
						{  echo '<div class="success-title">0 reviews</div>'; }
						
                         $pos = strpos($productCoupon[0]['coupon_discount'],'%');
					    if($pos == false)
						{ $new_pos= '$'.number_format($productCoupon[0]['coupon_discount']).' Off'; }
						else
						{ $new_pos=$productCoupon[0]['coupon_discount'].' Off'; }
					 ?>
                       </div>
                       <div class="success-100pur"><?php echo $new_pos; ?><?php //echo $productCoupon[0]['product_price']; ?></div>
                      <div class="clr"></div>
                    </div>
                    </a>
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
                    <div class="comment-box-inner showTimer_<?php echo $productCoupon[0]['coupon_id'] ?>" style="width:120px;"></div>
                    <script type="text/javascript">
						$(document).ready(function(){
							var endDate = "<?php echo date('Y/m/d',strtotime($productCoupon[0]['coupon_expirydate']));?>";
							// var date = new Date(new Date().valueOf() + 15 * 24 * 60 * 60 * 1000);
						  //dateFormat is YYYY/MM/DD
						  $('.showTimer_<?php echo $productCoupon[0]['coupon_id'] ?>').countdown(endDate, function(event) {
							if(event.strftime('%D')=='00')
							{
								$(this).html(event.strftime('Expire Today'));
							}  
							else
							{
								$(this).html(event.strftime('Expires in %D days'));
							}
						  });
						});
						</script>
                      <div class="comment-box-inner"><img src="<?php echo base_url();?>images/comment.png" width="12" height="12" alt="comment-icon" style=" margin-top:7px;"/></div>
                      <?php //echo base_url().'share_coupon/'.base64_encode($productCoupon[0]['coupon_id']).'/';class="fancybox fancybox.ajax" ?>
                      <div class="comment-box-inner" style="width:150px;"><a href="javascript:void(0);" id="cmntCount_<?php echo $productCoupon[0]['coupon_id']; ?>" name="commentContainer_<?php echo $productCoupon[0]['coupon_id']; ?>" class="openBox" ><span id="counter_<?php echo $productCoupon[0]['coupon_id']; ?>"><?php  echo $this->master_model->getRecordCount('tbl_coupon_comments',array('couponid'=>$productCoupon[0]['coupon_id']));  ?></span> add comments</a></div>
                      <div class="comment-box-inner" style="width:150px;">brand- 
                        <a href="<?php echo base_url();?>brand/<?php echo $productCoupon[0]['brand_slug'];?>/"><?php echo stripslashes(ucfirst($productCoupon[0]['brand_title']));?></a>
                      </div>
                    <?php if($this->session->userdata('login_id')!='')
					{?>
                    <div class="comment-box-inner" style="width:160px; float:right;" id="loadlikeunlikediv">
                   <?php
				   $coupon_count=$this->master_model->getRecordCount('tbl_save_master',array('tbl_save_master.couponid'=>$productCoupon[0]['coupon_id'],'tbl_save_master.coupon_login_id'=>$this->session->userdata('login_id')));
				if($coupon_count==0 && $this->session->userdata('login_id')!='')
				{?>
                    <a href="#" class="save_coupon" id="save_coupon" rel="<?php echo base64_encode($productCoupon[0]['coupon_id']);?>" >
                        <div class="product-save-in alreadydone" style="display:block;" id="coupon_<?php echo $productCoupon[0]['coupon_id'];?>" >
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
                         <a href="#" class="like_unlike" id="like_unlike" lang="<?php echo base64_encode(1);?>" rel="<?php echo $productCoupon[0]['coupon_id'];?>" title="Like Coupon">
                        <div class="LoadingImage" style="display:none;"><img src="<?php echo base_url();?>images/loading2.gif"/></div>
                        <div class="product-like-in">
                            <div class="product-like-out">
                           <img src="<?php echo base_url();?>images/like.png" width="17" height="24" alt="like" style=" margin-top:2px;"/>
                            </div>
                            <div class="product-like-out loadlikediv" id="like<?php echo $productCoupon[0]['coupon_id'];  ?>">
                            <?php  echo $like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$productCoupon[0]['coupon_id'],'like_id'=>'1'));?>
                            </div>
                            <div class="clr"></div>
                        </div>
                          <input type="hidden" id="txt_like<?php echo $productCoupon[0]['coupon_id'];?>" value="<?php echo $like_count ?>" />
                        </a>
                         <a href="#" class="like_unlike" id="like_unlike" lang="<?php echo base64_encode(0);?>" rel="<?php echo $productCoupon[0]['coupon_id'];?>" title="Unlike Coupon" >
                        <div class="product-unlike-in">
                            <div class="product-like-out" >
                            <img src="<?php echo base_url();?>images/unlike.png" width="17" height="24" alt="like" style=" margin-top:2px;"/>
                            </div>
                            <div class="product-like-out" id="unlike<?php echo $productCoupon[0]['coupon_id'];  ?>">
							<?php  echo $like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$productCoupon[0]['coupon_id'],'unlike_id'=>'1'));?></div>
                            <input type="hidden" id="txt_unlike<?php echo $productCoupon[0]['coupon_id'];?>" value="<?php echo $like_count ?>" />
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
                            <div class="product-like-out loadlikediv" id="like<?php echo $productCoupon[0]['coupon_id'];  ?>">
                            <?php  echo $like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$productCoupon[0]['coupon_id'],'like_id'=>'1'));?>
                            </div>
                            <div class="clr"></div>
                        </div>
                          <input type="hidden" id="txt_like<?php echo $productCoupon[0]['coupon_id'];?>" value="<?php echo $like_count ?>" />
                        </a>
                         <a href="#fade" class="initialism fade_open" title="Unlike Coupon">
                        <div class="product-unlike-in">
                            <div class="product-like-out" >
                            <img src="<?php echo base_url();?>images/unlike.png" width="17" height="24" alt="like" style=" margin-top:2px;"/>
                            </div>
                            <div class="product-like-out" id="unlike<?php echo $productCoupon[0]['coupon_id'];  ?>">
							<?php  echo $like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$productCoupon[0]['coupon_id'],'unlike_id'=>'1'));?></div>
                            <input type="hidden" id="txt_unlike<?php echo $productCoupon[0]['coupon_id'];?>" value="<?php echo $like_count ?>" />
                            <div class="clr"></div>
                        </div>
                        </a>
                     	<div class="clr"></div>
                    </div>
                    <?php }?>
                    <div class="clr"></div>
                  </div>
                  <div class="clr"></div>
                        <div class="comment-box " id="commentContainer_<?php echo $productCoupon[0]['coupon_id']; ?>" style="margin-top:10px;display:none;">
                        <div style="display:none;" id="divLoader_<?php echo $productCoupon[0]['coupon_id']; ?>" class="new-heading">
                            <div style="text-align:center;" class="new-heading-inner"> <img width="60" height="60" alt="myloader.gif" src="<?php echo base_url();?>images/myloader.gif"></div>
                          </div>
                         <fieldset style="border-color: #e5e5e5 !important; background-color: #fff; border-radius: 6px;">
                            <form name="postComment" method="post" action="" onsubmit="return false;">
                                  <span style="font-weight:bold;">Add Comment</span>
                                  <textarea id="couponComment_<?php echo $productCoupon[0]['coupon_id']; ?>" name="couponComment" rows="2" cols="5" class="texarea-select" placeholder="Leave your comment..." style="padding:1%;height:55px;"></textarea>
                                  <input type="hidden" value="<?php echo $productCoupon[0]['coupon_id']; ?>" id="txtCouponid_<?php echo $productCoupon[0]['coupon_id']; ?>" name="txtCouponid" />
                                  <input type="hidden" value="<?php echo $this->session->userdata('login_id'); ?>" id="txtSenderid_<?php echo $productCoupon[0]['coupon_id']; ?>" name="txtSenderid" />
                                  <span style="font-style:italic;">Post as <?php echo $this->session->userdata('user_slug'); ?></span>
                                  <div style="margin-top:6px; padding-right:6px; float:right; width:300px;" class="about-fildset">
                                    <input type="button" name="btnCancel" id="<?php echo $productCoupon[0]['coupon_id']; ?>" class="submit-button btnCancel" value="Cancel" style="float:right;height:34px; line-height:31px; padding:0px 10px;" />
                                    <input type="button" name="btnDoCmnt" id="<?php echo $productCoupon[0]['coupon_id']; ?>" class="submit-button btnDoCmnt" value="Post comment" style="float:right;margin-right:5px; height:34px; line-height:31px; padding:0px 10px;" />
                                    <div class="clr"></div>
                                  </div>
                                  <div class="clr"></div>
                                </form>
                            </fieldset>
                          <fieldset style="border-color: #e5e5e5 !important; background-color: #fff; border-radius: 6px;">
                            <legend>Showing 5 most recent comments</legend>
                            <?php      
							
							$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_coupon_comments.login_id');
							$this->db->select('COUNT(cmnt_id) TOTAL_REC')->from('tbl_coupon_comments')->where('couponid',$productCoupon[0]['coupon_id']);    
							$_queryResult = $this->db->get();
							$_commentData = $_queryResult->result_array();
				
							  $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_coupon_comments.login_id');
							  $this->db->select('*')->from('tbl_coupon_comments')->where('couponid',$productCoupon[0]['coupon_id'])->order_by('cmnt_id','DESC')->limit(5);
							  $queryResult = $this->db->get();
							  $commentData = $queryResult->result_array();
                              if(count($commentData) > 0) 
							  {     
                                echo ' <div id="postedComment_'.$productCoupon[0]['coupon_id'].'" style="overflow:auto;overflow-x:hidden;height:300px;">';
								foreach($commentData as $val) 
									{
										$id = $val['cmnt_id'];
										$couponid = $val['couponid'];
										 
										
									if($val['user_type']=='seller')
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
										 ?>
									<!--comments-->
									<div class="comments-box">
									  <div class="comments-box-left"><img src="<?php echo base_url().$imagePath;?>" width="36" height="36" alt="user"/></div>
									  <div class="comments-box-right" style="width:560px !important;">
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
                                   // echo $myPagination['page_links'];
								   if($_commentData[0]['TOTAL_REC']>5)
									{
									echo '<div class="active-inner" style="text-align:center;"><div class="more_div">
												<a href="javascript:void(0);">
													<div id="load_more_'.$id.'" id="more_tab_'.$id.'">
															<div class="show_more_cmnt" id="'.$id.'|'.$couponid.'">Load More Content</div>
													</div>
												</a>
												</div></div>';
									}
                                    echo '</div>';
                              }
                              else
                              {
                                    echo ' <div id="postedComment_'.$productCoupon[0]['coupon_id'].'"> <div class="product-right" style="width:100%!important;float:none!important;">
                                            <div class="product-right-innet-left">
                                              <div class="product-titme" style="color:#000;">No comment posted yet.</div>
                                               <div class="product-code">
                                                <div class="clr"></div>
                                              </div>
                                              <div class="clr"></div>
                                            </div></div></div>';
                              }?>
                          </fieldset>
                        </div>
                </div>
                <div class="clr"></div>
              </div>
        <!--main-box-->
         <input type="hidden" id="txtArray" value="<?php echo $productCoupon[0]['coupon_id'];?>" />
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
</div>
<!--inner-->
