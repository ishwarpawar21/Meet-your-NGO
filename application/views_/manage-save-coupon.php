<div class="contain"> 
  <!--inner-->
  <div class="innar-page"> 
    <!--profile-inner--> 
    <!--my-profile-->
    <div class="my-profile-outer"> 
      <!--profile-left-->
      <div class="my-profile-left">
        <div class="active-inner">
          <div class="new-heading">
            <div class="new-heading-inner">
              <div class="new-heading-main-head"><img src="<?php echo base_url(); ?>images/se-icon.jpg" width="30" height="20" alt="icon" /> </div>
              <div class="new-heading-main-head-left" >Save Coupon</div>
              <!--<div class="new-heading-main-head-right">There are currently <span></span> active brand</div>-->
              <div class="clr"></div>
            </div>
          </div>
          <div class="clr"></div>
        </div>
  <?php if($this->session->flashdata('success')){?><div class="right-message" ><?php echo $this->session->flashdata('success'); ?></div> <?php } ?>
  <?php if($this->session->flashdata('error')){?><div class="err-message" ><?php echo $this->session->flashdata('error'); ?></div> <?php } ?>
        <div class="active-inner"> 
	      <div class="quali-inner">
        	<!--inner-->
            <div class="quali-title">
            	<div class="quali-title-in" style="width:200px;">Title</div>
                <div class="quali-title-in" style="width:120px;">Manufacturer</div>
                <div class="quali-title-in" style="width:150px;">Price</div>
                <div class="quali-title-in" style="width:200px;">Image</div>
                <div class="quali-title-in" style="width:80px; background:none;">Action</div>
                <div class="clr"></div>
            </div>
            <!--inner-->
            <!--btm-->
        <?php
		if($this->uri->segment('3')=='')
		{$page='0';}
		else
		{$page=$this->uri->segment('3');}
		if(count($fetch_manage_save_coupon)>0)
		{	 
			foreach ($fetch_manage_save_coupon as $savecoupon)
			{
			?>
            <div class="quali-btm">
               <div class="quali-title-out" style="width:200px; text-align:center;"><?php echo stripslashes(substr(strip_tags($savecoupon['coupon_title'],'<p>'),0,70)); ?></div>
              <div class="quali-title-out" style="width:120px;text-align:center;"><?php echo $savecoupon['product_manufacturer'];?></div>
              <div class="quali-title-out" style="width:150px;text-align:center;"><?php echo $savecoupon['product_price'];?></div>
              <div class="quali-title-out" style="width:200px; text-align:center;">
              <img src="<?php echo $savecoupon['coupon_image'];?>" height="50" width="50" title=<?php echo "Coupon Image"; ?> /></div>   
              <div class="quali-title-out" style="width:80px; text-align:center; background:none;">
              		<div class="quali-save"><a href="<?php echo base_url().'seller/savecoupon-delete/'.$page.'/'.base64_encode($savecoupon['coupon_id']);?>" onclick="javascript : return deletconfirm();"><i class="fa fa-times" style=" margin-top:3px; margin-left:-1px;" title="Delete"></i></a></div>
                	<div class="clr"></div>
              </div>
                <div class="clr"></div>
          </div>
            <!--btm-->
            <div class="clr"></div>
            <?php 	 }
			echo $links;
			}else{ ?>           
           <tr>
           <td colspan="9"><div class="alert alert-danger" style="text-align:center;">No Data Found.</div></td>
           </tr>
           <?php }?>
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
    <!--my-profile--> 
    
    <!--profile-inner-->
    <div class="clr"></div>
  </div>
    <!--inner--> 
</div>
<!--Popup Div Start-->

<!--Popup Div End-->
<!--Popup JS & CSS Start-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/front-validation.js"></script>
<!--Popup JS & CSS End-->