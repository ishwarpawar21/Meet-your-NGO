<?php
if($this->session->userdata('email_id')=='' && $this->session->userdata('email_id')=='') 
{redirect(base_url());}?>
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
                	<div class="about-inner-title">Update Coupon  
                    	<span  style="padding-left:535px; color:#fff;">
                        <a href="<?php echo base_url(); ?>seller/profile/" style="text-decoration:none;" title="Back">Back</a>
                    	</span>
                    </div>
              </div>
               <div class="about-form">
                <?php 
					if($this->session->flashdata('success')!=''){ ?> 
					<div class="right-message"><?php echo $this->session->flashdata('success'); ?></div>
					<?php } 
					if($this->session->flashdata('error')!='')
					{ ?> 
					 <div class="err-message"><?php echo $this->session->flashdata('error'); ?></div>
			   		<?php } 
			   		if($error!='')
			   		{?>
				 	<div class="err-message"><?php echo $error; ?></div>
					<?php	}?>
                	<!--fildset-->
                    
                    <!--fildset-->
                    <div class="about-fildset">
                    	<div class="asin-product"><img src="<?php echo $fetch_coupon[0]['coupon_image'];?>" width="160" height="160" alt="product" /></div>
                        <div class="asin-product-right">
                        	<div class="asin-co-inner">
                            <div class="asin-title">ASIN : <span><?php echo $fetch_coupon[0]['product_asin_no'];?></span> </div>
                        		<div class="asin-title">Amount : <span>  <input name="product_price" id="product_price" placeholder="Coupon price" class="select-coupons select-about" type="text" value="<?php echo $fetch_coupon[0]['product_price'];?>"  style="width:20%;"/>
                                <div class="errr" style= " <?php if(form_error('product_price')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_product_price"><?php echo form_error('product_price'); ?></div>
                                </span> </div>
                           		<div class="asin-title">Manufacturer  : <span><?php echo $fetch_coupon[0]['product_manufacturer'];?></span> </div>
                            	<div class="clr"></div>    
                            </div>
                            <div class="asin-co-inner">
                            <div class="asin-co-title">
                            <textarea name="coupon_title" id="coupon_title" class="texarea-select" cols="" rows=""><?php echo $fetch_coupon[0]['coupon_title'];?></textarea>
                            <div class="errr" style= " <?php if(form_error('coupon_title')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_coupon_title"><?php echo form_error('coupon_title'); ?></div>
                            </div>
                            </div>
                            <div class="asin-co-heading">Feature </div>
                            <textarea name="coupon_desc" id="coupon_desc" class="texarea-select" cols="" rows=""><?php echo $fetch_coupon[0]['coupon_desc'];?></textarea>
                            <div class="errr" style= " <?php if(form_error('coupon_desc')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_coupon_desc"><?php echo form_error('coupon_desc'); ?></div>
						    <div style="width:120px;" class="comment-box-inner"><a href="<?php echo $fetch_coupon[0]['product_details_url']; ?>" target="_blank">View Details</a></div>
                          <div class="clr"></div>    
                        </div>
                        <div class="clr"></div>
                    </div>
                    <!--fildset-->
                    <div class="about-fildset">
                    	<div class="new-coupon-text">Code :</div>
                    	<div class="about-fild">
                        <input name="coupon_code" id="coupon_code" placeholder="Enter coupon code" class="select-coupons select-about" type="text" value="<?php echo $fetch_coupon[0]['coupon_code'];?>" />
                        <div class="errr" style= " <?php if(form_error('coupon_code')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_coupon_code"><?php echo form_error('coupon_code'); ?></div>
                        </div>
                      <div class="clr"></div>
                    </div>
                    <!--fildset-->
                    <?php  
					   $pos = strpos($fetch_coupon[0]['coupon_discount'],'%');
					   if($pos == false)
						{
						$amount_type="Price";	
						$new_pos= number_format($fetch_coupon[0]['coupon_discount']);
						}
						else
						{
						$amount_type="%";	
					    $new_pos1=explode('%',$fetch_coupon[0]['coupon_discount']);
						$new_pos=$new_pos1[0];
						}?>
                    <!--fildset-->
                    <div class="about-fildset">
                    	<div class="new-coupon-text">Discount :</div>
                    	<div class="about-fild">
                        	<div class="new-asin-discount">
                            <select class="new-asin-list" name="amount_type" id="amount_type" >
                              <option value="price" <?php if($amount_type=='Price'){echo 'selected="selected"';} ?>>Price</option>
                              <option value="%" <?php if($amount_type=='%'){echo 'selected="selected"';} ?>>Percentage (%)</option>
			                </select>
                            </div>
                            <div class="new-asin-prices">
                              <input name="coupon_discount" id="coupon_discount" placeholder="Enter coupon Price" class="select-about" type="text" value="<?php echo $new_pos;?>"/>
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
                        <option value="">Select Category</option>
                        <?php 
                        $this->db->order_by('category_name','ASC');
                        $category=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1','parent_id'=>'0'));
                        if(count($category)>0)
                        {
                        foreach($category as $rowcat)
                        {	 ?>
                        <option value="<?php echo $rowcat['category_id']; ?>" <?php if($fetch_coupon[0]['coupon_cat_id']==$rowcat['category_id']){echo 'selected="selected"';}?>><?php echo $rowcat['category_name']; ?></option>
			      <?php } }?>
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
                             <select class="new-asin-list1" name="brand_id" id="brand_id">
                                <option value="">Select Brand</option>
                                <?php
                                $this->db->order_by('brand_title','ASC');
                                $brand_res=$this->master_model->getRecords('tbl_brand_master',array('login_id'=>$this->session->userdata('login_id')));
                                if(count($brand_res)>0)
                                {
                                foreach($brand_res as $rowbrand)
                                {?>
                                <option value="<?php echo $rowbrand['brand_id'];?>" <?php if($fetch_coupon[0]['coupon_brand_id']==$rowbrand['brand_id']){echo 'selected="selected"';}?>><?php echo $rowbrand['brand_title'];?></option>
                                <?php }}?>
                             </select>
                             <div class="errr" style= " <?php if(form_error('brand_id')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_brand_id"><?php echo form_error('brand_id'); ?></div>
                             <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <!--fildset-->
                    <!--fildset-->
                    <div class="about-fildset">
                    	<div class="new-coupon-text">Expiration date :</div>
                    	<div class="about-fild">
                          <input name="exp_date" id="exp_date" placeholder="dd-mm-yy" class="select-about" type="text"  readonly="readonly" value="<?php echo $fetch_coupon[0]['coupon_expirydate'];?>"/>
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
                        <input name="btn_update_coupon" id="btn_update_coupon" class=" btn-select-save" value="Update" type="submit"  />
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
        	<div class="clr"></div>
			</div>
			<!--inner--> 
			</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>datepicker/css/zebra_datepicker.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>datepicker/javascript/zebra_datepicker.js"></script>
<!--<script type="text/javascript" src="<?php //echo base_url(); ?>js/jquery.wallform.js"></script>-->
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
 });
</script>