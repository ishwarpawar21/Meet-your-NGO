<?php
if($this->session->userdata('email_id')=='' && $this->session->userdata('email_id')=='') 
{redirect(base_url());}
			$this->db->select('tbl_seller_details.addcoupon');
			$coupon_count=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$this->session->userdata('login_id')));	 
			$coupon_master_count=$this->master_model->getRecordCount('tbl_coupon_master',array('login_id'=>$this->session->userdata('login_id')));		 
			$remaincount=$coupon_count[0]['addcoupon']-$coupon_master_count;
			if($remaincount>0)
			{$remain_cnt=$remaincount;}
			else{$remain_cnt='0';}
			if($remain_cnt>0)
			{?>
			<div class="contain"> 
			<!--inner-->
			<div class="innar-page">
			<div class="profile-top">
			<?php //include('profile-header.php'); ?>
			</div>
            <div class="co-pages">
            <form method="post" id="coupon_submit">
        	<div class="new-coupon-left">
            	<div class="submit-heading">
                	<div class="about-inner-title">Submit a new coupon  <span class="title-arow"><img width="20" height="21" alt="arow" src="<?php echo base_url(); ?>images/title-arow-arb.png"></span></div>
              </div>
               <div class="about-form">
                <?php 
					if($this->session->flashdata('success')!=''){ ?> 
					<div class="right-message"><?php echo $this->session->flashdata('success'); ?></div>
					<?php } 
					if($this->session->flashdata('error')!='')
					{ ?> 
					 <div class="wrong-message"><?php echo $this->session->flashdata('success'); ?></div>
			   <?php } ?>
                	<!--fildset-->
                    <div class="about-fildset">
                    	<div class="new-coupon-text">ASIN :</div>
                    	<div class="about-fild">
                        	<div class="new-asin-left">
                             <input name="store" id="store" placeholder="Enter ASIN No" class="select-about" type="text" value="<?php if($items!=''){echo $items['Items']['Item']['ASIN'];}?>"/>
                             <div class="errr" style= " <?php if(form_error('store')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_store"><?php echo form_error('store'); ?></div>
			                 <?php if($error_message!=''){echo '<div class="errr">'.$error_message.'</div>'; }?>
                             </div>
                            <div class="new-asin-right">
                              <input class="btn-select-save submit-asin-code" name="btn_check" id="btn_check" value="Submit" type="submit" />
			                  <img src="<?php echo base_url(); ?>images/712.GIF" style="display:none;" id="asin"/>
                             </div>
                            <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <!--fildset-->
                    <?php
					if($items!='')
					{
			        ?>
                   <!-- this is all the hidden text box -->
                   <input type="hidden" name="product_details_url" id="product_details_url" value="<?php echo  $items['Items']['Item']['DetailPageURL']; ?>"/>
			       <input type="hidden" name="coupon_image" id="coupon_image" value="<?php echo $items['Items']['Item']['MediumImage']['URL']; ?>"/>
			       <input type="hidden" name="coupon_title" id="coupon_title" value="<?php if(isset($items['Items']['Item']['ItemAttributes']['Title'])){echo $items['Items']['Item']['ItemAttributes']['Title'];} ?>"/>
			       <input type="hidden" name="product_price" id="product_price" value="<?php if(isset($items['Items']['Item']['ItemAttributes']['ListPrice']['FormattedPrice'])){echo $items['Items']['Item']['ItemAttributes']['ListPrice']['FormattedPrice'];}else{if(isset($items['Items']['Item']['OfferSummary']['LowestNewPrice']['FormattedPrice'])){echo $items['Items']['Item']['OfferSummary']['LowestNewPrice']['FormattedPrice'];}else{if(isset($items['Items']['Item']['OfferSummary']['LowestUsedPrice']['FormattedPrice'])){echo $items['Items']['Item']['OfferSummary']['LowestUsedPrice']['FormattedPrice'];}else{echo '$0';}}}  ?>"/>
			       <input type="hidden" name="product_manufacturer" id="product_manufacturer" value="<?php if(isset($items['Items']['Item']['ItemAttributes']['Manufacturer'])){ echo $items['Items']['Item']['ItemAttributes']['Manufacturer']; } ?>" />
			       <input type="hidden" name="product_group" id="product_group" value="<?php if(isset($items['Items']['Item']['ItemAttributes']['ProductGroup'])){echo $items['Items']['Item']['ItemAttributes']['ProductGroup'];} ?>"/>
			       <input type="hidden" name="product_reviews" id="product_reviews" value="<?php if($reviews!=''){echo $reviews;}?>"/>
                    <!-- this is all the hidden text box -->
                    <div class="about-fildset">
                    	<div class="asin-product"><img src="<?php echo $items['Items']['Item']['MediumImage']['URL']; ?>" width="160" height="160" alt="product" /></div>
                        <div class="asin-product-right">
                        	<div class="asin-co-inner">
                        		<div class="asin-title">Amount : <span><?php if(isset($items['Items']['Item']['ItemAttributes']['ListPrice']['FormattedPrice'])){echo $items['Items']['Item']['ItemAttributes']['ListPrice']['FormattedPrice'];}else{if(isset($items['Items']['Item']['OfferSummary']['LowestNewPrice']['FormattedPrice'])){echo $items['Items']['Item']['OfferSummary']['LowestNewPrice']['FormattedPrice'];}else{if(isset($items['Items']['Item']['OfferSummary']['LowestUsedPrice']['FormattedPrice'])){echo $items['Items']['Item']['OfferSummary']['LowestUsedPrice']['FormattedPrice'];}else{echo '$0';}}}  ?></span> </div>
                           		<div class="asin-title">Manufacturer  : <span><?php if(isset($items['Items']['Item']['ItemAttributes']['Manufacturer'])){echo $items['Items']['Item']['ItemAttributes']['Manufacturer']; }else{ echo '-'; }?></span> </div>
                            	<div class="asin-title">ProductGroup  : <span><?php if(isset($items['Items']['Item']['ItemAttributes']['ProductGroup'])){echo $items['Items']['Item']['ItemAttributes']['ProductGroup']; }else{echo '-';} ?></span> </div>
                                <div class="clr"></div>    
                            </div>
                            <div class="asin-co-inner">
                            <div class="asin-co-title"><?php if(isset($items['Items']['Item']['ItemAttributes']['Title'])){echo $items['Items']['Item']['ItemAttributes']['Title'];}?></div>
                            </div>
                            
                            	<div class="asin-co-heading">Feature </div>
                             <?php 
								if(isset($items['Items']['Item']['ItemAttributes']['Feature']))
								{
								if(count($items['Items']['Item']['ItemAttributes']['Feature'])>1)
								{
								foreach($items['Items']['Item']['ItemAttributes']['Feature'] as $row)
								{
								echo ' <div class="asin-co-point">'.$row.'</div>.'; 
								?>
								<input type="hidden" name="coupon_desc" id="coupon_desc" value="<?php echo $row; ?>" />
								<?php
								}
								
								}
								else
								{
								echo $items['Items']['Item']['ItemAttributes']['Feature'];
								?>
								<input type="hidden" name="coupon_desc" id="coupon_desc" value="<?php echo $items['Items']['Item']['ItemAttributes']['Feature']; ?>" />
								<?php
								}
								}
								else
								{
								?>
								<input type="hidden" name="coupon_desc" id="coupon_desc" value=""/>
								<?php
								}
								?>
                            <div style="width:120px;" class="comment-box-inner"><a href="<?php echo $items['Items']['Item']['DetailPageURL']; ?>">View Details</a></div>
                          <div class="clr"></div>    
                        </div>
                        <div class="clr"></div>
                    </div>
                    <?php 
					 } 
					?>
                    <!--fildset-->
                    <div class="about-fildset">
                    	<div class="new-coupon-text">Code :</div>
                    	<div class="about-fild">
                        <input name="coupon_code" id="coupon_code" placeholder="Enter coupon code" class="select-coupons select-about" type="text" value="<?php echo set_value('coupon_code');?>" />
                        <div class="errr" style= " <?php if(form_error('coupon_code')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_coupon_code"><?php echo form_error('coupon_code'); ?></div>
                        </div>
                      <div class="clr"></div>
                    </div>
                    <!--fildset-->
                    <!--fildset-->
                    <div class="about-fildset">
                    	<div class="new-coupon-text">Discount :</div>
                    	<div class="about-fild">
                        	<div class="new-asin-discount">
                            <select class="new-asin-list" name="amount_type" id="amount_type">
                              <option value="price" <?php if(set_value('amount_type')=='Price'){echo 'selected="selected"';} ?>>Price</option>
                              <option value="%" <?php if(set_value('amount_type')=='%'){echo 'selected="selected"';} ?>>Percentage (%)</option>
			                </select>
                            </div>
                            <div class="new-asin-prices">
                              <input name="coupon_discount" id="coupon_discount" placeholder="Enter coupon Price" class="select-about" type="text" value="<?php echo  set_value('coupon_discount');?>"/>
                              <div class="errr" style= " <?php if(form_error('coupon_discount')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_coupon_discount"><?php echo form_error('coupon_discount'); ?></div>
                             </div>
                            <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <!--fildset-->
                    <!--fildset-->
                    <div class="about-fildset">
                    	<div class="new-coupon-text">Category :</div>
                    	<div class="about-fild">
                       <select class="new-asin-list1" name="cate_id" id="cate_id">
                        <option value="">Select</option>
                        <?php 
                        $this->db->order_by('category_name','ASC');
                        $category=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1','parent_id'=>'0'));
                        if(count($category)>0)
                        {
                        foreach($category as $rowcat)
                        {	 ?>
                        <option value="<?php echo $rowcat['category_id']; ?>" <?php if(set_value('cate_id')==$rowcat['category_id']){echo 'selected="selected"';}?>><?php echo $rowcat['category_name']; ?></option>
			      <?php } 
				       }
					?>
			           </select>
			         <div class="errr" style= " <?php if(form_error('cate_id')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_cate_id"><?php echo form_error('cate_id'); ?></div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <!--fildset-->
                    <!--fildset-->
                    <div class="about-fildset">
                    	<div class="new-coupon-text">Brands :</div>
                    	<div class="about-fild">
                        	<div class="new-asin-left">
                             <select class="new-asin-list1" style="width:259px;" name="brand_id" id="brand_id">
                                <option value="">Select</option>
                                <?php
                                $this->db->order_by('brand_title','ASC');
                                $brand_res=$this->master_model->getRecords('tbl_brand_master',array('login_id'=>$this->session->userdata('login_id')));
                                if(count($brand_res)>0)
                                {
                                foreach($brand_res as $rowbrand)
                                {	 
                                ?>
                                <option value="<?php echo $rowbrand['brand_id'];?>" <?php if(set_value('brand_id')==$rowbrand['brand_id']){echo 'selected="selected"';}?>><?php echo $rowbrand['brand_title'];?></option>
                                <?php 
                                }
                                }
                              ?>
                             </select>
                             <div class="errr" style= " <?php if(form_error('brand_id')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_brand_id"><?php echo form_error('brand_id'); ?></div>
                            </div>
                            <div class="new-asin-right"><div class="submit-addbrand"><a href="#fade" class="fade_open">Add Brand</a></div></div>
                            <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <!--fildset-->
                    <!--fildset-->
                    <div class="about-fildset">
                    	<div class="new-coupon-text">Expiration date :</div>
                    	<div class="about-fild">
                          <input name="exp_date" id="exp_date" placeholder="dd-mm-yy" class="select-about" type="text"  readonly="readonly" value="<?php echo set_value('exp_date');?>"/>
                          <div class="errr" style= " <?php if(form_error('exp_date')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_exp_date"><?php echo form_error('exp_date'); ?></div>
                         </div>
                        <div class="clr"></div>
                    </div>
                    <!--fildset-->
                    <!--fildset-->
                    <div class="about-fildset">
                    	<div class="new-coupon-text">&nbsp;</div>
                    	<div class="about-fild"> 
                        <div class="save-btn"> 
                          <input name="btn_coupon" id="btn_coupon" class=" btn-select-save" value="Submit" type="submit"  <?php if($items=='') {?>disabled="disabled" <?php } ?> />
                        </div> 
                        </div>
                       <div class="clr"></div>
                    </div>
                    <!--fildset-->
                 <div class="clr"></div>
                </div>
                
                <div class="clr"></div>
            </div>
            </form>
            <div class="new-coupon-right">
                    <div class="co-pages">
                        <div class="about-heading">
                	<div class="about-inner-title">Coupon Community  <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
              </div>
                      <div class="clr"></div>
                    </div>
                    
                    <div class="co-pages">
                    	
        <div class="coupons-heading-desk">When you submit a coupon on Coupon.com, everybody wins! Not only do you help others save money, but you feel good doing it. </div>
        <div class="coupons-heading"><img src="<?php echo base_url(); ?>images/commu.png" width="284" height="283" alt="img" /></div>
                         <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div>
                
                <div class="clr"></div>
            </div>
            
			<!--login-inner-->
			<div class="coupons-inner" style=" margin-left:0px;">
			<div class="login-top">
			<div class="coupons-corner"><img src="<?php echo base_url(); ?>images/login-corner.jpg" width="30" height="80" alt="img" /></div>
			<div class="coupons-inner-title">
			<div class="coupons-title-in">Submit a new coupon to <div class="clr"></div> <span>Coupon.com</span> </div>
			</div>
			<div class="clr"></div>    
			</div>
            
			<form method="post" id="coupon_submit">
			<div class="login-btm">
			<div class="login-container">
			<div class="coupons-fild-text">ASIN </div>
			<div class="co-fild-coupons">
			  <input name="store" id="store" placeholder="Enter ASIN No" class="select-coupons" type="text" value="<?php if($items!=''){echo $items['Items']['Item']['ASIN'];}?>" style="width:73%;" />
			  <input class="btn-select-save" name="btn_check" id="btn_check" value="Submit" type="submit" style="width:20%; height:42px;" />
			<img src="<?php echo base_url(); ?>images/712.GIF" style="display:none;" id="asin"/>
			<div class="clr"></div>
			<div class="errr" style= " <?php if(form_error('store')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_store"><?php echo form_error('store'); ?></div>
			<?php if($error_message!=''){echo '<div class="errr">'.$error_message.'</div>'; }?>
			</div>
			<?php
			if($items!='')
			{
			?>
			<input type="hidden" name="product_details_url" id="product_details_url" value="<?php echo  $items['Items']['Item']['DetailPageURL']; ?>"/>
			<input type="hidden" name="coupon_image" id="coupon_image" value="<?php echo $items['Items']['Item']['MediumImage']['URL']; ?>"/>
			<input type="hidden" name="coupon_title" id="coupon_title" value="<?php if(isset($items['Items']['Item']['ItemAttributes']['Title'])){echo $items['Items']['Item']['ItemAttributes']['Title'];} ?>"/>
			<input type="hidden" name="product_price" id="product_price" value="<?php if(isset($items['Items']['Item']['ItemAttributes']['ListPrice']['FormattedPrice'])){echo $items['Items']['Item']['ItemAttributes']['ListPrice']['FormattedPrice'];}else{if(isset($items['Items']['Item']['OfferSummary']['LowestNewPrice']['FormattedPrice'])){echo $items['Items']['Item']['OfferSummary']['LowestNewPrice']['FormattedPrice'];}else{if(isset($items['Items']['Item']['OfferSummary']['LowestUsedPrice']['FormattedPrice'])){echo $items['Items']['Item']['OfferSummary']['LowestUsedPrice']['FormattedPrice'];}else{echo '$0';}}}  ?>"/>
			<input type="hidden" name="product_manufacturer" id="product_manufacturer" value="<?php if(isset($items['Items']['Item']['ItemAttributes']['Manufacturer'])){ echo $items['Items']['Item']['ItemAttributes']['Manufacturer']; } ?>" />
			<input type="hidden" name="product_group" id="product_group" value="<?php if(isset($items['Items']['Item']['ItemAttributes']['ProductGroup'])){echo $items['Items']['Item']['ItemAttributes']['ProductGroup'];} ?>"/>
			<input type="hidden" name="product_reviews" id="product_reviews" value="<?php if($reviews!=''){echo $reviews;}?>"/>
			<div class="coupons-fild-text">Product Image</div>
			<div class="co-fild-coupons" style="float:left;">
			<img src="<?php echo $items['Items']['Item']['MediumImage']['URL']; ?>" />
			</div>
			<div class="co-fild-coupons" style="float:left; margin-left:10px;"><strong>Amount</strong> : 
			<?php if(isset($items['Items']['Item']['ItemAttributes']['ListPrice']['FormattedPrice'])){echo $items['Items']['Item']['ItemAttributes']['ListPrice']['FormattedPrice'];}else{if(isset($items['Items']['Item']['OfferSummary']['LowestNewPrice']['FormattedPrice'])){echo $items['Items']['Item']['OfferSummary']['LowestNewPrice']['FormattedPrice'];}else{if(isset($items['Items']['Item']['OfferSummary']['LowestUsedPrice']['FormattedPrice'])){echo $items['Items']['Item']['OfferSummary']['LowestUsedPrice']['FormattedPrice'];}else{echo '$0';}}}  ?></div>
			<div class="co-fild-coupons" style="float:left; margin-left:10px;"><strong>Manufacturer</strong> : <?php if(isset($items['Items']['Item']['ItemAttributes']['Manufacturer'])){echo $items['Items']['Item']['ItemAttributes']['Manufacturer']; }?></div>
			<div class="co-fild-coupons" style="float:left; margin-left:10px;"><strong>ProductGroup</strong> : <?php if(isset($items['Items']['Item']['ItemAttributes']['ProductGroup'])){echo $items['Items']['Item']['ItemAttributes']['ProductGroup']; } ?></div>
			<div class="co-fild-coupons" style="float:left; margin-left:10px;"><?php if(isset($items['Items']['Item']['ItemAttributes']['Title'])){echo $items['Items']['Item']['ItemAttributes']['Title'];}?></div>
			<div class="clr"></div>
			<div class="coupons-fild-text">Feature</div>
			<div class="co-fild-coupons" style="float:left; margin-left:10px;">
			<?php 
			if(isset($items['Items']['Item']['ItemAttributes']['Feature']))
			{
			if(count($items['Items']['Item']['ItemAttributes']['Feature'])>1)
			{
			foreach($items['Items']['Item']['ItemAttributes']['Feature'] as $row)
			{
			echo '<li>'.$row.'</li>.'; 
			?>
			<input type="hidden" name="coupon_desc" id="coupon_desc" value="<?php echo $row; ?>" />
			<?php
			}
			
			}
			else
			{
			echo $items['Items']['Item']['ItemAttributes']['Feature'];
			?>
			<input type="hidden" name="coupon_desc" id="coupon_desc" value="<?php echo $items['Items']['Item']['ItemAttributes']['Feature']; ?>" />
			<?php
			}
			}
			else
			{
			?>
			<input type="hidden" name="coupon_desc" id="coupon_desc" value=""/>
			<?php
			}
			?>
			</div>
			<div class="clr"></div>
			<div class="coupons-fild-text">
			  <a href="<?php echo $items['Items']['Item']['DetailPageURL']; ?>" target="_new">View Details</a>            </div>
			<?php } ?>
			<div class="coupons-fild-text">Code</div>
			<div class="co-fild-coupons">
			<input name="coupon_code" id="coupon_code" placeholder="Enter coupon code" class="select-coupons" type="text" value="<?php echo set_value('coupon_code');?>" />
			<!--<div class="errr">Please enter the coupon code</div>-->
			<div class="errr" style= " <?php if(form_error('coupon_code')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_coupon_code"><?php echo form_error('coupon_code'); ?></div>
			</div>
			<div class="coupons-fild-text">Discount</div>
			<div class="co-fild-coupons">
			<select class="select-coupons" name="amount_type" id="amount_type" style="width:40%;">
			<option value="price" <?php if(set_value('amount_type')=='Price'){echo 'selected="selected"';} ?>>Price</option>
			<option value="%" <?php if(set_value('amount_type')=='%'){echo 'selected="selected"';} ?>>Percentage (%)</option>
			</select>
			<input name="coupon_discount" id="coupon_discount" placeholder="Enter coupon Price" class="select-coupons" type="text" style="width:53%;" value="<?php echo  set_value('coupon_discount');?>"/>
			<div class="errr" style= " <?php if(form_error('amount_type')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_amount_type"><?php echo form_error('amount_type'); ?></div>
			<div class="errr" style= " <?php if(form_error('coupon_discount')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_coupon_discount"><?php echo form_error('coupon_discount'); ?></div>
			</div>
			<div class="coupons-fild-text">Category</div>
			<div class="co-fild-coupons">
			<select class="select-coupons" name="cate_id" id="cate_id">
			<option value="">Select</option>
			<?php 
			$this->db->order_by('category_name','ASC');
			$category=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1','parent_id'=>'0'));
			if(count($category)>0)
			{
			foreach($category as $rowcat)
			{	 ?>
			<option value="<?php echo $rowcat['category_id']; ?>" <?php if(set_value('cate_id')==$rowcat['category_id']){echo 'selected="selected"';}?>><?php echo $rowcat['category_name']; ?></option>
			<?php } }?>
			</select>
			<div class="errr" style= " <?php if(form_error('cate_id')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_cate_id"><?php echo form_error('cate_id'); ?></div>
			</div>
			<div class="coupons-fild-text" style="float:left;">Brands</div>
			<div class="coupons-fild-text" style="float:left; margin-left:10px;">
			<a class="initialism fade_open btn btn-success" href="#fade">Add Brand</a>
			</div>
			<div class="co-fild-coupons">
			<select class="select-coupons" name="brand_id" id="brand_id">
			<option value="">Select</option>
			<?php
			$this->db->order_by('brand_title','ASC');
			$brand_res=$this->master_model->getRecords('tbl_brand_master',array('login_id'=>$this->session->userdata('login_id')));
			if(count($brand_res)>0)
			{
			foreach($brand_res as $rowbrand)
			{	 
			?>
			<option value="<?php echo $rowbrand['brand_id'];?>" <?php if(set_value('brand_id')==$rowbrand['brand_id']){echo 'selected="selected"';}?>><?php echo $rowbrand['brand_title'];?></option>
			<?php 
			}
			}
			?>
			</select>
			<div class="errr" style= " <?php if(form_error('brand_id')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_brand_id"><?php echo form_error('brand_id'); ?></div>
			</div>
			<div class="coupons-fild-text">Expiration date.</div>
			<div class="co-fild-coupons">
			<input name="exp_date" id="exp_date" placeholder="dd-mm-yy" class="select-coupons" type="text"  readonly="readonly" value="<?php echo set_value('exp_date');?>"/></div>
			<div class="errr" style= " <?php if(form_error('exp_date')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_exp_date"><?php echo form_error('exp_date'); ?></div>
			<div class="co-fild-coupons-last">
			<input name="btn_coupon" id="btn_coupon" class="btn-select-login" value="Submit" type="submit"  <?php if($items=='') {?>disabled="disabled" <?php } ?> /></div>
			<div class="clr"></div>
			</div>
			<div class="clr"></div>
			</div>
			</form>
			<div class="coupons-tearm">Please only submit publicly available coupon codes and not private or internal company codes. When in doubt, please obtain permission from the merchant first. See our <a href="#">Terms and Conditions</a> for more information regarding user generated content. Thank you very much! </div>
			<div class="clr"></div>
			</div>
			<!--login-inner-->
			<!--right-->
			<div class="coupons-right" style="width:668px; margin-left:60px;">
            <div class="coupons-right-insite">
				<div class="coupons-heading" style="font-family:'Open Sans'; font-size:26px; color:#23a2d8;">Coupon Community</div>
				<div class="coupons-heading-desk" style="width:380px; padding-top:30px; float:left;">When you submit a coupon on Coupon.com, everybody wins! Not only do you help others save money, but you feel good doing it.</div>
				<div class="coupons-heading" style=" float:right; width:198px; padding-right:20px;"><img src="<?php echo base_url(); ?>images/commu.png" width="198" height="199" alt="img" /></div>
			<div class="clr"></div>
            </div>
            <!--<div><img src="<?php echo base_url(); ?>images/coupon-shadow.jpg" width="668" height="14" style=" margin-top:1px; position:absolute;" alt="img" /></div>-->
			</div>
			<!--right-->
			<div class="clr"></div>
			</div>
			<!--inner--> 
			</div>
			<?php }
			else {?>
			<div class="contain"> 
			<!--inner-->
			<div class="innar-page">
			<div class="profile-top">
			<?php //include('profile-header.php'); ?>
			</div>
			<!--login-inner-->
			<div class="">
            
			<!--<div class="">Hello, you don't have permission to add coupon. If you want to add coupon then please contact Admin for that. Thank you very much!  </div>-->
            
            <div class="coupons-right" style="width:800px; margin-left:185px;">
        <div class="coupons-heading-desk" style=" float:left; width:380px; padding-top:20px; padding-right:30px;">
        	<div class="coupons-heading">Coupon Permission</div>
        Hello, you don't have permission to add coupon. If you want to add coupon then please contact Admin for that. Thank you very much!  </div>
        <div class="coupons-heading" style="width:284px; float:left;"><img src="<?php echo base_url(); ?>images/limit.png" width="284" height="283" alt="img" /></div>
        <div class="clr"></div>
      </div>
            
            
			<div class="clr"></div>
			</div>
			<!--login-inner-->
			<div class="clr"></div>
			</div>
			<!--inner--> 
			</div>
			<?php }?>
