	<?php
			$this->db->select('tbl_seller_details.brandaccess');
			$coupon_count_brand=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$this->session->userdata('login_id')));	 
			$coupon_master_brandcount=$this->master_model->getRecordCount('tbl_brand_master',array('login_id'=>$this->session->userdata('login_id')));		 
			$remainbrandcount=$coupon_count_brand[0]['brandaccess']-$coupon_master_brandcount;
			if($remainbrandcount>0)
			{$remain_brndcnt=$remainbrandcount;}
			else{$remain_brndcnt='0';}
    ?>
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
      <div class="my-profile-left">
        
        <div class="active-inner">
          <div class="new-heading">
            <div class="new-heading-inner">
             <div class="new-heading-main-head"><img src="<?php echo base_url(); ?>images/se-icon.jpg" width="30" height="20" alt="icon" /> </div>
             <div class="new-heading-main-head-left">Active Brand</div>
             <div class="new-heading-main-head-right">
             <?php if($remain_brndcnt=='0'){ ?>
             You have reached a limit for adding brands, Please contact to admin.
             <?php }else {?>
             <div class="submit-addbrand">
<!--             <a href="<?php //echo base_url('seller/addbrand');?>" title="Add Brand" class="fancybox fancybox.ajax">Add Brand</a>-->
             <a href="<?php echo base_url('seller/addbrand');?>" title="Add Brand" >Add Brand</a>
             </div>
             <?php }?>
             </div>
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
                <div class="quali-title-in" style="width:200px;">Description</div>
                <div class="quali-title-in" style="width:200px;">Image</div>
                <div class="quali-title-in" style="width:200px; background:none;">Action</div>
                <div class="clr"></div>
            </div>
            <!--inner-->
            <!--btm-->
            <?php
		//$login_id =$this->session->userdata('login_id');
		if(count($fetch_manage_brand)>0)
		{	 
	   	  foreach ($fetch_manage_brand as $brand)
			 {
			?>
            <div class="quali-btm">
              <div class="quali-title-out" style="width:200px;text-align:center;"><?php echo $brand['brand_title'];?></div>
              <div class="quali-title-out" style="width:200px; text-align:center;"><?php echo stripslashes(substr(strip_tags($brand['brand_desc'],'<p>'),0,60)); ?></div>
              <div class="quali-title-out" style="width:200px; text-align:center;"><img src="<?php echo base_url().'uploads/brand/'.$brand['brand_image']; ?>" height="50" width="50" title=<?php $brand['brand_image']; ?> /></div>   
              <div class="quali-title-out" style="width:200px; text-align:center; background:none;">
              		<div class="quali-save"><a href="<?php echo base_url().'seller/updatebrand/'.base64_encode($brand['brand_id']);?>"><i class="fa fa-edit" title="Edit" style=" margin-top:3px;"></i></a></div>
                	<div class="quali-save"><a href="<?php echo base_url().'seller/deletebrand/'.base64_encode($brand['brand_id']).'/'.base64_encode($brand['brand_image']);?>" onclick="javascript : return deletconfirm();"><i class="fa fa-times" style=" margin-top:3px; margin-left:-1px;" title="Delete"></i></a></div>
                	<div class="clr"></div>
              </div>
              
                <div class="clr"></div>
          </div>
            <!--btm-->
            <div class="clr"></div>
           
            <?php 	 
			 }
	}
	else
		{ ?>           
           <tr>
          <td colspan="9"><div class="alert alert-danger" style="text-align:center;">No Data Found.</div></td>
            </tr>
         <?php
		  }
	  
	  echo $links;
	  ?>
            
            
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