<!--popup-->
<div id="fade" class="well">
  <?php 
     $brand_check=$this->master_model->getRecords('tbl_brand_master',array('login_id'=>$this->session->userdata('login_id'))); 
	 $brand_seller=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$this->session->userdata('login_id')));
	 if(count($brand_check)<$brand_seller[0]['brandaccess'])
	 {
  ?>
        <input type="hidden" name="txt_brand"  id="txt_brand" value="<?php echo count($brand_check); ?>"/>
        <input type="hidden" name="txt_seller"  id="txt_seller" value="<?php echo $brand_seller[0]['brandaccess']; ?>"/>
        <div id="check_brand">
        <div class="top-close-area">
            <div class="top-close-title">Add Brands</div>
            <div class="top-close-right"><button class="fade_close button-close "></button></div>
            <div class="clr"></div>
        </div>
        <form method="post" name="new_brand" id="new_brand" action="<?php echo base_url().'ajax/addbrand/'?>" enctype="multipart/form-data" class="new_brand">
          <div class="inner-form-area">
            <!--left-site-->
                <div class="col-md-11">
                <div class="panel panel-cascade" style="box-shadow:none; background:none;">
                     <div class="ro">
                        <div class="form-group">
                           <div class="right-col">
                                <div class="co-pages fild-text-popup">Brand Name</div>
                                <div class="co-pages">
                                   <input type="text" id="brand_title" name="brand_title" class="form-control input-small">
                                   <div class="errr" style="display:none;" id="error_brand_title"></div>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                            <div class="left-col">
                                <div class="co-pages fild-text-popup">Brand Description</div>
                                <div class="co-pages">
                                   <textarea type="text" class="form-control input-small" name="brand_desc" id="brand_desc" style="width: 264px; height: 54px;"></textarea>
                                  <div class="errr" style="display:none;" id="error_brand_desc"></div>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                            <div class="right-col">
                                <div class="co-pages fild-text-popup">Brand Logo</div>
                                <div class="co-pages">
                                  <div id="imageloadbutton">
                                     <input type="file" id="brand_logo" name="brand_logo" class="form-control input-small">
                                  </div>
                                  <div class="errr" style="display:none;" id="error_brand_logo"></div>
                                  <div id='imageloadstatus' style='display:none'><img src="<?php echo base_url(); ?>images/loader.gif" alt="Uploading...."/></div>
                                 </div>
                                <div class="clr"></div>
                                <div id='preview'></div>
                            </div>
                            <div class="clr"></div>
                            <div class="left-col">
                                <div class="co-show-btn"><div class="co-pages">
                                <input type="submit" name="submit_btn" id="submit_btn" class="btn btn-success btn-animate-demo" value="Add Brand" />
                                <!--<a class="" href="#"><i class="fa fa-check"></i> Add Student</a>-->
                                </div></div>
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
        <div class="top-close-area" id="brand_limit" style="display:none;">
          <div class="top-close-title">You have reached a limit for adding brands, for adding more brands please contact to admin.</div>
          <div class="top-close-right"><button class="fade_close button-close "></button></div>
          <div class="clr"></div>
        </div>
    <?php 
	}
	else
	{
   ?>
    <div class="top-close-area">
      <div class="top-close-title">You have reached a limit for adding brands, for adding more brands please contact to admin.</div>
      <div class="top-close-right"><button class="fade_close button-close "></button></div>
      <div class="clr"></div>
    </div>
    <?php
	}
	?>
</div>
<style>
.preview
{
width:200px;
border:solid 1px #dedede;
padding:10px;
}
#preview
{
color:#cc0000;
font-size:12px
}
</style>
<!--popup-->
<link href="<?php echo base_url(); ?>popup/css/popup.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>popup/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>popup/js/jquery.popupoverlay.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>popup/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>datepicker/css/zebra_datepicker.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>datepicker/javascript/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.wallform.js"></script>
<script language="javascript">
$('#coupon_submit').submit(function(){
	  $('#btn_check').hide();
	  $('#asin').show();
 });
 $(document).ready(function(event){
 $('#exp_date').Zebra_DatePicker({
	 format: 'd-m-Y',
	 direction:1,
   });
 $('#fade').popup({
      transition: 'all 0.3s',
	  autozindex: true,
    }); 
 $('#submit_btn').click(function(){
	 if($('#brand_title').val()=='')
	 {
		$('#error_brand_title').show();
		$('#error_brand_title').fadeIn(3000);	
		document.getElementById('error_brand_title').innerHTML="Name field is required.";
		setTimeout(function(){
			$('#brand_title').css('border-color','#dddfe0');
			$('#error_brand_title').fadeOut('slow');
							
		},3000);
		return false; 
	 }
	 else if($('#brand_desc').val()=='')
	 {
		$('#error_brand_desc').show();
		$('#error_brand_desc').fadeIn(3000);	
		document.getElementById('error_brand_desc').innerHTML="Description field is required.";
		setTimeout(function(){
			$('#brand_desc').css('border-color','#dddfe0');
			$('#error_brand_desc').fadeOut('slow');
							
		},3000);
		return false; 
	 }
	 else if($('#brand_logo').val()=='')
	 {
		$('#error_brand_logo').show();
		$('#error_brand_logo').fadeIn(3000);	
		document.getElementById('error_brand_logo').innerHTML="Please upload logo";
		setTimeout(function(){
			$('#brand_logo').css('border-color','#dddfe0');
			$('#error_brand_logo').fadeOut('slow');
							
		},3000);
		return false; 
	 }
	 else
	 {
		$("#new_brand").ajaxForm({
			beforeSubmit:function(){ 
			  $("#imageloadstatus").show();
			  $("#imageloadbutton").hide();
			}, 
			success:function(){
				 $.ajax({
					  url:site_url+'ajax/brandshow/',
					  type:'POST',
					  success:function(res)
					  {   
						 $('#brand_id').html(res); 
					  }
				   });
			  $("#imageloadstatus").hide();
			  $("#imageloadbutton").show();
			}, 
			error:function(){ 
			  $("#imageloadstatus").hide();
			  $("#imageloadbutton").show();
			} 
		}).submit();
		return false;	
	  }
   });

 });


</script>